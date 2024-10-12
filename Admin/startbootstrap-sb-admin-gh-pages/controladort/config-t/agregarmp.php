<?php
if (!empty($_POST['btnagregar'])) {
    if (!empty($_POST["libras"]) and !empty($_POST["kilos"]) and !empty($_POST["suministro"]) ) {
        $libras= $_POST['kilos'];
        $kilos = $_POST['libras'];
        $suministro=$_POST['suministro'];
        $sql=$conexion->query("INSERT INTO `suministro_s(`kilos`,`libras`,`suministro_id` )
        values ('$kilos','$libras','$suministro')");
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
