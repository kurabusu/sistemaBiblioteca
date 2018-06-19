<?php
include '../dao/LibroDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode(eliminarLibro());
} else {
    echo "request_method incorrecto";
}

function eliminarLibro(){
    parse_str(file_get_contents("php://input"),$delete);
    
    print_r($delete);
    if(isset($delete["libro"]) && $delete["libro"] >0){
    } else {
        return array("resultado" => 'Falta el libro.' );   
    }
    
    $libro = new Libro($delete["libro"], null, null, null, null, null, null, null, null, null);
    $libroDAO = new LibroDAO();
    $m = $libroDAO->elmiminar($libro);
    
    return array("resultado" => $m);
}
