<?php

namespace ITEC\DAW\EPL\Tests;

use ITEC\DAW\EPL\Miscelanea\NIF;
use PHPUnit\Framework\TestCase;

class NIFTest extends TestCase
{
    public function testComprobarNumero()
    {
        $this->expectException(\Exception::class);
        $n1 = new NIF(1230);

        $n4 = new NIF(1111111, "X");
        $this->assertEquals("01111111G", $n4->obtenerNIF());
    }

    public function testComprobarLetraInicial()
    {
        $this->expectException(\Exception::class);
        $n2 = new NIF(1111111, "A");
    }

    public function testLetraInicialNIE()
    {
        $n4 = new NIF(1111111, "X");
        $this->assertEquals("01111111G", $n4->obtenerNIF());
    }

    public function testLetraDNI()
    {
        $n3 = new NIF(11111111);
        $this->assertEquals("11111111H", (string) $n3);
    }

    public function testComprobarLetra()
    {
        $this->assertTrue(NIF::comprobarLetra(11111111, "H"));
        $this->assertFalse(NIF::comprobarLetra(11111111, "A"));
    }
}
