<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE ROCK</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h2 class="float-start">LISTADO DE CATEGORIAS</h2>
                    <button type="button" class="btn btn-primary float-end" onclick="abrirModalNuevoCategoria()">
                        <i class="fas fa-plus"></i> Nuevo Categoria
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCategoria">
                        @forelse ($categorias as $categoria)
                            <tr id="fila-{{ $categoria->id }}">
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ $categoria->descripcion }}</td>
                                <td>{{ $categoria->estado }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="editarCategoria({{ $categoria->id }}, '{{ $categoria->nombre }}', '{{ $categoria->descripcion }}', '{{ $categoria->estado }}')">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="eliminarCategoria({{ $categoria->id }})">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <!-- Fila eliminada para evitar conflictos con DataTables -->
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para Nuevo/Editar Categoria -->
        <div class="modal fade" id="modalCategoria" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="formCategoria" method="POST" action="{{ route('categorias.store') }}">
                        @csrf
                        <input type="hidden" id="idCategoria" name="id">
                        <input type="hidden" id="metodoForm" name="_method" value="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Registrar Categoria</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombres *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción *</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
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

        <!-- Modal de confirmación para eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
                        <p><strong>Esta acción no se puede deshacer.</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="formEliminar" method="POST" action="" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Variables globales
        let table;
        let categoriaIdEliminar = null;
        const modalCategoria = new bootstrap.Modal(document.getElementById('modalCategoria'));
        const modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));

        // Inicializar DataTable después de que el DOM esté listo
        $(document).ready(function() {
            // Verificar si la tabla ya está inicializada y destruirla si es necesario
            if ($.fn.DataTable.isDataTable('#mitabla')) {
                $('#mitabla').DataTable().destroy();
            }
            
            // Inicializar DataTable con configuración completa
            table = $('#mitabla').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/es-ES.json',
                },
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                // Configuración para manejar tabla vacía
                emptyTable: "No hay categorías registradas",
                // Configuración de columnas
                columnDefs: [
                    {
                        targets: [3], // Columna de acciones
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: '_all',
                        defaultContent: ''
                    }
                ],
                // Configuración de DOM para mejor presentación
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                // Configuración adicional
                processing: true,
                stateSave: false,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                pagingType: "full_numbers"
            });
            
            // Auto-ocultar alertas después de 5 segundos
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        });

        // Función para abrir modal de nueva categoría
        function abrirModalNuevoCategoria() {
            document.getElementById('formCategoria').reset();
            document.getElementById('idCategoria').value = '';
            document.getElementById('metodoForm').value = 'POST';
            document.getElementById('formCategoria').action = '{{ route("categorias.store") }}';
            document.getElementById('tituloModal').textContent = 'Registrar Categoria';
            document.getElementById('btnGuardar').textContent = 'Guardar';
            modalCategoria.show();
        }

        // Función para editar categoría
        function editarCategoria(id, nombre, descripcion, estado) {
            document.getElementById('idCategoria').value = id;
            document.getElementById('nombre').value = nombre;
            document.getElementById('descripcion').value = descripcion;
            document.getElementById('estado').value = estado;
            document.getElementById('metodoForm').value = 'PUT';
            document.getElementById('formCategoria').action = `/categorias/${id}`;
            document.getElementById('tituloModal').textContent = 'Editar Categoria';
            document.getElementById('btnGuardar').textContent = 'Actualizar';
            modalCategoria.show();
        }

        // Función para eliminar categoría
        function eliminarCategoria(id) {
            categoriaIdEliminar = id;
            document.getElementById('formEliminar').action = `/categorias/${id}`;
            modalEliminar.show();
        }

        // Limpiar formulario cuando se cierra el modal
        document.getElementById('modalCategoria').addEventListener('hidden.bs.modal', function() {
            document.getElementById('formCategoria').reset();
        });

        // Manejar el menú sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
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
                                otherArrow.style.transform = 'rotate(0deg)';
                            }
                        });
                        
                        // Toggle del submenú actual
                        if (submenu.style.display === 'block') {
                            submenu.style.display = 'none';
                            arrow.style.transform = 'rotate(0deg)';
                        } else {
                            submenu.style.display = 'block';
                            arrow.style.transform = 'rotate(90deg)';
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>