<?php
require_once 'Admin\startbootstrap-sb-admin-gh-pages\config-php\conexion-bd.php';
use PHPUnit\Framework\TestCase;

class ConexionTest extends TestCase
{
    private $conexion;

    protected function setUp(): void
    {
        // Establecer la conexión antes de cada prueba
        $this->conexion = mysqli_connect("localhost", "root", "", "pan_y_mas");
    }

    protected function tearDown(): void
    {
        // Cerrar la conexión después de cada prueba
        if ($this->conexion) {
            mysqli_close($this->conexion);
        }
    }

    public function testConexionExitosa()
    {
        $this->assertNotFalse($this->conexion, 'La conexión debería ser exitosa');
        $this->expectOutputString('Conectado exitosamente');
        
        if ($this->conexion) {
            echo 'Conectado exitosamente';
        } else {
            echo 'No se pudo conectar a la base de datos';
        }
    }

    public function testConexionFallida()
    {
        $this->expectException(mysqli_sql_exception::class);
        $this->expectExceptionMessage('Access denied for user');
        
        mysqli_connect("localhost", "usuario_inexistente", "contraseña_incorrecta", "base_de_datos_inexistente");
        
        // Este código no se ejecutará si se lanza la excepción como se espera
        $this->fail('Se esperaba una excepción mysqli_sql_exception');
    }
}