<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\StockIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

        $stockIn = DB::transaction(function () use ($validated) {
            $ingredient = Ingredient::whereKey($validated['ingredient_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $stockIn = StockIn::create($validated);

            $ingredient->increment('stock', $validated['quantity']);

            return $stockIn;
        });

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

        $newIngredientId = (int) $validated['ingredient_id'];
        $newQuantity = (float) $validated['quantity'];

        DB::transaction(function () use ($stockIn, $validated, $newIngredientId, $newQuantity) {
            $freshStockIn = StockIn::whereKey($stockIn->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldQuantity = (float) $freshStockIn->quantity;
            $oldIngredientId = (int) $freshStockIn->ingredient_id;

            if ($oldIngredientId === $newIngredientId) {
                $ingredient = Ingredient::whereKey($newIngredientId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $difference = $newQuantity - $oldQuantity;

                if ((float) $ingredient->stock + $difference < 0) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Not enough stock available to adjust this record.',
                    ]);
                }

                $freshStockIn->update($validated);

                $ingredient->increment('stock', $difference);
            } else {
                $ids = collect([$oldIngredientId, $newIngredientId])->sort()->values();

                $locked = Ingredient::whereIn('id', $ids)
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $oldIngredient = $locked->get($oldIngredientId) ?? throw ValidationException::withMessages([
                    'ingredient_id' => 'Original ingredient not found.',
                ]);
                $newIngredient = $locked->get($newIngredientId) ?? throw ValidationException::withMessages([
                    'ingredient_id' => 'Selected ingredient not found.',
                ]);

                if ((float) $oldIngredient->stock - $oldQuantity < 0) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Not enough stock available to adjust this record.',
                    ]);
                }

                $freshStockIn->update($validated);

                $oldIngredient->decrement('stock', $oldQuantity);
                $newIngredient->increment('stock', $newQuantity);
            }
        });

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In updated successfully!');
    }

    public function destroy(StockIn $stockIn)
    {
        DB::transaction(function () use ($stockIn) {
            $ingredient = Ingredient::whereKey($stockIn->ingredient_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ((float) $ingredient->stock - (float) $stockIn->quantity < 0) {
                throw ValidationException::withMessages([
                    'quantity' => 'Cannot delete this record: ingredient stock would become negative.',
                ]);
            }

            $ingredient->decrement('stock', $stockIn->quantity);

            $stockIn->delete();
        });

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In deleted successfully!');
    }
}
