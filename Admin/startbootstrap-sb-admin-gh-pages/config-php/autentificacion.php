<?php
require_once "../config-php/session.php";
class AuthenticationHandler
{
  private $sessionManager;

  public function __construct(session $sessionManager)
  {
    $this->sessionManager = $sessionManager;
  }

  public function checkAuthentication()
  {
    if (!$this->sessionManager->isEmployeeLoggedIn()) {
      $this->handleUnauthenticatedAccess();
      return false;
    }
    return true;
  }

  private function handleUnauthenticatedAccess()
  {
    $this->sessionManager->destroySession();
    return $this->getRedirectScript();
  }

  private function getRedirectScript()
  {
    return '
        <script>
            alert("Por favor inicia sesión");
            window.location = "login.php";
        </script>
        ';
  }
}

$sessionManager = new session();
$authHandler = new AuthenticationHandler($sessionManager);
$authHandler->checkAuthentication();