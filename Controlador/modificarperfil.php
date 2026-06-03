<?php
session_start();
include '../Modelo/conex.php'; // Asegúrate de que esta ruta sea correcta

header('Content-Type: application/json');

// Verificar si hay un usuario logueado
if (!isset($_SESSION['user'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Sesión no iniciada'
    ]);
    exit;
}

$correoSesion = $_SESSION['user']; // Correo del usuario logueado

// Recibir los datos del formulario
$idTipoUsuario = $_POST['tipoUsuario'] ?? null;
$idTipoDoc = $_POST['tipoDocumento'] ?? null;
$identificacion = $_POST['identificacion'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$apellido = $_POST['apellido'] ?? null;
$correo = $_POST['correo'] ?? null;
$celular = $_POST['celular'] ?? null;
$clave = $_POST['clave'] ?? null;

// Validar campos obligatorios
// Validar campos obligatorios
// Validar campos obligatorios (mejor forma)
$campos = [
    'tipoUsuario' => $idTipoUsuario,
    'tipoDocumento' => $idTipoDoc,
    'identificacion' => $identificacion,
    'nombre' => $nombre,
    'apellido' => $apellido,
    'correo' => $correo
];

foreach ($campos as $key => $valor) {
    if ($valor === null || $valor === '') {
        echo json_encode([
            'success' => false,
            'message' => "Falta el campo: $key"
        ]);
        exit;
    }
}


// Si la clave viene vacía, no se actualiza
if (empty($clave)) {
    $sql = "UPDATE usuario 
            SET idTipoUsuario=?, idTipoDoc=?, identificacion=?, nombre=?, apellido=?, correo=?, celular=?
            WHERE correo=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iissssss", $idTipoUsuario, $idTipoDoc, $identificacion, $nombre, $apellido, $correo, $celular, $correoSesion);
} else {
    $hash = password_hash($clave, PASSWORD_DEFAULT);
    $sql = "UPDATE usuario 
            SET idTipoUsuario=?, idTipoDoc=?, identificacion=?, nombre=?, apellido=?, correo=?, celular=?, clave=?
            WHERE correo=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iisssssss", $idTipoUsuario, $idTipoDoc, $identificacion, $nombre, $apellido, $correo, $celular, $hash, $correoSesion);
}

// Ejecutar y responder
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Perfil actualizado correctamente'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar: ' . $stmt->error
    ]);
}

$stmt->close();
$conexion->close();
?>
