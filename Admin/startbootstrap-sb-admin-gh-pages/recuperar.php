<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/recuperar.css?v=<?php echo time(); ?>">
    <title>¿OLVIDO SU CONTRASEÑA?</title>
</head>
<body>
    <header>
        <figure class="logo"></figure>
    </header>
    <section>
        <article class="ar1">
            <article class="ar2">
                <h2>Recupera tu contraseña</h2>
            </article>
            <hr >
            <p>introduce tu correo electrónico para recuperar tu contraseña</p>
            <label for="correo">
                <input type="email" name="" id="correo">
            </label>
            <hr>
           <article class="botones">
            <a href="login.php"><label class="l1" for="cancelar">
                <input type="button" value="Cancelar" id="cancelar">
            </label></a>
            <label class="l2" for="enviar">
                <input type="submit" value="Enviar" id="enviar">
            </label>
           </article>
        </article>
    </section>
</body>
</html>