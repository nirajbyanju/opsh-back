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

        // Handle file upload
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
        $orderBy = $request->get('order_by', 'DESC'); // Default to DESC
        $categoryId = $request->get('categoryId'); // Get categoryId if exists
        $limit = $request->get('limit', 10); // Default limit of 10
        $page = $request->get('page', 1); // Default to page 1 if not provided
    
        // Initialize the query
        $query = CompanyProfile::with('category');
    
        // Filter by category if applicable
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        if($request->has('offset') && is_numeric($request->offset)) {      
            $query->skip($request->offset);
              }
    
        // Apply sorting
        $query->orderBy('id', $orderBy);
    
        // Apply pagination using limit and page
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
