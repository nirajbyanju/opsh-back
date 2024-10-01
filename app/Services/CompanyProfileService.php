<?php
namespace App\Services;

use App\Models\vacancy\CompanyProfile;

class CompanyProfileService
{
    
    use Illuminate\Support\Facades\Storage;

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
            'team_size' => $data['team_size'] ?? null,
            'description' => $data['description'] ?? null,
        ];
    
        // Check if 'logo' is a file and handle the file upload
        if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            // Store the logo and get the file path
            $mappedData['logo'] = $data['logo']->store('logos', 'public');
        }
    
        CompanyProfile::create($mappedData);
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
            'team_size' => $data['team_size'] ?? null,
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