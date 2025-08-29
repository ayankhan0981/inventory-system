<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with(['category','supplier'])->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create', [
            'categories' => Category::orderBy('name')->get(),
            'suppliers' => Supplier::orderBy('name')->get()
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'sku' => 'required|max:64|unique:products,sku',
            'barcode' => 'nullable|max:64|unique:products,barcode',
            'cost' => 'nullable|numeric|min:0',
            'price'=> 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success','Product created');
    }

    public function show(Product $product) {
        $product->load(['category','supplier']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product) {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'suppliers' => Supplier::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'sku' => ['required','max:64', Rule::unique('products','sku')->ignore($product->id)],
            'barcode' => ['nullable','max:64', Rule::unique('products','barcode')->ignore($product->id)],
            'cost' => 'nullable|numeric|min:0',
            'price'=> 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success','Product updated');
    }

    public function destroy(Product $product) {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted');
    }
}
