<?php
require __DIR__. '/../dao/LibroDAO.class.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    echo json_encode(ObtenerListado($_GET["clave"]));
}
