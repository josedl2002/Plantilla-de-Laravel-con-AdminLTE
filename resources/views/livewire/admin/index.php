<div>
    <!-- Header -->
    <nav class="app-header navbar navbar-expand bg-body">
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
                <!-- ... (código del header completo) ... -->
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="app-sidebar bg-body-secondary shadow {{ $sidebarOpen ? 'sidebar-open' : 'sidebar-collapse' }}" 
            data-bs-theme="dark" wire:ignore.self>
        <!-- ... (código del sidebar completo) ... -->
    </aside>

    <!-- Contenido Principal -->
    <main class="app-main">
        <!-- Encabezado de contenido -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido -->
        <div class="app-content">
            <div class="container-fluid">
                <!-- Widgets de Estadísticas -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $stats['orders'] }}</h3>
                                <p>New Orders</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                            </svg>
                            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- ... (otros widgets de estadísticas) ... -->
                </div>

                <!-- Gráficos y Chat -->
                <div class="row">
                    <div class="col-lg-7 connectedSortable">
                        <!-- Gráfico de Ingresos -->
                        <div class="card mb-4">
                            <div class="card-header"><h3 class="card-title">Sales Value</h3></div>
                            <div class="card-body"><div id="revenue-chart"></div></div>
                        </div>

                        <!-- Chat Directo -->
                        <div class="card direct-chat direct-chat-primary mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>
                                <div class="card-tools">
                                    <span title="3 New Messages" class="badge text-bg-primary"> {{ count($messages) }} </span>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" title="Contacts" data-lte-toggle="chat-pane">
                                        <i class="bi bi-chat-text-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="direct-chat-messages" style="height: 300px; overflow-y: auto;">
                                    @foreach($messages as $message)
                                        <div class="direct-chat-msg {{ $message['type'] === 'outgoing' ? 'end' : '' }}">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-{{ $message['type'] === 'outgoing' ? 'end' : 'start' }}">
                                                    {{ $message['name'] }}
                                                </span>
                                                <span class="direct-chat-timestamp float-{{ $message['type'] === 'outgoing' ? 'start' : 'end' }}">
                                                    {{ $message['time'] }}
                                                </span>
                                            </div>
                                            <img class="direct-chat-img" src="{{ asset($message['image']) }}" alt="message user image">
                                            <div class="direct-chat-text">{{ $message['text'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        @foreach($contacts as $contact)
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{ asset($contact['image']) }}" alt="User Avatar">
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            {{ $contact['name'] }}
                                                            <small class="contacts-list-date float-end">{{ $contact['time'] }}</small>
                                                        </span>
                                                        <span class="contacts-list-msg">{{ $contact['text'] }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <form wire:submit.prevent="sendMessage">
                                    <div class="input-group">
                                        <input type="text" wire:model="newMessage" placeholder="Type Message ..." class="form-control">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 connectedSortable">
                        <!-- Mapa Mundial -->
                        <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">Sales Value</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body"><div id="world-map" style="height: 220px"></div></div>
                            <div class="card-footer border-0">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1" class="text-dark"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2" class="text-dark"></div>
                                        <div class="text-white">Online</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3" class="text-dark"></div>
                                        <div class="text-white">Sales</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <strong>
            Copyright &copy; 2014-{{ date('Y') }}&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
    </footer>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        // Inicializar gráficos
        const salesChart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            {
                series: [
                    { name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90] },
                    { name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40] }
                ],
                chart: { height: 300, type: 'area', toolbar: { show: false } },
                colors: ['#0d6efd', '#20c997'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth' },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        '2023-01-01', '2023-02-01', '2023-03-01', 
                        '2023-04-01', '2023-05-01', '2023-06-01', '2023-07-01'
                    ]
                },
                tooltip: { x: { format: 'MMMM yyyy' } }
            }
        );
        salesChart.render();

        // Mapa mundial
        new jsVectorMap({
            selector: '#world-map',
            map: 'world'
        });

        // Sparklines
        [1, 2, 3].forEach(i => {
            new ApexCharts(document.querySelector(`#sparkline-${i}`), {
                series: [{ data: Array.from({length: 10}, () => Math.floor(Math.random() * 1000)) }],
                chart: { type: 'area', height: 50, sparkline: { enabled: true } },
                stroke: { curve: 'straight' },
                fill: { opacity: 0.3 },
                yaxis: { min: 0 },
                colors: ['#DCE6EC']
            }).render();
        });

        // Scroll al final del chat
        Livewire.on('scroll-chat-bottom', () => {
            const chatContainer = document.querySelector('.direct-chat-messages');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });

        // Inicializar plugins de AdminLTE
        window.AdminLTE.init();
        
        // Inicializar OverlayScrollbars en el sidebar
        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: 'os-theme-light',
                    autoHide: 'leave',
                    clickScroll: true,
                },
            });
        }
        
        // Inicializar Sortable para las tarjetas
        new Sortable(document.querySelector('.connectedSortable'), {
            group: 'shared',
            handle: '.card-header',
        });
        
        // Configurar los manejadores de los card-headers
        document.querySelectorAll('.connectedSortable .card-header').forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    });
</script>
@endpush