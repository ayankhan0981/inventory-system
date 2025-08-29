<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Product Details</h2></x-slot>
<div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-4 rounded shadow">
        <p><b>Name:</b> {{ $product->name }}</p>
        <p><b>Category:</b> {{ $product->category?->name }}</p>
        <p><b>Supplier:</b> {{ $product->supplier?->name }}</p>
        <p><b>SKU:</b> {{ $product->sku }}</p>
        <p><b>Barcode:</b> {!! DNS1D::getBarcodeHTML($product->barcode, 'C128') !!}</p>
        <p><b>Cost:</b> {{ number_format($product->cost,2) }}</p>
        <p><b>Price:</b> {{ number_format($product->price,2) }}</p>
        <p><b>Quantity:</b> {{ $product->quantity }}</p>
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="mt-3 h-32">
        @endif
    </div>
</div>
</x-app-layout>
