<?php

// Clase para manejar las sesiones de usuario
class SessionManager
{
    // Método para iniciar una sesión si no está ya iniciada
    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Método para destruir la sesión actual si está activa
    public function destroySession()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}

// Clase para manejar redirecciones
class Redirector
{
    // Método para redirigir al usuario a una URL específica
    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}

// Clase para manejar el cierre de sesión (logout)
class LogoutHandler
{
    private $sessionManager;
    private $redirector;

    // Constructor que recibe instancias de SessionManager y Redirector
    public function __construct(SessionManager $sessionManager, Redirector $redirector)
    {
        $this->sessionManager = $sessionManager;
        $this->redirector = $redirector;
    }

    // Método para realizar el proceso de cierre de sesión
    public function logout()
    {
        // Inicia la sesión si no está ya iniciada
        $this->sessionManager->startSession();
        // Destruye la sesión actual
        $this->sessionManager->destroySession();
        // Redirige al usuario a la página de login
        $this->redirector->redirect("../login.php");
    }
}

// Uso del código fuera de un entorno de pruebas
if (!defined('TESTING')) {
    $sessionManager = new SessionManager();
    $redirector = new Redirector();
    $logoutHandler = new LogoutHandler($sessionManager, $redirector);
    // Llama al método logout para cerrar sesión y redirigir al usuario
    $logoutHandler->logout();
}
