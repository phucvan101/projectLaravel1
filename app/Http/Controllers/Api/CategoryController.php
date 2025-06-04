<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAddRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function show($id)
    {
        return new CategoryResource(
            Category::findOrFail($id)
        );
    }

    public function store(CategoryAddRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return new CategoryResource($category);
    }

    public function update($id, CategoryAddRequest $request)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ], 200);
    }
}
