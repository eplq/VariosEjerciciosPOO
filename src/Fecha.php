<?php

namespace ITEC\DAW\EPL\Miscelanea;

class Fecha
{
    private \DateTime $fecha;

    public function __construct(string $fecha)
    {
        if (!self::comprobarFecha($fecha)) {
            throw new \Exception("La fecha no es correcta");
        }

        $this->fecha = \DateTime::createFromFormat("d/m/Y", $fecha);
    }

    private static function comprobarFecha(string $fecha)
    {
        $fecha = \DateTime::createFromFormat("d/m/Y", $fecha);
        return $fecha !== false;
    }

    public function diaSiguiente()
    {
        $unDia = \DateInterval::createFromDateString("1 day");

        $this->fecha->add($unDia);
    }

    public function __toString()
    {
        return $this->fecha->format("d/m/Y");
    }
}
