<?php
// 1. Conectar a la base de datos
include("../../Modelo/conexion.php"); // ajusta la ruta según tu proyecto

// 2. Hacer la consulta
$sql = "SELECT idUsuario, idTipoUsuario, idTipoDoc, identificacion, 
               CONCAT(nombre, ' ', apellido) AS nombreCompleto, 
               correo, celular 
        FROM usuario";

$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - DisciTrack</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- tu CSS -->
</head>
<body>

<h2>Usuarios</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Cód. Usuario</th>
            <th>Tipo Usuario</th>
            <th>Tipo Documento</th>
            <th>Identificación</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // 3. Pintar filas con datos de la BD
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['idUsuario']."</td>
                        <td>".$row['idTipoUsuario']."</td>
                        <td>".$row['idTipoDoc']."</td>
                        <td>".$row['identificacion']."</td>
                        <td>".$row['nombreCompleto']."</td>
                        <td>".$row['correo']."</td>
                        <td>".$row['celular']."</td>
                        <td><button>✏️</button></td>
                        <td><button>🗑️</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay usuarios registrados</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
