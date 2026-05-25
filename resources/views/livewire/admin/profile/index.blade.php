{{-- ============================================ --}}
{{-- ADMIN: PERFIL DE USUARIO                    --}}
{{-- Permite editar nombre, email y contraseña   --}}
{{-- ============================================ --}}
<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- Columna izquierda: Información del perfil --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información del Perfil</h3>
                </div>
                <div class="card-body">
                    {{-- Formulario de perfil --}}
                    <form wire:submit.prevent="updateProfile">
                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input
                                type="text"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                wire:model.blur="name"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                wire:model.blur="email"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Guardar Cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Columna derecha: Cambiar contraseña --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cambiar Contraseña</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="updatePassword">
                        {{-- Contraseña actual --}}
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input
                                type="password"
                                id="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                wire:model.blur="current_password"
                            >
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nueva contraseña --}}
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input
                                type="password"
                                id="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                wire:model.blur="new_password"
                            >
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmar nueva contraseña --}}
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input
                                type="password"
                                id="new_password_confirmation"
                                class="form-control"
                                wire:model.blur="new_password_confirmation"
                            >
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-key"></i> Cambiar Contraseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
