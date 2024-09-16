<?php
// sessionManager.php

class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isEmployeeLoggedIn() {
        return isset($_SESSION['cliente']);
    }

    public function destroySession() {
        session_destroy();
    }
}

// authenticationHandler.php

class AuthenticationHandler {
    private $sessionManager;

    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
    }

    public function checkAuthentication() {
        if (!$this->sessionManager->isEmployeeLoggedIn()) {
            $this->handleUnauthenticatedAccess();
            return false;
        }
        return true;
    }

    private function handleUnauthenticatedAccess() {
        $this->sessionManager->destroySession();
        return $this->getRedirectScript();
    }

    private function getRedirectScript() {
        return '
        <script>
            alert("Por favor inicia sesión");
            window.location = "login.php";
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
    <link rel="stylesheet" type="text/css" href="http://localhost/PAN-Y-MAS/Cliente/css/catalogo.css">
    <link rel="stylesheet" type="text/css" href="../css/carro.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Carrito</title>
</head>
<body>
    <header class="head">
        <a class="contenedor-log" href=""> <figure class="logocorp"></figure></a>
        <button id="abnav" class="ab-nav"><i class="bi bi-list"></i></button>
         <nav class="nav "  id="nav">
             <button id="crnav" class="cr-nav"><i class="bi bi-x-circle"></i></button>
             <ul class="ul">
                 <li><a href="../catalogo/catalogo.php">INICIO</a></li>
                 <li><a class="nosotros" id="snosotros" href="../pedido/pedido.php">PEDIDOS ONLINE</a></li>
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
      </header>
      <section class="s-principal">
        <article class="ar-cont1">
            <article class="sub-ar">
                <h2>MI CARRITO</h2>
            </article>    
            <hr>
            <button class="ic-cerrar"><i class="bi bi-x-lg"></i></button>
            <article class="cont-1">
               <div class="p-imgs"><div class="imgs"></div></div> 
            <article class="des">
                <p>Croasant de queso con bocadillo (dulce de guayaba)</p>
                <br>
                <p>1.000 <b>COP</b></p>
            </article>
            <article class="preci">
                <label class="n-cantidad" for="cantidad">
                    <input type="number" value="2" name="2" id="">
                </label>
                <p class="vr-pagar">2.000 <b>COP</b></p>
            </article>
            </article>
            <hr>
        </article>
        <article class="ar-cont2">
            <article class="sub-ar">
                <h2>RESUMEN DEL PEDIDO</h2>
            </article>    
            <hr>
            <article class="texto">
                <p>Envio: 600 <b>COP</b></p>
                <p>Total de la compra más envío </p>
                <p>2.600 <b>COP</b></p>
                <label class="compra" for="comprar">
                   <a href="../compra-exitosa/pagoex.php"> <input type="submit" value="Comprar"></a>
                </label>
            </article>
            <hr>
        </article>
        <script src="../js-inicio/inicio scrip.js"></script>
        <script src="../catalogo/js catalogo/catalogo scrip.js"></script>
      </section>
</body>
</html>