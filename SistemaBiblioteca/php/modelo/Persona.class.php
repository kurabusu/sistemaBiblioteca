<?php

class Persona{
    
    private $id;
    private $rut;
    private $nombres;
    private $apellidos;
    private $email;
    private $telefono;
    private $estado;
    
    public function __construct($id, $rut, $nombre, $apellidos, $email, $telefono, $estado) {
        $this->id = $id;
        $this->rut = $rut;
        $this->nombres = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->estado = $estado;
    }
    
    
}