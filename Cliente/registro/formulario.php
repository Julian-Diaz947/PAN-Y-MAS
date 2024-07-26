<?php 
// Iniciar la sesión
session_start();

// Verificar si existe una sesión activa para el cliente
if(isset($_SESSION['cliente'])){
    // Redirigir al usuario al catálogo si está autenticado
    header('Location: ../catalogo/catalogo.php');
    // Salir del script para asegurar que no se ejecuta más código después de la redirección
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/formulario.css?v=<?php echo time(); ?>">
    <title>PAN Y MÁS</title>
</head>
<body>
    <header class="head">
        <figure class="logocorp"></figure>
        <nav class="navegacion">
            <ul class="ul">
                <li><a class="inicio" href="../inicio.php">INICIO</a></li>
                <li><a class="pedidos" onclick="pedidos()" id="pedido1">PEDIDOS ONLINE</a></A></li>
                <li><a class="nosotros" id="snosotros" href="../sobre_nosotros/snosotros.php">SOBRE NOSOTROS</a></li>
            </ul>
        </nav>
     </header>
     <section class="sec1">
        <article class="formulario" id="formulario">
            <form action="../config-php/registro-bd-bk.php" method="POST">
                 <input type="text" name="nombres" placeholder="NOMBRES" required>
                 <input type="text"name="apellidos" placeholder="APELLIDOS" required>
                <select class="tidoc" name="tipo-de-documento" id="" >
                    <option value="">Seleccione su documento</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Targeta de Identidad</option>
                    <option value="CE">Cédula de Extrangería</option>
                </select>
                    <input type="text" name="n_documento" placeholder="NUMERO DE DOCUMENTO" id="">
                    <input type="number"id="" name="celular" placeholder="NUMERO DE CELULAR" required>
                    <input type="text"id="direccion" name="direccion" placeholder="DIRECCION" required>
                    <input type=""id=""name="municipio" placeholder="MUNICIPIO" required >
                    <input type="email"id="" name="correo" placeholder="CORREO ELECTRONICO" required>
                    <input type="password"id="" name="contrasena" placeholder="CONTRASEÑA" required>
                    <!--falta codigo parar verificar que juntas contraseñas sean iguales-->
                    <input type="password" id="" name="contrasena" placeholder=" CONFIRMAR CONTRASEÑA" required>
                   <div class="condiciones">
                    <p class="p">Autoriza el tratamiento de sus datos </p> 
                    <input type="checkbox" id="autorizacion" required>
                   </div>
                    <input type="submit" onclick="registrarcliente()" value="Finalizar" id="">
            </form>
            <div id="mensaje"></div>

        </article>
     </section>
     <script src="../js-inicio/inicio scrip.js"></script>
     <script src="../registro/js-registro/registro scrip.js"></script>
</body>
</html>