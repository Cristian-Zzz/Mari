<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar la sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../Modelo/conex.php"); // Ajusta si tu ruta es diferente

// Verificar si hay una sesión activa
if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "Sesión no iniciada"]);
    exit;
}

$correo = $_SESSION['user'];

// Consultar los datos del usuario actual
$sql = "SELECT 
            idTipoUsuario, 
            idTipoDoc, 
            identificacion, 
            nombre, 
            apellido, 
            correo, 
            celular 
        FROM usuario 
        WHERE correo = '$correo'";

$result = $conexion->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    // Enviar los datos del usuario en formato JSON
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Usuario no encontrado"]);
}
?>
