<?php 
session_start(); // Iniciar sesión
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
$query = $conexion->prepare("INSERT INTO cliente (nombres, apellidos, n_documento, direccion, municipio, celular, correo, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Bind de parámetros para evitar inyecciones SQL
$query->bind_param("ssssssss", $nombres, $apellidos, $n_documento, $direccion, $municipio, $celular, $correo, $contrasena);

// Ejecutar la consulta SQL y comprobar si se ejecutó correctamente
if ($query->execute()) {
    // Establecer la variable de sesión
    $_SESSION['cliente'] = $correo; // Usar el correo como identificador de sesión
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
$query->close();
$conexion->close();
?>
