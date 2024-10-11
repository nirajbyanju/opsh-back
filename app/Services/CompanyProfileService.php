<?php
namespace App\Services;

use App\Models\vacancy\CompanyProfile;

class CompanyProfileService
{
    
   public function CreateCompanyProfile(array $data)
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

        $sortBy = $request->input('sort_by', 'created_at');
        $perPage = $request->input('per_page', 10);
        $categoryId = $request->input('category_id');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query = CompanyProfile::with('category')
            ->active();  
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        $query->orderBy($sortBy, $sortDirection);
        return $query->paginate($perPage);
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
        $data->update( $mappedData);
        return $data;
    }

    public function getDeleteById($id)
    {
        $data= CompanyProfile::find($id);
    
        if (!$data) {
            return response()->json(['message' => 'data not found.'], 404);
        }
    
        $data->delete(); 
    
        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }

}