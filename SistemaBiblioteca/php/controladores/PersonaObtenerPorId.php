<?php
require __DIR__.'/../dao/PersonaDAO.class.php';
if ($_SERVER['REQUEST_METHOD']=='GET'){
    echo json_encode(ObtenerPorId($_GET["id"]));
}

function ObtenerPorId($id){
    $p = new PersonaDAO();
    $arr = $p->ObtenerPorId($id);
    
    $lista = array();
    for ($i = 0; $i<count($arr);$i++){
        array_push($lista, array(
            "id"=>$arr[$i]->getId(),
            "rut"=>$arr[$i]->getRut(),
            "nombres"=>$arr[$i]->getNombres(),
            "apellidos"=>$arr[$i]->getApellidos(),
            "email"=>$arr[$i]->getEmail(),
            "telefono"=>$arr[$i]->getTelefono(),
            "estado"=>$arr[$i]->getEstado(),
            "perfil"=>$arr[$i]->getPerfil(),
            "usuario"=>$arr[$i]->getUsuario()
        ));
    }
    return $lista;
}

