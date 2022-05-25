<?php

namespace ITEC\DAW\EPL\Miscelanea;

class Banco
{
    private array $cuentas;

    public function __construct()
    {
        $this->cuentas = [];
    }

    public function registrarCuenta(string $nif)
    {
        if (array_key_exists($nif, $this->cuentas)) {
            throw new \Exception('La cuenta ya existe');
        }

        $this->cuentas[$nif] = 0;
    }

    public function ingreso(string $nif, string $cantidad)
    {
        if (!array_key_exists($nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        $this->cuentas[$nif] += $cantidad;
    }

    public function cargo(string $nif, string $cantidad)
    {
        if (!array_key_exists($nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        $saldo = $this->cuentas[$nif];

        if ($saldo < $cantidad) {
            throw new \Exception("Saldo insuficiente");
        }

        $this->cuentas[$nif] -= $cantidad;
    }

    public function obtenerSaldo(string $nif)
    {
        if (!array_key_exists($nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        return $this->cuentas[$nif];
    }

    public function obtenerSaldoTotal()
    {
        return array_reduce($this->cuentas, function ($total, $saldo) {
            return $total + $saldo;
        }, 0);
    }
}
