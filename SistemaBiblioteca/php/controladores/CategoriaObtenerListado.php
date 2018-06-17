<?php
include '../dao/CategoriaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(getCategoria());
} else {
    echo "request_method incorrecto";
}

function getCategoria(){
    $categoriaDao = new CategoriaDAO();
    $arr = $categoriaDao->obtenerII();
    
    $lista = array();
    for ($i = 0; $i < count($arr); $i++) {
        array_push($lista, array(
            "id" => $arr[$i]->getid(),
            "codigo" => $arr[$i]->getCodigo(),
            "descripcion" => $arr[$i]->getDescripcion()
            ));
    }
    return $lista;
}