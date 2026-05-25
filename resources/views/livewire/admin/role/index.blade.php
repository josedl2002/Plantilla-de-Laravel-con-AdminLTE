{{-- ============================================ --}}
{{-- ADMIN: GESTIÓN DE ROLES                     --}}
{{-- CRUD completo con protección al eliminar     --}}
{{-- ============================================ --}}
<div>
    {{-- Mensajes flash --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Info boxes --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary">
                    <i class="bi bi-shield-lock-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Roles</span>
                    <span class="info-box-number">{{ $roles->total() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-info">
                    <i class="bi bi-key-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Permisos</span>
                    <span class="info-box-number">{{ $allPermissions->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-success">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios con roles</span>
                    <span class="info-box-number">{{ $userCounts->sum() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Encabezado: buscador + botón crear --}}
    <div class="card mb-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar roles..."
                               wire:model.live.debounce.300ms="search">
                    </div>
                </div>
                <div class="col-sm-6 text-end mt-2 mt-sm-0">
                    <button class="btn btn-primary" wire:click="openCreateRole">
                        <i class="bi bi-plus-lg me-1"></i> Nuevo Rol
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de roles --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles del sistema</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>
        <div class="card-body table-responsive p-0" style="max-height: 500px;">
            <table class="table table-hover table-head-fixed align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuarios</th>
                        <th>Permisos</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td><strong>{{ $role->name }}</strong></td>
                            <td>
                                <span class="badge bg-{{ ($userCounts[$role->id] ?? 0) > 0 ? 'primary' : 'secondary' }}">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $userCounts[$role->id] ?? 0 }}
                                </span>
                            </td>
                            <td>
                                @forelse ($role->permissions as $perm)
                                    <span class="badge bg-info me-1">{{ $perm->name }}</span>
                                @empty
                                    <span class="text-muted">Sin permisos</span>
                                @endforelse
                            </td>
                            <td class="text-end text-nowrap">
                                <button class="btn btn-sm btn-info" wire:click="openEditRole({{ $role->id }})" title="Editar rol" data-bs-toggle="tooltip">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                @if ($confirmDeleteRoleId === $role->id)
                                    <span class="d-inline-flex align-items-center gap-1 ms-2">
                                        <span class="small text-danger">¿Eliminar?</span>
                                        <button class="btn btn-sm btn-success" wire:click="deleteRole({{ $role->id }})" title="Confirmar">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary" wire:click="cancelDelete" title="Cancelar">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </span>
                                @else
                                    <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $role->id }})" title="Eliminar rol" data-bs-toggle="tooltip">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-shield-lock fs-1 d-block mb-2"></i>
                                    <p class="mb-0">No se encontraron roles.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($roles->hasPages())
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $roles->links() }}
                </div>
            </div>
        @endif
    </div>

    {{-- ============================================ --}}
    {{-- MODAL: CREAR / EDITAR ROL                   --}}
    {{-- Animado con Bootstrap JS + Livewire @script --}}
    {{-- ============================================ --}}
    <div wire:ignore.self class="modal fade" id="roleModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="saveRole">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-{{ $editRoleId ? 'pencil' : 'shield-plus' }} me-2"></i>
                            {{ $editRoleId ? 'Editar Rol' : 'Crear Rol' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-outline card-primary mb-0">
                            <div class="card-header">
                                <h6 class="card-title">Información del rol</h6>
                            </div>
                            <div class="card-body">
                                <label for="roleName" class="form-label">
                                    <i class="bi bi-tag me-1"></i>Nombre del Rol
                                </label>
                                <input type="text" id="roleName"
                                       class="form-control @error('roleName') is-invalid @enderror"
                                       wire:model.blur="roleName" placeholder="Ej: editor">
                                @error('roleName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                            <div class="card card-outline card-success mt-3">
                            <div class="card-header">
                                <h6 class="card-title">
                                    <i class="bi bi-key me-1"></i>Permisos
                                </h6>
                            </div>
                            <div class="card-body">
                                @error('selectedPermissions')
                                    <div class="alert alert-danger py-2">{{ $message }}</div>
                                @enderror

                                @if ($allPermissions->isEmpty())
                                    <p class="text-muted small mb-0">
                                        No hay permisos disponibles. Ejecuta <code>php artisan db:seed --class=RoleSeeder</code> para crearlos.
                                    </p>
                                @else
                                    <div class="input-group mb-3">
                                        <select class="form-control" wire:model.blur="newPermissionId">
                                            <option value="">— Seleccionar permiso —</option>
                                            @foreach ($availablePermissions as $perm)
                                                <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-outline-success" type="button"
                                                wire:click="addPermission">
                                            <i class="bi bi-plus-lg"></i> Agregar
                                        </button>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        @forelse ($selectedPermissions as $permId)
                                            @php
                                                $permName = $allPermissions->firstWhere('id', $permId)?->name ?? 'Permiso #' . $permId;
                                            @endphp
                                            <span class="badge bg-success fs-6 d-flex align-items-center gap-1 py-2 px-3">
                                                {{ $permName }}
                                                <a href="#" class="text-white text-decoration-none"
                                                   wire:click.prevent="removePermission({{ $permId }})"
                                                   title="Quitar permiso">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                            </span>
                                        @empty
                                            <p class="text-muted small mb-0">No hay permisos agregados.</p>
                                        @endforelse
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ $editRoleId ? 'Actualizar' : 'Crear' }} Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @script
        <script>
            const roleModal = new bootstrap.Modal(document.getElementById('roleModal'));
            $wire.on('show-role-modal', () => roleModal.show());
            $wire.on('hide-role-modal', () => roleModal.hide());
            document.getElementById('roleModal').addEventListener('hidden.bs.modal', () => {
                $wire.dispatch('role-modal-hidden');
            });
        </script>
    @endscript
</div>
