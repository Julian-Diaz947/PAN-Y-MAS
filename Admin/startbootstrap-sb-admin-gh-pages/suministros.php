<?php 
  session_start();
  if(!isset($_SESSION['empleado'])){
    echo'
       <script>
          alert("Por favor inicia sesion");
          window.location="login.php"
       </script>
    ';
    session_destroy();
    die();
  }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Suministros</title>
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
                        <h1 class="mt-4">Suministros</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Suministros</li>
                        </ol>
                        <h3>Entrada de suministros</h3>
                        <article class="table">
                            <table class="tabla" id="tabla">
                                <tr>
                                    <th>ID proveedor</th>
                                    <th>Nombre del proveedor</th>
                                    <th>Producto</th>
                                    <th>ID suministro</th>
                                    <th>Cantidad en KG</th>
                                    <th>Fecha </th>
                                    <th>Precio</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>HARINAS UNO S.A</td>
                                    <td>Harina de trigo</td>
                                    <td>100</td>
                                    <td>150</td>
                                    <td>13/04/2024</td>
                                    <td>523.500</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>MATEQUILLAS S.A</td>
                                    <td>Mantequilla industrial</td>
                                    <td>101</td>
                                    <td>80 KG</td>
                                    <td>15/04/2024</td>
                                    <td>10´562.500</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>CAÑAS S.A</td>
                                    <td>Azúcar morena</td>
                                    <td>102</td>
                                    <td>150 KG</td>
                                    <td>16/04/2024</td>
                                    <td>733.800</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>CAFÉ SUP S.A</td>
                                    <td>Café en grano</td>
                                    <td>103</td>
                                    <td>200 KG</td>
                                    <td>17/04/2024</td>
                                    <td>7´272.000</td>
                                </tr>
                            </table>
                        </article>
                        <h3>Salida de suministros</h3>
                        <article class="table">
                            <table class="tabla" id="tabla">
                                <tr>
                                    <th>ID suministro</th>
                                    <th>Producto</th>
                                    <th>Cantidad en KG entregada</th>
                                    <th>Cantidad en LBS entregadas</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Harina de trigo</td>
                                    <td>50</td>
                                    <td>11.023</td>
                                </tr>
                                
                                <tr>
                                    <td>2</td>
                                    <td>Mantequilla</td>
                                    <td>7.5</td>
                                    <td>16..534</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Azúcar</td>
                                    <td>20</td>
                                    <td>44.092</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Café</td>
                                    <td>3</td>
                                    <td>6.613</td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>Dulce de guayaba</td>
                                    <td>4</td>
                                    <td>8.818</td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>Queso</td>
                                    <td>10</td>
                                    <td>22.046</td>
                                </tr>

                                <tr>
                                    <td>7</td>
                                    <td>Sal</td>
                                    <td>10</td>
                                    <td>22.046</td>
                                </tr>
                            </table>
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
