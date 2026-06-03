<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<php lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../Admon/img/1.1.png" sizes="32x32">

    <title>Tipo de Usuario-DisciTrack</title>

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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                       

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
                        <i class="fa fa-users" aria-hidden="true"></i> Tipo de Usuario
                    </h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="d-flex justify-content-end m-3">
                            <button type="button" class="btn btn-primary align-content-end" data-toggle="modal"
                                data-target="#exampleModal">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: rgb(211, 248, 248);">
                                        <tr>
                                            <th class="text-center">Cód. de tipo Usuario</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Modificar</th>
                                            <th class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>

<?php
require_once __DIR__ . '/../../../Modelo/conex.php';

// Normalizar conexión
if (!isset($conexion)) {
    if (isset($conex)) $conexion = $conex;
    elseif (isset($conn)) $conexion = $conn;
    elseif (isset($mysqli)) $conexion = $mysqli;
}
if (!($conexion instanceof mysqli)) {
    die("ERROR: La conexión no está bien inicializada. Revisa conex.php");
}

// Consulta: obtener todos los tipos de usuario
$sql = "SELECT idTipoUsuario, Descripcion FROM tipousuario ORDER BY idTipoUsuario ASC";

$res = $conexion->query($sql) or die("Error en la consulta: " . $conexion->error);
?>

<tbody>
<?php
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td class='text-center'>{$row['idTipoUsuario']}</td>
                <td class='text-center'>{$row['Descripcion']}</td>
                <td class='text-center'>
                  <button class='btn btn-info'><i class='fa fa-edit'></i></button>
                </td>
                <td class='text-center'>
                  <button class='btn btn-danger' onclick=\"location='../../../Controlador/BorrarTipoUsuario.php?id={$row['idTipoUsuario']}'\">
                    <i class='fa fa-trash'></i>
                  </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No hay tipos de usuario registrados</td></tr>";
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
                        <span>Copyright &copy; Your Website 2020</span>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tipo de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Descripción</label>
                            <select class="form-control" id="exampleInputPass" aria-placeholder="emailHelp" >
                                <option selected disabled>Selecione el tipo de Usuario</option>
                                <option>Administrador</option>
                                <option>Profesor</option>
                                <option>Acudiente</option>
                                <option>Estudiante</option>
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
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