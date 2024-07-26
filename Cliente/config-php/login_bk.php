<?php
session_start(); // Inicia la sesión

include 'conexion-bd.php'; // Incluye la conexión a la base de datos

// Obtiene los datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Encripta la contraseña usando hash sha512
$contrasena = hash('sha512', $contrasena);

// Consulta para validar el login
$validar_login = mysqli_query($conexion, "SELECT * FROM cliente WHERE correo='$correo' AND contrasena='$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
    // Si existe el usuario, guarda el correo en la sesión y redirige al catálogo
    $_SESSION['cliente'] = $correo;
    header("Location: ../catalogo/catalogo.php");
    exit;
} else {
    // Si el usuario no existe, muestra una alerta y redirige al inicio
    echo '
    <script>
        alert("El usuario no existe");
        window.location = "../inicio.php";
    </script>
    ';
    exit;
}
?>
