<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UsersTable extends Component
{
    use WithPagination;

    // Search & sort
    public string $search = '';
    public string $sortField = 'nombre';
    public string $sortDirection = 'asc';

    // Delete
    public ?string $confirmingDeleteId = null;

    // ── Create modal ──────────────────────────────────────────────────────────
    public bool $showCreateModal = false;
    public string $nombre = '';
    public string $apellidos = '';
    public string $telefono = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $direccion = '';
    public bool $isAdmin = false;

    // ── Edit modal ────────────────────────────────────────────────────────────
    public bool $showEditModal = false;
    public ?string $editingUserId = null;
    public string $editNombre = '';
    public string $editApellidos = '';
    public string $editTelefono = '';
    public string $editEmail = '';
    public string $editDireccion = '';
    public bool $editIsAdmin = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    // ── Validation ────────────────────────────────────────────────────────────

    protected function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:64'],
            'apellidos' => ['required', 'string', 'max:64'],
            'telefono' => ['required', 'string', 'max:21'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'direccion' => ['nullable', 'string', 'max:255'],
            'isAdmin' => ['boolean'],
        ];
    }

    protected function editRules(): array
    {
        return [
            'editNombre' => ['required', 'string', 'max:64'],
            'editApellidos' => ['required', 'string', 'max:64'],
            'editTelefono' => ['required', 'string', 'max:21'],
            'editEmail' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->editingUserId)],
            'editDireccion' => ['nullable', 'string', 'max:255'],
            'editIsAdmin' => ['boolean'],
        ];
    }

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellidos' => 'apellidos',
        'telefono' => 'teléfono',
        'email' => 'email',
        'password' => 'contraseña',
        'direccion' => 'dirección',
        'editNombre' => 'nombre',
        'editApellidos' => 'apellidos',
        'editTelefono' => 'teléfono',
        'editEmail' => 'email',
        'editDireccion' => 'dirección',
    ];

    // ── Search / sort ─────────────────────────────────────────────────────────

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
        else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // ── Delete ────────────────────────────────────────────────────────────────

    public function confirmDelete(string $id): void
    {
        $this->confirmingDeleteId = $id;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteUser(string $id): void
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'No puedes eliminar tu propia cuenta.');
            $this->confirmingDeleteId = null;
            return;
        }

        $user->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Usuario eliminado correctamente.');
    }

    // ── Toggle admin ──────────────────────────────────────────────────────────

    public function toggleAdmin(string $id): void
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'No puedes modificar tu propio rol.');
            return;
        }

        $user->update(['isAdmin' => !$user->isAdmin]);
    }

    // ── Create ────────────────────────────────────────────────────────────────

    public function openCreateModal(): void
    {
        $this->resetCreateForm();
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
        $this->resetCreateForm();
        $this->resetValidation();
    }

    public function createUser(): void
    {
        $this->validate();

        User::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'direccion' => $this->direccion ?: null,
            'isAdmin' => $this->isAdmin,
        ]);

        $this->closeCreateModal();
        session()->flash('success', 'Usuario creado correctamente.');
    }

    private function resetCreateForm(): void
    {
        $this->nombre = '';
        $this->apellidos = '';
        $this->telefono = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->direccion = '';
        $this->isAdmin = false;
    }

    // ── Edit ──────────────────────────────────────────────────────────────────

    public function openEditModal(string $id): void
    {
        $user = User::findOrFail($id);

        $this->editingUserId = $user->id;
        $this->editNombre = $user->nombre;
        $this->editApellidos = $user->apellidos;
        $this->editTelefono = $user->telefono ?? '';
        $this->editEmail = $user->email;
        $this->editDireccion = $user->direccion ?? '';
        $this->editIsAdmin = (bool)$user->isAdmin;

        $this->resetValidation();
        $this->showEditModal = true;
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingUserId = null;
        $this->resetValidation();
    }

    public function updateUser(): void
    {
        $this->validate($this->editRules());

        $user = User::findOrFail($this->editingUserId);

        // Prevent removing your own admin role
        if ($user->id === auth()->id() && !$this->editIsAdmin) {
            $this->addError('editIsAdmin', 'No puedes quitarte el rol de administrador.');
            return;
        }

        $user->update([
            'nombre' => $this->editNombre,
            'apellidos' => $this->editApellidos,
            'telefono' => $this->editTelefono,
            'email' => $this->editEmail,
            'direccion' => $this->editDireccion ?: null,
            'isAdmin' => $this->editIsAdmin,
        ]);

        $this->closeEditModal();
        session()->flash('success', 'Usuario actualizado correctamente.');
    }

    // ── Render ────────────────────────────────────────────────────────────────

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
            $query->where(function ($q) {
                    $q->where('nombre', 'ilike', "%{$this->search}%")
                        ->orWhere('apellidos', 'ilike', "%{$this->search}%")
                        ->orWhere('email', 'ilike', "%{$this->search}%")
                        ->orWhere('telefono', 'ilike', "%{$this->search}%");
                }
                );
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.users-table', [
            'users' => $users,
        ]);
    }
}