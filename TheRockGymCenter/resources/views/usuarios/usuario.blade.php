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
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo-container">
            <a href="index.html"><img src="{{ asset('img/sin fondo 1.png') }}" alt="Logo" class="logo"></a>
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
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Encabezado -->
            <div class="row mb-4">
                <div class="col">
                    <h2 class="float-start">LISTADO DE USUARIOS</h2>
                    <button type="button" class="btn btn-primary float-end"
    data-bs-toggle="modal" data-bs-target="#modalUsuario"
    onclick="limpiarModalUsuario()">
    <i class="fas fa-plus"></i> Nuevo Usuario
</button>
                </div>
            </div>

            <!-- Tabla de Usuarios -->
            <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->cedula }}</td>
                            <td>{{ $usuario->nombres }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->fecha_nacimiento }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->estado }}</td>
                            <td>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-eliminar" type="button" data-id="{{ $usuario->id }}"><i class="fas fa-trash"></i></button>
                                </form>
                                <button type="button" class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalUsuario"
                                    onclick="llenarModalEditar(
                                        '{{ $usuario->id }}',
                                        '{{ $usuario->cedula }}',
                                        '{{ $usuario->nombres }}',
                                        '{{ $usuario->apellidos }}',
                                        '{{ $usuario->fecha_nacimiento }}',
                                        '{{ $usuario->email }}',
                                        '{{ $usuario->telefono }}',
                                        '{{ $usuario->estado }}'
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

        <!-- Modal para Nuevo Usuario limpio y responsivo -->
        <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form id="formUsuario" method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Registrar Usuario</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="cedula" class="form-label">Cédula *</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombres" class="form-label">Nombres *</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellidos *</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento *</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono *</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="estado" class="form-label">Estado *</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#mitabla').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/es-ES.json',
                },
            });
        });
    </script>
    <script>
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
    <script>
function llenarModalEditar(id, cedula, nombres, apellidos, fecha_nacimiento, email, telefono, estado) {
    document.getElementById('formUsuario').action = '/usuarios/' + id;
    document.getElementById('formUsuario').querySelector('input[name="_method"]')?.remove();
    // Agrega el método PUT para editar
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = '_method';
    input.value = 'PUT';
    document.getElementById('formUsuario').appendChild(input);

    document.getElementById('cedula').value = cedula;
    document.getElementById('nombres').value = nombres;
    document.getElementById('apellidos').value = apellidos;
    document.getElementById('fecha_nacimiento').value = fecha_nacimiento;
    document.getElementById('email').value = email;
    document.getElementById('telefono').value = telefono;
    document.getElementById('estado').value = estado;
    document.getElementById('tituloModal').textContent = 'Editar Usuario';
    document.getElementById('btnGuardar').textContent = 'Actualizar';
}
</script>
<script>
function limpiarModalUsuario() {
    document.getElementById('formUsuario').reset();
    document.getElementById('formUsuario').action = "{{ route('usuarios.store') }}";
    document.getElementById('formUsuario').querySelector('input[name="_method"]')?.remove();
    document.getElementById('tituloModal').textContent = 'Registrar Usuario';
    document.getElementById('btnGuardar').textContent = 'Guardar';
}
</script>
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
<script>
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