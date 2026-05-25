{{-- ============================================ --}}
{{-- LIVEWIRE: SIDEBAR ADMINLTE                  --}}
{{-- Versión Livewire del sidebar (reactivo)      --}}
{{-- ============================================ --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" wire:ignore.self>
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">Administrador</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false">

                <li class="nav-header">PRINCIPAL</li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">CONTENIDO</li>

                <li class="nav-item {{ request()->routeIs('admin.products*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Productos
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>Listado</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">ADMINISTRACIÓN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-header">CONFIGURACIÓN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>Mi Perfil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ui') }}" class="nav-link {{ request()->routeIs('admin.ui') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Componentes UI</p>
                    </a>
                </li>

                <li class="nav-header">SISTEMA</li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                            <i class="nav-icon bi bi-box-arrow-left"></i>
                            <p>Cerrar Sesión</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
