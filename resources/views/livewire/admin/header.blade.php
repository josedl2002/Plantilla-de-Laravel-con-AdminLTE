<nav class="app-header navbar navbar-expand bg-body" wire:ignore.self>
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" wire:click="toggleSidebar" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <!-- Mensajes -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">{{ $unreadMessages }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- Contenido de mensajes... -->
                </div>
            </li>

            <!-- Notificaciones -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">{{ $notifications }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- Contenido de notificaciones... -->
                </div>
            </li>

            <!-- Pantalla completa -->
            <li class="nav-item">
                <a class="nav-link" href="#" wire:click.prevent="toggleFullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- Menú usuario -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset($user['image']) }}" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline">{{ $user['name'] }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset($user['image']) }}" class="rounded-circle shadow" alt="User Image">
                        <p>
                            {{ $user['name'] }} - {{ $user['role'] }}
                            <small>Member since {{ $user['since'] }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <a href="{{ route('profile.show') }}" class="btn btn-primary btn-flat float-end me-2">
                            <i class="fas fa-user me-1"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        // Inicializar dropdowns de Bootstrap
        new bootstrap.Dropdown(document.querySelector('.dropdown-toggle'));
        
        // Manejar pantalla completa
        Livewire.on('toggleFullscreen', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });
    });
</script>
@endpush