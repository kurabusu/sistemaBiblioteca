<?php
require_once __DIR__.'/AbstractDAO.class.php';
require_once __DIR__.'/../conexion/DBConexion.class.php';
require_once __DIR__.'/../modelo/Usuario.class.php';
require_once __DIR__.'/../modelo/Perfil.class.php';

class UsuarioDAO implements AbstractDAO{
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
        $query = "SELECT u.id,"
                . " u.username,"
                . " u.password,"
                . " u.estado,"
                . " u.perfil_id,"
                . " u.persona_id"
                . " from usuario u where 1";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->execute();
            
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $usuario = new Usuario($row['id'],
                        $row['username'],
                        $row['password'],
                        $row['estado'],
                        $row['perfil_id'],
                        $row['persona_id']);
                
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
