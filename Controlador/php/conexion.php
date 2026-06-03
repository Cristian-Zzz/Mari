<?php
$servername = "localhost";  // servidor de MySQL
$username   = "root";       // usuario de MySQL (por defecto root en XAMPP)
$password   = "";           // contraseña de MySQL (si tienes, cámbiala)
$dbname     = "DisciTrack"; // nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
