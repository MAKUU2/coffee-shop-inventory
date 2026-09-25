<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
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

    private function registerPayload(array $overrides = []): array
    {
        return array_merge([
            'first_name' => 'New',
            'middle_name' => null,
            'last_name' => 'Admin',
            'username' => 'newadmin',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ], $overrides);
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

    public function test_first_admin_registration_succeeds_when_no_admins_exist(): void
    {
        $this->assertDatabaseCount('admins', 0);

        $response = $this->post(route('register.store'), $this->registerPayload());

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('admins', [
            'username' => 'newadmin',
            'role' => 'admin',
        ]);
        $this->assertTrue(Hash::check(
            'password123',
            Admin::where('username', 'newadmin')->firstOrFail()->password
        ));
    }

    public function test_registration_is_blocked_once_an_admin_exists(): void
    {
        $this->createAdmin();

        $response = $this->post(route('register.store'), $this->registerPayload());

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Registration is closed. Please login.');
        $this->assertDatabaseCount('admins', 1);
        $this->assertDatabaseMissing('admins', ['username' => 'newadmin']);

        $this->get(route('register'))->assertRedirect(route('login'));
    }

    public function test_valid_login_succeeds(): void
    {
        $admin = $this->createAdmin();

        $response = $this->post(route('login.process'), [
            'username' => 'testadmin',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('admin_id', $admin->id);
    }

    public function test_invalid_login_fails_with_generic_error(): void
    {
        $this->createAdmin();

        $response = $this->post(route('login.process'), [
            'username' => 'testadmin',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('username');
        $response->assertSessionMissing('admin_id');
    }

    public function test_logout_clears_the_authenticated_session(): void
    {
        $this->createAdmin();
        $this->post(route('login.process'), [
            'username' => 'testadmin',
            'password' => 'password123',
        ]);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $response->assertSessionMissing('admin_id');
    }

    public function test_guest_cannot_access_the_dashboard(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_access_account_management(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withSession($this->adminSession($admin))
            ->get(route('admins.index'));

        $response->assertOk();
        $response->assertViewIs('admins.index');
    }

    public function test_guest_cannot_access_account_management(): void
    {
        $this->get(route('admins.index'))->assertRedirect(route('login'));
        $this->get(route('admins.create'))->assertRedirect(route('login'));

        $this->post(route('admins.store'), $this->registerPayload())
            ->assertRedirect(route('login'));
        $this->assertDatabaseCount('admins', 0);
    }

    public function test_authenticated_admin_can_create_another_admin(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withSession($this->adminSession($admin))
            ->post(route('admins.store'), $this->registerPayload());

        $response->assertRedirect(route('admins.index'));
        $this->assertDatabaseCount('admins', 2);
        $this->assertDatabaseHas('admins', [
            'username' => 'newadmin',
            'role' => 'admin',
        ]);
        $this->assertTrue(Hash::check(
            'password123',
            Admin::where('username', 'newadmin')->firstOrFail()->password
        ));
    }

    public function test_newly_created_admin_can_log_in(): void
    {
        $admin = $this->createAdmin();

        $this->withSession($this->adminSession($admin))
            ->post(route('admins.store'), $this->registerPayload());

        $newAdmin = Admin::where('username', 'newadmin')->firstOrFail();

        $response = $this->post(route('login.process'), [
            'username' => 'newadmin',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('admin_id', $newAdmin->id);
    }
}
