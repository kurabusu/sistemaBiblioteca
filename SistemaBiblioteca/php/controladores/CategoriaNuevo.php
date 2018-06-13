<?php
include '../dao/CategoriaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(categoriaNuevo());
} else {
    echo "request_method incorreco";
}

function categoriaNuevo(){
    $categoria = new categoria(null, null, null);
    $categoriaDao = new CategoriaDAO();
    
    if(isset($_POST["codigo"]) && strlen($_POST["codigo"]) > 0 ){
       
        $cant = $categoriaDao->obtener(new categoria(null, $_POST["codigo"], null)); 
        if(count($cant) == 0){
            $categoria->setCodigo($_POST["codigo"]);
        }else{
            return array("resultado" => "El código ya esta ocupado.");
        }
    }else{
        return array("resultado" => "Falta el código.");
    }
    
    if(isset($_POST["descripcion"]) && strlen($_POST["descripcion"]) > 0){
        $categoria->setDescripcion($_POST["descripcion"]);
    
    }else{
        return array("resultado" => "Falta la descripción.");
    }
    
    $arr = $categoriaDao->obtener($categoria);
    
    
    $categoriaDao = new CategoriaDAO();
    $r = $categoriaDao->ingresar($categoria);
    
    return array("resultado" => $r);
    
}