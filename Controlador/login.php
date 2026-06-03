<?php
session_start();
include("../Modelo/conex.php");

if (isset($_POST['login'])) {
    $correo = $_POST['username'];
    $clave = $_POST['password'];

    $sql = "SELECT correo, clave, concat(nombre, ' ', apellido), idTipoUsuario FROM usuario WHERE correo ='$correo' AND clave='$clave'";

    $res = $conexion->query($sql);
    $fila = $res->fetch_row();

    if ($fila) { // Si encontró un usuario
        $_SESSION['user'] = $fila[0];   // correo
        $_SESSION['tipo'] = $fila[3];   // idTipoUsuario
        $_SESSION['usuario'] = $fila[2]; // nombre completo

        $msj = "Bienvenido " . $_SESSION['usuario'];

        switch ($_SESSION['tipo']) {
            case '1':
                header("location: ../Vista/App/Admon/index.php?mensaje=$msj");
                break;
            case '2':
                header("location: ../Vista/index.php?mensaje=$msj");
                break;
            default:
                header("location: ../Vista/index.php?mensaje=$msj");
                break;
        }
    } else {
        echo "<script>
                alert('Usuario y/o Contraseña Incorrectos');
                location.href='../Vista/pages/iniciarsesion.php';
              </script>";
    }
}
?>