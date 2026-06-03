<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $clave  = $_POST['clave'];

    $sql = "SELECT * FROM usuario WHERE correo = '$correo' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($clave, $usuario['clave'])) {
            $_SESSION['usuario'] = $usuario['nombre'] . " " . $usuario['apellido'];
            $_SESSION['idTipoUsuario'] = $usuario['idTipoUsuario'];

            // Redirigir al dashboard
            header("Location: ../App/Admon/index.html");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location='../pages/iniciarsesion.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location='../pages/iniciarsesion.html';</script>";
    }
}

$conn->close();
?>
