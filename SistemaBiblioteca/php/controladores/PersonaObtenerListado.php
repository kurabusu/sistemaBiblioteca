<?php
require __DIR__.'/../dao/PersonaDAO.class.php';
if ($_SERVER['REQUEST_METHOD']=='GET'){
    echo json_encode(ObtenerListado($_GET["clave"]));
}
/**
 * 
 * @param String $clave para rut, nombre y apellido.
 * @return array
 */
function ObtenerListado($clave){
    $p = new PersonaDAO();
    $arr = $p->Obtener($clave);
    
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
            "perfil"=>array(
                "idperfil"=>$arr[$i]->getPerfil()->getId(),
                "descripcion"=>$arr[$i]->getPerfil()->getDescripcion(),
                "estado"=>$arr[$i]->getPerfil()->getEstado()
            )
        ));
    }
    return $lista;
}

