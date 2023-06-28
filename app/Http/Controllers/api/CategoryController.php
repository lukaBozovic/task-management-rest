<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::query()->get();
    }

    public function store(StoreCategoryRequest $request)
    {
        return Category::query()->create($request->validated());
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $category;
    }

    public function destroy(Category $category)
    {
        if ($category->tasks()->exists())
            return response(['message' => 'category-has-tasks'], Response::HTTP_FORBIDDEN);
        $category->delete();
        return response('Successfully deleted');
    }
}
