<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Ingredient;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class InventoryTest extends TestCase
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

    public function test_stock_in_store_creates_record_and_increases_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 20.00]);

        $response = $this->withSession($this->adminSession($admin))->post(route('stock-ins.store'), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
            'notes' => null,
        ]);

        $response->assertRedirect(route('stock-ins.index'));

        $this->assertDatabaseHas('stock_ins', [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
        ]);

        $this->assertEquals(30.50, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_in_store_rejects_non_positive_quantity(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 20.00]);

        $response = $this->withSession($this->adminSession($admin))->post(route('stock-ins.store'), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 0,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('stock_ins', 0);
        $this->assertEquals(20.00, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_in_update_same_ingredient_adjusts_stock_by_difference(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 20.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 15.50,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertEquals(25.50, (float) $ingredient->refresh()->stock);
        $this->assertEquals(15.50, (float) $stockIn->refresh()->quantity);
    }

    public function test_stock_in_update_same_ingredient_rejected_when_stock_would_go_negative(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 5.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 2.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');
        $this->assertEquals(5.00, (float) $ingredient->refresh()->stock);
        $this->assertEquals(10.00, (float) $stockIn->refresh()->quantity);
    }

    public function test_stock_in_update_changing_ingredient_moves_stock_correctly(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 20.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 30.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 4.50,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertEquals(10.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(34.50, (float) $newIngredient->refresh()->stock);
    }

    public function test_stock_in_update_changing_ingredient_rejected_when_old_stock_would_go_negative(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 5.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 30.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 4.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');
        $this->assertEquals(5.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(30.00, (float) $newIngredient->refresh()->stock);
        $this->assertEquals($oldIngredient->id, $stockIn->refresh()->ingredient_id);
    }

    public function test_stock_in_destroy_decrements_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 25.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->delete(route('stock-ins.destroy', $stockIn));

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertDatabaseMissing('stock_ins', ['id' => $stockIn->id]);
        $this->assertEquals(14.50, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_in_destroy_rejected_when_stock_would_go_negative(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 5.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->delete(route('stock-ins.destroy', $stockIn));

        $response->assertSessionHasErrors('quantity');
        $this->assertDatabaseHas('stock_ins', ['id' => $stockIn->id]);
        $this->assertEquals(5.00, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_out_store_creates_record_and_decreases_stock_with_exact_boundary(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 10.50]);

        $response = $this->withSession($this->adminSession($admin))->post(route('stock-outs.store'), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-outs.index'));

        $this->assertDatabaseHas('stock_outs', [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
        ]);
        $this->assertEquals(0.00, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_out_store_rejected_when_quantity_exceeds_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 5.00]);

        $response = $this->withSession($this->adminSession($admin))->post(route('stock-outs.store'), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.50,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');
        $this->assertDatabaseCount('stock_outs', 0);
        $this->assertEquals(5.00, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_out_update_increasing_beyond_stock_is_rejected(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 3.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 5.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');
        $this->assertEquals(3.00, (float) $ingredient->refresh()->stock);
        $this->assertEquals(5.00, (float) $stockOut->refresh()->quantity);
    }

    public function test_stock_out_update_decreasing_quantity_restores_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 5.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 6.50,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertEquals(8.50, (float) $ingredient->refresh()->stock);
        $this->assertEquals(6.50, (float) $stockOut->refresh()->quantity);
    }

    public function test_stock_out_update_changing_ingredient_moves_stock_correctly(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 5.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 20.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 7.25,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertEquals(15.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(12.75, (float) $newIngredient->refresh()->stock);
    }

    public function test_stock_out_update_changing_ingredient_rejected_when_new_stock_insufficient(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 5.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 5.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('quantity');
        $this->assertEquals(5.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(5.00, (float) $newIngredient->refresh()->stock);
        $this->assertEquals($oldIngredient->id, $stockOut->refresh()->ingredient_id);
    }

    public function test_stock_out_destroy_restores_stock(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 5.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response = $this->withSession($this->adminSession($admin))->delete(route('stock-outs.destroy', $stockOut));

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertDatabaseMissing('stock_outs', ['id' => $stockOut->id]);
        $this->assertEquals(15.00, (float) $ingredient->refresh()->stock);
    }

    public function test_unauthenticated_stock_in_post_redirects_to_login(): void
    {
        $response = $this->post(route('stock-ins.store'), [
            'ingredient_id' => 1,
            'quantity' => 1,
            'cost_per_unit' => 1,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_unauthenticated_stock_out_post_redirects_to_login(): void
    {
        $response = $this->post(route('stock-outs.store'), [
            'ingredient_id' => 1,
            'quantity' => 1,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_stock_in_update_uses_fresh_ledger_value_same_ingredient(): void
    {
        // SQLite :memory: cannot prove true concurrent locking; this proves
        // update() calculates from the current database ledger row.
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 20.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        // Simulate another committed change before the PUT request.
        $stockIn->update(['quantity' => 6.00]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 15.50,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertEquals(15.50, (float) $stockIn->refresh()->quantity);
        $this->assertEquals(29.50, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_in_update_uses_fresh_ledger_value_when_switching_ingredient(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 20.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 30.00]);
        $stockIn = StockIn::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 10.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        // Simulate another committed change before the PUT request.
        $stockIn->update(['quantity' => 4.00]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-ins.update', $stockIn), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 7.00,
            'cost_per_unit' => 12.00,
            'stock_in_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-ins.index'));
        $this->assertEquals($newIngredient->id, $stockIn->refresh()->ingredient_id);
        $this->assertEquals(7.00, (float) $stockIn->refresh()->quantity);
        $this->assertEquals(16.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(37.00, (float) $newIngredient->refresh()->stock);
    }

    public function test_stock_out_update_uses_fresh_ledger_value_same_ingredient(): void
    {
        $admin = $this->createAdmin();
        $ingredient = $this->createIngredient(['stock' => 12.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $ingredient->id,
            'quantity' => 5.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        // Simulate another committed change before the PUT request.
        $stockOut->update(['quantity' => 8.00]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $ingredient->id,
            'quantity' => 10.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertEquals(10.00, (float) $stockOut->refresh()->quantity);
        $this->assertEquals(10.00, (float) $ingredient->refresh()->stock);
    }

    public function test_stock_out_update_uses_fresh_ledger_value_when_switching_ingredient(): void
    {
        $admin = $this->createAdmin();
        $oldIngredient = $this->createIngredient(['name' => 'Old Beans', 'stock' => 15.00]);
        $newIngredient = $this->createIngredient(['name' => 'New Beans', 'stock' => 20.00]);
        $stockOut = StockOut::create([
            'ingredient_id' => $oldIngredient->id,
            'quantity' => 5.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        // Simulate another committed change before the PUT request.
        $stockOut->update(['quantity' => 9.00]);

        $response = $this->withSession($this->adminSession($admin))->put(route('stock-outs.update', $stockOut), [
            'ingredient_id' => $newIngredient->id,
            'quantity' => 6.00,
            'stock_out_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('stock-outs.index'));
        $this->assertEquals($newIngredient->id, $stockOut->refresh()->ingredient_id);
        $this->assertEquals(6.00, (float) $stockOut->refresh()->quantity);
        $this->assertEquals(24.00, (float) $oldIngredient->refresh()->stock);
        $this->assertEquals(14.00, (float) $newIngredient->refresh()->stock);
    }
}
