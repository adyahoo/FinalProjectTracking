<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategories;
use App\Http\Requests\BlogCategoryRequest;

class BlogCategoriesController extends Controller
{
    public function index()
    {
        $categories = BlogCategories::all();
        return view('project.admin.pages.blogs.blog_categories.index', compact('categories'));
    }

    public function store(BlogCategoryRequest $request)
    {
        $category = new BlogCategories($request->all());
        $category->save();

        return redirect()->route('admin.blog_categories.index')->with('success', 'Category created successfully');
    }

    public function show(BlogCategories $category)
    {
        return response()->json($category);
    }

    public function update(BlogCategoryRequest $request, BlogCategories $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.blog_categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(BlogCategories $category)
    {
        $category->delete();

        return redirect()->route('admin.blog_categories.index')->with('success', 'Category deleted successfully');
    }
}
