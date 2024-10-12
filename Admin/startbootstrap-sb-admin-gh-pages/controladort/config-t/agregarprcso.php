<?php
if (!empty($_POST['btnagregar'])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["cantidad"]) and !empty($_POST["empleado"]) ) {
        $nombre= $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $empleado = $_POST['empleado'];
        $sql=$conexion->query("INSERT INTO `producto_prcso`(`nombre`,`cantidad`,`empleado_id` )
        values ('$nombre','$cantidad','$empleado')");
        if ($sql==1) {
            echo "<div class='alert alert-success'>producto agregado correctamente</div>";
        }else{
            echo "<div class='alert alert-danger'> El producto no se agrego</div>";
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