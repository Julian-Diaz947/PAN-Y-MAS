<?php
// sessionManager.php

class SessionManager
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isEmployeeLoggedIn()
    {
        return isset($_SESSION['cliente']);
    }

    public function destroySession()
    {
        session_destroy();
    }
}

// authenticationHandler.php

class AuthenticationHandler
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function checkAuthentication()
    {
        if (!$this->sessionManager->isEmployeeLoggedIn()) {
            $this->handleUnauthenticatedAccess();
            return false;
        }
        return true;
    }

    private function handleUnauthenticatedAccess()
    {
        $this->sessionManager->destroySession();
        return $this->getRedirectScript();
    }

    private function getRedirectScript()
    {
        return '
        <script>
            alert("Por favor inicia sesión");
            window.location = "../inicio.php";
        </script>
        ';
    }
}

$sessionManager = new SessionManager();
$authHandler = new AuthenticationHandler($sessionManager);
$authHandler->checkAuthentication();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Perfil</title>
    <link rel="stylesheet" type="text/css" href="../css/perfil.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/catalogo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<header class="head">
        <a class="contenedor-log" href="">
            <figure class="logocorp"></figure>
        </a>
        <button id="abnav" class="ab-nav"><i class="bi bi-list"></i></button>
        <nav class="nav " id="nav">
            <button id="crnav" class="cr-nav"><i class="bi bi-x-circle"></i></button>
            <ul class="ul">
                <li><a href="../catalogo/catalogo.php">INICIO</a></li>
                <li><a class="nosotros" id="snosotros" href="../sobre_nosotros/snosotros.php">SOBRE NOSOTROS</a></li>
            </ul>
        </nav>
        <article class="ar0">
            <button id="abrir" class="ar1">
                <i class="bi bi-person-circle"></i>
            </button>
            <nav class="navse " id="navj">
                <button id="cerrar" class="ar2"><i class="bi bi-x-lg"></i></button>
                <ul class="nav-con">
                    <h3><?php echo htmlspecialchars($_SESSION['cliente']); ?></h3>
                    <lia><a href="">Configuración del perfil</a></li>
                        <li><a href="../config-php/cerrar_sesion.php">Cerrar sesión </a></li>
                </ul>
            </nav>
        </article>
        </article>
    <div class="container">
        <h1>Configuración de Perfil</h1>
        
        <?php if (isset($mensaje)): ?>
            <div class="mensaje"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <img src="<?php echo $usuario['foto_perfil']; ?>" class="foto-perfil" >
        
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"  required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono">
            
            <label for="nueva_contraseña">Nueva Contraseña:</label>
            <input type="password" id="nueva_contraseña" name="nueva_contraseña">
            
            <label for="confirmar_contraseña">Confirmar Nueva Contraseña:</label>
            <input type="password" id="confirmar_contraseña" name="confirmar_contraseña">
            
            <label for="foto_perfil">Cambiar Foto de Perfil:</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
            
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
  <script src="../js-inicio/inicio scrip.js"></script>
  <script src="../catalogo/js catalogo/catalogo scrip.js"></script>