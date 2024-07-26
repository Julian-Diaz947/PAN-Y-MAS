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
        <title>Eleminar cuenta</title>
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
              <!--  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuaración de la cuenta</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Cerrar sesion</a></li>
                    </ul>
                </li>-->
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="208px" fill="#F9DB78"><path d="M480-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM160-160v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q62 0 123 15.5t127.92 44.69q31.3 14.13 50.19 40.97Q800-292 800-254v94H160Zm60-60h520v-34q0-16-9.5-30.5T707-306q-64-31-117-42.5T480-360q-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T570-631q0-39-25.5-64.5T480-721q-39 0-64.5 25.5T390-631q0 39 25.5 64.5T480-541Zm0-90Zm0 411Z"/></svg>
                            <p class="pnav">xxxxxxxxxxxxxx</p>
                            <h7><?php echo htmlspecialchars($_SESSION['empleado']); ?></h7>
                            <h6>Configuración de la cuenta</h6>
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
                      <div class="fondo">
                        <div class="mensajecon">
                            <div class="mensaje">
                                <div class="cancel">
                                    <a href="configuracion.php"><svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#000000"><path d="m300-258-42-42 180-180-180-179 42-42 180 180 179-180 42 42-180 179 180 180-42 42-179-180-180 180Z"/></svg></a>
                                </div>
                                <h5 class="subh5">Elimina tu cuenta de PAN Y MÁS</h5>
                                <hr>
                                <p class="accion">Esta acción no se puede deshacer.</p>
                                <hr>
                                <div class="btn22">
                                    <label for="cancelar"><a href="configuracion.php">
                                        <input type="button" value="Cancelar">
                                    </a>
                                    </label>
                                    <label for="eleminar"><a href="">
                                        <input type="button" value="Eliminar mi cuenta" >
                                    </a></label>
                                </div>
                            </div>
                        </div>
                        <div class="contenedordv">
                            <div class="subcon1">
                                <div class="d1">
                                    <div class="d01">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="112px" viewBox="0 -960 960 960" width="308px" fill="#000000"><path d="M480-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM160-160v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q62 0 123 15.5t127.92 44.69q31.3 14.13 50.19 40.97Q800-292 800-254v94H160Zm60-60h520v-34q0-16-9.5-30.5T707-306q-64-31-117-42.5T480-360q-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T570-631q0-39-25.5-64.5T480-721q-39 0-64.5 25.5T390-631q0 39 25.5 64.5T480-541Zm0-90Zm0 411Z"/></svg>
                                    </div>
                                    <div class="d02">
                                        <label for="foto">
                                           <input type="file" name="Cambiar foto de perfil" id="foto">
                                        </label>
                                    </div>
                                </div>
                            <div class="d2">
                                <label for="guardar cambios">
                                    <input type="submit" value="Guardar cambios">
                                </label>
                            </div>
                            </div>
                            <hr>
                            <h3>Configuración del perfil</h3>
                            <div class="contenedordv1">
                                    <label for="nombres"> Nombres
                                        <input type="text" name="Nombres" id="Nombres">
                                    </label>
                                    <label for="apellidos">Apellidos
                                        <input type="text" name="Apellidos" id="Apellidos">
                                    </label>
                            </div>
                            <hr>
                            <h3>Configuración de la cuenta</h3>
                            <div class="contenedordv2">
                               <div class="dv-input">
                                <label for="texto">Nombre de usuario
                                    <input type="text" name="Nombres" id="Nombres">
                                </label>
                                <label for="correo"> Correo 
                                    <input type="email" name="" id="Correo">
                                </label>
                               <label for="actcontraseña"> Contraseña 
                                   <input type="password" name="actcontraseña" id="actcontraseña">
                               </label>
                               </div>
                               <div class="texto">
                                <p>Necesario para realizar cambios</p>
                               </div>
                            </div>
                           <hr>
                           <h3>Cambiar contraseña</h3>
                           <div class="contenedordv2">
                            <div class="dv-input">
                                <label for="ncontraseña">Nueva contraseña
                                    <input type="password" name="ncontraseña" id="ncontraseña">
                                </label>
                                <label for="rcontraseña">Repetir contraseña
                                    <input type="password" name="rcontraseña" id="rcontraseña">
                                </label>
                                <label for="actcontraseña">Contraseña actual
                                    <input type="password" name="actcontraseña" id="actcontraseña">                                        
                                </label>
                                <a class="recuperar" href="/Cliente/recuperar  contraseña/recuperar.html">¿Olvido su contraseña?</a>
                                </div>
                                <div class="texto">
                                    <p>Necesario para realizar cambios</p>
                            </div>
                           </div>
                           <hr>
                           <h3>Eliminar mi cuenta</h3>
                           <div class="eliminacion">
                            <div class="eliminacion1">
                                <p>Si borras tu cuenta tus datos se perderán para siempre</p>
                            </div>
                            <div class="eliminacion2">
                                <a href="">Eliminar cuenta</a>
                            </div>
                           </div>
                      </div>

                        </div>
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
