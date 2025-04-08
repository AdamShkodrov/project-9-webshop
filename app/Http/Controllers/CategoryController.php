<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {

        $categories = Category::all();
    
        return view('categories.index', compact('categories'));
    }
    
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
    
        return view('categories.create', compact('categories', 'products'));
    }
    
    public function store(CategoryRequest $request)
    {
        $category = new Category();
    
        $this->save($category, $request);
    
        return redirect('/categories');
    }
    
    public function show($category)
    {
        $category = Category::find($category);
        $products = Product::all();
    
        return view('categories.show', compact('category'));
    }
    
    public function edit(Category $category)
    {
        $products = Product::all();

        return view('categories.edit', compact('category', 'products'));
    }
    
    public function update(CategoryRequest $request, Category $category)
    {
        $this->save($category, $request);
    
        return redirect('/categories');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
    
        return redirect('/categories');
    }
    

    private function save(Category $category, Request $request)
    {
        $category->name = $request->name; 
        $category->save();
        $category->products()->attach($request->product_id);
    }
}
