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
if (empty($_POST['idAcudiente']) || empty($_POST['idEstudiante'])) {
    die("Error: Todos los campos son obligatorios.");
}

$idAcudiente = intval($_POST['idAcudiente']);
$idEstudiante = intval($_POST['idEstudiante']);

// Validar que el acudiente sea tipo 4 (Acudiente)
$verificarAcudiente = $db->prepare("SELECT idTipoUsuario FROM usuario WHERE idUsuario = ? AND idTipoUsuario = 4");
$verificarAcudiente->bind_param("i", $idAcudiente);
$verificarAcudiente->execute();
$verificarAcudiente->store_result();

if ($verificarAcudiente->num_rows === 0) {
    echo "<script>
        alert('Error: El usuario seleccionado no es un acudiente válido');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}
$verificarAcudiente->close();

// Validar que el estudiante sea tipo 2 (Estudiante)
$verificarEstudiante = $db->prepare("SELECT idTipoUsuario FROM usuario WHERE idUsuario = ? AND idTipoUsuario = 2");
$verificarEstudiante->bind_param("i", $idEstudiante);
$verificarEstudiante->execute();
$verificarEstudiante->store_result();

if ($verificarEstudiante->num_rows === 0) {
    echo "<script>
        alert('Error: El usuario seleccionado no es un estudiante válido');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}
$verificarEstudiante->close();

// Verificar que la relación no exista ya
$verificarRelacion = $db->prepare("SELECT IdAcuEstu FROM acudienteestud WHERE IdAcudiente = ? AND IdEstudiante = ?");
$verificarRelacion->bind_param("ii", $idAcudiente, $idEstudiante);
$verificarRelacion->execute();
$verificarRelacion->store_result();

if ($verificarRelacion->num_rows > 0) {
    echo "<script>
        alert('Error: Esta relación acudiente-estudiante ya existe');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
    exit;
}
$verificarRelacion->close();

// Insertar con prepared statement
$stmt = $db->prepare("INSERT INTO acudienteestud (IdAcudiente, IdEstudiante) VALUES (?, ?)");

if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}

$stmt->bind_param("ii", $idAcudiente, $idEstudiante);

if ($stmt->execute()) {
    echo "<script>
        alert('Relación acudiente-estudiante agregada correctamente');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
} else {
    echo "<script>
        alert('Error al agregar la relación: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
}

$stmt->close();
$db->close();
?>