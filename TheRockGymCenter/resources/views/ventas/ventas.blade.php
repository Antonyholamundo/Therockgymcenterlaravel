<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE ROCK - Ventas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/stilos.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.css" rel="stylesheet">
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

    <!-- Contenido principal -->
    <div class="main-content">
        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any()))
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col">
                    <h2 class="float-start">LISTADO DE VENTAS</h2>
                    <button type="button" class="btn btn-primary float-end"
                        data-bs-toggle="modal" data-bs-target="#modalVenta" onclick="limpiarModalVenta()">
                        <i class="fas fa-plus"></i> Nueva Venta
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Fecha Venta</th>
                            <th>Estado</th>
                            <th>Fecha Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->cliente }}</td>
                            <td>{{ $venta->vendedor }}</td>
                            <td>{{ $venta->producto }}</td>
                            <td>${{ number_format($venta->precio, 2) }}</td>
                            <td>{{ $venta->fecha_venta }}</td>
                            <td>
                                <span  {{ $venta->pagado == 'Pagado' ? 'bg-success' : 'bg-danger' }}>
                                    {{ $venta->pagado }}
                                </span>
                            </td>
                            <td>{{ $venta->fecha_pago ? $venta->fecha_pago : 'N/A' }}</td>
                            <td>
                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalVenta"
                                    onclick="llenarModalEditarVenta(
                                        '{{ $venta->id }}',
                                        '{{ $venta->cliente }}',
                                        '{{ $venta->vendedor }}',
                                        '{{ $venta->producto }}',
                                        '{{ $venta->precio }}',
                                        '{{ $venta->fecha_venta }}',
                                        '{{ $venta->pagado }}',
                                        '{{ $venta->fecha_pago ? $venta->fecha_pago : '' }}'
                                    )">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalVenta" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formVenta" method="POST" action="{{ route('ventas.store') }}">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="tituloModalVenta">Registrar Venta</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cliente" class="form-label">Cliente *</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vendedor" class="form-label">Vendedor *</label>
                                <input type="text" class="form-control" id="vendedor" name="vendedor" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="producto" class="form-label">Producto *</label>
                                <input type="text" class="form-control" id="producto" name="producto" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">Precio *</label>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_venta" class="form-label">Fecha de Venta *</label>
                                <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pagado" class="form-label">Estado de Pago *</label>
                                <select class="form-select" id="pagado" name="pagado" required>
                                    <option value="">Seleccione estado</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Pendiente">Pendiente</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardarVenta">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>
    <script>
        new DataTable('#mitabla', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/es-ES.json' }
        });

        function llenarModalEditarVenta(id, cliente, vendedor, producto, precio, fecha_venta, pagado, fecha_pago) {
            const form = document.getElementById('formVenta');
            form.action = '/ventas/' + id;
            form.querySelector('input[name="_method"]')?.remove();
            let input = document.createElement('input');
            input.type = 'hidden'; input.name = '_method'; input.value = 'PUT';
            form.appendChild(input);

            document.getElementById('cliente').value = cliente;
            document.getElementById('vendedor').value = vendedor;
            document.getElementById('producto').value = producto;
            document.getElementById('precio').value = precio;
            document.getElementById('fecha_venta').value = fecha_venta;
            document.getElementById('pagado').value = pagado;
            document.getElementById('fecha_pago').value = fecha_pago;

            document.getElementById('tituloModalVenta').textContent = 'Editar Venta';
            document.getElementById('btnGuardarVenta').textContent = 'Actualizar';
        }

        function limpiarModalVenta() {
            const form = document.getElementById('formVenta');
            form.reset();
            form.action = "{{ route('ventas.store') }}";
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('tituloModalVenta').textContent = 'Registrar Venta';
            document.getElementById('btnGuardarVenta').textContent = 'Guardar';
        }

        // Mostrar/ocultar fecha de pago según estado
        document.getElementById('pagado').addEventListener('change', function() {
            const fechaPagoField = document.getElementById('fecha_pago');
            if (this.value === 'Pagado') {
                fechaPagoField.required = true;
            } else {
                fechaPagoField.required = false;
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Toggle para los submenús
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    const arrow = this.querySelector('.arrow');
                    if (submenu && submenu.classList.contains('submenu')) {
                        // Cerrar otros submenús
                        menuItems.forEach(otherItem => {
                            const otherSubmenu = otherItem.nextElementSibling;
                            const otherArrow = otherItem.querySelector('.arrow');
                            if (otherSubmenu !== submenu && otherSubmenu && otherSubmenu.classList.contains('submenu')) {
                                otherSubmenu.style.display = 'none';
                                if (otherArrow) otherArrow.style.transform = 'rotate(0deg)';
                            }
                        });
                        // Toggle del submenú actual
                        if (submenu.style.display === 'block') {
                            submenu.style.display = 'none';
                            if (arrow) arrow.style.transform = 'rotate(0deg)';
                        } else {
                            submenu.style.display = 'block';
                            if (arrow) arrow.style.transform = 'rotate(90deg)';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>