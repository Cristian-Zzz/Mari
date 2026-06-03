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
if (empty($_POST['idEstudiante']) || empty($_POST['idGrado']) || empty($_POST['idGrupo']) || 
    empty($_POST['direccion']) || empty($_POST['sexo'])) {
    die("Error: Todos los campos son obligatorios.");
}

$idEstudiante = intval($_POST['idEstudiante']);
$idGrado = intval($_POST['idGrado']);
$idGrupo = intval($_POST['idGrupo']);
$direccion = trim($_POST['direccion']);
$sexo = trim($_POST['sexo']);

// Validar que el sexo sea válido
if (!in_array($sexo, ['Hombre', 'Mujer'])) {
    die("Error: Valor de sexo no válido.");
}

// Verificar que el estudiante no esté ya registrado en datosestudiante
$verificar = $db->prepare("SELECT IdEstudiante FROM datosestudiante WHERE IdEstudiante = ?");
$verificar->bind_param("i", $idEstudiante);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
    echo "<script>
        alert('Error: Este estudiante ya tiene datos registrados');
        window.location.href='../Vista/App/Admon/DatosEstudiantes.php';
    </script>";
    exit;
}
$verificar->close();

// Insertar con prepared statement
$stmt = $db->prepare("INSERT INTO datosestudiante (IdEstudiante, IdGrado, IdGrupo, Direccion, Sexo) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error al preparar consulta: " . $db->error);
}

$stmt->bind_param("iiiss", $idEstudiante, $idGrado, $idGrupo, $direccion, $sexo);

if ($stmt->execute()) {
    echo "<script>
        alert('Estudiante agregado correctamente');
        window.location.href='../Vista/App/Admon/DatosEstudiantes.php';
    </script>";
} else {
    echo "<script>
        alert('Error al agregar el estudiante: " . $stmt->error . "');
        window.location.href='../Vista/App/Admon/DatosEstudiantes.php';
    </script>";
}

$stmt->close();
$db->close();
?>