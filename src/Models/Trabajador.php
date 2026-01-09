<?php
require_once __DIR__ . '/Persona.php';
// Respuesta 6) Clase abstracta
abstract class Trabajador extends Persona
{
    abstract public function calcularPago(): float;
}
