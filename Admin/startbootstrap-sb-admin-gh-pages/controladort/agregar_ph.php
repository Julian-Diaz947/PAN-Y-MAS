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
  <link rel="stylesheet" type="text/css" href="../css/styles.css?v=<?php echo time(); ?>">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <title>Productos Horneados</title>
</head>

<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">
      <figure class="logo"></figure>
    </a>
    <!-- Sidebar Toggle-->
    
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form >
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
  <h1 class="mt-4 text-center">Agregar Productos Horneados</h1>
  <ol class="breadcrumb mb-4 m-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="../Produccion.php">Producción</a></li>
    <li class="breadcrumb-item active">Agregar</li>
  </ol>
  <!--formulario-->
 <div class="cformulario">
 <div class="formulario">
  <form method="post" >
    <?php 
    include "../config-php/conexion-bd.php";
    include "./config_t/agregarph.php";
    ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Cantidad</label>
    <input type="text" class="form-control" name="cantidad">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">id empleado</label>
    <input type="text" class="form-control" name="empleado">
  </div>
  <button type="submit" class="btn btn-primary" name="btnagregar" value="ok" >Agregar</button>
</form>
  </div>
 </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
  crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

</html>