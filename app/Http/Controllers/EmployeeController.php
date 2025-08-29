<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::latest()->paginate(12);
        return view('employees.index', compact('employees'));
    }

    public function create() {
        return view('employees.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'nullable|email|unique:employees,email',
            'phone'=> 'nullable|string|max:30',
            'position' => 'nullable|string|max:255',
            'salary'=> 'nullable|numeric|min:0',
            'address'=> 'nullable|string|max:255',
            'active'=> 'nullable|boolean',
        ]);
        $data['active'] = $request->boolean('active');
        Employee::create($data);
        return redirect()->route('employees.index')->with('success','Employee created');
    }

    public function show(Employee $employee) {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee) {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> ['nullable','email', Rule::unique('employees','email')->ignore($employee->id)],
            'phone'=> 'nullable|string|max:30',
            'position' => 'nullable|string|max:255',
            'salary'=> 'nullable|numeric|min:0',
            'address'=> 'nullable|string|max:255',
            'active'=> 'nullable|boolean',
        ]);
        $data['active'] = $request->boolean('active');
        $employee->update($data);
        return redirect()->route('employees.index')->with('success','Employee updated');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee deleted');
    }
}
