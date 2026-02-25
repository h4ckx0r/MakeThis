<?php

use App\Livewire\Admin\UserList;
use App\Models\User;
use Livewire\Livewire;

test('admins can see the user list page with its Livewire component', function () {
    $admin = User::factory()->create(['isAdmin' => true]);

    $this->actingAs($admin)
        ->get(route('admin.users'))
        ->assertOk()
        ->assertSeeLivewire(UserList::class);
});

test('user list paginates results', function () {
    $admin = User::factory()->create(['isAdmin' => true]);

    // Create 12 users to span two pages (10 per page by default)
    $latestUser = User::factory()->create(['nombre' => 'Usuario Nuevo']);
    User::factory()->count(10)->create();
    $oldestUser = User::factory()->create([
        'nombre' => 'Usuario Antiguo',
        'created_at' => now()->subDays(5),
    ]);

    $this->actingAs($admin);

    $component = Livewire::test(UserList::class);

    $component
        ->assertSee($latestUser->nombre)
        ->assertDontSee($oldestUser->nombre);

    $component
        ->call('gotoPage', 2)
        ->assertSee($oldestUser->nombre)
        ->assertDontSee($latestUser->nombre);
});

test('admins can delete a user from the list', function () {
    $admin = User::factory()->create(['isAdmin' => true]);
    $userToDelete = User::factory()->create(['nombre' => 'Usuario A Eliminar']);

    $this->actingAs($admin);

    $component = Livewire::test(UserList::class);

    $component
        ->call('confirmarEliminacion', $userToDelete->id)
        ->call('eliminarUsuario')
        ->assertSet('usuarioAEliminarId', null);

    expect(User::query()->whereKey($userToDelete->id)->exists())->toBeFalse();
});
