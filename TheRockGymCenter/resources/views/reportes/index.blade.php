<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE ROCK - Reportes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/stilos.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo-container">
            <a href="{{ url('/') }}"><img src="{{ asset('img/sin fondo 1.png') }}" alt="Logo" class="logo"></a>
            <span class="logo-text">The rock gym center</span>
        </div>
        <div class="user-info">
            <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
            <img src="#" alt="Usuario" class="user-avatar">
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>OPCIONES</h4>
        </div>
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
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">
                        <i class="fas fa-file-pdf text-danger"></i>
                        Generador de Reportes PDF
                    </h2>
                </div>
            </div>

            <div class="row">
                <!-- Reporte General -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie"></i> Reporte General
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Resumen completo de todas las métricas del gimnasio.</p>
                            <a href="{{ route('reportes.general') }}" class="btn btn-primary">
                                <i class="fas fa-download"></i> Generar PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Reporte de Ventas -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shopping-cart"></i> Reporte de Ventas
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reportes.ventas') }}" method="GET">
                                <div class="mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="">Todos</option>
                                        <option value="Pagado">Pagado</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-download"></i> Generar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reporte de Ingresos -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-money-bill"></i> Reporte de Ingresos
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reportes.ingresos') }}" method="GET">
                                <div class="mb-3">
                                    <label for="fecha_inicio_ingresos" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio_ingresos" name="fecha_inicio">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_fin_ingresos" class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin_ingresos" name="fecha_fin">
                                </div>
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-download"></i> Generar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reporte de Inventario -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-boxes"></i> Reporte de Inventario
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reportes.inventario') }}" method="GET">
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <select class="form-control" id="categoria" name="categoria">
                                        <option value="">Todas las categorías</option>
                                        @foreach(\App\Models\Categorias::all() as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="estado_producto" class="form-label">Estado</label>
                                    <select class="form-control" id="estado_producto" name="estado">
                                        <option value="">Todos</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-download"></i> Generar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reporte de Usuarios -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users"></i> Reporte de Usuarios
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reportes.usuarios') }}" method="GET">
                                <div class="mb-3">
                                    <label for="estado_usuario" class="form-label">Estado</label>
                                    <select class="form-control" id="estado_usuario" name="estado">
                                        <option value="">Todos</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-download"></i> Generar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reporte de Membresías -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-dumbbell"></i> Reporte de Membresías
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reportes.membresias') }}" method="GET">
                                <div class="mb-3">
                                    <label for="estado_membresia" class="form-label">Estado</label>
                                    <select class="form-control" id="estado_membresia" name="estado">
                                        <option value="">Todas</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-download"></i> Generar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Toggle submenu
            $('.menu-item').click(function(e) {
                e.preventDefault();
                $(this).next('.submenu').slideToggle();
                $(this).find('.arrow').toggleClass('rotate');
            });

            // Set current date as default for date inputs
            const today = new Date().toISOString().split('T')[0];
            $('input[type="date"]').each(function() {
                if (!$(this).val()) {
                    $(this).val(today);
                }
            });
        });
    </script>
</body>

</html> 