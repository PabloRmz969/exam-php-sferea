<?php
class Persona
{
    public $nombre;

    //Respuesta 1) Constructor
    
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    // Respuesta 2) Método saludar
     
    public function saludar(): string
    {
        return "Hola mi nombre es " . $this->nombre;
    }
}
