<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">Add Supplier</h2></x-slot>
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <x-flash/>
        <form method="POST" action="{{ route('suppliers.store') }}" class="bg-white p-4 rounded shadow">
            @csrf
            @include('suppliers.partials.form', ['supplier'=>null])
            <button class="btn mt-3">Save</button>
        </form>
    </div>
    <style>.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
