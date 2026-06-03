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

// Validar que se enviaron los datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Método no permitido.");
}

// Validar y sanitizar datos
if (empty($_POST['idDatosEstudiante']) || empty($_POST['direccion']) || empty($_POST['sexo'])) {
    die("Error: Todos los campos son obligatorios.");
}

$idDatosEstudiante = intval($_POST['idDatosEstudiante']);
$direccion = trim($_POST['direccion']);
$sexo = trim($_POST['sexo']);

// Validar que el sexo sea válido
if (!in_array($sexo, ['Hombre', 'Mujer'])) {
    die("Error: Valor de sexo no válido.");
}

// Actualizar con prepared statement
$stmt = $db->prepare("UPDATE datosestudiante SET Direccion = ?, Sexo = ? WHERE IdDatosEstudiante = ?");

if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}

$stmt->bind_param("ssi", $direccion, $sexo, $idDatosEstudiante);

if ($stmt->execute()) {
    echo "<script>
        alert('Datos del estudiante actualizados correctamente');
        window.location.href='../Vista/App/Admon/DatosEstudiantes.php';
    </script>";
} else {
    echo "<script>
        alert('Error al actualizar los datos: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/DatosEstudiantes.php';
    </script>";
}

$stmt->close();
$db->close();
?>