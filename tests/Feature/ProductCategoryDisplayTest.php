<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductCategoryDisplayTest extends TestCase
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

    public function test_products_index_displays_category_name(): void
    {
        $admin = $this->createAdmin();
        $category = Category::create([
            'name' => 'Espresso',
            'description' => 'Test category',
        ]);
        Product::create([
            'category_id' => $category->id,
            'name' => 'Latte',
            'description' => null,
            'price' => 150.00,
            'stock' => 10,
        ]);

        $response = $this->withSession($this->adminSession($admin))
            ->get(route('products.index'));

        $response->assertOk();
        $response->assertSee('Espresso');
    }

    public function test_products_index_displays_no_category_when_relationship_missing(): void
    {
        $product = new Product([
            'category_id' => 999999,
            'name' => 'Orphan Latte',
            'description' => null,
            'price' => 150.00,
            'stock' => 10,
        ]);
        $product->id = 1;
        $product->setRelation('category', null);

        $view = $this->view('products.index', [
            'products' => collect([$product]),
        ]);

        $view->assertSee('No Category');
    }
}
