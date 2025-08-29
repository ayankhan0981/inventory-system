<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Stock Report</h2></x-slot>
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2">Category</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">Cost</th>
                    <th class="p-2">Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2 text-center">{{ $p->category?->name }}</td>
                    <td class="p-2 text-center">{{ $p->quantity }}</td>
                    <td class="p-2 text-center">{{ number_format($p->cost,2) }}</td>
                    <td class="p-2 text-center">{{ number_format($p->quantity * $p->cost,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3 font-semibold">Total Inventory Value: {{ number_format($totalValue,2) }}</div>
    </div>
</div>
</x-app-layout>
