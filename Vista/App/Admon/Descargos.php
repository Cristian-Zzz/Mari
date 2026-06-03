<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<?php
// Mostrar errores mientras depuras
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ajusta la ruta si es necesario:
$conexionFile = __DIR__ . '/../../../Modelo/conex.php';
if (!file_exists($conexionFile)) {
    die("ERROR: No se encontró el archivo de conexión en: $conexionFile");
}

require_once $conexionFile;

// Normalizar la variable de conexión
if (!isset($conexion) || !($conexion instanceof mysqli)) {
    if (isset($conn) && ($conn instanceof mysqli))
        $conexion = $conn;
    elseif (isset($mysqli) && ($mysqli instanceof mysqli))
        $conexion = $mysqli;
    else
        die("ERROR: La variable de conexión no está definida correctamente. Revisa conex.php");
}

// ============ CONSULTA PARA MOSTRAR DESCARGOS ============
$sqlDescargos = "
    SELECT 
        d.idDescargo,
        d.idFalta,
        d.idEstudiante,
        d.fechaRespuesta,
        d.contenido,
        d.aceptada,
        u.idUsuario AS codigoEstudiante,
        CONCAT(u.nombre, ' ', u.apellido) AS nombreEstudiante,
        f.descripcion AS descripcionFalta
    FROM descargos d
    INNER JOIN usuario u ON d.idEstudiante = u.idUsuario
    INNER JOIN falta f ON d.idFalta = f.idFalta
    ORDER BY d.fechaRespuesta DESC
";

