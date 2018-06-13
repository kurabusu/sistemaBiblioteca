<?php
include '../dao/CategoriaDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(categoriaObtener());
} else {
    echo "request_method incorreco";
}

function categoriaObtener(){
    
    $categoria = new categoria(null, null, null);
    if(isset($_GET["id"])){
        $categoria->setId($_GET["id"]);
    }
    
    if(isset($_GET["codigo"]) && strlen($_GET["codigo"]) > 0 ){
        $categoria->setCodigo($_GET["codigo"]);
    }
    
    if(isset($_GET["descripcion"]) && strlen($_GET["descripcion"]) > 0){
        $categoria->setDescripcion($_GET["descripcion"]);
    }
    
    $categoriaDao = new CategoriaDAO();
    $arr = $categoriaDao->obtener($categoria);
    
    $lista = array();
    for ($i = 0; $i < count($arr); $i++) {
        array_push($lista, array(
            "id" => $arr[$i]->getid(),
            "codigo" => $arr[$i]->getCodigo(),
            "descripcion" => $arr[$i]->getDescripcion()
            ));
    }
    
    return array("resultado" => $lista);
    
}