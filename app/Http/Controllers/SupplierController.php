<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        $suppliers = Supplier::latest()->paginate(12);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create() { return view('suppliers.create'); }

    public function store(Request $request) {
        $data = $request->validate([
            'name'=>'required|max:255',
            'company'=>'nullable|max:255',
            'email'=>'nullable|email',
            'phone'=>'nullable|max:30',
            'address'=>'nullable|max:255',
            'active'=>'nullable|boolean',
        ]);
        $data['active'] = $request->boolean('active');
        Supplier::create($data);
        return redirect()->route('suppliers.index')->with('success','Supplier created');
    }

    public function show(Supplier $supplier) {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier) {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier) {
        $data = $request->validate([
            'name'=>'required|max:255',
            'company'=>'nullable|max:255',
            'email'=>'nullable|email',
            'phone'=>'nullable|max:30',
            'address'=>'nullable|max:255',
            'active'=>'nullable|boolean',
        ]);
        $data['active'] = $request->boolean('active');
        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('success','Supplier updated');
    }

    public function destroy(Supplier $supplier) {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success','Supplier deleted');
    }
}
