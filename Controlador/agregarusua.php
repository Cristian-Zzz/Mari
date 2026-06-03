<?php
// Controlador/agregarusua.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../Modelo/conex.php';

// Normalizar nombre de la conexión
if (isset($conexion) && $conexion instanceof mysqli) {
    $db = $conexion;
} elseif (isset($conn) && $conn instanceof mysqli) {
    $db = $conn;
} elseif (isset($mysqli) && $mysqli instanceof mysqli) {
    $db = $mysqli;
} else {
    die("Error: No se encontró una conexión mysqli válida. Revisa Modelo/conex.php");
}

// Recoger y sanitizar datos del POST
$tipoDoc      = isset($_POST['tipoDoc']) ? intval($_POST['tipoDoc']) : 0;
$tipoUsuario  = isset($_POST['tipoUsuario']) ? intval($_POST['tipoUsuario']) : 0;
$identificacion = trim($_POST['identificacion'] ?? '');
$nombre       = trim($_POST['nombre'] ?? '');
$apellido     = trim($_POST['apellido'] ?? '');
$correo       = trim($_POST['correo'] ?? '');
$celular      = trim($_POST['celular'] ?? '');
$clave        = trim($_POST['clave'] ?? '');

// Validaciones básicas
if ($tipoDoc <= 0 || $tipoUsuario <= 0) {
    die("Error: Debes seleccionar tipo de documento y tipo de usuario válidos.");
}

if (empty($identificacion) || empty($nombre) || empty($apellido)) {
    die("Error: La identificación, nombre y apellido son obligatorios.");
}

if (empty($clave)) {
    die("Error: La contraseña es obligatoria.");
}

// Comprobar que el tipo de documento existe
$stmt = $db->prepare("SELECT COUNT(*) FROM tipodocumento WHERE idTipoDoc = ?");
$stmt->bind_param("i", $tipoDoc);
$stmt->execute();
$stmt->bind_result($countDoc);
$stmt->fetch();
$stmt->close();
if ($countDoc == 0) {
    die("Error: El tipo de documento seleccionado no existe.");
}

// Comprobar que el tipo de usuario existe
$stmt = $db->prepare("SELECT COUNT(*) FROM tipousuario WHERE idTipoUsuario = ?");
$stmt->bind_param("i", $tipoUsuario);
$stmt->execute();
$stmt->bind_result($countTipo);
$stmt->fetch();
$stmt->close();
if ($countTipo == 0) {
    die("Error: El tipo de usuario seleccionado no existe.");
}

// Verificar si la identificación ya existe
$stmt = $db->prepare("SELECT COUNT(*) FROM usuario WHERE identificacion = ?");
$stmt->bind_param("s", $identificacion);
$stmt->execute();
$stmt->bind_result($countIdent);
$stmt->fetch();
$stmt->close();
if ($countIdent > 0) {
    die("Error: Ya existe un usuario con esa identificación.");
}

// Encriptar la contraseña
$claveHash = password_hash($clave, PASSWORD_DEFAULT);

// Insertar el nuevo usuario
$insert = $db->prepare("INSERT INTO usuario (idTipoDoc, idTipoUsuario, identificacion, nombre, apellido, correo, celular, clave) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if (!$insert) {
    die("Error al preparar la consulta: " . $db->error);
}

$insert->bind_param("iissssss", $tipoDoc, $tipoUsuario, $identificacion, $nombre, $apellido, $correo, $celular, $claveHash);

if (!$insert->execute()) {
    die("Error al insertar usuario: " . $insert->error);
}

$insert->close();

// Redirigir de vuelta a la vista con mensaje de éxito
    echo "<script>
            alert('Usuario agregado correctamente');
            window.location.href='../Vista/App/Admon/Usuarios.php';
          </script>";
?>