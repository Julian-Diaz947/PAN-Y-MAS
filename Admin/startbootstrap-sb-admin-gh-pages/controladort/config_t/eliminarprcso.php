<?php
// Definición de la clase EliminarProductoProceso para manejar la eliminación de productos procesados
class EliminarProductoProceso {
     // Propiedades privadas para la conexión a la base de datos, el ID del producto, y el mensaje de respuesta
    private $conexion;
    private $id;
    private $mensaje;
    
// Constructor de la clase que inicializa la conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para establecer el ID del producto a eliminar y validarlo como un número entero
    public function setId($id) {
        $this->id = filter_var($id, FILTER_VALIDATE_INT);
        return $this;// Retorna el propio objeto para permitir el encadenamiento de métodos
    }

    // Método para eliminar el producto de la base de datos
    public function eliminar() {
        try {
            // Verificar si el ID es válido antes de proceder
            if (!$this->id) {
                throw new Exception("ID no válido o no proporcionado");// Lanzar una excepción si el ID es inválido
            }

            // Preparar la consulta SQL para eliminar el producto en proceso de la base de datos usando el ID
            $query = "DELETE FROM producto_prcso WHERE id_prcso = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("i", $this->id);// Enlazar el ID como parámetro de tipo entero
            
             // Ejecutar la consulta y verificar si fue exitosa
            if ($stmt->execute()) {
                // Verificar si se eliminó alguna fila de la base de datos
                if ($stmt->affected_rows > 0) {
                    // Si el producto fue eliminado, crear un mensaje de éxito
                    $this->mensaje = $this->crearMensaje("Producto eliminado correctamente", "success");
                    return true; // Retornar verdadero indicando que la eliminación fue exitosa
                } else {
                    // Si no se eliminó ninguna fila, crear un mensaje de advertencia
                    $this->mensaje = $this->crearMensaje("No se encontró el producto a eliminar", "warning");
                    return false;// Retornar falso indicando que el producto no fue encontrado
                }
            } else {
                // Lanzar una excepción si hubo un error al ejecutar la consulta
                throw new Exception("Error al ejecutar la consulta");
            }
        } catch (Exception $e) {
            // Capturar cualquier excepción y crear un mensaje de error
            $this->mensaje = $this->crearMensaje("Error: " . $e->getMessage(), "danger");
            return false; // Retornar falso indicando que hubo un error
        }
    }
    // Método privado para crear un mensaje formateado en HTML con un tipo específico de alerta
    private function crearMensaje($texto, $tipo) {
        return "<div class='alert alert-{$tipo}'>{$texto}</div>";
    }

    // Método para obtener el mensaje creado después de intentar eliminar el producto
    public function getMensaje() {
        return $this->mensaje;
    }
}

// uso de la clase para eliminar un producto
try {
    // Verificar si el ID del producto a eliminar ha sido proporcionado en la URL (parámetro 'id')
    if (!empty($_GET['id'])) {
    // Crear una instancia de EliminarProductoProceso y ejecutar el proceso de eliminación
        $producto = new EliminarProductoProceso($conexion);
        $producto->setId($_GET['id'])->eliminar();
       // Mostrar el mensaje resultante de la operación (éxito, advertencia o error)
        echo $producto->getMensaje();
    }
} catch (Exception $e) {
    // Mostrar un mensaje de error en caso de cualquier excepción en la aplicación
    echo "<div class='alert alert-danger'>Error en la aplicación: " . $e->getMessage() . "</div>";
}