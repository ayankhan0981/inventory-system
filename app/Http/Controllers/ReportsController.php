<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function stockReport() {
        $products = Product::with('category','supplier')->orderBy('name')->get();
        $totalValue = $products->sum(fn($p) => $p->quantity * $p->cost);
        return view('reports.stock', compact('products','totalValue'));
    }

    public function salesReport(Request $request) {
        $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $q = StockMovement::with('product')
                ->where('type','out');

        if ($request->filled('from')) $q->whereDate('created_at','>=',$request->from);
        if ($request->filled('to'))   $q->whereDate('created_at','<=',$request->to);

        $movements = $q->orderByDesc('created_at')->paginate(30)->withQueryString();

        // revenue approximation: sum(out quantity * product price at current price)
        $revenue = $movements->getCollection()->sum(fn($m) => $m->quantity * $m->product->price);

        return view('reports.sales', compact('movements','revenue'));
    }
}
