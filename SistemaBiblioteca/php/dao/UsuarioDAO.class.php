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

    /**
     * 
     * @param Usuario $usuario
     * @return boolean
     * @throws Exception
     */
    public function insertar($usuario) {
        $query = "insert into usuario (username, password, estado, perfil_id, persona_id) values (?,?,?,?,?)";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement !== false){
            $username = $usuario->getUsername();
            $password = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);
            $estado = $usuario->getEstado();
            $perfil = $usuario->getPerfilId();
            $idpersona = $usuario->getPersonaId();
            
            $preparedStatement->bindParam(1,$username);
            $preparedStatement->bindParam(2,$password);
            $preparedStatement->bindParam(3,$estado);
            $preparedStatement->bindParam(4,$perfil);
            $preparedStatement->bindParam(5,$idpersona);
            
            $preparedStatement->execute();
            
            return $this->conexion->lastInsertId();
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        return false;
    }

    /**
     * 
     * @param Usuario $element
     */
    public function update($element) {
        $query = "update usuario set username=?, perfil_id=? where persona_id=?";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement !== false){
            $username = $element->getUsername();
            $preparedStatement->bindParam(1,$username);
            
            $perfil = $element->getPerfilId();
            $preparedStatement->bindParam(2, $perfil);
            
            $personaid = $element->getPersonaId();
            $preparedStatement->bindParam(3,$personaid);
            
            $preparedStatement->execute();
            return 0;
         
        }else{
            throw new Exception('no se pudo realizar la consulta: '.$this->conexion->error);
            return -1;
        }
    }
    
    /**
     * 
     * @param Usuario $element
     */
    public function ActualizarClave($element){
        $query = "UPDATE usuario set password=? where persona_id=?";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement!=false){
            $password = $element->getPassword();
            $preparedStatement->bindParam(1,$password);
            
            $idpersona = $element->getPersonaId();
            $preparedStatement->bindParam(2,$idpersona);
            
            $preparedStatement->execute();
            return 0;
        }else{
            throw new Exception('no se pudo preparar la consulta: '.$this->conexion->error);
            return -1;
        }
    }

}
