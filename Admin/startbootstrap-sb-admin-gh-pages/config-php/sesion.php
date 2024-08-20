<?php
// sessionManager.php

// Clase para manejar las sesiones de usuario
class SessionManager {
    // Constructor que inicia una sesión si no está ya iniciada
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Método para verificar si un empleado está logueado
    public function isEmployeeLoggedIn() {
        return isset($_SESSION['empleado']);
    }

    // Método para destruir la sesión actual
    public function destroySession() {
        session_destroy();
    }
}

// authenticationHandler.php

// Clase para manejar la autenticación de usuarios
class AuthenticationHandler {
    private $sessionManager;

    // Constructor que recibe una instancia de SessionManager
    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
    }

    // Método para verificar la autenticación del usuario
    public function checkAuthentication() {
        // Si el empleado no está logueado, maneja el acceso no autenticado
        if (!$this->sessionManager->isEmployeeLoggedIn()) {
            $this->handleUnauthenticatedAccess();
            return false;
        }
        // Si el empleado está logueado, retorna true
        return true;
    }

    // Método privado para manejar el acceso no autenticado
    private function handleUnauthenticatedAccess() {
        // Destruye la sesión
        $this->sessionManager->destroySession();
        // Retorna un script para redirigir al usuario a la página de login
        return $this->getRedirectScript();
    }

    // Método privado para generar un script de redirección con un mensaje de alerta
    private function getRedirectScript() {
        return '
        <script>
            alert("Por favor inicia sesión");
            window.location = "login.php";
        </script>
        ';
    }
}
