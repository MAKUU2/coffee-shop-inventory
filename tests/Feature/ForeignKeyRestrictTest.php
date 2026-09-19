<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForeignKeyRestrictTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_prevents_ingredient_delete_with_stock_in_history(): void
    {
        $ingredient = Ingredient::create([
            'name' => 'Arabica Beans',
            'description' => 'Test ingredient',
            'unit' => 'kg',
            'stock' => 20.00,
            'minimum_stock' => 5.00,
            'cost_per_unit' => 10.00,
        ]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 5.00,
            'cost_per_unit' => 10.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        try {
            $ingredient->delete();
            $this->fail('Expected QueryException was not thrown.');
        } catch (QueryException $exception) {
            $this->assertSame('23000', (string) $exception->getCode());
        }

        $this->assertDatabaseHas('ingredients', ['id' => $ingredient->id]);
        $this->assertDatabaseHas('stock_ins', ['id' => $stockIn->id]);
    }

    public function test_database_prevents_category_delete_with_products(): void
    {
        $category = Category::create([
            'name' => 'Coffee',
            'description' => 'Test category',
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Latte',
            'description' => null,
            'price' => 150.00,
            'stock' => 10,
        ]);

        try {
            $category->delete();
            $this->fail('Expected QueryException was not thrown.');
        } catch (QueryException $exception) {
            $this->assertSame('23000', (string) $exception->getCode());
        }

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }
}
