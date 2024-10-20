<?php

namespace App\Http\Controllers\API\Vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyProfileService;
use App\Http\Requests\CompanyProfileRequest;
use Illuminate\Http\JsonResponse;

class CompanyProfileController extends Controller
{
    protected $companyProfileService;

    public function __construct(CompanyprofileService $categoryService)
    {
        $this->companyProfileService = $categoryService;
    }

    public function create (CompanyProfileRequest $request): JsonResponse{
        $companyProfile = $this->companyProfileService->CreateCompanyProfile($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Company Profile  added successfully.',
            'data' => $companyProfile,
        ], 201);
    }

    public function list(Request $request)
    {
        $paginatedResults = $this->companyProfileService->listActiveCompanyProfile($request);
    
        if ($paginatedResults->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No posts available',
                'data' => [],
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'List of posts',
            'data' => $paginatedResults->items(),
            'pagination' => [
                'total' => $paginatedResults->total(), // Total records
                'per_page' => $paginatedResults->perPage(), // Items per page
                'current_page' => $paginatedResults->currentPage(), // Current page
                'last_page' => $paginatedResults->lastPage(), // Last page number
            ],
        ], 200);
    }

    public function listing($id):JsonResponse{
        $data =$this->companyProfileService->getCompanyProfileById($id);

        return response()-> json([
                'success' =>true,
                'data' => $data,
                'message' => 'Category have been successfully listed',
            ], 200);
    }

    public function update(Request $request, $id): JsonResponse{
        $data = $this->companyProfileService->getUpdateById($id, $request->all());
        return response()->json([
            'success' =>true,
            'data' =>[
                'category' =>$data,
            ],
            'message' => 'Category have been successfully updated',
        ], 200);
    }

    public function delete($id): JsonResponse{
        $data = $this->companyProfileService->getDeleteById($id);
        return response()->json([
            'success' =>true,
            'data' =>[
                'category' =>$data,
            ],
            'message' => 'Category have been successfully delete',
        ], 200);
    }
}
