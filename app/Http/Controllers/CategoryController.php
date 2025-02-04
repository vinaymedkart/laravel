<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            $userId = $request->user()->id; // Get authenticated user ID

            $category = $this->categoryRepository->create($validated, $userId);

            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'category' => $category,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Category creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllCategory()
    {
        try {
            $categories = $this->categoryRepository->getAllCategories();

            return response()->json([
                'status' => true,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
