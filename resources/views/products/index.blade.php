<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Products</h2></x-slot>
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-flash/>
    @if(auth()->user()->role === 'admin')
    <div class="mb-3"><a class="btn" href="{{ route('products.create') }}">Add Product</a></div>
    @endif
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2">Category</th>
                    <th class="p-2">Supplier</th>
                    <th class="p-2">SKU</th>
                    <th class="p-2">Barcode</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2 text-center">{{ $p->category?->name }}</td>
                    <td class="p-2 text-center">{{ $p->supplier?->name }}</td>
                    <td class="p-2 text-center">{{ $p->sku }}</td>
                    <td class="p-2 text-center">{!! DNS1D::getBarcodeHTML($p->barcode, 'C128') !!}</td>
                    <td class="p-2 text-center">{{ $p->quantity }}</td>
                    <td class="p-2 text-center">{{ number_format($p->price,2) }}</td>
                    <td class="p-2">
                        <a class="link" href="{{ route('products.show',$p) }}">View</a>
                        @if(auth()->user()->role === 'admin')
                        | <a class="link" href="{{ route('products.edit',$p) }}">Edit</a>
                        | <form class="inline" method="POST" action="{{ route('products.destroy',$p) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Delete?')">Delete</button>
                          </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $products->links() }}</div>
    </div>
</div>
<style>.btn{padding:.4rem .8rem;background:#111827;color:#fff;border-radius:.4rem}.link{color:#2563eb}</style>
</x-app-layout>
