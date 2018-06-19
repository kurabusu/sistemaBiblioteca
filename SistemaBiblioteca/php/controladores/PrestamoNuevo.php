<?php
include '../dao/PrestamoDAO.class.php';
include '../dao/ReservaDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(prestamosNuevo());
} else {
    echo "request_method incorreco";
}

function prestamosNuevo(){
    $prestamoDao = new PrestamoDAO();
    $persona = new Persona(null, null, null, null, null, null, null, null, null);
    $libro = new Libro(null, null, null, null, null, null, null, null, null, null);
    
    if(isset($_POST["libro"]) && strlen($_POST["libro"]) > 0){
        $libro->setId($_POST["libro"]);
    }else{
        return array("resultado" => "Falta el libro.");
    }
    
    if(isset($_POST["persona"]) && strlen($_POST["persona"]) > 0){
        $persona->setId($_POST["persona"]);
    }else{
        return array("resultado" => "Falta persona.");
    }
    
    if(isset($_POST["reserva"]) && strlen($_POST["reserva"]) > 0 ){
        $reservaDao = new ReservaDAO();
        $reserva = new Reserva($_POST["reserva"], null, $persona, $libro);
        $r2 = $reservaDao->eliminar($reserva);
    }
    
    
    $prestamo = new Prestamo(null, null, $persona, $libro);
    
    $r = $prestamoDao->ingresar($prestamo);
    return array("resultado" => $r);    
}