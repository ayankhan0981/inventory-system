<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Employee;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'products' => Product::count(),
            'categories' => Category::count(),
            'suppliers' => Supplier::count(),
            'employees' => Employee::count(),
            'stockIns' => StockMovement::where('type','in')->count(),
            'stockOuts'=> StockMovement::where('type','out')->count(),
        ]);
    }
}
