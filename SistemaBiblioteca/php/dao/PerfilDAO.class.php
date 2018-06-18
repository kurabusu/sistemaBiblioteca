<?php
include_once '../conexion/DBConexion.class.php';
include_once '../modelo/Perfil.class.php';

Class PerfilDAO {
    
    private $conexion = null;
    
    public function __construct() {
        $this->conexion = DBConexion::getInstance()->getConexion();
    }
    
    public function ObtenerPerfiles(){
        
        $query = "SELECT id, descripcion, estado from perfil";
        
        $lista = array();
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement !== false){
            $preparedStatement->execute();
            while ($row = $preparedStatement->fetch(PDO::FETCH_ASSOC)){
                $perfil = new Perfil($row["id"], $row["descripcion"], $row["estado"]);
                array_push($lista, $perfil);
            }   
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        return $lista;
    }
}

