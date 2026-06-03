<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<?php
// Mostrar errores (solo mientras depuras)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ruta al archivo de conexión (ajusta si tu estructura es distinta)
// Asumiendo: DisciTrack/Modelo/conexion.php y este archivo está en DisciTrack/Vista/App/Admon/Usuarios.php
$conexionFile = __DIR__ . '/../../../Modelo/conex.php';

if (!file_exists($conexionFile)) {
    // Mensaje claro para saber qué ruta está buscando PHP
    die("ERROR: No se encontró el archivo de conexión en: $conexionFile");
}

// Incluir la conexión (usa require_once para que detenga si hay error)
require_once $conexionFile;

// Normalizar el nombre de la variable de conexión
// (algunos archivos usan $conexion, otros $conn — esto lo detecta)
if (!isset($conexion)) {
    if (isset($conn)) {
        $conexion = $conn;
    } elseif (isset($mysqli)) {
        $conexion = $mysqli;
    }
}

// Verificar que realmente tengamos una conexión mysqli
if (!isset($conexion) || !($conexion instanceof mysqli)) {
    die("ERROR: La variable de conexión no está definida correctamente. Revisa conexion.php");
}

// Ahora la conexión está lista, puedes hacer consultas sin que falle por null.
?>

<!DOCTYPE html>
<php lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="../Vista/img/1.1.png" sizes="32x32">

        <title>Usuarios-DisciTrack</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <script src="https://kit.fontawesome.com/2d662cadae.js" crossorigin="anonymous"></script>
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stlesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <img style="width: 100px; height: auto;" src="img/1.1.png" alt="">
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span href="index.php">DisciTrack</span>

                    </a>



                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item">
                    <a class="nav-link" href="Usuarios.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Usuarios</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="DatosEstudiantes.php">
                        <i class="fa-solid fa-house"></i>
                        <span>Datos Estudiante</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="infoFamiliar.php">
                        <i class="fa-solid fa-person-chalkboard"></i>
                        <span>Acudiente del Estudiante</span></a>
                </li>
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="Descargos.php">
                        <i class="fa-solid fa-scale-unbalanced-flip"></i>
                        <span>Descargos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Reportes.php">
                        <i class="fa-solid fa-flag-checkered"></i>
                        <span>Reportes</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Configuración</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            <a class="collapse-item" href="TipoDocumento.php">Tipo Documento</a>
                            <a class="collapse-item" href="TipoUsuario.php">Tipo Usuario</a>
                            <a class="collapse-item" href="TipoFalta.php">Tipo Falta</a>
                            <a class="collapse-item" href="Grados.php">Grados</a>
                            <a class="collapse-item" href="Grupos.php">Grupos</a>
                            <a class="collapse-item" href="Faltas.php">Faltas</a>

                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>








            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>

                        <!-- Topbar Search -->
                       <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" id="topSearch" class="form-control bg-light border-0 small"
      placeholder="Buscar" aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" id="btnTopSearch" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form>



                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">            
<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
    <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario'; ?>
</span>

        <img class="img-profile rounded-circle" src="img/1.1.png">
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Mi Perfil
        </a>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalPerfil">
  <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
  Configuración del Perfil
</a>


        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesión
        </a>
    </div>
</li>


                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2" style="color: #002d6b;">
                            <i class="fa fa-users" aria-hidden="true"></i> Usuarios
                        </h1>


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="d-flex justify-content-end m-3">
                                <button type="button" class="btn btn-primary align-content-end" data-toggle="modal"
                                    data-target="#exampleModal">Agregar <i class="fa fa-plus-circle"
                                        aria-hidden="true"></i>
                                </button>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- Tabla Usuarios -->
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead style="background-color: rgb(211, 248, 248);">
                                            <tr>
                                                <th class="text-center">Cód. Usuario</th>
                                                <th class="text-center">Tipo Usuario</th>
                                                <th class="text-center">Tipo Documento</th>
                                                <th class="text-center">Identificación</th>
                                                <th class="text-center">Nombres</th>
                                                <th class="text-center">Apellidos</th>
                                                <th class="text-center">Correo</th>
                                                <th class="text-center">Celular</th>
                                                <th class="text-center">Modificar</th>
                                                <th class="text-center">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "
  SELECT 
    u.idUsuario,
    u.idTipoDoc,
    u.idTipoUsuario,
    tu.descripcion AS tipoUsuario,
    td.descripcion AS tipoDocumento,
    u.identificacion,
    u.nombre,
    u.apellido,
    u.correo,
    u.celular
  FROM usuario u
  LEFT JOIN tipousuario tu ON u.idTipoUsuario = tu.idTipoUsuario
  LEFT JOIN tipodocumento td ON u.idTipoDoc = td.idTipoDoc
  ORDER BY u.idUsuario ASC
