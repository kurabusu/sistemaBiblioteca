<?php
include '../dao/PersonaDAO.class.php';
include '../dao/UsuarioDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo json_encode(personaNuevo());
}else{
    echo "request_method incorrecto";
}

function personaNuevo(){
    $persona = new Persona(0, 
            $_POST["rut"], 
            $_POST["nombres"], 
            $_POST["apellidos"], 
            $_POST["email"], 
            $_POST["telefono"], 
            1,
            0,
            0);
    
    $personaDao = new PersonaDAO();
    $idPersona = $personaDao->ingresar($persona);
    
    $usuario = new Usuario(0, 
            $_POST["email"], 
            $_POST["password"], 
            1, 
            $_POST["perfil"], 
            $idPersona);
    
    $usuarioDao = new UsuarioDAO();
    $resp = $usuarioDao->insertar($usuario);
    return $resp;
}