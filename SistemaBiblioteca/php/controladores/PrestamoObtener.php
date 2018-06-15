<?php
include '../dao/PrestamoDAO.class.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(prestamoObtener());
} else {
    echo "request_method incorreco";
}

function  prestamoObtener(){
    
    
    
    
    
    $r = null;
    return array("resultado" => $r);
}