";

                                            $result = $conexion->query($sql);

                                            if (!$result) {
                                                die('Error en la consulta: ' . $conexion->error);
                                            }

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "
        <tr>
            <td class='text-center'>{$row['idUsuario']}</td>
            <td class='text-center'>{$row['tipoUsuario']}</td>
            <td class='text-center'>{$row['tipoDocumento']}</td>
            <td class='text-center'>{$row['identificacion']}</td>
            <td class='text-center'>{$row['nombre']}</td>
            <td class='text-center'>{$row['apellido']}</td>
            <td class='text-center'>{$row['correo']}</td>
            <td class='text-center'>{$row['celular']}</td>

            <!-- Botón Modificar -->
            <td class='text-center'>
                <button type='button' class='btn btn-info'
                    data-toggle='modal'
                    data-target='#editarUsuarioModal'
                    data-id='{$row['idUsuario']}'
                    data-tipodoc='{$row['idTipoDoc']}'
                    data-tipousuario='{$row['idTipoUsuario']}'
                    data-identificacion='{$row['identificacion']}'
                    data-nombre='{$row['nombre']}'
                    data-apellido='{$row['apellido']}'
                    data-correo='{$row['correo']}'
                    data-celular='{$row['celular']}'>
                    <i class='fa fa-edit'></i>
                </button>
            </td>

            <!-- Botón Eliminar -->
            <td class='text-center'>
<button type='button' class='btn btn-danger btnEliminar'
    data-id='{$row['idUsuario']}'
    data-nombre='{$row['nombre']} {$row['apellido']}'>
    <i class='fa fa-trash'></i>
