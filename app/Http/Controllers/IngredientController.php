<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::latest()->get();

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        Ingredient::create($validated);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient created successfully!');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        $ingredient->update($validated);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        if (StockIn::where('ingredient_id', $ingredient->id)->exists()
            || StockOut::where('ingredient_id', $ingredient->id)->exists()) {
            return back()->withErrors([
                'ingredient' => 'Cannot delete this ingredient because it has stock transaction history.',
            ]);
        }

        $ingredient->delete();

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully!');
    }
}
