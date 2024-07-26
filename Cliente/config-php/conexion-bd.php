<?php 
// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "pan_y_mas");

// Verificar si la conexión fue exitosa
if ($conexion) {
    echo 'Conectado exitosamente';
} else {
    echo 'No se pudo conectar a la base de datos';
}
?>
