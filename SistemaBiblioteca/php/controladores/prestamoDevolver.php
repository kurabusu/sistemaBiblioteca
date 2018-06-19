<?php
include '../dao/PrestamoDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode(ReservaEliminar());
} else {
    echo "request_method incorreco";
}

function ReservaEliminar(){
    parse_str(file_get_contents("php://input"),$delete);
    
    $prestamoDAO = new PrestamoDAO();
    $persona = new Persona(null, null, null, null, null, null, null, null, null);
    $libro = new Libro(null, null, null, null, null, null, null, null, null, null);
    $prestamo = new Prestamo(null, null, $persona, $libro);
    
    if(isset($delete["prestamo"]) && $delete["prestamo"] > 0){
        $prestamo->setId($delete["prestamo"]);
    }else{
        return array("resultado" => "Falta el prestamo.");
    } 
     
    $r = $prestamoDAO->eliminar($prestamo);
    
    return array("resultado" => $r);
    
    
}