$resultadoDescargos = $conexion->query($sqlDescargos);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../Admon/img/1.1.png" sizes="32x32">

    <title>Descargos-DisciTrack</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2d662cadae.js" crossorigin="anonymous"></script>
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

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2" style="color: #002d6b;">
                        <i class="fa-solid fa-scale-unbalanced-flip"></i> Descargos
                    </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="d-flex justify-content-end m-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#agregarDescargoModal">
                                Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: rgb(211, 248, 248);">
                                        <tr>
                                            <th class="text-center">Cód. Estudiante</th>
                                            <th class="text-center">Nombre Estudiante</th>
                                            <th class="text-center">Falta</th>
                                            <th class="text-center">Fecha de Respuesta</th>
                                            <th class="text-center">Contenido</th>
                                            <th class="text-center">Aceptada</th>
                                            <th class="text-center">Modificar</th>
                                            <th class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($resultadoDescargos && $resultadoDescargos->num_rows > 0) {
                                            while ($row = $resultadoDescargos->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . htmlspecialchars($row['codigoEstudiante']) . "</td>";
                                                echo "<td class='text-center'>" . htmlspecialchars($row['nombreEstudiante']) . "</td>";
                                                echo "<td class='text-center'>" . htmlspecialchars(substr($row['descripcionFalta'], 0, 30)) . "...</td>";
                                                echo "<td class='text-center'>" . htmlspecialchars($row['fechaRespuesta']) . "</td>";
                                                echo "<td class='text-center'>" . htmlspecialchars(substr($row['contenido'], 0, 40)) . "...</td>";
                                                echo "<td class='text-center'>" . htmlspecialchars($row['aceptada']) . "</td>";

                                                // Botón Modificar
                                                echo "<td class='text-center'>
                                                    <button type='button' class='btn btn-info btn-editar' 
                                                        data-toggle='modal' 
                                                        data-target='#editarDescargoModal'
                                                        data-id='" . $row['idDescargo'] . "'
                                                        data-idfalta='" . $row['idFalta'] . "'
                                                        data-idestudiante='" . $row['idEstudiante'] . "'
                                                        data-fecharespuesta='" . $row['fechaRespuesta'] . "'
                                                        data-contenido='" . htmlspecialchars($row['contenido']) . "'
                                                        data-aceptada='" . htmlspecialchars($row['aceptada']) . "'>
                                                        <i class='fa fa-edit'></i>
                                                    </button>
                                                </td>";

                                                // Botón Eliminar
                                                echo "<td class='text-center'>
                                                    <button type='button' class='btn btn-danger btn-eliminar'
                                                        data-toggle='modal'
                                                        data-target='#confirmarEliminar'
                                                        data-id='" . $row['idDescargo'] . "'
                                                        data-nombre='" . htmlspecialchars($row['nombreEstudiante'] . " - " . $row['fechaRespuesta']) . "'>
                                                        <i class='fa fa-trash'></i>
                                                    </button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center'>No hay descargos registrados</td></tr>";
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
                        <span>Copyright &copy; DisciTrack 2025</span>
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

    <!-- ================== Modal Agregar Descargo ================== -->
    <div class="modal fade" id="agregarDescargoModal" tabindex="-1" role="dialog"
        aria-labelledby="agregarDescargoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Encabezado -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarDescargoLabel">Agregar Descargo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Cuerpo -->
                <div class="modal-body">
                    <form method="POST" action="../../../Controlador/agregardescar.php">

                        <!-- Seleccionar Falta -->
                        <div class="form-group">
                            <label for="idFalta">Seleccionar Falta:</label>
                            <select class="form-control" id="idFalta" name="idFalta" required>
                                <option value="">Seleccione una falta...</option>
                                <?php
                                // Mostrar faltas disponibles
                                $sqlFaltas = "
                                    SELECT f.idFalta, f.descripcion, CONCAT(u.nombre, ' ', u.apellido) AS estudiante 
                                    FROM falta f
                                    INNER JOIN usuario u ON f.idEstudiante = u.idUsuario
                                    ORDER BY f.fechaRegistro DESC
                                ";
                                $faltas = $conexion->query($sqlFaltas);
                                if ($faltas) {
                                    while ($f = $faltas->fetch_assoc()) {
                                        echo "<option value='" . $f['idFalta'] . "'>"
                                            . htmlspecialchars($f['estudiante'] . " - " . substr($f['descripcion'], 0, 40))
                                            . "...</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Seleccionar Estudiante -->
                        <div class="form-group">
                            <label for="idEstudiante">Seleccionar Estudiante:</label>
                            <select class="form-control" id="idEstudiante" name="idEstudiante" required>
                                <option value="">Seleccione un estudiante...</option>
                                <?php
                                // Mostrar estudiantes
                                $sqlEst = "SELECT idUsuario, nombre, apellido, identificacion FROM usuario WHERE idTipoUsuario = 2 ORDER BY nombre ASC";
                                $estudiantes = $conexion->query($sqlEst);
                                if ($estudiantes) {
                                    while ($e = $estudiantes->fetch_assoc()) {
                                        echo "<option value='" . $e['idUsuario'] . "'>"
                                            . htmlspecialchars($e['nombre'] . " " . $e['apellido'])
                                            . " (ID: " . htmlspecialchars($e['identificacion']) . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Fecha de Respuesta -->
                        <div class="form-group">
                            <label for="fechaRespuesta">Fecha de Respuesta:</label>
                            <input type="date" class="form-control" id="fechaRespuesta" name="fechaRespuesta" required>
                        </div>

                        <!-- Contenido -->
                        <div class="form-group">
                            <label for="contenido">Contenido:</label>
                            <textarea class="form-control" id="contenido" name="contenido" rows="4"
                                placeholder="Ingrese el descargo del estudiante" required></textarea>
                        </div>

                        <!-- Aceptada -->
                        <div class="form-group">
                            <label for="aceptada">¿Aceptada?:</label>
                            <select class="form-control" id="aceptada" name="aceptada" required>
                                <option value="">Seleccione...</option>
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <!-- Botón Guardar -->
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

    <!-- ================== Modal Editar Descargo ================== -->
    <div class="modal fade" id="editarDescargoModal" tabindex="-1" role="dialog"
        aria-labelledby="editarDescargoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editarDescargoLabel">Editar Descargo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="../../../Controlador/modificardescar.php">
                        <input type="hidden" id="edit_id" name="idDescargo">

                        <!-- Seleccionar Falta -->
                        <div class="form-group">
                            <label>Seleccionar Falta:</label>
                            <select class="form-control" id="edit_idFalta" name="idFalta" required>
                                <option value="">Seleccione una falta...</option>
                                <?php
                                // Volver a consultar faltas para el modal de edición
                                $sqlFaltas2 = "
                                    SELECT f.idFalta, f.descripcion, CONCAT(u.nombre, ' ', u.apellido) AS estudiante 
                                    FROM falta f
                                    INNER JOIN usuario u ON f.idEstudiante = u.idUsuario
                                    ORDER BY f.fechaRegistro DESC
                                ";
                                $faltas2 = $conexion->query($sqlFaltas2);
                                if ($faltas2) {
                                    while ($f = $faltas2->fetch_assoc()) {
                                        echo "<option value='" . $f['idFalta'] . "'>"
                                            . htmlspecialchars($f['estudiante'] . " - " . substr($f['descripcion'], 0, 40))
                                            . "...</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Seleccionar Estudiante -->
                        <div class="form-group">
                            <label>Seleccionar Estudiante:</label>
                            <select class="form-control" id="edit_idEstudiante" name="idEstudiante" required>
                                <option value="">Seleccione un estudiante...</option>
                                <?php
                                // Volver a consultar estudiantes para el modal de edición
                                $sqlEst2 = "SELECT idUsuario, nombre, apellido, identificacion FROM usuario WHERE idTipoUsuario = 2 ORDER BY nombre ASC";
                                $estudiantes2 = $conexion->query($sqlEst2);
                                if ($estudiantes2) {
                                    while ($e = $estudiantes2->fetch_assoc()) {
                                        echo "<option value='" . $e['idUsuario'] . "'>"
                                            . htmlspecialchars($e['nombre'] . " " . $e['apellido'])
                                            . " (ID: " . htmlspecialchars($e['identificacion']) . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Fecha de Respuesta -->
                        <div class="form-group">
                            <label>Fecha de Respuesta:</label>
                            <input type="date" class="form-control" id="edit_fechaRespuesta" name="fechaRespuesta"
                                required>
                        </div>

                        <!-- Contenido -->
                        <div class="form-group">
                            <label>Contenido:</label>
                            <textarea class="form-control" id="edit_contenido" name="contenido" rows="4"
                                required></textarea>
                        </div>

                        <!-- Aceptada -->
                        <div class="form-group">
                            <label>¿Aceptada?:</label>
                            <select class="form-control" id="edit_aceptada" name="aceptada" required>
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Guardar cambios
                            </button>
                        </div>
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
                    <h5 class="modal-title">Eliminar Descargo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el descargo de: <strong id="descargoNombre"></strong>?</p>
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

    <!-- Script para manejar modales -->
    <script>
        // Modal Editar - Cargar datos
        $('#editarDescargoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var idFalta = button.data('idfalta');
            var idEstudiante = button.data('idestudiante');
            var fechaRespuesta = button.data('fecharespuesta');
            var contenido = button.data('contenido');
            var aceptada = button.data('aceptada');

            var modal = $(this);
            modal.find('#edit_id').val(id);
            modal.find('#edit_idFalta').val(idFalta);
            modal.find('#edit_idEstudiante').val(idEstudiante);
            modal.find('#edit_fechaRespuesta').val(fechaRespuesta);
            modal.find('#edit_contenido').val(contenido);
            modal.find('#edit_aceptada').val(aceptada);
        });

        // Modal Eliminar - Cargar datos
        $('#confirmarEliminar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');

            var modal = $(this);
            modal.find('#descargoNombre').text(nombre);
            modal.find('#btnConfirmarEliminar').attr('href', '../../../Controlador/borrardescar.php?id=' + id);
        });
    </script>

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

</html>