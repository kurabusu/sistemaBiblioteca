<?php
include '../dao/LibroDAO.class.php';
include '../dao/CategoriaDAO.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo json_encode(personaNuevo());
}else{
    echo "request_method incorrecto";
}

function nuevoLibro(){
    $libro = new Libro(0,
            $_POST["isbn"],
            $_POST["titulo"],
            $_POST["autor"],
            $_POST["editorial"],
            $_POST["annio"],
            $_POST["cantidad"],
            $_POST["categoria"]);
    
    $libroDAO = new LibroDAO();
    $nuevoLibro = $libroDAO->ingresar($libro);
}
