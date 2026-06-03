<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTipoDoc     = $_POST['idTipoDoc'];
    $idTipoUsuario = $_POST['idTipoUsuario'];
    $identificacion = $_POST['identificacion'];
    $nombre        = $_POST['nombre'];
    $apellido      = $_POST['apellido'];
    $correo        = $_POST['correo'];
    $clave         = password_hash($_POST['clave'], PASSWORD_BCRYPT); // Encriptar clave
    $celular       = $_POST['celular'];

    $sql = "INSERT INTO usuario (idTipoDoc, idTipoUsuario, identificacion, nombre, apellido, correo, clave, celular) 
            VALUES ('$idTipoDoc', '$idTipoUsuario', '$identificacion', '$nombre', '$apellido', '$correo', '$clave', '$celular')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario registrado correctamente'); window.location='../pages/iniciarsesion.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
