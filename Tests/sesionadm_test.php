<?php
require_once 'Admin/startbootstrap-sb-admin-gh-pages/config-php/sesion.php';

use PHPUnit\Framework\TestCase;

class sesionadm_test extends TestCase
{
    private $sessionManager;

    protected function setUp(): void
    {
        $this->sessionManager = new SessionManager();
    }

    public function testIsEmployeeLoggedIn()
    {
        // Caso: empleado no está logueado
        $this->assertFalse($this->sessionManager->isEmployeeLoggedIn());

        // Caso: empleado está logueado
        $_SESSION['empleado'] = true;
        $this->assertTrue($this->sessionManager->isEmployeeLoggedIn());
    }

}

class AuthenticationHandlerTest extends TestCase
{
    private $authHandler;
    private $sessionManager;

    protected function setUp(): void
    {
        $this->sessionManager = new SessionManager(); // Crea un objeto real de SessionManager
        $this->authHandler = new AuthenticationHandler($this->sessionManager);
    }

    public function testCheckAuthenticationWhenLoggedIn()
    {
        $this->sessionManager->method('isEmployeeLoggedIn')->willReturn(true);
        $this->assertTrue($this->authHandler->checkAuthentication());
    }

    public function testCheckAuthenticationWhenNotLoggedIn()
    {
        $this->sessionManager->method('isEmployeeLoggedIn')->willReturn(false);
        $this->sessionManager->expects($this->once())->method('destroySession');

        $result = $this->authHandler->checkAuthentication();

        $this->assertFalse($result);
        
    }
}