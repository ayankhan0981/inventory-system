<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Stock</h2></x-slot>
<div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
    <x-flash/>

    @if(auth()->user()->role === 'admin')
    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="POST" action="{{ route('stock.move') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            @csrf
            <div>
                <label>Product</label>
                <select name="product_id" class="input" required>
                    <option value="">-- select --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->quantity }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Type</label>
                <select name="type" class="input" required>
                    <option value="in">IN</option>
                    <option value="out">OUT</option>
                </select>
            </div>
            <div>
                <label>Quantity</label>
                <input type="number" name="quantity" min="1" class="input" required>
            </div>
            <div class="md:col-span-2">
                <label>Note</label>
                <input name="note" class="input" placeholder="Optional">
            </div>
            <div class="md:col-span-5">
                <button class="btn">Save Movement</button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">When</th>
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2">Type</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">User</th>
                    <th class="p-2 text-left">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $m)
                <tr class="border-t">
                    <td class="p-2">{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2">{{ $m->product->name }}</td>
                    <td class="p-2 text-center">{{ strtoupper($m->type) }}</td>
                    <td class="p-2 text-center">{{ $m->quantity }}</td>
                    <td class="p-2 text-center">{{ $m->user->name }}</td>
                    <td class="p-2">{{ $m->note }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $history->links() }}</div>
    </div>
</div>
<style>.input{border:1px solid #d1d5db;border-radius:.375rem;padding:.5rem;width:100%}.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
