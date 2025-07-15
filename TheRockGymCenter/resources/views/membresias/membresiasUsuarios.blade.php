<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE ROCK - Membresías Usuarios</title>
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
                    <h2 class="float-start">LISTADO DE MEMBRESÍAS DE USUARIOS</h2>
                    <button type="button" class="btn btn-primary float-end"
                        data-bs-toggle="modal" data-bs-target="#modalMembresiaUsuario" onclick="limpiarModalMembresiaUsuario()">
                        <i class="fas fa-plus"></i> Nueva Membresía Usuario
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Usuario</th>
                            <th>Membresía</th>
                            <th>Precio</th>
                            <th>Fecha Pago</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($membresiasUsuarios as $membresiaUsuario)
                        <tr>
                            <td>{{ $membresiaUsuario->usuario }}</td>
                            <td>{{ $membresiaUsuario->membresia }}</td>
                            <td>${{ number_format($membresiaUsuario->precio, 2) }}</td>
                            <td>{{ $membresiaUsuario->fecha_pago}}</td>
                            <td>{{ $membresiaUsuario->fecha_inicio }}</td>
                            <td>{{ $membresiaUsuario->fecha_fin }}</td>
                            <td>
                                <span {{ $membresiaUsuario->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}>
                                    {{ $membresiaUsuario->estado }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('membresias_usuarios.destroy', $membresiaUsuario->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-eliminar" type="button" data-id="{{ $membresiaUsuario->id }}"><i class="fas fa-trash"></i></button>
                                </form>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalMembresiaUsuario"
                                    onclick="llenarModalEditarMembresiaUsuario(
                                        '{{ $membresiaUsuario->id }}',
                                        '{{ $membresiaUsuario->usuario }}',
                                        '{{ $membresiaUsuario->membresia_id }}',
                                        '{{ $membresiaUsuario->precio }}',
                                        '{{ $membresiaUsuario->fecha_pago }}',
                                        '{{ $membresiaUsuario->fecha_inicio }}',
                                        '{{ $membresiaUsuario->fecha_fin }}',
                                        '{{ $membresiaUsuario->estado }}'
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
    <div class="modal fade" id="modalMembresiaUsuario" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formMembresiaUsuario" method="POST" action="{{ route('membresias_usuarios.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalMembresiaUsuario">Registrar Membresía Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label">Usuario *</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="membresia_id" class="form-label">Membresía *</label>
                                <select class="form-select" id="membresia_id" name="membresia_id" required>
                                    <option value="">Seleccione una membresía</option>
                                    @foreach($membresias as $membresia)
                                        <option value="{{ $membresia->id }}" data-precio="{{ $membresia->precio }}">{{ $membresia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">Precio *</label>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_pago" class="form-label">Fecha de Pago *</label>
                                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio *</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de Fin *</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccione estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardarMembresiaUsuario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="modalConfirmarEliminar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Sí</button>
                </div>
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

        // Llenar automáticamente el precio cuando se selecciona una membresía
        document.getElementById('membresia_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio');
            if (precio) {
                document.getElementById('precio').value = precio;
            }
        });

        function llenarModalEditarMembresiaUsuario(id, usuario, membresia_id, precio, fecha_pago, fecha_inicio, fecha_fin, estado) {
            const form = document.getElementById('formMembresiaUsuario');
            form.action = '/membresias_usuarios/' + id;
            form.querySelector('input[name="_method"]')?.remove();
            let input = document.createElement('input');
            input.type = 'hidden'; input.name = '_method'; input.value = 'PUT';
            form.appendChild(input);

            document.getElementById('usuario').value = usuario;
            document.getElementById('membresia_id').value = membresia_id;
            document.getElementById('precio').value = precio;
            document.getElementById('fecha_pago').value = fecha_pago;
            document.getElementById('fecha_inicio').value = fecha_inicio;
            document.getElementById('fecha_fin').value = fecha_fin;
            document.getElementById('estado').value = estado;

            document.getElementById('tituloModalMembresiaUsuario').textContent = 'Editar Membresía Usuario';
            document.getElementById('btnGuardarMembresiaUsuario').textContent = 'Actualizar';
        }

        function limpiarModalMembresiaUsuario() {
            const form = document.getElementById('formMembresiaUsuario');
            form.reset();
            form.action = "{{ route('membresias_usuarios.store') }}";
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('tituloModalMembresiaUsuario').textContent = 'Registrar Membresía Usuario';
            document.getElementById('btnGuardarMembresiaUsuario').textContent = 'Guardar';
        }

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

        let formAEliminar = null;
        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', function() {
                formAEliminar = this.closest('form');
                const modal = new bootstrap.Modal(document.getElementById('modalConfirmarEliminar'));
                modal.show();
            });
        });
        document.getElementById('btnConfirmarEliminar').addEventListener('click', function() {
            if (formAEliminar) {
                formAEliminar.submit();
            }
        });
    </script>
</body>
</html>