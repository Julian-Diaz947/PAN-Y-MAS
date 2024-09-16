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
    <link rel="stylesheet" type="text/css" href="../css/catalogo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/pedido.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Detalles del Pedido</title>

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
                    <lia><a href="../perfil/perfil.php">Configuración del perfil</a></li>
                        <li><a href="../config-php/cerrar_sesion.php">Cerrar sesión </a></li>
                </ul>
            </nav>
        </article>
        </article>
        <br>
        <article class="container">
            <h1>Detalles del Pedido</h1>
            <img src="../productos/imgs/croasant.jpg" alt="Imagen del producto" class="producto-img">
            <div class="detalles">
                <p><strong>ID del Producto:</strong>4</p>
                <p><strong>ID del Pedido:</strong>1005</p>
                <p><strong>Cantidad:</strong>2</p>
                <p><strong>Precio Total:</strong>2.600</p>
                <p><strong>Fecha y Hora del Pedido:</strong>16/09/24 13:00 pm</p>
                <p><strong>Dirección de Entrega:</strong>Calle 3#15 El Rosal </p>
                <p><strong>Tiempo Estimado de Entrega:</strong> 30 Min</p>
                <p><strong>Estado:</strong>Activo</p>
            </div>
        </article>
</body>

</html>
<script src="../catalogo/js catalogo/catalogo scrip.js"></script>
<script src="../js-inicio/inicio scrip.js"></script>