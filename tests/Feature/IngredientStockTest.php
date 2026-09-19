<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class IngredientStockTest extends TestCase
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

    private function ingredientPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Arabica Beans',
            'description' => 'Test ingredient',
            'unit' => 'kg',
            'minimum_stock' => 5.00,
            'cost_per_unit' => 10.00,
        ], $overrides);
    }

    public function test_creating_ingredient_always_starts_with_zero_stock(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withSession($this->adminSession($admin))
            ->post(route('ingredients.store'), array_merge(
                $this->ingredientPayload(),
                ['stock' => 50]
            ));

        $response->assertRedirect(route('ingredients.index'));

        $ingredient = Ingredient::firstOrFail();
        $this->assertEquals(0.00, (float) $ingredient->stock);
    }

    public function test_creating_ingredient_does_not_create_stock_in_record(): void
    {
        $admin = $this->createAdmin();

        $this->withSession($this->adminSession($admin))
            ->post(route('ingredients.store'), array_merge(
                $this->ingredientPayload(),
                ['stock' => 50]
            ));

        $this->assertDatabaseCount('stock_ins', 0);
    }

    public function test_updating_ingredient_does_not_change_existing_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = Ingredient::create(array_merge(
            $this->ingredientPayload(),
            ['stock' => 20.00]
        ));

        $response = $this->withSession($this->adminSession($admin))
            ->put(route('ingredients.update', $ingredient), array_merge(
                $this->ingredientPayload(['name' => 'Arabica Beans']),
                ['stock' => 999]
            ));

        $response->assertRedirect(route('ingredients.index'));
        $this->assertEquals(20.00, (float) $ingredient->refresh()->stock);
    }

    public function test_updating_ingredient_can_change_other_fields(): void
    {
        $admin = $this->createAdmin();
        $ingredient = Ingredient::create(array_merge(
            $this->ingredientPayload(),
            ['stock' => 20.00]
        ));

        $response = $this->withSession($this->adminSession($admin))
            ->put(route('ingredients.update', $ingredient), $this->ingredientPayload([
                'name' => 'Robusta Beans',
                'minimum_stock' => 8.50,
                'cost_per_unit' => 12.75,
            ]));

        $response->assertRedirect(route('ingredients.index'));

        $ingredient->refresh();
        $this->assertEquals('Robusta Beans', $ingredient->name);
        $this->assertEquals(8.50, (float) $ingredient->minimum_stock);
        $this->assertEquals(12.75, (float) $ingredient->cost_per_unit);
        $this->assertEquals(20.00, (float) $ingredient->stock);
    }

    public function test_stock_in_still_increases_stock(): void
    {
        $admin = $this->createAdmin();

        $this->withSession($this->adminSession($admin))
            ->post(route('ingredients.store'), $this->ingredientPayload());

        $ingredient = Ingredient::firstOrFail();
        $this->assertEquals(0.00, (float) $ingredient->stock);

        $response = $this->withSession($this->adminSession($admin))
            ->post(route('stock-ins.store'), [
                'ingredient_id' => $ingredient->id,
                'quantity' => 10.50,
                'cost_per_unit' => 10.00,
                'stock_in_date' => now()->toDateString(),
            ]);

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertEquals(10.50, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_out_still_decreases_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = Ingredient::create(array_merge(
            $this->ingredientPayload(),
            ['stock' => 20.00]
        ));

        $response = $this->withSession($this->adminSession($admin))
            ->post(route('stock-outs.store'), [
                'ingredient_id' => $ingredient->id,
                'quantity' => 5.00,
                'stock_out_date' => now()->toDateString(),
            ]);

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertEquals(15.00, (float) $ingredient->refresh()->stock);
    }
}
