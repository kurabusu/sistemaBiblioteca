<?php
require '../dao/LibroDAO.class.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    echo json_encode(ObtenerListado() );
}else{
     echo "request_method incorrecto";
}

function ObtenerListado(){
    $categoria = new categoria(null, null, null);
    
    if(isset($_GET["categoria"]) && strlen($_GET["categoria"]) >0 ){
        $categoria->setDescripcion($_GET["categoria"]);
    }
    
    $libro = new Libro(null, null, null, null, null, null, null, $categoria, null, null);
    
    if(isset($_GET["isbn"]) && strlen($_GET["isbn"]) >0){
        $libro->setIsbn($_GET["isbn"]);
    }
    
    if(isset($_GET["titulo"]) && strlen($_GET["titulo"]) >0){
        $libro->setTitulo($_GET["titulo"]);
    }
    
    if(isset($_GET["autor"]) && strlen($_GET["autor"]) >0 ){
        $libro->setAutor($_GET["autor"]);
    }
    
    if(isset($_GET["editorial"]) && strlen($_GET["editorial"]) >0 ){
        $libro->setEditorial($_GET["editorial"]); 
    }
    
    
    $p = new LibroDAO();
    $arr = $p->obtener($libro);
    
    $lista = array();
    for ($i = 0; $i<count($arr);$i++){
        array_push($lista, array(
            "id"=>$arr[$i]->getId(),
            "isbn"=>$arr[$i]->getIsbn(),
            "titulo"=>$arr[$i]->getTitulo(),
            "autor"=>$arr[$i]->getAutor(),
            "editorial"=>$arr[$i]->getEditorial(),
            "año"=>$arr[$i]->getAnnio(),
            "cantidad"=>$arr[$i]->getCantidad(),
            "categoria"=>$arr[$i]->getCategoria()
            
        ));
    }
    return array("resultado" => $lista);
}
