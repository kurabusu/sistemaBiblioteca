<?php
include '../dao/ReservaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(ReservaNuevo());
} else {
    echo "request_method incorreco";
}

function  ReservaNuevo(){
    $reservaDAO = new ReservaDAO();
    $persona = new Persona(null, null, null, null, null, null, null, null, null);
    $libro = new Libro(null, null, null, null, null, null, null, null, null, null);
    
    if(isset($_POST["libro"]) && $_POST["libro"] > 0){
        $libro->setId($_POST["libro"]);
    }else{
        return array("resultado" => "Falta el libro.");
    }
    
    if(isset($_POST["persona"]) && $_POST["persona"] > 0){
        $persona->setId($_POST["persona"]);
    }else{
        return array("resultado" => "Falta persona.");
    }
    
    $reserva = new Reserva(null, null, $persona, $libro);
    
    $r = $reservaDAO->ingresar($reserva);
    
    return array("resultado" => $r);
}