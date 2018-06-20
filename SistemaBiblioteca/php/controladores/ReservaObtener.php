<?php
include '../dao/ReservaDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(reservaObtener());
} else {
    echo "request_method incorreco";
}

function reservaObtener(){
    $reservaDAO = new ReservaDAO();
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
    
    $reserva = new Reserva(null, null, $persona, $libro);
    
    if(isset($_GET["fechaReserva"]) && strlen($_GET["fechaReserva"]) > 0){
        $reserva->setFecha_reserva($_GET["fechaReserva"]);
    }
    
    
    $lista = array();
    $arr = $reservaDAO->obtener($reserva);
    
    for ($i = 0; $i < count($arr); $i++) {
        array_push($lista, array(
            "id" => $arr[$i]->getid(),
            "fechaReserva" => $arr[$i]->getFecha_reserva(),
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