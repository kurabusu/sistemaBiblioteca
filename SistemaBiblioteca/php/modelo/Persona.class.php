<?php
include_once __DIR__.'/Usuario.class.php';
include_once __DIR__.'/Perfil.class.php';

class Persona{
    
    private $id;
    private $rut;
    private $nombres;
    private $apellidos;
    private $email;
    private $telefono;
    private $estado;
    private $perfil;
    private $usuario;
    
    public function __construct($id, $rut, $nombre, $apellidos, $email, $telefono, $estado, $perfil, $usuario) {
        $this->id = $id;
        $this->rut = $rut;
        $this->nombres = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->estado = $estado;
        $this->perfil = $perfil;
        $this->usuario = $usuario;
    }
    
    function getId() {
        return $this->id;
    }

    function getRut() {
        return $this->rut;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEstado() {
        return $this->estado;
    }
    
    function getPerfil() {
        return $this->perfil;
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    function setUsuario($usuario){
        $this->usuario = $usuario;
    }

}