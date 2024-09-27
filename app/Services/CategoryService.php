<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function CreateCategory(array $data){

        $mappedData =[
            'name' => $data['name'],
            'status' => 1,
        ];

        Category::create($mappedData);

        return [
            'message' => 'Category created successful'
        ];

    }

    public function listActiveCategories()
    {
        return Category::select('id', 'name')->active()->get();
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function getUpdateById($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function getDeleteById($id)
    {
        $category = Category::find($id); // Find the category by ID
    
        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    
        $category->delete(); // Delete the category
    
        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }

    
    


}
