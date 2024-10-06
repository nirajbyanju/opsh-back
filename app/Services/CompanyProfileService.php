<?php
namespace App\Services;

use App\Models\vacancy\CompanyProfile;

class CompanyProfileService
{
    
   public function CreateCompanyProfile(array $data): CompanyProfile
    {
        // Handle logo file upload if present
        if (isset($data['logo']) && $data['logo']->isValid()) {
            $file = $data['logo'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('logos'), $filename);

            // Add the logo URL to the data array
            $data['logo'] = asset('logos/' . $filename);
        }

        // Use the trait's automatic camelCase-to-snake_case conversion
        return CompanyProfile::create($data);
    }

    public function listActiveCompanyProfile()
    {
        return CompanyProfile::active()->get();
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
            'website' => $data['website'] ?? null, // Use null coalescing here
            'location' => $data['location'] ?? null,
            'established' => $data['established'] ?? null,
            'team_size' => $data['teamSize'] ?? null,
            'logo' => $data['logo'] ?? null,
            'description' => $data['description'] ?? null,
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