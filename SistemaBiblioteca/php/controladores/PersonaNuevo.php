<?php
include '../dao/PersonaDAO.class.php';
include '../dao/UsuarioDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo json_encode(personaNuevo());
}else{
    echo "request_method incorrecto";
}

function personaNuevo(){
    $hayerror = false;
    $mensajes = "";
    if (isset($_POST["rut"]) && strlen($_POST["rut"])==0){
        $hayerror = true;
        $mensajes.= "- Rut es obligatorio<br>";
    }else{
        $perDAO = new PersonaDAO();
        $totrut = $perDAO->VerificarRut($_POST["rut"]);
        if ($totrut>0){
            $hayerror = true;
            $mensajes.="- Ya existe un usuario con el mismo rut<br>";
        }
    }
    if (isset($_POST["nombres"]) && strlen($_POST["nombres"])==0){
        $hayerror = true;
        $mensajes.= "- Nombre es obligatorio<br>";
    }
    if (isset($_POST["apellidos"]) && strlen($_POST["apellidos"])==0){
        $hayerror = true;
        $mensajes.= "- Apellido es obligatorio<br>";
    }
    if (isset($_POST["email"]) && strlen($_POST["email"])==0){
        $hayerror = true;
        $mensajes.= "- Email es obligatorio<br>";
    }else{
        $perDao = new PersonaDAO();
        $totmail = $perDao->VerificarCorreo($_POST["email"]);
        if($totmail>0){
            $hayerror = true;
            $mensajes.="- Ya existe un usuario con este correo<br>";
        }
    }
    if (isset($_POST["telefono"]) && strlen($_POST["telefono"])==0){
        $hayerror = true;
        $mensajes.= "- Tel&eacute;fono es obligatorio<br>";
    }
    if ((isset($_POST["password1"]) && isset($_POST["password2"])) && (strlen($_POST["password1"])>0 && strlen($_POST["password2"])>0)){
        if($_POST["password1"]!=$_POST["password2"]){
            $hayerror = true;
            $mensajes.="- Las contrase&ntilde;as no coinciden<br>";
        }
    }else{
        $hayerror = true;
        $mensajes.="- La contrase&ntilde;a es obligatoria<br>";
    }
    if (isset($_POST["perfil"]) && $_POST["perfil"]==0){
        $hayerror = true;
        $mensajes.="- Debe seleccionar un tipo de perfil para el usuario<br>";
    }
    if($hayerror){
        return array("resultado" => $mensajes);
    }
    
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
            $_POST["password1"], 
            1, 
            $_POST["perfil"], 
            $idPersona);
    
    $usuarioDao = new UsuarioDAO();
    $resp = $usuarioDao->insertar($usuario);
    return array("resultado"=>$resp);
}