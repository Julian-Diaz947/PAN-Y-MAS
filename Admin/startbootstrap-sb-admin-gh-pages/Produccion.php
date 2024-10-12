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
        return isset($_SESSION['empleado']);
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Producción</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=<?php echo time(); ?>">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">
            <figure class="logo"></figure>
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <h7><?php echo htmlspecialchars($_SESSION['empleado']); ?></h7>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="configuracion.php">Configuración de la cuenta</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="config-php/cerrar_sesion.php">Cerrar sesión </a></li>
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <!-- <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.php">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
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
                    <h1 class="mt-4">Producción</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Producción</li>
                    </ol>
                    <h3>Productos honeados</h3>
                    <script src="js/eliminar scrip.js"></script>
                    <article class="table">
                        <table class="tabla" id="tabla">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Empleado Acargo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "config-php/conexion-bd.php";
                                include "../startbootstrap-sb-admin-gh-pages/controladort/config-t/eliminarph.php";
                                $sql = $conexion->query("SELECT 
                                 productos_horneados.id_horneado,
                                 productos_horneados.nombre,
                                 productos_horneados.cantidad,
                                 empleado.nombres_apellidos AS empleado_nombres_apellidos
                                FROM productos_horneados 
                                INNER JOIN empleado ON productos_horneados.empleado_id = empleado.id_empleado
                                WHERE 1");
                                while ($resultado = $sql->fetch_object()) {
                                    ?>
                                    <td scope="row"><?= $resultado->id_horneado ?></td>
                                    <td><?= $resultado->nombre ?></td>
                                    <td><?= $resultado->cantidad ?></td>
                                    <td><?= $resultado->empleado_nombres_apellidos ?></td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="controladort/editar_ph.php?id=<?= $resultado->id_horneado ?>">Editar</a>
                                        <a onclick="return eliminar()" class="btn btn-danger"
                                            href="startbootstrap-sb-admin-gh-pages/Produccion.php ?id=<?= $resultado->id_horneado ?>">Eliminar</a>
                                    </td>
                                    </tr>
                                    <?php
                                } ?>
                            </tbody>
                        </table>
                        <br>
                        <div><a class="btn btn-success" href="controladort/agregar_ph.php">Agregar Producto</a></div>
                    </article>

                    <h3>Productos en proceso</h3>
                    <article class="table">
                        <table class="tabla" id="tabla">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Empleado Acargo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    include "config-php/conexion-bd.php";
                                    include "controladort/config-t/eliminarprcso.php";
                                    $sql = $conexion->query("SELECT 
                                producto_prcso.id_prcso,
                                producto_prcso.nombre,
                                producto_prcso.cantidad,
                                empleado.nombres_apellidos AS empleado_nombres_apellidos
                                FROM producto_prcso 
                                INNER JOIN empleado ON producto_prcso.empleado_id = empleado.id_empleado
                               
                                WHERE 1");

                                    while ($datos = $sql->fetch_object()) {
                                        ?>
                                        <td scope="row"><?= $datos->id_prcso ?></td>
                                        <td><?= $datos->nombre ?></td>
                                        <td><?= $datos->cantidad ?></td>
                                        <td><?= $datos->empleado_nombres_apellidos ?></td>
                                        
                                        <td>
                                            <a class="btn btn-warning"
                                                href="controladort/editar_prcso.php?id=<?= $datos->id_prcso ?>">Editar</a>
                                            <a onclick="return eliminar()" class="btn btn-danger"
                                                href="../startbootstrap-sb-admin-gh-pages/Produccion.php"?id=<?= $datos->id_prcso ?>">Eliminar</a>
                                        </td>
                                    </tr>
                                    <?php
                                    } ?>
                            </tbody>
                            </tbody>
                        </table>
                        <br>
                        <div><a class="btn btn-success" href="controladort/agregar_ppso.php">Agregar Producto</a></div>
                    </article>
                    <h3>Materias primas utilizadas el día de hoy</h3>
                    <article class="table">
                        <table class="tabla" id="tabla">
                            <thead>
                            <tr>
                                <th>ID Salida de Suministro</th>
                                <th>Libras</th>
                                <th>kilos</th>
                                <th>Suministro</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                           <tbody>
                           <tr>
                           <?php
                                include "config-php/conexion-bd.php";
                                include "controladort/config-t/eliminarph.php";
                                $conexion->set_charset("utf8mb4");
                                $sql = $conexion->query("SELECT 
                                 suministro_s.id_s,
                                 suministro_s.kilos,
                                 suministro_s.libras,
                                 suministro.nmbre_suministro AS suministro_nmbre_suministro
                                FROM suministro_s 
                                INNER JOIN suministro ON suministro_s.suministro_id = suministro.id_suministro
                                WHERE 1");   
                                    while ($igual = $sql->fetch_object()) {
                                        ?>
                                        <td scope="row"><?= $igual->id_s?></td>
                                        <td><?= $igual->libras ?></td>
                                        <td><?= $igual->kilos?></td>
                                        <td><?= $igual->suministro_nmbre_suministro ?></td>
                                <td>
                                    <a class="btn btn-warning" href="">Editar</a>
                                    <a class="btn btn-danger" href="">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                            }?>
                           </tbody>
                           
                            
                        </table>
                        <br>
                        <div><a class="btn btn-success" href="controladort/agregar_mp.php">Agregar Pruducto</a></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>