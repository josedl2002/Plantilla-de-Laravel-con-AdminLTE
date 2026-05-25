<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    // Modal crear/editar
    public $showUserModal = false;
    public $editUserId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $selectedRole = '';

    // Confirmación de eliminación
    public $confirmDeleteUserId = null;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->editUserId),
            ],
            'selectedRole' => 'nullable|string',
        ];

        // Solo validar password si se está creando o si se llenó el campo al editar
        if (!$this->editUserId || !empty($this->password)) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'Ingresa un email válido.',
        'email.unique' => 'Este email ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Abre el modal para crear un nuevo usuario
     */
    public function openCreateUser()
    {
        $this->reset(['editUserId', 'name', 'email', 'password', 'password_confirmation', 'selectedRole']);
        $this->dispatch('show-user-modal');
    }

    public function openEditUser($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $this->editUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = $user->getRoleNames()->first() ?? '';
        $this->dispatch('show-user-modal');
    }

    public function closeUserModal()
    {
        $this->dispatch('hide-user-modal');
        $this->resetErrorBag();
    }

    /**
     * Se ejecuta cuando el modal se oculta (close/backdrop/Escape)
     */
    public function userModalHidden()
    {
        $this->resetErrorBag();
    }

    public function saveUser()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->editUserId) {
            $user = User::findOrFail($this->editUserId);

            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
            $user->syncRoles($this->selectedRole ? [$this->selectedRole] : []);

            session()->flash('message', "Usuario '{$user->name}' actualizado correctamente.");
        } else {
            $data['password'] = Hash::make($this->password);

            $user = User::create($data);
            $user->syncRoles($this->selectedRole ? [$this->selectedRole] : []);

            session()->flash('message', "Usuario '{$user->name}' creado correctamente.");
        }

        $this->closeUserModal();
    }

    /**
     * Solicita confirmación de eliminación
     */
    public function confirmDelete($id)
    {
        $this->confirmDeleteUserId = $id;
    }

    /**
     * Cancela la eliminación
     */
    public function cancelDelete()
    {
        $this->confirmDeleteUserId = null;
    }

    /**
     * Elimina un usuario (evita que se borre a sí mismo)
     */
    public function deleteUser($id)
    {
        if ((int) $id === (int) auth()->id()) {
            session()->flash('error', 'No puedes eliminar tu propio usuario.');
            $this->cancelDelete();
            return;
        }

        $user = User::findOrFail($id);
        $userName = $user->name;
        $user->delete();

        $this->cancelDelete();
        session()->flash('message', "Usuario '{$userName}' eliminado correctamente.");
    }

    public function render()
    {
        $users = User::with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $roles = Role::orderBy('name')->get();

        return view('livewire.admin.user.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
