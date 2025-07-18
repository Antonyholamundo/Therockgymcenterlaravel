<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE ROCK</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/stilos.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Paginacion -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo-container">
            <a href="index.html"><img src="./img/sin fondo 1.png" alt="Logo" class="logo"></a>
            <span class="logo-text">The rock gym center</span>
        </div>
        <div class="user-info">
            <span class="user-name">Anthony Erreyes</span>
            <img src="#" alt="Usuario" class="user-avatar">
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>OPCIONES</h4>
        </div>

        <!-- Menú principal -->
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/usuarios') }}">Usuarios</a></li>
                    <li><a href="{{ url('/roles') }}">Roles</a></li>
                    <li><a href="{{ url('/permisos') }}">Permisos</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-id-card"></i>
                    <span>Membresía</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/membresias') }}">Membresias</a></li>
                    <li><a href="{{ url('/membresias_usuarios') }}">Membresias-Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-box"></i>
                    <span>Inventario</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/productos') }}">Productos</a></li>
                    <li><a href="{{ url('/categorias') }}">Categorias</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Ventas</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/ventas') }}">Ventas</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-money-bill"></i>
                    <span>Ingresos</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/ingresos') }}">Ingresos</a></li>
                   <li><a href="{{ url('/detalles_ingresos') }}">Detalles de ingresos</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Reportes</span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ url('/reportes') }}">Reportes PDF</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Main content -->

    <div class="main-content" style="display: flex; justify-content: center; align-items: center;">
        <table class="table table-bordered text-center" style="width: 80%; height: 80%; margin: 0;">
            <tr>
                <th colspan="2" style="background-color: black; color: white;">THE ROCK GYM CENTER</th>
            </tr>
            <tr>
                <th>MEMBRESIAS</th>
                <th>PRODUCTOS</th>
            </tr>
            <tr>
                <th style="width: 50%; height: 100%;">
                    <canvas id="myChartMem" style="width: 100%; height: 100%; display: block;"></canvas>
                </th>
                <th style="width: 50%; height: 100%;">
                    <canvas id="myChartPro" style="width: 100%; height: 100%; display: block;"></canvas>
                </th>
            </tr>
        </table>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Sistema JS -->
        <script src="./js/sistema.js"></script>
        <!-- Aquí va el contenido de tu sistema -->
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle para los submenús
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    if (submenu) {
                        submenu.classList.toggle('active');
                        this.classList.toggle('open');
                    }
                });
            });
        });
    </script>
    <script>
        const ctx = document.getElementById('myChartMem');
        const ctxP = document.getElementById('myChartPro');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Oro',
                    'Plata',
                    'Bronce',
                    'Estudiantil',
                    'Anuales'
                ],
                datasets: [{
                    data: [300, 50, 100, 25, 30],
                    backgroundColor: [
                        'rgb(217, 136, 128)',
                        'rgb(187, 143, 206)',
                        'rgb(127, 179, 213)',
                        'rgb(125, 206, 160)',
                        'rgb(229, 152, 102)'
                    ],
                    hoverOffset: 4
                }]
            },
        });

        new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: [
                    'Ropa',
                    'Suplemento',
                    'Equipo Deportivo',
                    'Bebida'
                ],
                datasets: [{
                    data: [300, 50, 100, 25],
                    backgroundColor: [
                        'rgb(125, 206, 160)',
                        'rgb(127, 179, 213)',
                        'rgb(187, 143, 206)',
                        'rgb(229, 152, 102)'
                    ],
                    hoverOffset: 4
                }]
            },
        });

    </script>
</body>
</html>