<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Sales Report</h2></x-slot>
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-4 rounded shadow mb-4">
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <div>
                <label>From</label>
                <input type="date" name="from" value="{{ request('from') }}" class="input">
            </div>
            <div>
                <label>To</label>
                <input type="date" name="to" value="{{ request('to') }}" class="input">
            </div>
            <div class="md:col-span-2 flex items-end">
                <button class="btn">Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">When</th>
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2">Qty (OUT)</th>
                    <th class="p-2">Unit Price</th>
                    <th class="p-2">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movements as $m)
                <tr class="border-t">
                    <td class="p-2">{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2">{{ $m->product->name }}</td>
                    <td class="p-2 text-center">{{ $m->quantity }}</td>
                    <td class="p-2 text-center">{{ number_format($m->product->price,2) }}</td>
                    <td class="p-2 text-center">{{ number_format($m->quantity * $m->product->price,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $movements->links() }}</div>
        <div class="p-3 font-semibold">Total Revenue (approx): {{ number_format($revenue,2) }}</div>
    </div>
</div>
<style>.input{border:1px solid #d1d5db;border-radius:.375rem;padding:.5rem;width:100%}.btn{padding:.5rem 1rem;background:#111827;color:#fff;border-radius:.5rem}</style>
</x-app-layout>
