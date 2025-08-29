<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Add Product</h2></x-slot>
<div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <x-flash/>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
        @csrf
        @include('products.partials.form', ['product'=>null,'categories'=>$categories,'suppliers'=>$suppliers])
        <button class="btn mt-3">Save</button>
    </form>
</div>
<style>.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
