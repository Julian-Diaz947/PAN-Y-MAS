<?php
// sessionManager.php

class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isEmployeeLoggedIn() {
        return isset($_SESSION['empleado']);
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

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Personal</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/styles.css?v=<?php echo time(); ?>">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><figure class="logo"></figure></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <h7><?php echo htmlspecialchars($_SESSION['empleado']); ?></h7>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="configuracion.php">Configuración de la cuenta</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Cerrar sesión </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="Produccion.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Producción
                            </a>
                            <a class="nav-link" href="Pedidos.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Pedidos
                            </a>
                            <a class="nav-link" href="Personal.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Personal
                            </a>
                            <a class="nav-link" href="suministros.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Suministros
                            </a>
                            <a class="nav-link" href="Ventas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Ventas
                            </a>
                            <a class="nav-link" href="usuarios.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Usuarios
                        </a>
                           <!-- <div class="sb-sidenav-menu-heading">Interface</div>-->
                            <!--<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                               <!-- <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>-->
                                            <a class="nav-link" href="password.php">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>-->
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Personal</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Personal</li>
                        </ol>
                        <h3>Lista de empleados</h3>
                           <article class="table">
                            <table class="tabla" id="tabla">
                               <tr>
                                <th>ID empleado</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Salario</th>
                                <th>Acciones</th>
                               </tr>

                               <tr>
                                <td>2</td>
                                <td>JUAN PÉREZ</td>
                                <td>Panadero</td>
                                <td>322222222</td>
                                <td>juan@hotmail.com</td>
                                <td>1´800.00</td>
                                <td>
                                        <a class="btn btn-warning" href="">Editar</a>
                                        <a class="btn btn-danger" href="">Eliminar</a>
                                    </td>
                               </tr>

                               <tr>
                                <td>3</td>
                                <td>CARLOS RAMÍRES</td>
                                <td>Jefe de producción</td>
                                <td>3035555555</td>
                                <td>carlos@hotmail.com</td>
                                <td>2´000,000</td>
                                <td>
                                        <a class="btn btn-warning" href="">Editar</a>
                                        <a class="btn btn-danger" href="">Eliminar</a>
                                    </td>
                               </tr>

                               <tr>
                                <td>1</td>
                                <td>CAMILO SÁNCHEZ</td>
                                <td>Vendedor</td>
                                <td>3134444444</td>
                                <td>sancheszc@otmail.com</td>
                                <td>1´500,000</td>
                                <td>
                                        <a class="btn btn-warning" href="">Editar</a>
                                        <a class="btn btn-danger" href="">Eliminar</a>
                                    </td>
                               </tr>

                               <tr>
                                <td>4</td>
                                <td>SOFÍA CAMACHO</td>
                                <td>Almacenista</td>
                                <td>3176666666</td>
                                <td>sofia12@hotmail.com</td>
                                <td>1´7000.000</td>
                                <td>
                                        <a class="btn btn-warning" href="">Editar</a>
                                        <a class="btn btn-danger" href="">Eliminar</a>
                                    </td>
                               </tr>

                               <tr>
                                <td>5</td>
                                <td>LEIDY PAREDES</td>
                                <td>Contadora</td>
                                <td>3189993333</td>
                                <td>leidy145@hotmail.com</td>
                                <td>2´500.000</td>
                                <td>
                                        <a class="btn btn-warning" href="">Editar</a>
                                        <a class="btn btn-danger" href="">Eliminar</a>
                                    </td>
                               </tr>
                            </table>
                            <br>
                            <div ><a class="btn btn-success" href ="">Agregar</a></div>
                           </article>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
