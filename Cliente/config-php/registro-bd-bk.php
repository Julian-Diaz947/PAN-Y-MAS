<?php 
include 'conexion-bd.php'; // Incluir el archivo de conexión a la base de datos

// Obtener datos del formulario usando el método POST
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$n_documento = $_POST['n_documento'];
$direccion = $_POST['direccion'];
$municipio = $_POST['municipio'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Cifrar la contraseña usando SHA-512
$contrasena = hash('sha512', $contrasena);

// Preparar la consulta SQL para insertar los datos en la tabla 'cliente'
$query = "INSERT INTO cliente (nombres, apellidos, n_documento, direccion, municipio, celular, correo, contrasena) 
          VALUES ('$nombres', '$apellidos', '$n_documento', '$direccion', '$municipio', '$celular', '$correo', '$contrasena')";

// Ejecutar la consulta SQL
$ejecutar = mysqli_query($conexion, $query);

// Comprobar si la consulta se ejecutó correctamente
if ($ejecutar) {
    echo '
    <script>
    alert("Usuario registrado correctamente");
    window.location = "../catalogo/catalogo.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("Usuario no registrado, intente de nuevo");
    window.location = "registro/formulario.php";
    </script>
    ';
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
