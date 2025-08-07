<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" wire:ignore.self>
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">Administrador</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" id="navigation">
                <!-- Dashboard -->
                <li class="nav-item {{ $this->activemenu == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $this->activemenu == 'dashboard' ? 'active' : '' }}" 
                       wire:click.prevent="toggleMenu('dashboard')">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-{{ $collapsedmenus['dashboard'] ? 'right' : 'down' }}"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ $collapsedmenus['dashboard'] ? 'none' : 'block' }};">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.v1') }}" 
                               class="nav-link {{ $this->activemenu == 'dashboard.v1' ? 'active' : '' }}"
                               wire:click.prevent="setActive('dashboard.v1')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <!-- Más items del submenú -->
                    </ul>
                </li>
                
                <!-- Repite la estructura para otros menús usando $activemenu y $collapsedmenus -->
                
            </ul>
        </nav>
    </div>
</aside>

@script
<script>
    // Inicializar plugins de AdminLTE para el menú
    document.addEventListener('livewire:initialized', () => {
        $('[data-lte-toggle="treeview"]').Treeview('init');
        
        Livewire.on('menuToggled', () => {
            $('[data-lte-toggle="treeview"]').Treeview('init');
        });
    });
</script>
@endscript