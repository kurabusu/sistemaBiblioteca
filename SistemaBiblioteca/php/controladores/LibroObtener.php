<?php
require __DIR__. '/../dao/LibroDAO.class.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    echo json_encode(ObtenerListado($_GET["clave"]));
}

function ObtenerListado($isbn){
    $p = new LibroDAO();
    $arr = $p->ObtenerPorId($isbn);
    
    $lista = array();
    for ($i = 0; $i<count($arr);$i++){
        array_push($lista, array(
            "id"=>$arr[$i]->getId(),
            "isbn"=>$arr[$i]->getIsbn(),
            "titulo"=>$arr[$i]->getTitulo(),
            "autor"=>$arr[$i]->getAutor(),
            "editorial"=>$arr[$i]->getEditorial(),
            "año"=>$arr[$i]->getTelefono(),
            "cantidad"=>$arr[$i]->getEstado(),
            "categoria"=>$arr[$i]->getCategoria()
            
        ));
    }
    return $lista;
}
