<?php
include '../dao/PersonaDAO.class.php';
include '../dao/UsuarioDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    echo json_encode(ActualizarPersona());
}else{
    echo "request method incorrecto";
}

function ActualizarPersona(){
    parse_str(file_get_contents("php://input"),$put);
    $hayerror = false;
    $mensajes = "";
    
    if (isset($put["nombres"]) && strlen($put["nombres"]) > 0){
       //pasa  
    }else{
        $hayerror = true;
        $mensajes.="- El nombre no puede estar en blanco<br>";
    }
    
    if (isset($put["apellidos"]) && strlen($put["apellidos"]) > 0){
    }else{
        $hayerror = true;
        $mensajes.="- El apellido no puede estar en blanco<br>";
    }
    
    if(isset($put["email"]) && strlen($put["email"]) > 0){
    }else{
        $hayerror=true;
        $mensajes.="- El correo no puede estar en blanco<br>";
    }
    
    if(isset($put["telefono"]) && strlen($put["telefono"]) > 0){
    }else{
        $hayerror=true;
        $mensajes.="- El tel&eacute;fono no puede estar en blanco<br>";
    }
    
    if(isset($put["perfil"]) && $put["perfil"]!=0){
    }else{
        $hayerror=true;
        $mensajes.="- Debe seleccionar un tipo de perfil<br>";
    }
    
    if($hayerror){
        return array("resultado"=>$mensajes);
    }
    
    $persona = new Persona($put["id"], 0, $put["nombres"], $put["apellidos"], $put["email"], $put["telefono"], 1, $put["perfil"], 0);
    $personaDAO = new PersonaDAO();
    $r = $personaDAO->update($persona);
    
    $usuario = new Usuario(0, $put["email"], 0, 0, $put["perfil"], $put["id"]);
    $usuarioDAO = new UsuarioDAO();
    $u = $usuarioDAO->update($usuario);
    
    if(isset($put["actualizarsesion"]) && $put["actualizarsesion"]=="si"){
        session_start();
        $usuario = $_SESSION["usuario"];
        $usuario["nombres"]=$put["nombres"];
        $usuario["apellidos"]=$put["apellidos"];
        $usuario["email"]=$put["email"];
        $usuario["telefono"]=$put["telefono"];
        $_SESSION["usuario"] = $usuario;
    }
    
    return array("resultado"=>$u);
    
    
}
