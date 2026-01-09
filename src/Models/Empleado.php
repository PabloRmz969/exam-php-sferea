<?php
require_once __DIR__ . '/Trabajador.php';

// Respuesta 3) Herencia 
class Empleado extends Trabajador
{
    public $puesto;
    public $salario;

    public function __construct(string $nombre, string $puesto, float $salario)
    {
        parent::__construct($nombre);
        $this->puesto = $puesto;
        $this->salario = $salario;
    }

    public function calcularPago(): float
    {
        return $this->salario;
    }

    public function info(): string
    {
        return $this->saludar() . " y trabajo como " . $this->puesto;
    }
}
