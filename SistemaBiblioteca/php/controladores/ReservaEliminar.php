<?php
include '../dao/ReservaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode(ReservaEliminar());
} else {
    echo "request_method incorreco";
}

function ReservaEliminar(){
    parse_str(file_get_contents("php://input"),$delete);
    
    $reservaDAO = new ReservaDAO();
    $persona = new Persona(null, null, null, null, null, null, null, null, null);
    $libro = new Libro(null, null, null, null, null, null, null, null, null, null);
    $reserva = new Reserva(null, null, $persona, $libro);
    
    if(isset($delete["reserva"]) && $delete["reserva"] > 0){
        $reserva->setId($delete["reserva"]);
    }else{
        return array("resultado" => "Falta la reserva.");
    }
    
     $r = $reservaDAO->eliminar($reserva);
    
    return array("resultado" => $r);
    
    
}