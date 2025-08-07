<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register 
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    <!-- Contenido principal -->
    <main class="w-full lg:max-w-4xl max-w-[335px] bg-white dark:bg-[#161615] p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 dark:text-[#EDEDEC]">Sistema de Gestión InventarioTech</h1>
        
        <div class="mb-6">
            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">
                Bienvenido a InventarioTech, un sistema completo para la gestión de inventarios en pequeñas y medianas empresas. 
                Nuestra plataforma permite:
            </p>
            <ul class="list-disc pl-5 text-[#706f6c] dark:text-[#A1A09A] space-y-2">
                <li>Registro y seguimiento de productos</li>
                <li>Control de entradas y salidas</li>
                <li>Generación de reportes automáticos</li>
                <li>Alertas de stock mínimo</li>
                <li>Integración con sistemas de punto de venta</li>
            </ul>
        </div>

        <div class="bg-[#fff2f2] dark:bg-[#1D0002] p-4 rounded-lg mb-6">
            <h2 class="font-medium text-[#F53003] dark:text-[#F61500] mb-2">Estado del sistema</h2>
            <p id="systemStatus" class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Verificando estado...</p>
        </div>

        <button id="demoBtn" class="px-5 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-all">
            Ver demostración
        </button>
    </main>

    <!-- Footer -->
    <footer class="w-full lg:max-w-4xl max-w-[335px] mt-6 text-center text-xs text-[#706f6c] dark:text-[#A1A09A]">
        <p>InventarioTech v1.0 &copy; 2023 - Todos los derechos reservados</p>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simular verificación de estado del sistema
            setTimeout(function() {
                document.getElementById('systemStatus').textContent = 'Sistema operativo - Todos los servicios funcionando correctamente';
            }, 1500);

            // Botón de demostración
            const demoBtn = document.getElementById('demoBtn');
            demoBtn.addEventListener('click', function() {
                alert('¡Funcionalidad de demostración activada! Esta sería la vista previa del panel de control.');
                
                // Cambiar texto temporalmente
                const originalText = demoBtn.textContent;
                demoBtn.textContent = 'Cargando...';
                
                setTimeout(function() {
                    demoBtn.textContent = originalText;
                }, 2000);
            });

            // Efecto de hover en tarjetas (se agregaría si hubiera más elementos)
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
    <div class="mb-6 bg-white dark:bg-[#161615] p-4 rounded-lg shadow-inner">
  <h2 class="text-xl font-medium mb-4 dark:text-[#EDEDEC]">
    Estadísticas de Inventario
  </h2>
  <div style="width: 100%; max-width: 600px; margin: auto;">
  <canvas id="inventoryChart"></canvas>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Datos de ejemplo
  const labels   = ['Enero','Febrero','Marzo','Abril','Mayo','Junio'];
  const entradas = [120, 90, 150, 80, 200, 170];
  const salidas  = [100, 70, 130, 60, 180, 150];

  const ctx = document
    .getElementById('inventoryChart')
    .getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Entradas',
          data: entradas,
          backgroundColor: 'rgba(34, 197, 94, 0.7)',
          borderColor:     'rgba(34, 197, 94, 1)',
          borderWidth: 1
        },
        {
          label: 'Salidas',
          data: salidas,
          backgroundColor: 'rgba(239, 68, 68, 0.7)',
          borderColor:     'rgba(239, 68, 68, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: { color: '#706f6c' },
          grid:  { color: '#e5e7eb' }
        },
        x: {
          ticks: { color: '#706f6c' },
          grid:  { display: false }
        }
      },
      plugins: {
        legend:  { labels: { color: '#1b1b18' } },
        tooltip: { enabled: true }
      }
    }
  });  // <<< Aquí cerramos new Chart

});    // <<< Cerramos DOMContentLoaded
</script>

</body>
        
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
