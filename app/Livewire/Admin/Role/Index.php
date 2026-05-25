<?php

namespace App\Livewire\Admin\Role;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    // Modal crear/editar
    public $showRoleModal = false;
    public $editRoleId = null;
    public $roleName = '';
    public $selectedPermissions = [];
    public $newPermissionId = '';

    // Confirmación de eliminación
    public $confirmDeleteRoleId = null;

    protected function rules()
    {
        return [
            'roleName' => 'required|string|max:255|unique:roles,name,' . $this->editRoleId,
        ];
    }

    protected $messages = [
        'roleName.required' => 'El nombre del rol es obligatorio.',
        'roleName.unique' => 'Ya existe un rol con ese nombre.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Abre el modal en modo creación
     */
    public function openCreateRole()
    {
        $this->reset(['editRoleId', 'roleName', 'selectedPermissions', 'newPermissionId']);
        $this->dispatch('show-role-modal');
    }

    public function openEditRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $this->editRoleId = $role->id;
        $this->roleName = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->map(fn($id) => (string) $id)->toArray();
        $this->dispatch('show-role-modal');
    }

    public function closeRoleModal()
    {
        $this->dispatch('hide-role-modal');
        $this->resetErrorBag();
    }

    /**
     * Se ejecuta cuando el modal se oculta (close/backdrop/Escape)
     */
    public function roleModalHidden()
    {
        $this->resetErrorBag();
    }

    public function addPermission()
    {
        $this->validate([
            'newPermissionId' => 'required|exists:permissions,id',
        ]);

        if (!in_array($this->newPermissionId, $this->selectedPermissions)) {
            $this->selectedPermissions[] = $this->newPermissionId;
        }

        $this->newPermissionId = '';
    }

    public function removePermission($id)
    {
        $this->selectedPermissions = array_values(
            array_filter($this->selectedPermissions, fn($p) => $p != $id)
        );
    }

    public function saveRole()
    {
        $this->validate();

        if ($this->editRoleId) {
            $role = Role::findOrFail($this->editRoleId);
            $role->update(['name' => $this->roleName]);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', "Rol '{$role->name}' actualizado correctamente.");
        } else {
            $role = Role::create(['name' => $this->roleName]);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', "Rol '{$role->name}' creado correctamente.");
        }

        $this->closeRoleModal();
    }

    /**
     * Solicita confirmación antes de eliminar
     */
    public function confirmDelete($id)
    {
        $this->confirmDeleteRoleId = $id;
    }

    /**
     * Cancela la eliminación
     */
    public function cancelDelete()
    {
        $this->confirmDeleteRoleId = null;
    }

    /**
     * Elimina un rol solo si no tiene usuarios asignados
     */
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        // Protección: contar usuarios con este rol vía Spatie
        $userCount = DB::table('model_has_roles')
            ->where('role_id', $role->id)
            ->count();

        if ($userCount > 0) {
            session()->flash('error', "No se puede eliminar el rol '{$role->name}' porque tiene {$userCount} usuario(s) asignado(s).");
            $this->cancelDelete();
            return;
        }

        $roleName = $role->name;
        $role->delete();

        $this->cancelDelete();
        session()->flash('message', "Rol '{$roleName}' eliminado correctamente.");
    }

    public function render()
    {
        $roles = Role::with('permissions')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate(10);

        // Contar usuarios por rol para mostrar en la tabla
        $userCounts = DB::table('model_has_roles')
            ->select('role_id', DB::raw('count(*) as total'))
            ->groupBy('role_id')
            ->pluck('total', 'role_id');

        $allPermissions = Permission::orderBy('name')->get();

        // Excluir del select los permisos ya agregados
        $availablePermissions = $allPermissions->reject(
            fn($perm) => in_array((string) $perm->id, $this->selectedPermissions)
        )->values();

        return view('livewire.admin.role.index', [
            'roles' => $roles,
            'userCounts' => $userCounts,
            'allPermissions' => $allPermissions,
            'availablePermissions' => $availablePermissions,
        ]);
    }
}
