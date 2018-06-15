<?php
include '../dao/PrestamoDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(prestamosNuevo());
} else {
    echo "request_method incorreco";
}

function prestamosNuevo(){

    
    $r = null;
    return array("resultado" => $r);    
}