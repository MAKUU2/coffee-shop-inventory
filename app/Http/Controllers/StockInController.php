<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\StockIn;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('ingredient')
            ->latest()
            ->get();

        return view('stock_ins.index', compact('stockIns'));
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy('name')->get();

        return view('stock_ins.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|gt:0',
            'cost_per_unit' => 'required|numeric|min:0',
            'stock_in_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $stockIn = StockIn::create($validated);

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        $ingredient->increment('stock', $validated['quantity']);

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In recorded successfully!');
    }

    public function edit(StockIn $stockIn)
    {
        $ingredients = Ingredient::orderBy('name')->get();

        return view('stock_ins.edit', compact('stockIn', 'ingredients'));
    }

    public function update(Request $request, StockIn $stockIn)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|gt:0',
            'cost_per_unit' => 'required|numeric|min:0',
            'stock_in_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $oldQuantity = $stockIn->quantity;
        $oldIngredientId = $stockIn->ingredient_id;

        $stockIn->update($validated);

        if ($oldIngredientId == $validated['ingredient_id']) {

            $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

            $difference = $validated['quantity'] - $oldQuantity;

            $ingredient->increment('stock', $difference);
        } else {

            $oldIngredient = Ingredient::findOrFail($oldIngredientId);
            $newIngredient = Ingredient::findOrFail($validated['ingredient_id']);

            $oldIngredient->decrement('stock', $oldQuantity);
            $newIngredient->increment('stock', $validated['quantity']);
        }

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In updated successfully!');
    }

    public function destroy(StockIn $stockIn)
    {
        $ingredient = Ingredient::findOrFail($stockIn->ingredient_id);

        $ingredient->decrement('stock', $stockIn->quantity);

        $stockIn->delete();

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In deleted successfully!');
    }
}
