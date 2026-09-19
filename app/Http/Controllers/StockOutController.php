<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

        DB::transaction(function () use ($validated) {
            $ingredient = Ingredient::whereKey($validated['ingredient_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Check kung sapat ang stock
            if ((float) $ingredient->stock < (float) $validated['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Not enough stock available.',
                ]);
            }

            // Gumawa ng Stock Out record
            StockOut::create($validated);

            // Bawasan ang ingredient stock
            $ingredient->decrement(
                'stock',
                $validated['quantity']
            );
        });

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

        $newIngredientId = (int) $validated['ingredient_id'];
        $newQuantity = (float) $validated['quantity'];

        DB::transaction(function () use ($stockOut, $validated, $newIngredientId, $newQuantity) {
            $freshStockOut = StockOut::whereKey($stockOut->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldQuantity = (float) $freshStockOut->quantity;
            $oldIngredientId = (int) $freshStockOut->ingredient_id;

            // Same ingredient
            if ($oldIngredientId === $newIngredientId) {
                $ingredient = Ingredient::whereKey($newIngredientId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $difference = $newQuantity - $oldQuantity;

                // Kung dinagdagan ang Stock Out quantity,
                // siguraduhin na sapat ang remaining stock.
                if ($difference > 0 && (float) $ingredient->stock < $difference) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Not enough stock available.',
                    ]);
                }

                if ((float) $ingredient->stock - $difference < 0) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Not enough stock available.',
                    ]);
                }

                $freshStockOut->update($validated);

                $ingredient->decrement(
                    'stock',
                    $difference
                );
            } else {
                // Magkaibang ingredient: lock in id order to avoid deadlocks
                $ids = collect([$oldIngredientId, $newIngredientId])->sort()->values();

                $locked = Ingredient::whereIn('id', $ids)
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                // Magkaibang ingredient
                $oldIngredient = $locked->get($oldIngredientId) ?? throw ValidationException::withMessages([
                    'ingredient_id' => 'Original ingredient not found.',
                ]);

                $newIngredient = $locked->get($newIngredientId) ?? throw ValidationException::withMessages([
                    'ingredient_id' => 'Selected ingredient not found.',
                ]);

                // Check kung sapat ang bagong ingredient
                if ((float) $newIngredient->stock < $newQuantity) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Not enough stock available.',
                    ]);
                }

                $freshStockOut->update($validated);

                // Ibalik ang dating quantity sa old ingredient
                $oldIngredient->increment(
                    'stock',
                    $oldQuantity
                );

                // Bawasan ang bagong ingredient
                $newIngredient->decrement(
                    'stock',
                    $newQuantity
                );
            }
        });

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock Out updated successfully!');
    }

    public function destroy(StockOut $stockOut)
    {
        DB::transaction(function () use ($stockOut) {
            $ingredient = Ingredient::whereKey($stockOut->ingredient_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Ibalik ang stock kapag dinelete ang Stock Out
            $ingredient->increment(
                'stock',
                $stockOut->quantity
            );

            $stockOut->delete();
        });

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock Out deleted successfully!');
    }
}
