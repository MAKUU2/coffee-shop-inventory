<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;

class DashboardController extends Controller
{
    public function index()
    {
        // Dashboard statistics

        $totalProducts = Product::count();

        $totalIngredients = Ingredient::count();

        $totalStockIns = StockIn::count();

        $totalStockOuts = StockOut::count();

        $totalCategories = Category::count();

        $outOfStockCount = Ingredient::where('stock', '<=', 0)->count();

        $inventoryValue = (float) Ingredient::query()
            ->selectRaw('COALESCE(SUM(stock * cost_per_unit), 0) AS total')
            ->value('total');

        // Low stock

        $lowStockCount = Ingredient::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        $lowStockIngredients = Ingredient::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock', 'asc')
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentStockIns = StockIn::with('ingredient')
            ->latest()
            ->take(5)
            ->get();

        $recentStockOuts = StockOut::with('ingredient')
            ->latest()
            ->take(5)
            ->get();

        // Send data to dashboard

        return view('dashboard', compact(
            'totalProducts',
            'totalIngredients',
            'totalStockIns',
            'totalStockOuts',
            'totalCategories',
            'outOfStockCount',
            'inventoryValue',
            'lowStockCount',
            'lowStockIngredients',
            'recentProducts',
            'recentStockIns',
            'recentStockOuts'
        ));
    }
}
