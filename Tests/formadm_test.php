<?php
require_once 'Admin/startbootstrap-sb-admin-gh-pages/config-php/registro-bd-bk.php';
use PHPUnit\Framework\TestCase;

class formadm_test extends TestCase
{
    private $mockDb;
    private $userRegistration;

    protected function setUp(): void
    {
        $this->mockDb = $this->createMock(mysqli::class);
        $this->userRegistration = new UserRegistration($this->mockDb, true);
    }

    public function testValidatePasswords()
    {
        $method = new ReflectionMethod(UserRegistration::class, 'validatePasswords');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($this->userRegistration, 'password123', 'password123'));
        $this->assertFalse($method->invoke($this->userRegistration, 'password123', 'password456'));
    }

    public function testHashPassword()
    {
        $method = new ReflectionMethod(UserRegistration::class, 'hashPassword');
        $method->setAccessible(true);

        $password = 'password123';
        $hashedPassword = $method->invoke($this->userRegistration, $password);

        $this->assertEquals(hash('sha512', $password), $hashedPassword);
    }

    public function testInsertUser()
    {
        $userData = [
            'nombres_apellidos' => 'John Doe',
            'ndocumento' => '1234567890',
            'correo' => 'john@example.com'
        ];
        $hashedPassword = hash('sha512', 'password123');

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with('ssss', $userData['nombres_apellidos'], $userData['ndocumento'], $userData['correo'], $hashedPassword);
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
        $mockStmt->expects($this->once())
                 ->method('close');

        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->willReturn($mockStmt);

        $method = new ReflectionMethod(UserRegistration::class, 'insertUser');
        $method->setAccessible(true);

        $result = $method->invoke($this->userRegistration, $userData, $hashedPassword);
        $this->assertTrue($result);
    }

    public function testRegisterUser()
    {
        $userData = [
            'nombres_apellidos' => 'John Doe',
            'ndocumento' => '1234567890',
            'correo' => 'john@example.com',
            'contrasena' => 'password123',
            'rcontrasena' => 'password123'
        ];

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->willReturn(true);
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
        $mockStmt->expects($this->once())
                 ->method('close');

        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->willReturn($mockStmt);

        $result = $this->userRegistration->registerUser($userData);
        $this->assertTrue($result);
    }
}