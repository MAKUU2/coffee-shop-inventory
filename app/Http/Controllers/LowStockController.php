<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;

class LowStockController extends Controller
{
    public function index()
    {
        $lowStockIngredients = Ingredient::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock', 'asc')
            ->get();

        return view(
            'low_stock.index',
            compact('lowStockIngredients')
        );
    }
}
