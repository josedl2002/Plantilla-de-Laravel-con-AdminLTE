{{-- ============================================ --}}
{{-- ADMIN: GESTIÓN DE USUARIOS                  --}}
{{-- Tabla + Modal para crear/editar/eliminar    --}}
{{-- ============================================ --}}
<div>
    {{-- Mensajes --}}
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
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Usuarios</span>
                    <span class="info-box-number">{{ $users->total() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-success">
                    <i class="bi bi-person-check-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Con Rol</span>
                    <span class="info-box-number">{{ $users->filter(fn($u) => $u->roles->isNotEmpty())->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-secondary">
                    <i class="bi bi-person-dash-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Sin Rol</span>
                    <span class="info-box-number">{{ $users->filter(fn($u) => $u->roles->isEmpty())->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-info">
                    <i class="bi bi-shield-check"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Roles</span>
                    <span class="info-box-number">{{ $roles->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Buscador + botón crear --}}
    <div class="card mb-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar usuarios por nombre o email..."
                               wire:model.live.debounce.300ms="search">
                    </div>
                </div>
                <div class="col-sm-6 text-end mt-2 mt-sm-0">
                    <button class="btn btn-primary" wire:click="openCreateUser">
                        <i class="bi bi-plus-lg me-1"></i> Nuevo Usuario
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de usuarios --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Usuarios registrados</h3>
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
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Registrado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->profile_photo_url }}" alt="Avatar"
                                         class="rounded-circle me-2 img-size-32">
                                    <span>{{ $user->name }}</span>
                                    @if ((int) $user->id === (int) auth()->id())
                                        <span class="badge bg-success ms-2">Tú</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge bg-primary me-1">{{ $role }}</span>
                                @empty
                                    <span class="badge bg-secondary">Sin rol</span>
                                @endforelse
                            </td>
                            <td class="text-nowrap">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-end text-nowrap">
                                <button class="btn btn-sm btn-info" wire:click="openEditUser({{ $user->id }})" title="Editar usuario" data-bs-toggle="tooltip">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                @if ($confirmDeleteUserId === $user->id)
                                    <span class="d-inline-flex align-items-center gap-1 ms-2">
                                        <span class="small text-danger">¿Eliminar?</span>
                                        <button class="btn btn-sm btn-success" wire:click="deleteUser({{ $user->id }})" title="Confirmar">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary" wire:click="cancelDelete" title="Cancelar">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </span>
                                @else
                                    <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $user->id }})" title="Eliminar usuario" data-bs-toggle="tooltip">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    <p class="mb-0">No se encontraron usuarios.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $users->links() }}
                </div>
            </div>
        @endif
    </div>

    {{-- ============================================ --}}
    {{-- MODAL: CREAR / EDITAR USUARIO               --}}
    {{-- Animado con Bootstrap JS + Livewire @script --}}
    {{-- ============================================ --}}
    <div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="saveUser">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-{{ $editUserId ? 'pencil' : 'person-plus' }} me-2"></i>
                            {{ $editUserId ? 'Editar Usuario' : 'Crear Usuario' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-outline card-primary mb-0">
                            <div class="card-header">
                                <h6 class="card-title">Datos del usuario</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="userName" class="form-label">
                                            <i class="bi bi-person me-1"></i>Nombre
                                        </label>
                                        <input type="text" id="userName"
                                               class="form-control @error('name') is-invalid @enderror"
                                               wire:model.blur="name" placeholder="Nombre completo">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="userEmail" class="form-label">
                                            <i class="bi bi-envelope me-1"></i>Email
                                        </label>
                                        <input type="email" id="userEmail"
                                               class="form-control @error('email') is-invalid @enderror"
                                               wire:model.blur="email" placeholder="correo@ejemplo.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="userPassword" class="form-label">
                                            <i class="bi bi-lock me-1"></i>
                                            Contraseña {{ $editUserId ? '(dejar vacío para no cambiar)' : '' }}
                                        </label>
                                        <input type="password" id="userPassword"
                                               class="form-control @error('password') is-invalid @enderror"
                                               wire:model.blur="password" placeholder="Mínimo 8 caracteres">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="userPasswordConfirmation" class="form-label">
                                            <i class="bi bi-lock-fill me-1"></i>Confirmar Contraseña
                                        </label>
                                        <input type="password" id="userPasswordConfirmation"
                                               class="form-control"
                                               wire:model.blur="password_confirmation" placeholder="Repite la contraseña">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-success mt-3">
                            <div class="card-header">
                                <h6 class="card-title">
                                    <i class="bi bi-shield-check me-1"></i>Rol
                                </h6>
                            </div>
                            <div class="card-body">
                                <select class="form-control @error('selectedRole') is-invalid @enderror"
                                        wire:model.blur="selectedRole">
                                    <option value="">— Sin rol —</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedRole')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($roles->isEmpty())
                                    <p class="text-muted small mb-0 mt-2">
                                        No hay roles disponibles.
                                        <a href="{{ route('admin.roles') }}">Crea uno aquí</a>.
                                    </p>
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
                            {{ $editUserId ? 'Actualizar' : 'Crear' }} Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @script
        <script>
            const userModal = new bootstrap.Modal(document.getElementById('userModal'));
            $wire.on('show-user-modal', () => userModal.show());
            $wire.on('hide-user-modal', () => userModal.hide());
            document.getElementById('userModal').addEventListener('hidden.bs.modal', () => {
                $wire.dispatch('user-modal-hidden');
            });
        </script>
    @endscript
</div>
