{{-- ============================================ --}}
{{-- ADMIN: COMPONENTES UI DE ADMINLTE           --}}
{{-- Catalogo visual de componentes disponibles   --}}
{{-- ============================================ --}}
<div>

{{-- ============================================ --}}
{{-- 1. ALERTAS                                   --}}
{{-- Clases: alert, alert-success/info/warning/danger, alert-dismissible --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Alertas</h3></div>
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap mb-3">
            @foreach (['success', 'info', 'warning', 'danger'] as $type)
                <button class="btn btn-{{ $type }}" wire:click="showAlert('{{ $type }}')">
                    Mostrar {{ ucfirst($type) }}
                </button>
            @endforeach
        </div>
        @if ($alertMessage)
            <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
                {{ $alertMessage }}
                <button type="button" class="btn-close" wire:click="$set('alertMessage', '')"></button>
            </div>
        @endif
    </div>
</div>

{{-- ============================================ --}}
{{-- 2. TARJETAS (CARDS)                          --}}
{{-- Clases: card, card-header, card-body, card-footer, text-bg-*, card-outline card-* --}}
{{-- ============================================ --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Card básica</h3></div>
            <div class="card-body">
                <p>Card estándar con header, body y footer.</p>
            </div>
            <div class="card-footer text-muted">Footer</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-primary">
            <div class="card-header"><h3 class="card-title">Card con color</h3></div>
            <div class="card-body">
                <p>Usa <code>text-bg-{color}</code> para el fondo.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-success">
            <div class="card-header"><h3 class="card-title">Card outline</h3></div>
            <div class="card-body">
                <p>Usa <code>card-outline card-{color}</code> para borde.</p>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 3. BOTONES                                    --}}
{{-- Clases: btn, btn-{color}, btn-outline-*, btn-sm, btn-lg --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Botones</h3></div>
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap mb-3">
            @foreach (['primary','secondary','success','info','warning','danger','dark','light'] as $c)
                <button class="btn btn-{{ $c }}">{{ ucfirst($c) }}</button>
            @endforeach
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-primary">Outline</button>
            <button class="btn btn-primary btn-sm">Pequeño</button>
            <button class="btn btn-primary btn-lg">Grande</button>
            <button class="btn btn-primary" disabled>Deshabilitado</button>
            <button class="btn btn-primary"><i class="bi bi-star me-1"></i>Con icono</button>
            <div class="btn-group">
                <button class="btn btn-primary">Grupo</button>
                <button class="btn btn-primary">De</button>
                <button class="btn btn-primary">Botones</button>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 4. MODALES (Bootstrap + Livewire)             --}}
{{-- Clases: modal, modal-dialog, modal-content, modal-{sm/lg/xl} --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Modales</h3></div>
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-primary" wire:click="openModal('modal-sm')">Modal pequeño</button>
            <button class="btn btn-primary" wire:click="openModal('modal-md')">Modal normal</button>
            <button class="btn btn-primary" wire:click="openModal('modal-lg')">Modal grande</button>
            <button class="btn btn-primary" wire:click="openModal('modal-xl')">Modal extra grande</button>
        </div>
        {{-- Modal animado con Bootstrap JS + Livewire @script --}}
        <div wire:ignore.self class="modal fade" id="uiModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog {{ $modalSize }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal de ejemplo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal animado con Bootstrap JS. Tamaño: <code>{{ $modalSize }}</code>.</p>
                        <p>Usa la clase <code>fade</code> de Bootstrap para la transición.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        @script
            <script>
                const uiModal = new bootstrap.Modal(document.getElementById('uiModal'));
                $wire.on('show-modal', () => uiModal.show());
                $wire.on('hide-modal', () => uiModal.hide());
            </script>
        @endscript
    </div>
</div>

{{-- ============================================ --}}
{{-- 5. TABS (Livewire)                            --}}
{{-- Clases: nav nav-tabs, nav-item, nav-link, tab-pane --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Tabs con Livewire</h3></div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <button class="nav-link {{ $activeTab === 'tab1' ? 'active' : '' }}"
                        wire:click="switchTab('tab1')">Tab 1</button>
            </li>
            <li class="nav-item">
                <button class="nav-link {{ $activeTab === 'tab2' ? 'active' : '' }}"
                        wire:click="switchTab('tab2')">Tab 2</button>
            </li>
            <li class="nav-item">
                <button class="nav-link {{ $activeTab === 'tab3' ? 'active' : '' }}"
                        wire:click="switchTab('tab3')">Tab 3</button>
            </li>
        </ul>
        <div class="tab-content">
            @if ($activeTab === 'tab1')
                <div class="tab-pane active"><p>Contenido del <strong>Tab 1</strong>. Los tabs cambian sin recargar gracias a Livewire.</p></div>
            @elseif ($activeTab === 'tab2')
                <div class="tab-pane active"><p>Contenido del <strong>Tab 2</strong>. Cada pestaña puede tener su propio contenido dinámico.</p></div>
            @elseif ($activeTab === 'tab3')
                <div class="tab-pane active"><p>Contenido del <strong>Tab 3</strong>. Ideal para seccionar formularios grandes.</p></div>
            @endif
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 6. TABLAS                                     --}}
{{-- Clases: table, table-striped, table-hover, table-bordered, table-sm --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Tablas</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr><th>#</th><th>Nombre</th><th>Estado</th><th>Progreso</th></tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id' => 1, 'name' => 'Proyecto Alpha', 'status' => 'Completado', 'progress' => 100],
                        ['id' => 2, 'name' => 'Proyecto Beta', 'status' => 'En progreso', 'progress' => 65],
                        ['id' => 3, 'name' => 'Proyecto Gamma', 'status' => 'Pendiente', 'progress' => 10],
                    ] as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['name'] }}</td>
                            <td><span class="badge bg-{{ $row['progress'] === 100 ? 'success' : ($row['progress'] > 50 ? 'warning' : 'secondary') }}">{{ $row['status'] }}</span></td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" style="width: {{ $row['progress'] }}%">{{ $row['progress'] }}%</div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-muted small mt-2">Clases: <code>table</code> + <code>table-striped</code> + <code>table-hover</code> + <code>table-dark</code> en el <code>thead</code>.</p>
    </div>
</div>

{{-- ============================================ --}}
{{-- 7. ACCORDION / COLLAPSE                      --}}
{{-- Clases: accordion, accordion-item, accordion-button, accordion-collapse, collapse --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Accordion / Collapse</h3></div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            @foreach ([
                ['id' => '1', 'title' => 'Sección 1', 'content' => 'Contenido de la primera sección del accordion.'],
                ['id' => '2', 'title' => 'Sección 2', 'content' => 'Contenido de la segunda sección. Puede contener HTML y componentes Livewire.'],
                ['id' => '3', 'title' => 'Sección 3', 'content' => 'Contenido de la tercera sección. Útil para FAQs o documentación.'],
            ] as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $accordionOpen === $item['id'] ? '' : 'collapsed' }}"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $item['id'] }}">
                            {{ $item['title'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $item['id'] }}"
                         class="accordion-collapse collapse {{ $accordionOpen === $item['id'] ? 'show' : '' }}"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">{{ $item['content'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 8. LIST GROUPS                                --}}
{{-- Clases: list-group, list-group-item, list-group-item-action --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">List Groups</h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item active">Item activo</li>
                    <li class="list-group-item">Item normal</li>
                    <li class="list-group-item list-group-item-success">Item success</li>
                    <li class="list-group-item list-group-item-danger">Item danger</li>
                    <li class="list-group-item disabled">Item deshabilitado</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Link 1</a>
                    <a href="#" class="list-group-item list-group-item-action active">Link 2 (activo)</a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                        Link 3 <span class="badge bg-primary">14</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Notificaciones <span class="badge bg-danger rounded-pill">7</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Mensajes <span class="badge bg-warning rounded-pill">3</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tareas <span class="badge bg-success rounded-pill">12</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 9. BADGES Y PROGRESS BARS                    --}}
{{-- Clases: badge bg-*, progress, progress-bar, progress-bar-striped --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Badges y Barras de Progreso</h3></div>
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap mb-3">
            @foreach (['primary','secondary','success','info','warning','danger'] as $c)
                <span class="badge bg-{{ $c }}">{{ ucfirst($c) }}</span>
            @endforeach
            <span class="badge rounded-pill bg-primary">Pill</span>
            <span class="badge bg-primary fs-6">Grande</span>
            <span class="badge bg-danger position-relative">
                Con notificación
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">99+</span>
            </span>
        </div>
        <div class="progress mb-2" style="height: 25px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%">75%</div>
        </div>
        <div class="progress mb-2" style="height: 20px;">
            <div class="progress-bar bg-success" style="width: 40%">40%</div>
            <div class="progress-bar bg-warning" style="width: 30%">30%</div>
            <div class="progress-bar bg-danger" style="width: 20%">20%</div>
        </div>
        <div class="progress" style="height: 10px;">
            <div class="progress-bar" style="width: 50%"></div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 10. SPINNERS                                  --}}
{{-- Clases: spinner-border, spinner-grow, spinner-{sm} --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Spinners</h3></div>
    <div class="card-body">
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>
            <div class="spinner-border text-secondary"></div>
            <div class="spinner-border text-success"></div>
            <div class="spinner-border text-danger"></div>
            <div class="spinner-border text-warning"></div>
            <div class="spinner-border text-info"></div>
            <div class="spinner-grow text-primary" role="status"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-border spinner-border-sm"></div>
            <div class="spinner-grow spinner-grow-sm"></div>
            <button class="btn btn-primary" disabled>
                <span class="spinner-border spinner-border-sm me-1"></span> Cargando...
            </button>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 11. TOASTS (Bootstrap 5)                      --}}
{{-- Clases: toast, toast-header, toast-body --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Toasts</h3></div>
    <div class="card-body">
        <button class="btn btn-primary" wire:click="showToastMessage('Operación completada exitosamente.')">
            <i class="bi bi-bell"></i> Mostrar Toast
        </button>
        <button class="btn btn-success" wire:click="showToastMessage('Los cambios se guardaron correctamente.')">
            Mostrar Toast éxito
        </button>
        <button class="btn btn-danger" wire:click="showToastMessage('Ocurrió un error inesperado.')">
            Mostrar Toast error
        </button>

        {{-- Toast animado con Bootstrap JS --}}
        <div wire:ignore class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center border-0 text-bg-primary" id="uiToast" role="alert" data-bs-delay="3000">
                <div class="d-flex">
                    <div class="toast-body" id="uiToastBody">Mensaje</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
        @script
            <script>
                const toastEl = document.getElementById('uiToast');
                const toast = new bootstrap.Toast(toastEl);

                $wire.on('show-toast', ({ message, type }) => {
                    document.getElementById('uiToastBody').textContent = message;
                    toastEl.className = 'toast align-items-center border-0 text-bg-' + type;
                    toast.show();
                });
            </script>
        @endscript
    </div>
</div>

{{-- ============================================ --}}
{{-- 12. TOOLTIPS (requieren inicialización JS)    --}}
{{-- Clases/Atributos: data-bs-toggle="tooltip", title="..." --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Tooltips</h3></div>
    <div class="card-body">
        <p class="mb-0">
            Pasa el mouse sobre estos elementos:
            <button class="btn btn-secondary" data-bs-toggle="tooltip" title="Tooltip en botón">Botón</button>
            <span class="text-primary" data-bs-toggle="tooltip" title="Tooltip en texto">texto con tooltip</span>
            <i class="bi bi-question-circle-fill text-info fs-5" data-bs-toggle="tooltip" title="Información adicional"></i>
        </p>
        <p class="text-muted small mt-2">
            Los tooltips requieren inicialización JS:
            <code>document.querySelectorAll('[data-bs-toggle=\"tooltip\"]').forEach(el => new bootstrap.Tooltip(el))</code>
        </p>
    </div>
</div>

{{-- ============================================ --}}
{{-- 13. DROPDOWNS                                 --}}
{{-- Clases: dropdown, dropdown-menu, dropdown-item, dropdown-header, dropdown-divider --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Dropdowns</h3></div>
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Dropdown básico
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Acción 1</a></li>
                    <li><a class="dropdown-item" href="#">Acción 2</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separada</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    Con encabezado
                </button>
                <ul class="dropdown-menu">
                    <li><h6 class="dropdown-header">Encabezado</h6></li>
                    <li><a class="dropdown-item" href="#">Item 1</a></li>
                    <li><a class="dropdown-item disabled" href="#">Item deshabilitado</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button class="btn btn-success">Split</button>
                <button class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Opción 1</a></li>
                    <li><a class="dropdown-item" href="#">Opción 2</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 14. PAGINATION                                --}}
{{-- Clases: pagination, page-item, page-link --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Paginación</h3></div>
    <div class="card-body">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </nav>
        <p class="text-muted small text-center mb-0">
            Livewire ya incluye paginación: <code>@{{ $users->links() }}</code> renderiza automáticamente estos estilos si usas <code>tailwind</code> o <code>bootstrap</code> en <code>AppServiceProvider</code>.
        </p>
    </div>
</div>

{{-- ============================================ --}}
{{-- 15. OFFCANVAS (panel lateral)                 --}}
{{-- Clases: offcanvas, offcanvas-start/end, offcanvas-header, offcanvas-body --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Offcanvas</h3></div>
    <div class="card-body">
        <button class="btn btn-primary" wire:click="toggleOffcanvas">
            <i class="bi bi-layout-sidebar"></i> Abrir Offcanvas
        </button>

        @if ($showOffcanvas)
            <div class="offcanvas offcanvas-end show" tabindex="-1" style="background-color: rgba(0,0,0,.1);">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Panel lateral</h5>
                    <button type="button" class="btn-close" wire:click="toggleOffcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <p>Offcanvas controlado por Livewire. Útil para paneles de filtros, detalles o formularios rápidos.</p>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- ============================================ --}}
{{-- 16. NAV / BREADCRUMB                         --}}
{{-- Clases: nav, nav-pills, breadcrumb, breadcrumb-item --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Navegación y Breadcrumbs</h3></div>
    <div class="card-body">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Módulo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Página actual</li>
            </ol>
        </nav>

        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#">Activo</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
            <li class="nav-item"><a class="nav-link disabled" href="#">Deshabilitado</a></li>
        </ul>
    </div>
</div>

{{-- ============================================ --}}
{{-- 17. INFO BOX (AdminLTE)                      --}}
{{-- Clases: info-box, info-box-icon, info-box-content, info-box-number, info-box-text --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Info Box (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-6 mb-3">
                <div class="info-box">
                    <span class="info-box-icon text-bg-primary"><i class="bi bi-people-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios</span>
                        <span class="info-box-number">1,250</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6 mb-3">
                <div class="info-box">
                    <span class="info-box-icon text-bg-success"><i class="bi bi-graph-up-arrow"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventas</span>
                        <span class="info-box-number">$8,500</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6 mb-3">
                <div class="info-box">
                    <span class="info-box-icon text-bg-warning"><i class="bi bi-clock-history"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pendientes</span>
                        <span class="info-box-number">23</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="info-box">
                    <span class="info-box-icon text-bg-danger"><i class="bi bi-exclamation-triangle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Errores</span>
                        <span class="info-box-number">5</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="info-box">
                    <span class="info-box-icon text-bg-info"><i class="bi bi-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mensajes</span>
                        <span class="info-box-number">148</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="info-box">
                    <span class="info-box-icon text-bg-secondary"><i class="bi bi-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Favoritos</span>
                        <span class="info-box-number">32</span>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-muted small mt-2 mb-0">
            El <code>info-box</code> es un componente clásico de AdminLTE. Combina un icono cuadrado a la izquierda con un número y descripción a la derecha.
        </p>
    </div>
</div>

{{-- ============================================ --}}
{{-- 18. CALLOUT (AdminLTE)                       --}}
{{-- Clases: callout, callout-{info/success/warning/danger} --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Callout (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="callout callout-info">
            <h5>Callout Info</h5>
            <p class="mb-0">Callout de información. Similar a un alert pero sin botón de cierre. Ideal para tips y ayudas contextuales.</p>
        </div>
        <div class="callout callout-success mt-3">
            <h5><i class="bi bi-check-circle me-1"></i>Operación exitosa</h5>
            <p class="mb-0">Los datos se guardaron correctamente. Puedes continuar trabajando.</p>
        </div>
        <div class="callout callout-warning mt-3">
            <h5><i class="bi bi-exclamation-circle me-1"></i>Atención</h5>
            <p class="mb-0">Esta acción no se puede deshacer. ¿Estás seguro de continuar?</p>
        </div>
        <div class="callout callout-danger mt-3">
            <h5><i class="bi bi-x-circle me-1"></i>Error</h5>
            <p class="mb-0">Ocurrió un error al procesar la solicitud. Intenta nuevamente.</p>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 19. TIMELINE (AdminLTE)                      --}}
{{-- Clases: timeline, time-label, timeline-item, timeline-header, timeline-body, timeline-footer, timeline-icon --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Timeline (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="timeline">
            <div class="time-label">
                <span class="bg-primary">Hoy</span>
            </div>
            <div>
                <i class="timeline-icon bi bi-check-circle-fill bg-success"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <a href="#">Sistema</a>
                        <span class="float-end text-muted text-sm">10:30 AM</span>
                    </h3>
                    <div class="timeline-body">
                        Actualización completada exitosamente. Se aplicaron 3 parches de seguridad.
                    </div>
                    <div class="timeline-footer">
                        <a href="#" class="btn btn-sm btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
            <div>
                <i class="timeline-icon bi bi-person-fill bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <a href="#">Admin</a>
                        <span class="float-end text-muted text-sm">9:15 AM</span>
                    </h3>
                    <div class="timeline-body">
                        Nuevo usuario registrado: <a href="#">juan@ejemplo.com</a>
                    </div>
                </div>
            </div>
            <div>
                <i class="timeline-icon bi bi-file-earmark-text bg-warning"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <a href="#">Reportes</a>
                        <span class="float-end text-muted text-sm">8:00 AM</span>
                    </h3>
                    <div class="timeline-body">
                        Reporte mensual generado: Enero 2026
                    </div>
                    <div class="timeline-footer">
                        <a href="#" class="btn btn-sm btn-warning">Descargar PDF</a>
                    </div>
                </div>
            </div>
            <div class="time-label">
                <span class="bg-secondary">Ayer</span>
            </div>
            <div>
                <i class="timeline-icon bi bi-shield-check bg-primary"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <a href="#">Seguridad</a>
                        <span class="float-end text-muted text-sm">6:45 PM</span>
                    </h3>
                    <div class="timeline-body">
                        Copia de seguridad completada. 2.3 GB respaldados.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 20. DESCRIPTION BLOCK (AdminLTE)             --}}
{{-- Clases: description-block, description-header, description-text, description-percentage --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Description Block (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="description-block border-end">
                    <span class="description-percentage text-success"><i class="bi bi-arrow-up"></i> 12.5%</span>
                    <h5 class="description-header">$2,350</h5>
                    <span class="description-text">INGRESOS TOTALES</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="description-block border-end">
                    <span class="description-percentage text-warning"><i class="bi bi-arrow-down"></i> 3.2%</span>
                    <h5 class="description-header">$1,280</h5>
                    <span class="description-text">GASTOS TOTALES</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="description-block">
                    <span class="description-percentage text-success"><i class="bi bi-arrow-up"></i> 8.7%</span>
                    <h5 class="description-header">89</h5>
                    <span class="description-text">NUEVOS USUARIOS</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 21. PROGRESS GROUP (AdminLTE)                --}}
{{-- Clases: progress-group, progress-text, progress-number --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Progress Group (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="progress-group mb-3">
            <span class="progress-text">Tareas completadas</span>
            <span class="progress-number"><b>160</b>/200</span>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success" style="width: 80%">80%</div>
            </div>
        </div>
        <div class="progress-group mb-3">
            <span class="progress-text">Productividad</span>
            <span class="progress-number"><b>45</b>/100</span>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-warning" style="width: 45%">45%</div>
            </div>
        </div>
        <div class="progress-group mb-3">
            <span class="progress-text">Objetivos trimestrales</span>
            <span class="progress-number"><b>90</b>/100</span>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-info" style="width: 90%">90%</div>
            </div>
        </div>
        <div class="progress-group mb-0">
            <span class="progress-text">Satisfacción del cliente</span>
            <span class="progress-number"><b>72</b>/100</span>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-danger" style="width: 72%">72%</div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 22. BUTTON APP (AdminLTE)                    --}}
{{-- Clases: btn-app --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Button App (AdminLTE)</h3></div>
    <div class="card-body">
        <p class="text-muted">Botones grandes con icono apilado sobre texto, ideales para accesos rápidos tipo aplicación móvil.</p>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn-app" href="#">
                <i class="bi bi-speedometer2 fs-2"></i> Dashboard
            </a>
            <a class="btn-app" href="#">
                <i class="bi bi-people fs-2"></i> Usuarios
                <span class="badge bg-primary">12</span>
            </a>
            <a class="btn-app" href="#">
                <i class="bi bi-envelope fs-2"></i> Mensajes
                <span class="badge bg-warning">3</span>
            </a>
            <a class="btn-app" href="#">
                <i class="bi bi-gear fs-2"></i> Configuración
            </a>
            <a class="btn-app" href="#">
                <i class="bi bi-box-seam fs-2"></i> Productos
                <span class="badge bg-success">+99</span>
            </a>
            <a class="btn-app" href="#">
                <i class="bi bi-graph-up fs-2"></i> Reportes
            </a>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 23. ELEVATION (AdminLTE)                     --}}
{{-- Clases: elevation-1, elevation-2, elevation-3, elevation-4 --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Elevation / Sombras (AdminLTE)</h3></div>
    <div class="card-body">
        <div class="row">
            @foreach ([1, 2, 3, 4] as $e)
                <div class="col-md-3 col-6 mb-3">
                    <div class="elevation-{{ $e }} bg-body p-4 rounded text-center">
                        <p class="fw-bold mb-1">elevation-{{ $e }}</p>
                        <small class="text-muted">Sombra nivel {{ $e }}</small>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-muted small mt-2 mb-0">
            Las clases <code>elevation-1</code> a <code>elevation-4</code> agregan profundidad con <code>box-shadow</code>.
            Útiles para destacar tarjetas, modales o elementos interactivos.
        </p>
    </div>
</div>

{{-- ============================================ --}}
{{-- 24. TABLE HEAD FIXED (AdminLTE)              --}}
{{-- Clases: table-head-fixed --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Table Head Fixed (AdminLTE)</h3></div>
    <div class="card-body">
        <p class="text-muted">El encabezado permanece fijo mientras el cuerpo hace scroll. Útil para tablas con muchos registros.</p>
        <div class="table-responsive" style="max-height: 250px;">
            <table class="table table-hover table-head-fixed align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (range(1, 15) as $i)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Usuario {{ $i }}</td>
                            <td>usuario{{ $i }}@ejemplo.com</td>
                            <td><span class="badge bg-primary">Admin</span></td>
                            <td><span class="badge bg-success">Activo</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ============================================ --}}
{{-- 25. CARD WIDGET INTERACTIVO (AdminLTE)       --}}
{{-- data-lte-toggle: card-collapse, card-remove, card-maximize --}}
{{-- ============================================ --}}
<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Card Widget interactivo (AdminLTE)</h3></div>
    <div class="card-body">
        <p class="text-muted">Las tarjetas pueden colapsarse, maximizarse o eliminarse usando los atributos <code>data-lte-toggle</code>.</p>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Colapsable</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        Haz clic en el botón <code>data-lte-toggle="card-collapse"</code> del header para colapsar/expandir esta tarjeta con animación.
                    </div>
                    <div class="card-footer text-muted">Footer opcional</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Expandible / Eliminable</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-maximize">
                                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        Prueba los botones: <code>data-lte-toggle="card-maximize"</code> para pantalla completa y <code>card-remove</code> para eliminar.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:init', function () {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
    });
    document.addEventListener('livewire:navigated', function () {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
    });
</script>
@endpush
