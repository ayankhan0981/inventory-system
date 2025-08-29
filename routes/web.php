<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Shared dashboard redirect (role based)
Route::get('/redirect', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('redirect');

// ==================== User & Admin Shared ====================

// Authenticated dashboard (both roles use same URI but different controllers)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return app(AdminDashboardController::class)->index();
        }
        return app(UserDashboardController::class)->index();
    })->name('dashboard');

    // Shared product routes (everyone can view, only admin can manage)
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});

// ==================== Admin Only ====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Employees
    Route::resource('employees', EmployeeController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products (management routes only)
    Route::resource('products', ProductController::class)->except(['index', 'show']);

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock/move', [StockController::class, 'move'])->name('stock.move');

    // Reports
    Route::get('/reports/stock', [ReportsController::class, 'stockReport'])->name('reports.stock');
    Route::get('/reports/sales', [ReportsController::class, 'salesReport'])->name('reports.sales');
});

// ==================== User Only ====================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// ==================== Profile ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
