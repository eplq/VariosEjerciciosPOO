<?php

namespace ITEC\DAW\EPL\Tests;

use ITEC\DAW\EPL\Miscelanea\Fraccion;
use PHPUnit\Framework\TestCase;

class FraccionTest extends TestCase
{
    public function obtenerComponentes()
    {
        $fraccion = new Fraccion(10, 100);

        [$numerador, $denominador] = $fraccion->obtenerComponentes();

        $this->assertEquals(10, $numerador);
        $this->assertEquals(100, $denominador);
    }

    public function testSuma()
    {
        $fraccion = new Fraccion(10, 5);
        $fraccion2 = new Fraccion(5, 3);

        $suma = $fraccion->suma($fraccion2);

        [$numerador, $denominador] = $suma->obtenerComponentes();

        $this->assertEquals(55, $numerador);
        $this->assertEquals(15, $denominador);
    }

    public function testResta()
    {
        $fraccion = new Fraccion(10, 5);
        $fraccion2 = new Fraccion(5, 3);

        $resta = $fraccion->resta($fraccion2);

        [$numerador, $denominador] = $resta->obtenerComponentes();

        $this->assertEquals(5, $numerador);
        $this->assertEquals(15, $denominador);
    }

    public function testProducto()
    {
        $fraccion = new Fraccion(10, 5);
        $fraccion2 = new Fraccion(5, 3);

        $producto = $fraccion->producto($fraccion2);

        [$numerador, $denominador] = $producto->obtenerComponentes();

        $this->assertEquals(50, $numerador);
        $this->assertEquals(15, $denominador);
    }

    public function testCociente()
    {
        $fraccion = new Fraccion(10, 5);
        $fraccion2 = new Fraccion(5, 3);

        $cociente = $fraccion->cociente($fraccion2);

        [$numerador, $denominador] = $cociente->obtenerComponentes();

        $this->assertEquals(30, $numerador);
        $this->assertEquals(25, $denominador);
    }
}
