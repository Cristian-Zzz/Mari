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
if (empty($_POST['idAcuEstu']) || empty($_POST['idAcudiente']) || empty($_POST['idEstudiante'])) {
    die("Error: Todos los campos son obligatorios.");
}

$idAcuEstu = intval($_POST['idAcuEstu']);          // ID de la relación (acudiente-estudiante)
$idAcudiente = intval($_POST['idAcudiente']);      // ID del acudiente (usuario tipo 4)
$idEstudiante = intval($_POST['idEstudiante']);    // ID del estudiante (usuario tipo 2)

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

// Verificar que la nueva relación no exista ya (excepto el registro actual)
$verificarRelacion = $db->prepare("SELECT IdAcuEstu FROM acudienteestud WHERE IdAcudiente = ? AND IdEstudiante = ? AND IdAcuEstu != ?");
$verificarRelacion->bind_param("iii", $idAcudiente, $idEstudiante, $idAcuEstu);
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

// Actualizar relación
$stmt = $db->prepare("UPDATE acudienteestud SET IdAcudiente = ?, IdEstudiante = ? WHERE IdAcuEstu = ?");

if (!$stmt) {
    die("Error al preparar la consulta: " . $db->error);
}

$stmt->bind_param("iii", $idAcudiente, $idEstudiante, $idAcuEstu);

if ($stmt->execute()) {
    echo "<script>
        alert('Relación acudiente-estudiante actualizada correctamente');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
} else {
    echo "<script>
        alert('Error al actualizar la relación: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/infoFamiliar.php';
    </script>";
}

$stmt->close();
$db->close();
?>
