<?php

namespace ITEC\DAW\EPL\Miscelanea;

class Fraccion
{
    private float $numerador;
    private float $denominador;

    public function __construct(float $numerador, float $denominador)
    {
        $this->numerador = $numerador;
        $this->denominador = $denominador;
    }

    public function obtenerComponentes()
    {
        return [$this->numerador, $this->denominador];
    }

    public function suma(Fraccion $sumando)
    {
        [$sumandoNumerador, $sumandoDenominador] = $sumando->obtenerComponentes();

        $numeradorResultado = $this->numerador * $sumandoDenominador + $this->denominador * $sumandoNumerador;
        $denominadorResultado = $this->denominador * $sumandoDenominador;

        return new Fraccion($numeradorResultado, $denominadorResultado);
    }

    public function resta(Fraccion $sustraendo)
    {
        [$sustraendoNumerador, $sustraendoDenominador] = $sustraendo->obtenerComponentes();

        $numeradorResultado = $this->numerador * $sustraendoDenominador - $this->denominador * $sustraendoNumerador;
        $denominadorResultado = $this->denominador * $sustraendoDenominador;

        return new Fraccion($numeradorResultado, $denominadorResultado);
    }

    public function producto(Fraccion $multiplicador)
    {
        [$multiplicadorNumerador, $multiplicadorDenominador] = $multiplicador->obtenerComponentes();

        return new Fraccion($this->numerador * $multiplicadorNumerador, $this->denominador * $multiplicadorDenominador);
    }

    public function cociente(Fraccion $divisor)
    {
        [$divisorNumerador, $divisorDenominador] = $divisor->obtenerComponentes();

        return new Fraccion($this->numerador * $divisorDenominador, $this->denominador * $divisorNumerador);
    }
}
