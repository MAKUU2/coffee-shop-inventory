<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with('ingredient')
            ->latest()
            ->get();

        return view('stock_outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy('name')->get();

        return view('stock_outs.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|gt:0',
            'stock_out_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $ingredient = Ingredient::findOrFail(
            $validated['ingredient_id']
        );

        // Check kung sapat ang stock
        if ($ingredient->stock < $validated['quantity']) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'Not enough stock available.'
                ]);
        }

        // Gumawa ng Stock Out record
        StockOut::create($validated);

        // Bawasan ang ingredient stock
        $ingredient->decrement(
            'stock',
            $validated['quantity']
        );

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock Out recorded successfully!');
    }

    public function edit(StockOut $stockOut)
    {
        $ingredients = Ingredient::orderBy('name')->get();

        return view('stock_outs.edit', compact(
            'stockOut',
            'ingredients'
        ));
    }

    public function update(Request $request, StockOut $stockOut)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|gt:0',
            'stock_out_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $oldQuantity = $stockOut->quantity;
        $oldIngredientId = $stockOut->ingredient_id;

        // Same ingredient
        if ($oldIngredientId == $validated['ingredient_id']) {

            $ingredient = Ingredient::findOrFail(
                $validated['ingredient_id']
            );

            $difference = $validated['quantity'] - $oldQuantity;

            // Kung dinagdagan ang Stock Out quantity,
            // siguraduhin na sapat ang remaining stock.
            if ($difference > 0 && $ingredient->stock < $difference) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'quantity' => 'Not enough stock available.'
                    ]);
            }

            $ingredient->decrement(
                'stock',
                $difference
            );
        } else {

            // Magkaibang ingredient
            $oldIngredient = Ingredient::findOrFail(
                $oldIngredientId
            );

            $newIngredient = Ingredient::findOrFail(
                $validated['ingredient_id']
            );

            // Check kung sapat ang bagong ingredient
            if ($newIngredient->stock < $validated['quantity']) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'quantity' => 'Not enough stock available.'
                    ]);
            }

            // Ibalik ang dating quantity sa old ingredient
            $oldIngredient->increment(
                'stock',
                $oldQuantity
            );

            // Bawasan ang bagong ingredient
            $newIngredient->decrement(
                'stock',
                $validated['quantity']
            );
        }

        $stockOut->update($validated);

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock Out updated successfully!');
    }

    public function destroy(StockOut $stockOut)
    {
        $ingredient = Ingredient::findOrFail(
            $stockOut->ingredient_id
        );

        // Ibalik ang stock kapag dinelete ang Stock Out
        $ingredient->increment(
            'stock',
            $stockOut->quantity
        );

        $stockOut->delete();

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock Out deleted successfully!');
    }
}
