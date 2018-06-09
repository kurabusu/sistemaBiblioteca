<?php
include '../dao/CategoriaDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    echo json_encode($categoria);
} else {
    echo "error";
}

function categoriaNuevo(){
    parse_str(file_get_contents("php://input"),$put);
    
    $categoria = new categoria();
    $categoria->setCodigo($put["codigo"]);
    $categoria->setDescripcion($put["descripcion"]);
    
    $categoriaDao = new CategoriaDAO();
    $r = $categoriaDao->ingresar($categoria);
    
    return array("resultado" => $r);
    
}