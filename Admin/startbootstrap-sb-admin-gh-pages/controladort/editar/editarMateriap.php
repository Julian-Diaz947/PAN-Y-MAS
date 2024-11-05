<?php
namespace  controladort\editar;
// Incluir el archivo de configuración que contiene la conexión a la base de datos
include "../config-php/conexion-bd.php";

// Definición de la clase editarMateriaPrima que se encarga de actualizar las materias primas utilzadas
class editarMateriaPrima {
    // Propiedad privada para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor que inicializa la clase con la conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para actualizar las materias primas en la base de datos
    public function actualizarMateriaPrima($id, $libras, $kilos, $suministroId) {
        // Sanitizar los datos de entrada para evitar inyecciones SQL y otros problemas de seguridad
        $libras = $this->sanitizarEntrada($libras);
        $kilos = $this->sanitizarEntrada($kilos);
        $suministroId = $this->sanitizarEntrada($suministroId);

        // Consulta SQL para actualizar el sumimistro_s(sumistro salida) en la base de datos
        $sql = "UPDATE suministro_s SET libras=?, kilos=?, suministro_id=? WHERE id_s=?";
        // Preparar la consulta para su ejecución segura
        $stmt = $this->conexion->prepare($sql);
        // Asignar los valores a los parámetros de la consulta
        $stmt->bind_param("ssii", $libras, $kilos, $suministroId, $id);
        
        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Mostrar mensaje de éxito si el sumintro fue actualizado correctamente
            echo "<div class='alert alert-success'>Suministro actualizado correctamente</div>";
            // Redirigir al usuario a la página de Producción después de 2 segundos
            echo "<script>
                    setTimeout(function() {
                        window.location.href = '../Produccion.php';
                    }, 2000);
                  </script>";
        } else {
            // Mostrar mensaje de error si la actualización falla
            echo "<div class='alert alert-danger'>Error al actualizar el sumistro</div>";
        }
    }

    // Método privado para sanitizar la entrada del usuario, eliminando caracteres peligrosos
    private function sanitizarEntrada($dato) {
        return htmlspecialchars(strip_tags(trim($dato)));
    }
}

// Verificar si se presionó el botón de editar (btneditar)
if (!empty($_POST['btneditar'])) {
    // Verificar que los campos requeridos (libras, kilos, suministro) no estén vacíos
    if (!empty($_POST["libras"]) && !empty($_POST["kilos"]) && !empty($_POST["suministro"])) {
        // Crear una instancia de editarMateriaPrima y llamar al método actualizarMateriaPrima
        $actualizador = new editarMateriaPrima($conexion);
        $actualizador->actualizarMateriaPrima(
            $_GET['id'],               // ID del producto a actualizar, obtenido de la URL
            $_POST['libras'],          // Cantidad de libras de la materia prima, obtenido del formulario
            $_POST['kilos'],        // Cantidad de kilos de la materia prima, obtenido del formulario
            $_POST['suministro']        // ID del suministro, obtenido del formulario
        );
    } else {
        // Mostrar un mensaje de advertencia si no se completan todos los campos requeridos
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }
}

// Obtener el ID del producto a editar desde la URL (parámetro 'id')
$id = $_GET['id'];
// Ejecutar una consulta SQL para obtener los datos actuales del suministro_s a partir de su ID
$sql = $conexion->query("SELECT * FROM suministro_s WHERE id_s = $id");
// Obtener el resultado de la consulta como un objeto (contiene los datos del producto)
$datos = $sql->fetch_object();
?>

<!-- HTML del formulario para editar las materias primas usadas en el día -->
<div class="cformulario">
    <div class="formulario">
        <form method="post">
            <!-- Campo oculto que almacena el ID del suministro para ser enviado con el formulario -->
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Libras</label>
                <!-- Campo de texto para la cantidad del materia prima, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="libras" value="<?= $datos->libras ?>">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Kilos</label>
                <!-- Campo de texto para la cantidad de la materia prima, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="kilos" value="<?= $datos->kilos ?>">
            </div>
            <div class="mb-3">
                <label for="empleadoo" class="form-label">Suministro</label>
                <!-- Campo de texto para el ID del suministro, con el valor actual obtenido de la base de datos -->
                <input type="text" class="form-control" name="suministro" value="<?= $datos->suministro_id ?>">
            </div>
            <!-- Botón para enviar el formulario y ejecutar la actualización del producto -->
            <button type="submit" class="btn btn-primary" name="btneditar" value="ok">Editar</button>
        </form>
    </div>
</div>
