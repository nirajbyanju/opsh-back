<?php

namespace App\Services;

use App\Models\vacancy\CompanyProfile;
use App\Models\User;


class CompanyProfileService
{

    public function CreateCompanyProfile(array $data)
    {
        $user = User::find($data['createdBy']);
        $userRoles = $user->roles()->pluck('name')->toArray();
        $data['status']  = 0;
        if (in_array('Admin', $userRoles) || in_array('Super Admin', $userRoles)) {
            $data['status']  = 1;
        }

        $mappedData = [
            'company_name' => $data['companyName'] ?? null,
            'category_id' => $data['categoryId'] ?? null,
            'email' => $data['email'] ?? null,
            'phone_number' => $data['phoneNumber'] ?? null,
            'website' => $data['website'] ?? null,
            'location' => $data['location'] ?? null,
            'established' => $data['established'] ?? null,
            'team_size' => $data['teamSize'] ?? null,
            'description' => $data['description'] ?? null,
            'created_by' => $data['createdBy'] ?? null,
            'verified_by' => $data['verifiedBy'] ?? null,
            'status' => $data['status'] ?? null,
            'verified_at' => $data['verifiedAt'] ?? null,
        ];

        if (isset($data['logo']) && $data['logo']->isValid()) {
            $file = $data['logo'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('logos'), $filename);

            // Add the logo URL to the mapped data
            $mappedData['logo'] = asset('logos/' . $filename); // Use asset() to generate a linkable URL
        } else {
            $mappedData['logo'] = $data['logo'] ?? null;
        }

        $companyProfile = CompanyProfile::create($mappedData);

        // Retrieve the created profile with the associated category
        return CompanyProfile::with('category')->find($companyProfile->id);
    }

    public function listActiveCompanyProfile($request)
    {
        // Set default values and validate order, limit, and page
        $orderBy = in_array(strtoupper($request->get('order_by')), ['ASC', 'DESC']) ? strtoupper($request->get('order_by')) : 'DESC';
        $limit = is_numeric($request->get('limit')) ? $request->get('limit') : 10;
        $page = is_numeric($request->get('page')) ? $request->get('page') : 1;
    
        // Collect filters from the request
        $filters = [
            'category_id' => $request->get('categoryId'),
            'company_name' => $request->get('companyName'),
            'team_size' => $request->get('teamSize'),
            'location' => $request->get('location'),
            'phone_number' => $request->get('phoneNumber'),
            'established' => $request->get('established'),
            'status' => $request->get('status'),
        ];
    
        // Handle file upload if a logo is provided and valid
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('logos'), $filename);
            $filters['logo'] = asset('logos/' . $filename);
        }
    
        // Initialize the query with eager loading
        $query = CompanyProfile::with('category');
    
        // Apply filters dynamically
        foreach ($filters as $column => $value) {
            if (!empty($value)) {
                if ($column === 'company_name') {
                    $query->where($column, 'like', '%' . $value . '%');
                } else {
                    $query->where($column, $value);
                }
            }
        }
    
        // Apply offset if provided
        if ($request->has('offset') && is_numeric($request->get('offset'))) {
            $query->skip($request->get('offset'));
        }
    
        // Apply sorting
        $query->orderBy('id', $orderBy);
    
        // Paginate the results
        $paginatedResults = $query->paginate($limit, ['*'], 'page', $page);
    
        // Return the paginated response
        return $paginatedResults;
    }
    
    

    public function getCompanyProfileById($id)
    {
        return CompanyProfile::findorFail($id);
    }

    public function getUpdateById($id, array $data)
    {
        $mappedData = [
            'company_name' => $data['companyName'] ?? null,
            'category_id' => $data['categoryId'] ?? null,
            'email' => $data['email'] ?? null,
            'phone_number' => $data['phoneNumber'] ?? null,
            'website' => $data['website'] ?? null,
            'location' => $data['location'] ?? null,
            'established' => $data['established'] ?? null,
            'team_size' => $data['teamSize'] ?? null,
            'description' => $data['description'] ?? null,
            'created_by' => $data['created_by'] ?? null,
            'verified_by' => $data['verified_by'] ?? null,
            'status' => $data['status'] ?? null,
            'verified_at' => $data['verified_at'] ?? null,
        ];
        $data = CompanyProfile::findOrFail($id);
        $data->update($mappedData);
        return $data;
    }

    public function getUpdateStatusById($id, $data)
    {
        $companyProfile = CompanyProfile::findOrFail($id);;
        $companyProfile->status = $data['status'];
        $companyProfile->save();
        return $companyProfile;
    }

    public function getDeleteById($id)
    {
        $data = CompanyProfile::find($id);

        if (!$data) {
            return response()->json(['message' => 'data not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }
}
