<?php 
include 'conexion-bd.php';

$nombres_apellidos=$_POST['nombres_apellidos'];
$ndocumento=$_POST['ndocumento'];
$correo=$_POST['correo'];
$contrasena=$_POST['contrasena'];
 /*para cifrar claves encriptadas*/
$contrasena=hash('sha512',$contrasena);

$query="INSERT INTO empleado(nombres_apellidos,ndocumento,correo, contrasena)
values('$nombres_apellidos','$ndocumento','$correo', '$contrasena')";

$ejecutar=mysqli_query($conexion,$query);

if($ejecutar){
    echo '
    <script>
    alert("usuario registrado correctamente")
    window.location= "../index.php";
    </script>
    ';
}else{
    echo '
    <script>
    alert("usuario no  registrado intente de nuevo")
    window.location= "../login.php";
    </script>
    ';
}
mysqly_close(conexion)
?>