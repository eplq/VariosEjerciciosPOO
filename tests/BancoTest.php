<?php

namespace ITEC\DAW\EPL\Tests;

use ITEC\DAW\EPL\Miscelanea\Banco;
use ITEC\DAW\EPL\Miscelanea\NIF;
use PHPUnit\Framework\TestCase;

class BancoTest extends TestCase
{
    public function testRegistrarCuenta()
    {
        $banco = new Banco();
        $nif = new NIF(12345678);
        $banco->registrarCuenta($nif);

        $this->expectExceptionMessage("La cuenta ya existe");
        $banco->registrarCuenta($nif);
    }

    public function testIngreso()
    {
        $banco = new Banco();
        $nif = new NIF(12345678);
        $banco->registrarCuenta($nif);

        $banco->ingreso($nif, 1000);

        $nif2 = new NIF(12356784);
        $this->expectExceptionMessage("No existe la cuenta");
        $banco->ingreso($nif2, 1000);
    }

    public function testCargo()
    {
        $banco = new Banco();
        $nif = new NIF(12345678);
        $banco->registrarCuenta($nif);

        $banco->ingreso($nif, 1000);
        $banco->cargo($nif, 1000);

        $nif2 = new NIF(12356784);
        $this->expectExceptionMessage("No existe la cuenta");
        $banco->cargo($nif2, 1000);
    }

    public function testCargoSinSaldo()
    {
        $banco = new Banco();
        $nif = new NIF(12345678);
        $banco->registrarCuenta($nif);

        $this->expectExceptionMessage("Saldo insuficiente");
        $banco->cargo($nif, 1000);
    }

    public function testObtenerSaldo()
    {
        $banco = new Banco();
        $nif = new NIF(12345678);
        $banco->registrarCuenta($nif);

        $banco->ingreso($nif, 1000);
        $this->assertEquals(1000, $banco->obtenerSaldo($nif));

        $nif2 = new NIF(12356784);
        $this->expectExceptionMessage("No existe la cuenta");
        $banco->obtenerSaldo($nif2);
    }

    public function testObtenerSaldoTotal()
    {
        $banco = new Banco();

        $this->assertEquals(0, $banco->obtenerSaldoTotal());

        $nif = new NIF(12345678);
        $nif2 = new NIF(12356784);
        $banco->registrarCuenta($nif);
        $banco->registrarCuenta($nif2);

        $banco->ingreso($nif, 1000);
        $banco->ingreso($nif, 2000);
        $this->assertEquals(3000, $banco->obtenerSaldoTotal());

        $banco->ingreso($nif2, 1000);
        $banco->ingreso($nif2, 2000);
        $this->assertEquals(6000, $banco->obtenerSaldoTotal());
    }
}
