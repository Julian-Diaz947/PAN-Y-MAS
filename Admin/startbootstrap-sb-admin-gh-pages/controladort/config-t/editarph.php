<?php
if (!empty($_POST['btneditar'])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["cantidad"]) and !empty($_POST["empleado"]) ) {
        $nombre= $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $empleado = $_POST['empleado'];
        $sql=$conexion->query("UPDATE `productos_horneados` SET `nombre`='$nombre',`cantidad`= '$cantidad',`empleado_id`='$empleado'
        WHERE `id_horneado`=$id" );
        if ($sql==1) {
            header("Location:../Produccion.php ");
        }else{
            echo "<div class='alert alert-danger'> El producto no se modifico</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Hay espacios vacios </div>";
    }?>
    <script>
        history.replaceState(null,null,location.pathname)
    </script>
<?php
}
?>