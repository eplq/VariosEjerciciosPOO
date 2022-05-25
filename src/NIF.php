<?php

namespace ITEC\DAW\EPL\Miscelanea;

const LETRAS = [
    'T',
    'R',
    'W',
    'A',
    'G',
    'M',
    'Y',
    'F',
    'P',
    'D',
    'X',
    'B',
    'N',
    'J',
    'Z',
    'S',
    'Q',
    'V',
    'H',
    'L',
    'C',
    'K',
    'E'
];

const TIPOS_NIF = [
    7 => "NIE",
    8 => "DNI"
];

const LETRA_INICIAL_NIE = [
    "X" => 0,
    "Y" => 1,
    "Z" => 2
];

class NIF
{
    private int $numero;
    private string $letra;
    private string $letraInicial;
    private string $tipo;

    public function __construct(int $numero, string $letraInicial = "")
    {
        if (!self::comprobarNumero($numero)) {
            throw new \Exception("El número no es válido, debe tener 7 u 8 caracteres.");
        }

        $this->numero = $numero;
        $this->tipo = self::tipoNIF($numero);

        if ($this->tipo === "NIE" && !self::comprobarLetraInicial($letraInicial)) {
            throw new \Exception("La letra inicial no es válida");
        }

        if ($this->tipo === "NIE") {
            $this->numero = $this->numero + LETRA_INICIAL_NIE[$letraInicial] * (10 ** 7);
        }

        $this->letra = self::obtenerLetra($numero);
        $this->letraInicial = $letraInicial;
    }

    public static function comprobarNumero(int $numeroAComprobar): string
    {
        $numeroStr = (string) $numeroAComprobar;
        return strlen($numeroStr) == 7 || strlen($numeroStr) == 8;
    }

    public static function tipoNIF(int $numero): string
    {
        $numeroStr = (string) $numero;

        return TIPOS_NIF[strlen($numeroStr)];
    }

    public static function obtenerLetra(int $numero): string
    {
        return LETRAS[$numero % 23];
    }

    public static function comprobarLetraInicial(string $letra)
    {
        return array_key_exists($letra, LETRA_INICIAL_NIE);
    }

    public static function comprobarLetra(int $numero, string $letra)
    {
        return self::obtenerLetra($numero) === $letra;
    }

    public function obtenerNIF(): string
    {
        if ($this->tipo === "NIE" && $this->letraInicial === "X") {
            return "0$this->numero$this->letra";
        }

        return "$this->numero$this->letra";
    }

    public function __toString(): string
    {
        return $this->obtenerNIF();
    }
}
