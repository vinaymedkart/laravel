<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data, $userId)
    {
        return Category::create([
            'name' => $data['name'],
            'created_by' => $userId, // Assign user ID
        ]);
    }

    public function getAllCategories()
    {
        return Category::with('creator:id,name')->get(); // Fetch creator details
    }
}
