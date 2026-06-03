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
if (empty($_POST['idDescargo']) || empty($_POST['idFalta']) || empty($_POST['idEstudiante']) || 
    empty($_POST['fechaRespuesta']) || empty($_POST['contenido']) || empty($_POST['aceptada'])) {
    die("Error: Todos los campos son obligatorios.");
}

$idDescargo = intval($_POST['idDescargo']);
$idFalta = intval($_POST['idFalta']);
$idEstudiante = intval($_POST['idEstudiante']);
$fechaRespuesta = trim($_POST['fechaRespuesta']);
$contenido = trim($_POST['contenido']);
$aceptada = trim($_POST['aceptada']);

// Validar que la fecha sea válida
$fecha = DateTime::createFromFormat('Y-m-d', $fechaRespuesta);
if (!$fecha || $fecha->format('Y-m-d') !== $fechaRespuesta) {
    echo "<script>
        alert('Error: Fecha de respuesta no válida');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
    exit;
}

// Validar que aceptada sea Sí o No
if (!in_array($aceptada, ['Sí', 'No', 'SI', 'si'])) {
    echo "<script>
        alert('Error: Valor de aceptada no válido');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
    exit;
}

// Validar que la falta exista
$verificarFalta = $db->prepare("SELECT idFalta FROM falta WHERE idFalta = ?");
$verificarFalta->bind_param("i", $idFalta);
$verificarFalta->execute();
$verificarFalta->store_result();

if ($verificarFalta->num_rows === 0) {
    echo "<script>
        alert('Error: La falta seleccionada no existe');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
    exit;
}
$verificarFalta->close();

// Validar que el estudiante exista y sea tipo 2
$verificarEstudiante = $db->prepare("SELECT idTipoUsuario FROM usuario WHERE idUsuario = ? AND idTipoUsuario = 2");
$verificarEstudiante->bind_param("i", $idEstudiante);
$verificarEstudiante->execute();
$verificarEstudiante->store_result();

if ($verificarEstudiante->num_rows === 0) {
    echo "<script>
        alert('Error: El estudiante seleccionado no es válido');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
    exit;
}
$verificarEstudiante->close();

// Verificar que no exista otro descargo para esta falta y estudiante (excepto el actual)
$verificarDescargo = $db->prepare("SELECT idDescargo FROM descargos WHERE idFalta = ? AND idEstudiante = ? AND idDescargo != ?");
$verificarDescargo->bind_param("iii", $idFalta, $idEstudiante, $idDescargo);
$verificarDescargo->execute();
$verificarDescargo->store_result();

if ($verificarDescargo->num_rows > 0) {
    echo "<script>
        alert('Error: Ya existe otro descargo para esta falta y estudiante');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
    exit;
}
$verificarDescargo->close();

// Actualizar con prepared statement
$stmt = $db->prepare("UPDATE descargos SET idFalta = ?, idEstudiante = ?, fechaRespuesta = ?, contenido = ?, aceptada = ? WHERE idDescargo = ?");

if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}

$stmt->bind_param("iisssi", $idFalta, $idEstudiante, $fechaRespuesta, $contenido, $aceptada, $idDescargo);

if ($stmt->execute()) {
    echo "<script>
        alert('Descargo actualizado correctamente');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
} else {
    echo "<script>
        alert('Error al actualizar el descargo: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/Descargos.php';
    </script>";
}

$stmt->close();
$db->close();
?>