</button>

            </td>
        </tr>
        ";
                                                }
                                            } else {
                                                echo "<tr><td colspan='9' class='text-center'>No hay usuarios registrados</td></tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>&copy;2025 DisciTrack. Todos los derechos reservados.</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Realmente Deseas terminar Sesión?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">Selecciona Salir si realmente desea terminar sesión</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="../../../Controlador/logout.php">Salir</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../../../Controlador/agregarusua.php">

                            <!-- Tipo Documento -->
                            <div class="form-group">
                                <label for="tipoDoc">Tipo documento:</label>
                                <select class="form-control" id="tipoDoc" name="tipoDoc" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    $docs = $conexion->query("SELECT idTipoDoc, descripcion FROM tipodocumento");
                                    while ($d = $docs->fetch_assoc()) {
                                        echo "<option value='" . $d['idTipoDoc'] . "'>" . $d['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Tipo Usuario -->
                            <div class="form-group">
                                <label for="tipoUsuario">Tipo usuario:</label>
                                <select class="form-control" id="tipoUsuario" name="tipoUsuario" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    $tipos = $conexion->query("SELECT idTipoUsuario, descripcion FROM tipousuario");
                                    while ($t = $tipos->fetch_assoc()) {
                                        echo "<option value='" . $t['idTipoUsuario'] . "'>" . $t['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Identificación -->
                            <div class="form-group">
                                <label for="identificacion">Identificación:</label>
                                <input type="text" class="form-control" name="identificacion" id="identificacion"
                                    placeholder="Ingrese su número de identificación" required>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombres:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    placeholder="Ingrese su nombre" required>
                            </div>

                            <!-- Apellido -->
                            <div class="form-group">
                                <label for="apellido">Apellidos:</label>
                                <input type="text" class="form-control" name="apellido" id="apellido"
                                    placeholder="Ingrese su apellido" required>
                            </div>

                            <!-- Celular -->
                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" name="celular" id="celular"
                                    placeholder="Ingrese su número de celular">
                            </div>

                            <!-- Correo -->
                            <div class="form-group">
                                <label for="correo">Correo electrónico:</label>
                                <input type="email" class="form-control" name="correo" id="correo"
                                    placeholder="Ingrese su correo electrónico">
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group">
                                <label for="clave">Contraseña:</label>
                                <input type="password" class="form-control" name="clave" id="clave"
                                    placeholder="Contraseña" required>
                            </div>

                            <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ================== Modal Editar ================== -->
        <div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../../../Controlador/modificarusua.php">
                            <input type="hidden" id="edit_id" name="idUsuario">

                            <!-- Tipo Documento -->
                            <div class="form-group">
                                <label>Tipo Documento</label>
                                <select class="form-control" id="edit_tipoDoc" name="tipoDoc" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    $docs = $conexion->query("SELECT idTipoDoc, descripcion FROM tipodocumento");
                                    while ($d = $docs->fetch_assoc()) {
                                        echo "<option value='" . $d['idTipoDoc'] . "'>" . $d['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Tipo Usuario -->
                            <div class="form-group">
                                <label>Tipo Usuario</label>
                                <select class="form-control" id="edit_tipoUsuario" name="tipoUsuario" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    $tipos = $conexion->query("SELECT idTipoUsuario, descripcion FROM tipousuario");
                                    while ($t = $tipos->fetch_assoc()) {
                                        echo "<option value='" . $t['idTipoUsuario'] . "'>" . $t['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Identificación</label>
                                <input type="text" class="form-control" id="edit_identificacion" name="identificacion">
                            </div>

                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre">
                            </div>

                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" id="edit_apellido" name="apellido">
                            </div>

                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" class="form-control" id="edit_correo" name="correo">
                            </div>

                            <div class="form-group">
                                <label>Celular</label>
                                <input type="text" class="form-control" id="edit_celular" name="celular">
                            </div>

                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ================== Modal Borrar ================== -->
        <div class="modal fade" id="confirmarEliminar" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Eliminar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar al usuario <strong id="usuarioNombre"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a id="btnConfirmarEliminar" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal Configuración de Perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="modalPerfilLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Configuración del Perfil</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formPerfil">
          <div class="text-center mb-3">
            <img src="img/1.1.png" class="rounded-circle" width="100" height="100" id="perfil_foto">
            <br>
            <button type="button" class="btn btn-sm btn-secondary mt-2">Cambiar foto</button>
          </div>

          <div class="form-group">
            <label for="perfil_tipoUsuario">Tipo de Usuario</label>
            <select class="form-control" id="perfil_tipoUsuario" name="tipoUsuario" required>
                <option value="">Seleccione...</option>
    <option value="1">Administrador</option>
    <option value="2">Docente</option>
    <option value="3">Estudiante</option>
    </select>
          </div>

          <div class="form-group">
            <label for="perfil_tipoDocumento">Tipo de Documento</label>
            <select class="form-control" id="perfil_tipoDocumento" name="tipoDocumento" required>
                    <option value="">Seleccione...</option>
    <option value="1">Cédula de Ciudadanía</option>
    <option value="2">Tarjeta de Identidad</option>
    <option value="3">Cédula de Extranjería</option>
            </select>
          </div>

          <div class="form-group">
            <label for="perfil_identificacion">Identificación</label>
            <input type="text" class="form-control" id="perfil_identificacion" name="identificacion" required>
          </div>

          <div class="form-group">
            <label for="perfil_nombres">Nombres</label>
            <input type="text" class="form-control" id="perfil_nombres" name="nombres" required>
          </div>

          <div class="form-group">
            <label for="perfil_apellidos">Apellidos</label>
            <input type="text" class="form-control" id="perfil_apellidos" name="apellidos" required>
          </div>

          <div class="form-group">
            <label for="perfil_correo">Correo electrónico</label>
            <input type="email" class="form-control" id="perfil_correo" name="correo" required>
          </div>

          <div class="form-group">
            <label for="perfil_celular">Celular</label>
            <input type="text" class="form-control" id="perfil_celular" name="celular" required>
          </div>

          <div class="form-group">
            <label for="perfil_clave">Nueva contraseña (opcional)</label>
            <input type="password" class="form-control" id="perfil_clave" name="clave" placeholder="Deja vacío si no deseas cambiarla">
          </div>

          <div class="text-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>








        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


   <script>
$('#modalPerfil').on('shown.bs.modal', function() {
  $.ajax({
    url: '../../../Controlador/perfil.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      console.log("Datos recibidos del servidor:", data);

      if (data.error) {
        alert(data.error);
      } else {
        $('#perfil_tipoUsuario').val(data.idTipoUsuario);
        $('#perfil_tipoDocumento').val(data.idTipoDoc);
        $('#perfil_identificacion').val(data.identificacion);
        $('#perfil_nombres').val(data.nombre);
        $('#perfil_apellidos').val(data.apellido);
        $('#perfil_correo').val(data.correo);
        $('#perfil_celular').val(data.celular);
      }
    },
    error: function(xhr, status, error) {
      console.error("Error AJAX:", error);
      alert('Error al cargar los datos del perfil');
    }
  });




  $('#formPerfil').on('submit', function(e) {
  e.preventDefault();

  const datos = {
    idTipoUsuario: $('#tipoUsuario').val(),
    idTipoDoc: $('#tipoDocumento').val(),
    identificacion: $('#identificacion').val(),
    nombre: $('#nombres').val(),
    apellido: $('#apellidos').val(),
    correo: $('#correo').val(),
    celular: $('#celular').val(),
    clave: $('#clave').val() // puede venir vacío
  };

  $.ajax({
    url: '../../../Controlador/modificarperfil.php',
    type: 'POST',
    data: datos,
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        alert('Perfil actualizado correctamente');
        $('#modalPerfil').modal('hide');
      } else {
        alert('Error al actualizar: ' + response.message);
      }
    },
    error: function() {
      alert('Error al intentar actualizar el perfil');
    }
  });
});


});

</script>





        <!-- Script para llenar el modal de edición -->
        <script>
            $('#editarUsuarioModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                // Llenar los campos con los valores correctos
                $('#edit_id').val(button.data('id'));
                $('#edit_tipoDoc').val(button.data('tipodoc'));
                $('#edit_tipoUsuario').val(button.data('tipousuario'));
                $('#edit_identificacion').val(button.data('identificacion'));
                $('#edit_nombre').val(button.data('nombre'));
                $('#edit_apellido').val(button.data('apellido'));
                $('#edit_correo').val(button.data('correo'));
                $('#edit_celular').val(button.data('celular'));
            });
        </script>
        <script>
            $(document).on('click', '.btnEliminar', function () {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                $('#usuarioNombre').text(nombre);
                $('#btnConfirmarEliminar').attr('href', '../../../Controlador/borrarusua.php?id=' + id);
                $('#confirmarEliminar').modal('show');
            });
        </script>

<script>
$(document).ready(function() {
  // Inicializa la DataTable normalmente
  var tabla = $('#dataTable').DataTable({
    dom: 'lrtip', // quita el buscador por defecto
    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      infoEmpty: "Mostrando 0 registros",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      paginate: { previous: "Anterior", next: "Siguiente" }
    }
  });

  // Filtrar mientras escribes
  $('#topSearch').on('keyup', function() {
    tabla.search(this.value).draw();
  });

  // Filtrar cuando presionas el botón de la lupa
  $('#btnTopSearch').on('click', function() {
    const texto = $('#topSearch').val();
    tabla.search(texto).draw();
  });
});
</script>

<style>
/* 🔹 Oculta el selector de cantidad de registros ("Show 10 entries") */
.dataTables_length {
  display: none !important;
}

/* 🔹 Oculta el buscador por defecto (ya lo hiciste, pero lo dejo completo) */
.dataTables_filter {
  display: none !important;
}

/* 🔹 Oculta la paginación ("Previous / Next") */
.dataTables_paginate {
  display: none !important;
}

/* 🔹 Oculta el texto de información ("Showing 1 to 1 of ... entries") */
.dataTables_info {
  display: none !important;
}
</style>




    </body>

</php>