<?php
include '../dao/LibroDAO.class.php';
include '../dao/CategoriaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo json_encode(nuevoLibro());
}else{
    echo "request_method incorrecto";
}

function nuevoLibro(){
    $libro = new Libro(null, null, null, null, null, null, null, null);
    $libroDAO = new LibroDAO();
    
    if(isset($_POST["isbn"]) && strlen($_POST["isbn"]) >= 10){
        if(is_numeric($_POST["isbn"])){
            $libro->setIsbn($_POST["isbn"]);
        }else{
            return array("resultado" => "Ingrese sólo Números.");
        }
    }else{
        return array("resultado" => "El ISBN debe Tener 10 números o más.");
    }
    
    if(isset($_POST["titutlo"]) && strlen($_POST["titulo"])>0){
        $libro->setTitulo($_POST["titulo"]);
    }else{
        return array("resultado" => "Ingrese el título del Libro.");
    }
    
    if(isset($_POST["autor"]) && strlen($_POST["autor"])>0){
        $libro->setAutor($_POST["autor"]);
    }else{
        return array("resultado" => "Ingrese el nombre del Autor.");
    }
    
    if(isset($_POST["editorial"]) && strlen($_POST["editorial"])>0){
        $libro->setEditorial($_POST["editorial"]);
    }else{
        return array("resultado" => "Ingrese el nombre de la Editorial.");
    }
    
    if(isset($_POST["anno"]) && strlen($_POST["anno"])>0){
        $libro->setAnnio($_POST["anno"]);
    }else{
        return array("resultado" => "Ingrese el año de Edición.");
    }
    
    if(isset($_POST["categoria"])==""){
        $libro->setCategoria($_POST["categoria"]);
    }else{
        return array("resultado" => "Escoja una Categoria.");
    }
    
    if(isset($_POST["cantidad"])>0){
        $libro->setCantidad($_POST["cantidad"]);
    }else{
        return array("resultado" => "Ingrese la cantidad.");
    }
    $libroDAO = new LibroDAO();
    $nuevoLibro = $libroDAO->ingresar($libro);
}
