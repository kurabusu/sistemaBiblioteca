<?php
include '../dao/UsuarioDAO.class.php';

if($_SERVER['REQUEST_METHOD']=='PUT'){
    echo json_encode(ActualizarClave());
}else{
    echo "request method incorrecto";
}

function ActualizarClave(){
    parse_str(file_get_contents("php://input"),$put);
    $hayerror = false;
    $mensajes = "";
    
    if(isset($put["password1"]) && strlen($put["password1"]) > 0){
        if(isset($put["password2"]) && strlen($put["password2"]) > 0){
            if($put["password1"] != $put["password2"]){
                $hayerror = true;
                $mensajes.="- Las contrase&ntilde;as no coinciden<br>";
            }
        }else{
            $hayerror = true;
            $mensajes.="- La nueva contrase&ntilde;a no puede ser vac&iacute;a<br>";
        }
    }else{
        $hayerror = true;
        $mensajes.="- La nueva contrase&ntilde;a no puede ser vac&iacute;a<br>";        
    }
    
    if ($hayerror){
        return array("resultado"=>$mensajes);
    }
    
    $nuevaclave = password_hash($put["password1"],PASSWORD_DEFAULT);
    $usuario = new Usuario(0, "", $nuevaclave, "", "", $put["idusuario"]);
    $usuarioDAO = new UsuarioDAO();
    
    $resp = $usuarioDAO->ActualizarClave($usuario);
    
    return array("resultado"=>$resp);
}


