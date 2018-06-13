<?php
require_once __DIR__.'/../conexion/DBConexion.class.php';
require_once __DIR__.'/../modelo/Usuario.class.php';
require_once __DIR__.'/../modelo/Perfil.class.php';
require_once __DIR__.'/../modelo/Persona.class.php';

class UsuarioDAO {
    private $conexion;
    
    function __construct() {
        $d = DBConexion::getInstance();
        $this->conexion = $d->getConexion();
    }
            
            
    public function delete($id) {
        
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    public function getAll() {
        $arUser = array();
        $query = "SELECT p.id, p.rut, p.nombres, p.apellidos, p.email, p.telefono, pe.descripcion, p.estado from persona p 
JOIN usuario u on u.persona_id=p.id
JOIN perfil pe on u.perfil_id=pe.id;";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->execute();
            
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $usuario = new Usuario($row['id'],
                        $row['rut'],
                        $row['nombres'],
                        $row['apellidos'],
                        $row['email'],
                        $row['telefono']);
                        
                
                array_push($arUser,$usuario);
            }
        } else {
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
                
    }

    public function getById($id) {
        
    }

    public function insert($element) {
        
    }

    public function update($element) {
        
    }

}
