<?php
require_once("../Modelo/conex.php");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$idUsuario      = $_POST['idUsuario'];
$tipoDoc        = $_POST['tipoDoc'];
$tipoUsuario    = $_POST['tipoUsuario'];
$identificacion = $_POST['identificacion'];
$nombre         = $_POST['nombre'];
$correo         = $_POST['correo'];
$celular        = $_POST['celular'];

// OJO: si guardas nombre y apellido separados en la BD, deberías separarlos aquí
$sql = "UPDATE usuario 
        SET idTipoDoc = ?, idTipoUsuario = ?, identificacion = ?, nombre = ?, correo = ?, celular = ? 
        WHERE idUsuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iissssi", $tipoDoc, $tipoUsuario, $identificacion, $nombre, $correo, $celular, $idUsuario);

if ($stmt->execute()) {
    echo "<script>
            alert('Usuario actualizado correctamente');
            window.location.href='../Vista/App/Admon/Usuarios.php';
          </script>";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
