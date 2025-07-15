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
    <!-- Topbar -->s
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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col">
                    <h2 class="float-start">LISTADO DE PERMISOS</h2>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalPermiso" onclick="limpiarModalPermiso()">
                        <i class="fas fa-plus"></i> Nuevo Permiso
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Fecha Asignación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permisos as $permiso)
                        <tr>
                            <td>{{ $permiso->usuario->nombres }}</td>
                            <td>{{ $permiso->rol }}</td>
                            <td>{{ $permiso->fecha_asignacion }}</td>
                            <td>
                                <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-eliminar" type="button" data-id="{{ $permiso->id }}"><i class="fas fa-trash"></i></button>
                                </form>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalPermiso"
                                    onclick="llenarModalEditarPermiso(
                                        '{{ $permiso->id }}',
                                        '{{ $permiso->usuario_id }}',
                                        '{{ $permiso->rol }}',
                                        '{{ $permiso->fecha_asignacion }}'
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

        <!-- Modal -->
        <div class="modal fade" id="modalPermiso" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="formPermiso" method="POST" action="{{ route('permisos.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModalPermiso">Registrar Permiso</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Usuario *</label>
                                    <select name="usuario_id" id="usuario_id" class="form-select" required>
                                        <option value="">Seleccione un usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->nombres }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Rol *</label>
                                    <select name="rol" id="rol" class="form-select" required>
                                        <option value="">Seleccione un Rol</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Entrenador">Entrenador</option>
                                        <option value="Cliente">Cliente</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Fecha de Asignación *</label>
                                    <input type="date" class="form-control" name="fecha_asignacion" id="fecha_asignacion" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btnGuardarPermiso">Guardar</button>
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
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>
    <script>
        new DataTable('#mitabla', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/es-ES.json' }
        });

        function llenarModalEditarPermiso(id, usuario_id, rol, fecha_asignacion) {
            const form = document.getElementById('formPermiso');
            form.action = '/permisos/' + id;
            form.querySelector('input[name="_method"]')?.remove();
            let input = document.createElement('input');
            input.type = 'hidden'; input.name = '_method'; input.value = 'PUT';
            form.appendChild(input);
            document.getElementById('usuario_id').value = usuario_id;
            document.getElementById('rol').value = rol;
            document.getElementById('fecha_asignacion').value = fecha_asignacion;

            document.getElementById('tituloModalPermiso').textContent = 'Editar Permiso';
            document.getElementById('btnGuardarPermiso').textContent = 'Actualizar';
        }

        function limpiarModalPermiso() {
            const form = document.getElementById('formPermiso');
            form.reset();
            form.action = "{{ route('permisos.store') }}";
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('tituloModalPermiso').textContent = 'Registrar Permiso';
            document.getElementById('btnGuardarPermiso').textContent = 'Guardar';
        }
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
