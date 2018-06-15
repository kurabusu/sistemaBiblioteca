<?php
include_once __DIR__.'/Persona.class.php';
include_once __DIR__.'/Libro.class.php';

class Reserva{
    
    private $id;
    private $fecha_reserva;
    
    /**
     *
     * @var Persona 
     */
    private $persona;
    /**
     *
     * @var Libro
     */
    private $libro;
        
    function __construct($id, $fecha_reserva, Persona $persona, Libro $libro) {
        $this->id = $id;
        $this->fecha_reserva = $fecha_reserva;
        $this->persona = $persona;
        $this->libro = $libro;
    }

    function getId() {
        return $this->id;
    }

    function getFecha_reserva() {
        return $this->fecha_reserva;
    }

    function getPersona() {
        return $this->persona;
    }

    function getLibro() {
        return $this->libro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha_reserva($fecha_reserva) {
        $this->fecha_reserva = $fecha_reserva;
    }

    function setPersona(Persona $persona) {
        $this->persona = $persona;
    }

    function setLibro(Libro $libro) {
        $this->libro = $libro;
    }

}