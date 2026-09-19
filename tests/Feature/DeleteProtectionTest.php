<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteProtectionTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(array $overrides = []): Admin
    {
        return Admin::create(array_merge([
            'first_name' => 'Test',
            'middle_name' => null,
            'last_name' => 'Admin',
            'username' => 'testadmin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ], $overrides));
    }

    /**
     * @return array<string, mixed>
     */
    private function adminSession(Admin $admin): array
    {
        return [
            'admin_id' => $admin->id,
            'admin_username' => $admin->username,
            'admin_name' => $admin->first_name.' '.$admin->last_name,
            'admin_role' => $admin->role,
        ];
    }

    private function createIngredient(array $overrides = []): Ingredient
    {
        return Ingredient::create(array_merge([
            'name' => 'Arabica Beans',
            'description' => 'Test ingredient',
            'unit' => 'kg',
            'stock' => 20.00,
            'minimum_stock' => 5.00,
            'cost_per_unit' => 10.00,
        ], $overrides));
    }

    public function test_ingredient_deletion_blocked_when_stock_in_history_exists(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient();
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 5.00,
            'cost_per_unit' => 10.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))
            ->delete(route('ingredients.destroy', $ingredient));

        $response->assertSessionHasErrors('ingredient');
        $this->assertDatabaseHas('ingredients', ['id' => $ingredient->id]);
        $this->assertDatabaseHas('stock_ins', ['id' => $stockIn->id]);
    }

    public function test_ingredient_deletion_blocked_when_stock_out_history_exists(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient();
        $stockOut = StockOut::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 2.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))
            ->delete(route('ingredients.destroy', $ingredient));

        $response->assertSessionHasErrors('ingredient');
        $this->assertDatabaseHas('ingredients', ['id' => $ingredient->id]);
        $this->assertDatabaseHas('stock_outs', ['id' => $stockOut->id]);
    }

    public function test_ingredient_deletion_succeeds_when_no_stock_history(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient();

        $response = $this->withSession($this->adminSession($admin))
            ->delete(route('ingredients.destroy', $ingredient));

        $response->assertRedirect(route('ingredients.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }

    public function test_category_deletion_blocked_when_products_exist(): void
    {
        $admin = $this->createAdmin();
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

        $response = $this->withSession($this->adminSession($admin))
            ->delete(route('categories.destroy', $category));

        $response->assertSessionHasErrors('category');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_category_deletion_succeeds_when_no_products_exist(): void
    {
        $admin = $this->createAdmin();
        $category = Category::create([
            'name' => 'Coffee',
            'description' => 'Test category',
        ]);

        $response = $this->withSession($this->adminSession($admin))
            ->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
