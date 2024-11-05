<?php
namespace  controladort\editar;
// Incluir el archivo de configuración que contiene la conexión a la base de datos
include "../config-php/conexion-bd.php";

// Definición de la clase esditarPh que se encarga de actualizar los productos horneados
class editarPh {
    // Propiedad privada para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor que inicializa la clase con la conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para actualizar un producto horneado en la base de datos
    public function actualizarProducto($id, $nombre, $cantidad, $empleadoId) {
        // Sanitizar los datos de entrada para evitar inyecciones SQL y otros problemas de seguridad
        $nombre = $this->sanitizarEntrada($nombre);
        $cantidad = $this->sanitizarEntrada($cantidad);
        $empleadoId = $this->sanitizarEntrada($empleadoId);

        // Consulta SQL para actualizar el producto horneado en la base de datos
        $sql = "UPDATE productos_horneados SET nombre=?, cantidad=?, empleado_id=? WHERE id_horneado=?";
        // Preparar la consulta para su ejecución segura
        $stmt = $this->conexion->prepare($sql);
        // Asignar los valores a los parámetros de la consulta
        $stmt->bind_param("ssii", $nombre, $cantidad, $empleadoId, $id);
        
        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Mostrar mensaje de éxito si el producto fue actualizado correctamente
            echo "<div class='alert alert-success'>Producto actualizado correctamente</div>";
            // Redirigir al usuario a la página de Producción después de 2 segundos
            echo "<script>
                    setTimeout(function() {
                        window.location.href = '../Produccion.php';
                    }, 2000);
                  </script>";
        } else {
            // Mostrar mensaje de error si la actualización falla
            echo "<div class='alert alert-danger'>Error al actualizar el producto</div>";
        }
    }

    // Método privado para sanitizar la entrada del usuario, eliminando caracteres peligrosos
    private function sanitizarEntrada($dato) {
        return htmlspecialchars(strip_tags(trim($dato)));
    }
}

// Verificar si se presionó el botón de editar (btneditar)
if (!empty($_POST['btneditar'])) {
    // Verificar que los campos requeridos (nombre, cantidad, empleadoo) no estén vacíos
    if (!empty($_POST["nombre"]) && !empty($_POST["cantidad"]) && !empty($_POST["empleadoo"])) {
        // Crear una instancia de editarPh y llamar al método actualizarProducto
        $actualizador = new editarPh($conexion);
        $actualizador->actualizarProducto(
            $_GET['id'],               // ID del producto a actualizar, obtenido de la URL
            $_POST['nombre'],          // Nombre del producto, obtenido del formulario
            $_POST['cantidad'],        // Cantidad del producto, obtenido del formulario
            $_POST['empleadoo']        // ID del empleado responsable, obtenido del formulario
        );
    } else {
        // Mostrar un mensaje de advertencia si no se completan todos los campos requeridos
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }
}

// Obtener el ID del producto a editar desde la URL (parámetro 'id')
$id = $_GET['id'];
// Ejecutar una consulta SQL para obtener los datos actuales del producto horneado a partir de su ID
$sql = $conexion->query("SELECT * FROM productos_horneados WHERE id_horneado = $id");
// Obtener el resultado de la consulta como un objeto (contiene los datos del producto)
$datos = $sql->fetch_object();
?>

<!-- HTML del formulario para editar el producto horneado -->
<div class="cformulario">
    <div class="formulario">
        <form method="post">
            <!-- Campo oculto que almacena el ID del producto para ser enviado con el formulario -->
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <!-- Campo de texto para el nombre del producto, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <!-- Campo de texto para la cantidad del producto, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="cantidad" value="<?= $datos->cantidad ?>">
            </div>
            <div class="mb-3">
                <label for="empleadoo" class="form-label">ID Empleado</label>
                <!-- Campo de texto para el ID del empleado, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="empleadoo" value="<?= $datos->empleado_id ?>">
            </div>
            <!-- Botón para enviar el formulario y ejecutar la actualización del producto -->
            <button type="submit" class="btn btn-primary" name="btneditar" value="ok">Editar</button>
        </form>
    </div>
</div>




