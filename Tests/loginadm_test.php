<?php
require_once'Admin/startbootstrap-sb-admin-gh-pages/config-php/login_bk.php';
use PHPUnit\Framework\TestCase;

class loginadm_test extends TestCase
{
    private $mockDatabase;
    private $userAuthenticator;

    protected function setUp(): void
    {
        $this->mockDatabase = $this->createMock(mysqli::class);
        $this->userAuthenticator = new UserAuthenticator($this->mockDatabase);
    }

    public function testAuthenticateSuccess()
    {
        $email = 'test@example.com';
        $password = 'password123';
        $hashedPassword = hash('sha512', $password);

        $mockStatement = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);

        $mockStatement->expects($this->once())
            ->method('bind_param')
            ->with('ss', $email, $hashedPassword);
        $mockStatement->expects($this->once())
            ->method('execute');
        $mockStatement->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        $mockResult->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(['id' => 1, 'correo' => $email]);

        $this->mockDatabase->expects($this->once())
            ->method('prepare')
            ->willReturn($mockStatement);

        $result = $this->userAuthenticator->authenticate($email, $password);
        $this->assertTrue($result);
    }

    public function testAuthenticateFailure()
    {
        $email = 'test@example.com';
        $password = 'wrongpassword';

        $mockStatement = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);

        $mockStatement->expects($this->once())
            ->method('bind_param');
        $mockStatement->expects($this->once())
            ->method('execute');
        $mockStatement->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        $mockResult->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(null);

        $this->mockDatabase->expects($this->once())
            ->method('prepare')
            ->willReturn($mockStatement);

        $result = $this->userAuthenticator->authenticate($email, $password);
        $this->assertFalse($result);
    }
}

class SessionManagerTest extends TestCase
{
    private $sessionManager;

    protected function setUp(): void
    {
        $this->sessionManager = new SessionManager();
    }

    public function testStartSession()
    {
        $this->sessionManager->startSession();
        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());
    }

    public function testSetUserSession()
    {
        $email = 'test@example.com';
        $this->sessionManager->setUserSession($email);
        $this->assertEquals($email, $_SESSION['empleado']);
    }
}

class ResponseHandlerTest extends TestCase
{
    private $responseHandler;

    protected function setUp(): void
    {
        $this->responseHandler = new ResponseHandler();
    }

    public function testRedirect()
    {
        $url = 'http://example.com';
        
        $this->expectOutputString('');
        $this->expectException('PHPUnit\Framework\Exception');
        
        $this->responseHandler->redirect($url);
    }

    public function testShowAlert()
    {
        $message = 'Test message';
        $redirectUrl = 'http://example.com';
        
        $expectedOutput = "
        <script>
            alert('$message');
            window.location = '$redirectUrl';
        </script>
        ";
        
        $this->expectOutputString($expectedOutput);
        $this->expectException('PHPUnit\Framework\Exception');
        
        $this->responseHandler->showAlert($message, $redirectUrl);
    }
}