<?php
include_once __DIR__.'/Persona.class.php';
include_once __DIR__.'/Libro.class.php';


class Prestamo {
    
    private $id;
    private $fechaEntrega;
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
    
    public function __construct($id, $fechaEntrega, $persona, $libro) {
        $this->id = $id;
        $this->fechaEntrega = $fechaEntrega;
        $this->persona = $persona;
        $this->libro = $libro;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getFechaEntrega(){
        return $this->fechaEntrega;
    }
    
    public function getPersona(){
        return $this->persona;
    }
    
    public function getLibro(){
        return $this->libro;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setFechaEntrega($fechaEntrega){
        $this->fechaEntrega = $fechaEntrega;
    }
    
    public function setPersona($persona){
        $this->persona = $persona;
    }
    
    public function setLibro($libro){
        $this->libro = $libro;
    }
    
    
}