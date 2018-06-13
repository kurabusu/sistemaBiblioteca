<?php

Class categoria{
    
    private $id;
    private $codigo;
    private $descripcion;
    
    public function __construct($id, $codigo, $descripcion) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
    }
    public function getId(){
       return $this->id;
    }
    
    public function setId($id){
       return $this->id = $id;
    }
    
    public function getCodigo(){
       return $this->codigo;
    }
    
    public function setCodigo($codigo){
       return $this->codigo = $codigo;
    }
    
    public function getDescripcion(){
       return $this->descripcion;
    }
    
    public function setDescripcion($descripcion){
       return $this->descripcion = $descripcion;
    }
    
}
