<?php 
  // Inicia la sesión
  session_start();
  
  // Destruye la sesión actual
  session_destroy();
  
  // Redirige al usuario a la página de inicio de sesión
  // Utiliza 'exit;' después de header para asegurar que el script se detenga
  header("location:../inicio.php");
  exit();
?>
