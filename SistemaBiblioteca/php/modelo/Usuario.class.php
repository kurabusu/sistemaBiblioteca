<?php
include_once __DIR__.'/Perfil.class.php';
class Usuario{
    private $id;
    private $username;
    private $password;
    private $estado;
    private $perfil;
    private $persona_id;
    
    function __construct($id,$username,$password,$estado,$perfil,$persona_id) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->estado = $estado;
        $this->perfil = $perfil;
        $this->persona_id = $persona_id;
    }
    
    function getID(){
        return $this->id;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getEstado(){
        return $this->estado;
    }
    
    function getPerfilId(){
        return $this->perfil;
    }
    
    function getPersonaId(){
        return $this->persona_id;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setUsername($username){
        $this->username = $username;
    }
    
    function setPassword($password){
        $this->password = $password;
    }
    
    function setEstado($estado){
        $this->estado = $estado;
    }
    
    function setPerfil($perfil){
        $this->perfil = $perfil;
    }
    
    function setPersonaId($persona_id){
        $this->persona_id = $persona_id;
    }
    
}
