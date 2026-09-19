<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_users_are_redirected_from_dashboard_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_access_the_dashboard(): void
    {
        $admin = Admin::create([
            'first_name' => 'Test',
            'middle_name' => null,
            'last_name' => 'Admin',
            'username' => 'testadmin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->withSession([
            'admin_id' => $admin->id,
            'admin_username' => $admin->username,
            'admin_name' => $admin->first_name.' '.$admin->last_name,
            'admin_role' => $admin->role,
        ])->get('/');

        $response->assertOk();
        $response->assertViewIs('dashboard');
    }
}
