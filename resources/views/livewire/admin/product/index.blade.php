{{-- ============================================ --}}
{{-- ADMIN: LISTADO DE PRODUCTOS                  --}}
{{-- ============================================ --}}
<div>
    {{-- Mensaje flash después de crear/editar/eliminar --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Encabezado: buscador + botón crear --}}
    <div class="card mb-4">
        <div class="card-header">
            <div class="row align-items-center">
                {{-- Buscador --}}
                <div class="col-sm-6">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Buscar productos..."
                        wire:model.live.debounce.300ms="search"
                    >
                </div>
                {{-- Botón crear --}}
                <div class="col-sm-6 text-end mt-2 mt-sm-0">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Nuevo Producto
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        {{-- Al hacer click ordena por ese campo --}}
                        <th role="button" wire:click="sortBy('name')" class="user-select-none">
                            Nombre
                            <i class="bi bi-arrow-{{ $sortField === 'name' ? ($sortDirection === 'asc' ? 'up' : 'down') : 'down' }}"></i>
                        </th>
                        <th role="button" wire:click="sortBy('price')" class="user-select-none">
                            Precio
                            <i class="bi bi-arrow-{{ $sortField === 'price' ? ($sortDirection === 'asc' ? 'up' : 'down') : 'down' }}"></i>
                        </th>
                        <th>Descripción</th>
                        <th role="button" wire:click="sortBy('created_at')" class="user-select-none">
                            Creado
                            <i class="bi bi-arrow-{{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? 'up' : 'down') : 'down' }}"></i>
                        </th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                {{-- Botón editar --}}
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-sm btn-info"
                                   title="Editar producto">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                {{-- Botón eliminar con confirmación --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    title="Eliminar producto"
                                    onclick="confirm('¿Eliminar este producto?') || event.stopImmediatePropagation()"
                                    wire:click="deleteProduct({{ $product->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No se encontraron productos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Paginación --}}
        <div class="card-footer">
            {{ $products->links() }}
        </div>
    </div>
</div>
