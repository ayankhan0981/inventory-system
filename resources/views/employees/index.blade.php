<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">User Dashboard</h2></x-slot>
    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <p class="mb-4">View-only access to products, stock, and reports.</p>
        <div class="flex gap-3">
            <a class="btn" href="{{ route('user.products.index') }}">Products</a>
            <a class="btn" href="{{ route('user.stock.index') }}">Stock</a>
            <a class="btn" href="{{ route('user.reports.stock') }}">Stock Report</a>
            <a class="btn" href="{{ route('user.reports.sales') }}">Sales Report</a>
        </div>
    </div>
    <style>.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
