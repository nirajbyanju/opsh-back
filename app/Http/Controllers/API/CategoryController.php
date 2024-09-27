<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create (CategoryRequest $request): JsonResponse{
        $data = $this->categoryService->CreateCategory($request->all());

        return response()->json([
            'success' => true,
            'data' => [$data['message']
            ],
            'message' => 'User registered successfully.',
        ], 201);

    }

    public function list()
    {
        $data = $this->categoryService->listActiveCategories();
        
        return response()->json([
            'success' => true,
            'data' => [
                'category' => $data,
            ],
            'message' => 'Categories have been successfully listed',
        ], 200);
    }

    public function listing($id): JsonResponse{
        $data = $this->categoryService->getCategoryById($id);
        return response()->json([
            'success' => true,
            'data' => [
                'category' => $data,
            ],
            'message' => 'Category have been successfully listed',
        ], 200);

    }

    public function update(CategoryRequest $request, $id): JsonResponse{
        $data = $this->categoryService->getUpdateById($id, $request->all());
        return response()->json([
            'success' =>true,
            'data' =>[
                'category' =>$data,
            ],
            'message' => 'Category have been successfully updated',
        ], 200);
    }

    public function delete($id): JsonResponse{
        $data = $this->categoryService->getDeleteById($id);
        return response()->json([
            'success' =>true,
            'data' =>[
                'category' =>$data,
            ],
            'message' => 'Category have been successfully delete',
        ], 200);
    }
}
