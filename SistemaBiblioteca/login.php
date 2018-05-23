<?php
require_once __DIR__.'/php/modelo/Usuario.class.php';
require_once __DIR__.'/php/dao/UsuarioDAO.class.php';

//if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $daoUsuario = new UsuarioDAO();
    $usuarios = $daoUsuario->getAll();
    //print_r($usuarios);
    
    foreach ($usuarios as $row){
        
        
        echo $row->getID();
        echo $row->getUsername();
    }
//}

