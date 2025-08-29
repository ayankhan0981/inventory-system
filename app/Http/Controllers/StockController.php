<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index() {
        return view('stock.index', [
            'products' => Product::orderBy('name')->get(),
            'history'  => StockMovement::with(['product','user'])->latest()->paginate(20),
        ]);
    }

    public function move(Request $request) {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($data, $request) {
            $product = Product::lockForUpdate()->find($data['product_id']);

            if ($data['type'] === 'out' && $product->quantity < $data['quantity']) {
                abort(422, 'Insufficient stock.');
            }

            $delta = $data['type'] === 'in' ? $data['quantity'] : -$data['quantity'];
            $product->update(['quantity' => $product->quantity + $delta]);

            StockMovement::create([
                'product_id' => $product->id,
                'user_id'    => $request->user()->id,
                'type'       => $data['type'],
                'quantity'   => $data['quantity'],
                'note'       => $data['note'] ?? null,
            ]);
        });

        return back()->with('success', 'Stock updated.');
    }
}
