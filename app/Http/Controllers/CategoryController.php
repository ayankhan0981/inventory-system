<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::latest()->paginate(12);
        return view('categories.index', compact('categories'));
    }
    public function create() { return view('categories.create'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|max:255|unique:categories,name','description'=>'nullable']);
        Category::create($data);
        return redirect()->route('categories.index')->with('success','Category created');
    }
    public function show(Category $category) { return view('categories.show', compact('category')); }
    public function edit(Category $category) { return view('categories.edit', compact('category')); }
    public function update(Request $request, Category $category) {
        $data = $request->validate([
            'name'=>'required|max:255|unique:categories,name,'.$category->id,
            'description'=>'nullable'
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success','Category updated');
    }
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted');
    }
}
