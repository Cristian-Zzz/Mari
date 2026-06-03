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
    die("<script>
        alert('Error: No hay conexión válida a la base de datos.');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>");
}

// ✅ Validar método de envío
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>
        alert('Error: Método no permitido.');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}

// ✅ Validar ID recibido
if (empty($_POST['idAcuEstu']) || !is_numeric($_POST['idAcuEstu'])) {
    echo "<script>
        alert('Error: ID de relación no válido.');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}

$idAcuEstu = intval($_POST['idAcuEstu']);

// ✅ Eliminar con prepared statement
$stmt = $db->prepare("DELETE FROM acudienteestud WHERE IdAcuEstu = ?");

if (!$stmt) {
    echo "<script>
        alert('Error al preparar la consulta: " . $db->error . "');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}

$stmt->bind_param("i", $idAcuEstu);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>
        alert('✅ Relación acudiente-estudiante eliminada correctamente.');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
} else {
    echo "<script>
        alert('⚠️ No se encontró el registro a eliminar o ya fue eliminado.');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
}

$stmt->close();
$db->close();
?>
