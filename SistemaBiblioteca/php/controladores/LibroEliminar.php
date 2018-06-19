<?php
include '../dao/LibroDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode(eliminarLibro());
} else {
    echo "request_method incorrecto";
}

function eliminarLibro(){
    parse_str(file_get_contents("php://input"),$delete);
   
    if(!isset($delete["id"])){
        return array("resultado:{mensaje:'Falta el id.'}" );   
    }
    $libro = new Libro($delete["id"], null, null, null,
            null, null, null, null, null, null);
    $libroDAO = new LibroDAO();
    $m = $libroDAO->elmiminar($libro);
    return ["resultado" => $m];
}
