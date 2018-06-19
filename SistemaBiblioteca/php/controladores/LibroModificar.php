<?php
include '../dao/LibroDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    echo json_encode(modificarLibro());
} else {
    echo "request_method incorrecto";
}

function modificarLibro(){
    parse_str(file_get_contents("php://input"),$put);
    
    if(!isset($put["id"])){
        return array("resultado:{mensaje:'Falta el id.'}" );   
    }
    
    if(!isset($put["isbn"])){
        return array("resultado:{mensaje:'Ingrese el ISBN'}");
    }
    
    if(!isset($put["titulo"])){
        return array("resultado:{mensaje:'Ingrese el Titulo'}");
    }
    
    if(!isset($put["autor"])){
        return array("resultado:{mensaje:'Ingrese el nombre del Autor'}");
    }
    
    if(!isset($put["editorial"])){
        return array("resultado:{mensaje:'Ingrese nombre de Editorial'}");
    }
    
    if(!isset($put["anno"])){
        return array("resultado:{mensaje:'Ingrese el año de Edicion'}");
    }
    
    if(!isset($put["cantidad"])){
        return array("resultado:{mensaje:'Ingrese la cantidad disponible'}");
    }
    
    if(!isset($put["categoria"])){
        return array("resultado:{mensaje:'Escoja una Categoria'}");
    }
    
    $libro = new Libro($put["id"], $put["isbn"], $put["titulo"], $put["autor"],
            $put["editorial"], $put["anno"], $put["cantidad"], $put["categoria"], null, null);
    $libroDAO = new LibroDAO();
    $m = $libroDAO->modificar($libro);
    
    return ["resultado" => $m];
}