<?php

namespace ITEC\DAW\EPL\Miscelanea;

class Banco
{
    private array $cuentas;
    private array $ingresos;
    private array $cargos;

    public function __construct()
    {
        $this->cuentas = [];
        $this->ingresos = [];
        $this->cargos = [];
    }

    public function registrarCuenta(NIF $nif)
    {
        if (array_key_exists((string) $nif, $this->cuentas)) {
            throw new \Exception('La cuenta ya existe');
        }

        $this->cuentas[(string) $nif] = 0;
    }

    public function ingreso(NIF $nif, float $cantidad)
    {
        if (!array_key_exists((string) $nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        $this->cuentas[(string) $nif] += $cantidad;
        array_push($this->ingresos, [$nif, $cantidad, Fecha::hoy()]);
    }

    public function cargo(NIF $nif, float $cantidad)
    {
        if (!array_key_exists((string) $nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        $saldo = $this->cuentas[(string) $nif];

        if ($saldo < $cantidad) {
            throw new \Exception("Saldo insuficiente");
        }

        $this->cuentas[(string) $nif] -= $cantidad;
        array_push($this->cargos, [$nif, $cantidad, Fecha::hoy()]);
    }

    public function obtenerSaldo(NIF $nif)
    {
        if (!array_key_exists((string) $nif, $this->cuentas)) {
            throw new \Exception('No existe la cuenta');
        }

        return $this->cuentas[(string) $nif];
    }

    public function obtenerSaldoTotal()
    {
        return array_reduce($this->cuentas, function ($total, $saldo) {
            return $total + $saldo;
        }, 0);
    }
}
