<?php

namespace ITEC\DAW\EPL\Tests;

use ITEC\DAW\EPL\Miscelanea\Fecha;
use PHPUnit\Framework\TestCase;

class FechaTest extends TestCase
{
    public function testFechaException()
    {
        $this->expectException(\Exception::class);
        $f = new Fecha("11111");
    }

    public function testFecha()
    {
        $f = new Fecha("11/11/2022");

        $this->assertEquals("11/11/2022", $f->__toString());

        return $f;
    }

    /**
     * @depends testFecha
     */
    public function testDiaSiguiente(Fecha $fecha)
    {
        $fecha->diaSiguiente();

        $this->assertEquals("12/11/2022", $fecha->__toString());
    }
}
