{{-- ============================================ --}}
{{-- ADMIN: FORMULARIO DE PRODUCTO (Crear/Editar) --}}
{{-- ============================================ --}}
<div>
    {{-- Mensaje flash --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.products') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card-body">
            {{-- El formulario se envía con Livewire --}}
            <form wire:submit.prevent="save">
                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Producto</label>
                    <input
                        type="text"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        wire:model.blur="name"
                        placeholder="Ej: Laptop Gamer"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Precio --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                            type="number"
                            id="price"
                            step="0.01"
                            min="0.01"
                            class="form-control @error('price') is-invalid @enderror"
                            wire:model.blur="price"
                            placeholder="0.00"
                        >
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        wire:model.blur="description"
                        placeholder="Descripción del producto (opcional)"
                    ></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        {{ $isEditing ? 'Actualizar' : 'Crear' }} Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
