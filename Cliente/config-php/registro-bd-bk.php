<?php
// Evita iniciar la sesión en el entorno de pruebas (CLI)
if (php_sapi_name() !== 'cli') {
    session_start();
}

// Omite la inclusión de la conexión a la base de datos en el entorno de pruebas (CLI)
if (php_sapi_name() !== 'cli') {
    require_once 'conexion-bd.php';
}

// Clase para manejar el registro de usuarios
class UserRegistration {
    private $db;
    private $isTestingEnvironment;

    // Constructor que recibe una instancia de la base de datos y un indicador del entorno de pruebas
    public function __construct($conexion, $isTestingEnvironment = false) {
        $this->db = $conexion;
        $this->isTestingEnvironment = $isTestingEnvironment;
    }

    // Método para registrar un nuevo usuario
    public function registerUser($userData) {
        // Verifica que las contraseñas coincidan
        if (!$this->validatePasswords($userData['contrasena'], $userData['rcontrasena'])) {
            $this->showAlert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.",
             "../registro/formulario.php");
            return false;
        }

        // Verifica si el usuario ya está registrado
        if ($this->userExists($userData['correo'], $userData['n_documento'])) {
            $this->showAlert("El usuario ya está registrado", "../registro/formulario.php");
            return false;
        }

        // Hashea la contraseña
        $hashedPassword = $this->hashPassword($userData['contrasena']);
        
        // Inserta el usuario en la base de datos
        if ($this->insertUser($userData, $hashedPassword)) {
            // Si no es entorno de pruebas, guarda el correo en la sesión
            if (!$this->isTestingEnvironment) {
                $_SESSION['cliente'] = $userData['correo'];
            }
            // Muestra un mensaje de éxito y redirige
            $this->showAlert("Usuario registrado correctamente", "../catalogo/catalogo.php");
            return true;
        } else {
            // Muestra un mensaje de error y redirige
            $this->showAlert("Usuario no registrado, intente de nuevo", "../registro/formulario.php");
            return false;
        }
    }

    // Método privado para validar que las contraseñas coincidan
    private function validatePasswords($password, $confirmPassword) {
        return $password === $confirmPassword;
    }

    // Método privado para hashear la contraseña usando SHA-512
    private function hashPassword($password) {
        return hash('sha512', $password);
    }

    // Método privado para verificar si el usuario ya existe
    private function userExists($email, $document) {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE correo = ? OR n_documento = ?");
        $query->bind_param("ss", $email, $document);
        $query->execute();
        $result = $query->get_result();
        $exists = $result->num_rows > 0;
        $query->close();
        return $exists;
    }

    // Método privado para insertar un nuevo usuario en la base de datos
    private function insertUser($userData, $hashedPassword) {
        $query = $this->db->prepare("INSERT INTO cliente (nombres, apellidos, n_documento,
        direccion, municipio, celular, correo, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssssss", $userData['nombres'],$userData['apellidos'], $userData['n_documento'],
        $userData['direccion'],$userData['municipio'],$userData['celular'], $userData['correo'], $hashedPassword);
        $result = $query->execute();
        $query->close();
        return $result;
    }

    // Método privado para mostrar una alerta y redirigir al usuario
    private function showAlert($message, $location) {
        if ($this->isTestingEnvironment) {
            return; // No hacer nada en el entorno de pruebas
        }
        echo "<script>
            alert('$message');
            window.location = '$location';
        </script>";
        exit();
    }
}

// Lógica para manejar el registro de usuario desde un formulario POST, fuera de la clase
if (php_sapi_name() !== 'cli' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se crea una instancia de UserRegistration
    $userRegistration = new UserRegistration($conexion);
    // Se llama al método registerUser para registrar al usuario
    $userRegistration->registerUser($_POST);
}
?>