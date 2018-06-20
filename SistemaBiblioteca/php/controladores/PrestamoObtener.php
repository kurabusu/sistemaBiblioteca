<?php
include '../dao/PrestamoDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(prestamoObtener());
} else {
    echo "request_method incorreco";
}

function  prestamoObtener(){
    $prestamoDAO = new PrestamoDAO();
    $libro = new Libro(null, null, null, null, null, null, null, null, null, null);
    $persona = new Persona(null, null, null, null, null, null, null, null, null);
    
    if(isset($_GET["libro"]) && strlen($_GET["libro"]) > 0){
        $libro->setTitulo($_GET["libro"]);
    }
    
    if(isset($_GET["persona"]) && strlen($_GET["persona"]) > 0){
        $persona->setId($_GET["persona"]);
        $persona->setNombres($_GET["persona"]);
        $persona->setApellidos($_GET["persona"]);
    }
    
    $prestamo = new Prestamo(null, null, $persona, $libro);
    
    $lista = array();
    $arr = $prestamoDAO->obtener($prestamo);
    
    
    for ($i = 0; $i < count($arr); $i++) {
        array_push($lista, array(
            "id" => $arr[$i]->getid(),
            "fechaEntrega" => $arr[$i]->getFechaEntrega(),
            "libro" => array(
                "id" => $arr[$i]->getLibro()->getId(),
                "titulo" => $arr[$i]->getLibro()->getTitulo()
            ),
            "persona" => array(
                "id" => $arr[$i]->getPersona()->getId(),
                "rut" => $arr[$i]->getPersona()->getRut(),
                "nombres" => $arr[$i]->getPersona()->getNombres(),
                "apellido" => $arr[$i]->getPersona()->getApellidos(),
            ) 
        ));
    }
    return array("resultado" => $lista);
}