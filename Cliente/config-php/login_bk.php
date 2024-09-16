<?php

// Clase para manejar la autenticación de usuarios
class UserAuthenticator
{
    private $database;

    // Constructor que recibe una instancia de la base de datos
    public function __construct($database)
    {
        $this->database = $database;
    }

    // Método para autenticar un usuario con correo y contraseña
    public function authenticate($email, $password)
    {
        // Se hashea la contraseña utilizando el método hashPassword
        $hashedPassword = $this->hashPassword($password);
        // Se busca el usuario en la base de datos utilizando el método findUser
        $user = $this->findUser($email, $hashedPassword);

        // Si se encuentra el usuario, retorna true; de lo contrario, retorna false
        if ($user) {
            return true;
        }

        return false;
    }

    // Método privado para hashear la contraseña usando SHA-512
    private function hashPassword($password)
    {
        return hash('sha512', $password);
    }

    // Método privado para buscar un usuario en la base de datos con correo y contraseña hasheada
    private function findUser($email, $hashedPassword)
    {
        // Consulta SQL para seleccionar el usuario que coincida con el correo y la contraseña
        $query = "SELECT * FROM cliente WHERE correo = ? AND contrasena = ?";
        $statement = $this->database->prepare($query);
        // Se vinculan los parámetros de correo y contraseña hasheada a la consulta
        $statement->bind_param("ss", $email, $hashedPassword);
        $statement->execute();
        $result = $statement->get_result();
        // Retorna el resultado de la consulta como un array asociativo
        return $result->fetch_assoc();
    }
}

// Clase para manejar la sesión del usuario
class SessionManager
{
    // Método para iniciar una sesión, si no está ya iniciada
    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Método para establecer la sesión del usuario
    public function setUserSession($email)
    {
        $_SESSION['cliente'] = $email;
    }
}

// Clase para manejar las respuestas del servidor al cliente
class ResponseHandler
{
    // Método para redirigir al usuario a una URL específica
    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    // Método para mostrar un mensaje de alerta y redirigir a una URL
    public function showAlert($message, $redirectUrl)
    {
        echo "
        <script>
            alert('$message');
            window.location = '$redirectUrl';
        </script>
        ";
        exit;
    }
}

// Si el script no está siendo ejecutado desde la línea de comandos (CLI)
if (php_sapi_name() !== 'cli') {
    // Verifica si el método de solicitud es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Se incluye el archivo de conexión a la base de datos
        require_once 'conexion-bd.php';

        // Se obtienen los valores de correo y contraseña desde el formulario
        $email = $_POST['correo'];
        $password = $_POST['contrasena'];

        // Se crean instancias de las clases necesarias para la autenticación, sesión y manejo de respuestas
        $authenticator = new UserAuthenticator($conexion);
        $sessionManager = new SessionManager();
        $responseHandler = new ResponseHandler();

        // Se inicia la sesión
        $sessionManager->startSession();

        // Si la autenticación es exitosa, se establece la sesión del usuario y se redirige a la página principal
        if ($authenticator->authenticate($email, $password)) {
            $sessionManager->setUserSession($email);
            $responseHandler->redirect("../catalogo/catalogo.php");
        } else {
            // Si la autenticación falla, se muestra un mensaje de alerta y se redirige a la página de login
            $responseHandler->showAlert(" Usuario incorrecto o Contraseña incorrecta ", "../inicio.php");
        }
    }
}
?>
