<?php
include '../dao/CategoriaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(categoriaNuevo());
} else {
    echo "request_method incorreco";
}

function categoriaNuevo(){
    
    $categoria = new categoria(null, $_POST["codigo"], $_POST["descripcion"]);
    
    $categoriaDao = new CategoriaDAO();
    $r = $categoriaDao->ingresar($categoria);
    
    return array("resultado" => $r);
    
}