<?php

// Definimos el namespace donde está el controlador.
namespace controladort\config_t;

// Declaramos la clase MateiaPrimaController que manejará la lógica para las materias primas utilazadas .
class MateriaPrima
{
    // Variable privada para almacenar la conexión a la base de datos.
    private $conexion;

    // Constructor de la clase que recibe la conexión a la base de datos y la asigna a la variable $conexion.
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Función pública para insertar un nueva materia prima. Se ejecuta cuando el formulario se envía.
    public function insertarMateriaPrima()
    {
        // Verificamos si el formulario fue validado correctamente.
        if ($this->validarFormulario()) {
            // Sanitizamos las entradas del formulario para prevenir ataques de inyección o XSS.
            $libras = $this->sanitizarEntrada($_POST['libras']);
            $kilos = $this->sanitizarEntrada($_POST['kilos']);
            $suministroId = $this->sanitizarEntrada($_POST['suministro']);

            // Intentamos ejecutar la inserción de la nueva materia prima en la base de datos.
            $resultado = $this->ejecutarInsercion($libras, $kilos, $suministroId);

            // Si la inserción fue exitosa, mostramos un mensaje de éxito.
            if ($resultado) {
                $this->mostrarMensaje('success', 'Materia prima agregada correctamente');
            } else {
                // Si no fue exitosa, mostramos un mensaje de error.
                $this->mostrarMensaje('danger', 'No se pudo agregar');
            }
        } else {
            // Si la validación del formulario falla, mostramos un mensaje de advertencia.
            $this->mostrarMensaje('warning', 'Por favor, complete todos los campos');
        }

        // Evitamos que el formulario sea reenviado al recargar la página.
        $this->evitarReenvioFormulario();
    }

    // Función privada para validar el formulario. Se asegura de que todos los campos necesarios no estén vacíos.
    private function validarFormulario()
    {
        return !empty($_POST['btnagregar']) &&  // Se verifica que se haya enviado el formulario.
               !empty($_POST['libras']) &&      // Verifica que el campo libras no esté vacío.
               !empty($_POST['kilos']) &&    // Verifica que el campo kilos no esté vacío.
               !empty($_POST['suministro']);      // Verifica que se haya seleccionado un suministro.
    }

    // Función privada para sanitizar la entrada del usuario eliminando etiquetas HTML y espacios.
    private function sanitizarEntrada($dato)
    {
        return htmlspecialchars(strip_tags(trim($dato)));
    }

    // Función privada que ejecuta la consulta de inserción de un nuevo producto en la base de datos.
    private function ejecutarInsercion($libras, $kilos, $suministroId)
    {
        // SQL para insertar el las materias primas o salida de suministro.
        $sql = "INSERT INTO suministro_s (kilos,libras, suministro_id) VALUES (?, ?, ?)";
        // Preparamos la sentencia con la conexión a la base de datos.
        $stmt = $this->conexion->prepare($sql);
        // Vinculamos los parámetros a la consulta SQL (libras,kilos, suministrid).
        $stmt->bind_param("ssi", $libras, $kilos, $suministroId);
        // Ejecutamos la consulta y retornamos si fue exitosa o no.
        return $stmt->execute();
    }

    // Función privada para mostrar mensajes al usuario, recibe el tipo (alerta) y el mensaje.
    private function mostrarMensaje($tipo, $mensaje)
    {
        // Genera un mensaje de alerta en HTML, con una clase que define el estilo de la alerta.
        echo "<div class='alert alert-{$tipo}'>{$mensaje}</div>";
    }

    // Función privada para evitar el reenvío del formulario al recargar la página.
    private function evitarReenvioFormulario()
    {
        // JavaScript para actualizar el historial de navegación sin reenviar el formulario.
        echo "<script>history.replaceState(null, null, location.pathname);</script>";
    }
}

// Uso del controlador. Creamos una instancia del controlador pasándole la conexión a la base de datos.
$controlador = new MateriaPrima($conexion);

// Si la solicitud es de tipo POST (es decir, cuando el formulario es enviado), llamamos a la función insertarMateriaPrima.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->insertarMateriaPrima();
}

?>