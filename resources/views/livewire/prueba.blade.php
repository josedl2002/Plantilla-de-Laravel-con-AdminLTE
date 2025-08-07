<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 fw-bold">Registro de Producto</h2>

                    <!-- Mensajes -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="submit">
                        <!-- Nombre -->
                        <div class="form-floating mb-3">
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                placeholder="Nombre del Producto"
                                wire:model="name"
                                required
                            >
                            <label for="name">Nombre del Producto *</label>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Precio -->
                        <div class="form-floating mb-3">
                            <input 
                                type="number" 
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                placeholder="Precio"
                                wire:model="price"
                                step="0.01" 
                                min="0.01"
                                required
                            >
                            <label for="price">Precio (USD) *</label>
                            @error('price')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Descripción -->
                        <div class="form-floating mb-4">
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                placeholder="Descripción"
                                wire:model="description"
                                style="height: 100px"
                            ></textarea>
                            <label for="description">Descripción</label>
                            @error('description')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button 
                                type="submit" 
                                class="btn btn-primary btn-lg"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading.remove>Registrar Producto</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm"></span>
                                    Procesando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
