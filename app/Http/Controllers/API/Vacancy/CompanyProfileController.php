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
        $this->companyProfileService->CreateCompanyProfile($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Company Profile  added successfully.',
        ], 201);
    }

    public function list()
    {
        $data = $this->companyProfileService->listActiveCompanyProfile();

        return response()->json([
            'success' => true,
            'data' => [
                'Company' =>$data,
            ],
            'message' => 'Company Profile have been successfully listed',
        ], 200);
    }

    public function listing($id):JsonResponse{
        $data =$this->companyProfileService->getCompanyProfileById($id);

        return response()-> json([
                'success' =>true,
                'data' =>[
                    'company' => $data,
                ],
                'message' => 'Category have been successfully listed',
            ], 200);
    }

    public function update(Request $request, $id): JsonResponse{
        dd($request->all());
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