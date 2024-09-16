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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../css/catalogo.css?v=<?php echo time(); ?>">
    <title>PAN Y MAS</title>
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
    <section class="p1">
        <div class="cont-catalogo">
            <article class="produc" id="productos">
                <div class="img1"></div>
                <h2 class="subtitulo">PAN GRANDE</h2>
                <a class="a" href="../productos/pan_grande.php"><input type="button" value="VER MÁS" required></a>
            </article>
            <article class="produc" id="productos">
                <div class="img2"></div>
                <h2 class="subtitulo">CROASANT</h2>
                <a class="a" href="../productos/crosan.php"><input type="button" value="VER MÁS" required></a>
            </article>
            <article class="produc" id="productos">
                <div class="img3"></div>
                <h2 class="subtitulo">PASTELES</h2>
                <a class="a" href="../productos/pasteles.php"><input type="button" value="VER MÁS" required></a>
            </article>
            <article class="produc" id="productos">
                <div class="img4"></div>
                <h2 class="subtitulo">TAMALES</h2>
                <a class="a" href="../productos/tamales.php"><input type="button" value="VER MÁS" required></a>
            </article>
            <article class="produc" id="productos">
                <div class="img5"></div>
                <h2 class="subtitulo">LECHE ASADA</h2>
                <a class="a" href="../productos/leche_asada.php"><input type="button" value="VER MÁS" required></a>
            </article>
            <article class="produc" id="productos">
                <div class="img6"></div>
                <h2 class="subtitulo">GALLETAS</h2>
                <a class="a" href="../productos/galletas.php"><input type="button" value="VER MÁS" required></a>
            </article>
        </div>
        <div class="carro">
            <button id="abcarrito" class="ic-carrito"><i class="bi bi-cart3"></i></i></button>
            <article class="catalogo">

                <article class="contenido" id="contenido">
                    <article class="tit-icon">
                        <button id="crcarrito" class="icon-x"><i class="bi bi-chevron-left"></i></button>
                        <h1 class="titulo-car">Carrito</h1>
                    </article>
                    <hr>
                    <article class="cont">
                        <div class="imgcar"></div>
                        <article class="descrp">
                            <h4 class="desh4">Croasant de queso con bocadillo (dulce de guayaba)</h4>
                            <p class="precio-sub"><b>COP:</b>1.000</p>
                            <label for="aumentar">
                                <input type="number" value="1" name="aumentar" id="">
                            </label>
                        </article>
                        <article>
                        </article>
                    </article>
                    <hr>
                    <article class="sub-t">
                        <h2 class="sh2">Subtotal</h2>
                        <p class="precio">2.000 <b>COP</b></p>
                        <a class="interfz-carro" href="../carrito/carro.php"><button class="boton-carro">Ver
                                carrito</button></a>
                    </article>
                    <article>
                    </article>
        </div>
        <script src="../js-inicio/inicio scrip.js"></script>
        <script src="../catalogo/js catalogo/catalogo scrip.js"></script>
    </section>
</body>

</html>