<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../Modelo/conex.php';

// Normalizar conexión
if (isset($conexion) && $conexion instanceof mysqli) {
    $db = $conexion;
} elseif (isset($conn) && $conn instanceof mysqli) {
    $db = $conn;
} elseif (isset($mysqli) && $mysqli instanceof mysqli) {
    $db = $mysqli;
} else {
    die("Error: No hay conexión válida a la base de datos.");
}

// Validar ID recibido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: ID de usuario no válido.");
}

$idUsuario = intval($_GET['id']);

// Eliminar con prepared statement
$stmt = $db->prepare("DELETE FROM usuario WHERE idUsuario = ?");
if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}
$stmt->bind_param("i", $idUsuario);

if ($stmt->execute()) {
        echo "<script>
            alert('Usuario borrado correctamente');
            window.location.href='../Vista/App/Admon/Usuarios.php';
          </script>";
} else {
    die("Error al eliminar el usuario: " . $stmt->error);
}
