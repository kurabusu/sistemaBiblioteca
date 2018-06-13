<?php
include '../dao/CategoriaDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    echo json_encode(categoriaModificar());
} else {
    echo "request_method incorreco";
}

function categoriaModificar(){
    parse_str(file_get_contents("php://input"),$put);
    
    if(!isset($put["id"])){
        return array("resultado:{mensaje:'Falta el id.'}" );
        
    }
    
    if(!isset($put["codigo"])){
        return array("resultado:{mensaje:'Falta el codigo.'}" );
        
    }
    
    if(!isset($put["descripcion"])){
        return array("resultado:{mensaje:'Falta la descripcion.'}" );
        
    }
    
    $categoria = new categoria($put["id"], $put["codigo"], $put["descripcion"] );
    
    $categoriaDao = new CategoriaDAO();
    $r = $categoriaDao->modificar($categoria);
    
    return array("resultado" => $r);
    
}