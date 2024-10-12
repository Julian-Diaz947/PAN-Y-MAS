<?php
if (!empty($_GET['id'])) {
    $id=$_GET['id'];
    $sql=$conexion->query("DELETE FROM `productos_horneados` WHERE id_horneado=$id");
    if ($sql==1) {
        echo "<div class='alert alert-success' >Fila eliminada correctamente correctamente</div>";
    }else{
        echo "<div class='alert alert-danger' >La fila no ha sido eliminada</div>";
    }
}