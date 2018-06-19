<?php
include '../dao/PersonaDAO.class.php';

if($_SERVER['REQUEST_METHOD']=='PUT'){
    echo json_encode(CambiarEstado());
}else{
    echo "request method incorrecto";
}

function CambiarEstado(){
    parse_str(file_get_contents("php://input"),$put);
    
    
    if(!isset($put["idusuario"])){
        return array("resultado"=>"Falta el id del usuario a desactivar");
    }
    
    if(!isset($put["estado"])){
        return array("resultado"=>"Falta el nuevo estado");
    }
    
    $persona = new Persona($put["idusuario"], 0, 0, 0, 0, 0, $put["estado"], 0, 0);
    $personaDAO = new PersonaDAO();
    
    $r = $personaDAO->CambiarEstado($persona);
    
    return array("resultado"=>$r);
}

