<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Admin Dashboard</h2></x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash/>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="p-4 bg-white shadow rounded">Products: {{ $products }}</div>
                <div class="p-4 bg-white shadow rounded">Categories: {{ $categories }}</div>
                <div class="p-4 bg-white shadow rounded">Suppliers: {{ $suppliers }}</div>
                <div class="p-4 bg-white shadow rounded">Employees: {{ $employees }}</div>
                <div class="p-4 bg-white shadow rounded">Stock IN: {{ $stockIns }}</div>
                <div class="p-4 bg-white shadow rounded">Stock OUT: {{ $stockOuts }}</div>
            </div>
            <div class="mt-6 flex gap-3">
                <a class="btn" href="{{ route('products.index') }}">Products</a>
                <a class="btn" href="{{ route('categories.index') }}">Categories</a>
                <a class="btn" href="{{ route('suppliers.index') }}">Suppliers</a>
                <a class="btn" href="{{ route('employees.index') }}">Employees</a>
                <a class="btn" href="{{ route('stock.index') }}">Stock</a>
                <a class="btn" href="{{ route('reports.stock') }}">Reports</a>
            </div>
        </div>
    </div>
    <style>.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
