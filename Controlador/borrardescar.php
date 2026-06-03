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
    die("Error: ID de descargo no válido.");
}

$idDescargo = intval($_GET['id']);

// Eliminar con prepared statement
$stmt = $db->prepare("DELETE FROM descargos WHERE idDescargo = ?");

if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}

$stmt->bind_param("i", $idDescargo);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Descargo eliminado correctamente');
            window.location.href='../Vista/App/Admon/Descargos.php';
        </script>";
    } else {
        echo "<script>
            alert('No se encontró el descargo a eliminar');
            window.location.href='../Vista/App/Admon/Descargos.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Error al eliminar el descargo: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
}

$stmt->close();
$db->close();
?>