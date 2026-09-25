<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LowStockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use Illuminate\Support\Facades\Route;

// =============================
// AUTH ROUTES
// =============================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// =============================
// PROTECTED ADMIN ROUTES
// =============================

Route::middleware('admin.auth')->group(function () {

    // =============================
    // DASHBOARD ROUTE
    // =============================

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // =============================
    // CATEGORY ROUTES
    // =============================

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // =============================
    // PRODUCT ROUTES
    // =============================

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    // =============================
    // INGREDIENT ROUTES
    // =============================

    Route::get('/ingredients', [IngredientController::class, 'index'])
        ->name('ingredients.index');

    Route::get('/ingredients/create', [IngredientController::class, 'create'])
        ->name('ingredients.create');

    Route::post('/ingredients', [IngredientController::class, 'store'])
        ->name('ingredients.store');

    Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])
        ->name('ingredients.edit');

    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])
        ->name('ingredients.update');

    Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])
        ->name('ingredients.destroy');

    // =============================
    // STOCK IN ROUTES
    // =============================

    Route::get('/stock-ins', [StockInController::class, 'index'])
        ->name('stock-ins.index');

    Route::get('/stock-ins/create', [StockInController::class, 'create'])
        ->name('stock-ins.create');

    Route::post('/stock-ins', [StockInController::class, 'store'])
        ->name('stock-ins.store');

    Route::get('/stock-ins/{stockIn}/edit', [StockInController::class, 'edit'])
        ->name('stock-ins.edit');

    Route::put('/stock-ins/{stockIn}', [StockInController::class, 'update'])
        ->name('stock-ins.update');

    Route::delete('/stock-ins/{stockIn}', [StockInController::class, 'destroy'])
        ->name('stock-ins.destroy');

    // =============================
    // STOCK OUT ROUTES
    // =============================

    Route::get('/stock-outs', [StockOutController::class, 'index'])
        ->name('stock-outs.index');

    Route::get('/stock-outs/create', [StockOutController::class, 'create'])
        ->name('stock-outs.create');

    Route::post('/stock-outs', [StockOutController::class, 'store'])
        ->name('stock-outs.store');

    Route::get('/stock-outs/{stockOut}/edit', [StockOutController::class, 'edit'])
        ->name('stock-outs.edit');

    Route::put('/stock-outs/{stockOut}', [StockOutController::class, 'update'])
        ->name('stock-outs.update');

    Route::delete('/stock-outs/{stockOut}', [StockOutController::class, 'destroy'])
        ->name('stock-outs.destroy');

    // =============================
    // LOW STOCK ROUTE
    // =============================

    Route::get('/low-stock', [LowStockController::class, 'index'])
        ->name('low-stock.index');

    // =============================
    // ADMIN ACCOUNT ROUTES
    // =============================

    Route::get('/admins', [AdminController::class, 'index'])
        ->name('admins.index');

    Route::get('/admins/create', [AdminController::class, 'create'])
        ->name('admins.create');

    Route::post('/admins', [AdminController::class, 'store'])
        ->name('admins.store');
});
