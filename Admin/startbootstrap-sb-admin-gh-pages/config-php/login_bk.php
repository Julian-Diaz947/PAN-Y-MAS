<?php
 session_start();
  include'conexion-bd.php';
  $correo=$_POST['correo'];
  $contrasena=$_POST['contrasena'];
  /*para cifrar claves encriptadas*/
  $contrasena=hash('sha512',$contrasena);
  $validar_login= mysqli_query($conexion, "SELECT * FROM empleado
  WHERE correo='$correo' and contrasena='$contrasena' ");
  
  if(mysqli_num_rows($validar_login)>0){
    $_SESSION['empleado']=$correo;
    header("location:../index.php");
    exit;
  }else{
    echo'
    <script>
    alert("el usuario no existe");
    window.location="../login.php";
    </script>
    ';
    exit;
  }
?>