<?php
include '../dao/PerfilDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo json_encode(getPerfiles());
}else{
    echo "request_method incorrecto";
}

/**
 * $arr Perfil
 */
function getPerfiles(){
    $perfilDao = new PerfilDAO();
    $arr = $perfilDao->ObtenerPerfiles();
    
    $lista = array();
    for ($i = 0; $i < count($arr); $i++){
        array_push($lista, array(
            "id" => $arr[$i]->getId(),
            "descripcion" => $arr[$i]->getDescripcion(),
            "estado" => $arr[$i]->getEstado()
        ));
    }
    return $lista;
}
