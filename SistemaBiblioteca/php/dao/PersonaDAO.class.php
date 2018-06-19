<?php
require_once __DIR__.'/../conexion/DBConexion.class.php';
require_once __DIR__.'/../modelo/Usuario.class.php';
require_once __DIR__.'/../modelo/Perfil.class.php';
require_once __DIR__.'/../modelo/Persona.class.php';

class PersonaDAO {
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
    public function Obtener($clave) {
        $arUser = array();
        $query = "SELECT p.id," 
            ." p.rut, "
            ." p.nombres, "
            ." p.apellidos, "
            ." p.email, "
            ." p.telefono, "
            ." pe.id as idperfil, "
            ." pe.descripcion, "
            ." pe.estado, "
            ." p.estado from persona p"
            ." JOIN usuario u on u.persona_id=p.id"
            ." JOIN perfil pe on u.perfil_id=pe.id"
            ." WHERE UPPER(p.rut) LIKE UPPER(concat(?,'%')) OR"
            ." UPPER(p.nombres) LIKE UPPER(concat(?,'%')) OR"
            ." UPPER(p.apellidos) LIKE UPPER(concat(?,'%'))";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(1,$clave);
            $preparedStatement->bindParam(2,$clave);
            $preparedStatement->bindParam(3,$clave);
            
            $preparedStatement->execute();
            
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $perfil = new Perfil($row['idperfil'], 
                        $row['descripcion'], 
                        $row['estado']);
                $persona = new Persona($row['id'],
                        $row['rut'],
                        $row['nombres'],
                        $row['apellidos'],
                        $row['email'],
                        $row['telefono'],
                        $row['estado'],
                        $perfil,
                        null);
                
                array_push($arUser,$persona);
            }
        } else {
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
                
    }
    
    

    public function ObtenerPorId($id) {
        $arUser = array();
        $query = "SELECT p.id, p.rut, p.nombres, p.apellidos, p.email, p.telefono, p.estado, u.perfil_id from persona p"
                ." JOIN usuario u on p.id=u.persona_id where p.id=?";
        
        $preparedStatement = $this->conexion->prepare($query);
        if ($preparedStatement != false){
            $preparedStatement->bindParam(1,$id);
            
            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $persona = new Persona($row['id'],
                        $row['rut'],
                        $row['nombres'],
                        $row['apellidos'],
                        $row['email'],
                        $row['telefono'],
                        $row['estado'],
                        $row['perfil_id'],
                        0);
                array_push($arUser, $persona);
            }
        }else{
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
    }
    
    public function VerificarRut($rut){
        $query = "select count(id) as total from persona where rut=:rut";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(':rut',$rut,PDO::PARAM_STR);
            $preparedStatement->execute();
            $total = $preparedStatement->fetch();
            return $total["total"];
        }
        return -1;
    }
    
    public function VerificarCorreo($correo){
        $query = "select count(id) as total from persona where email=:email";
        
        $preparedStatement = $this->conexion->prepare($query);
        
        if($preparedStatement !== false){
            $preparedStatement->bindParam(':email',$correo,PDO::PARAM_STR);
            $preparedStatement->execute();
            $total = $preparedStatement->fetch();
            return $total["total"];
        }
        return -1;
    }

    public function ingresar($persona) {
        $query = "insert into persona (rut, nombres, apellidos, email, telefono, estado) values "
                . "(?,?,?,?,?,?)";
        
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement !== false){
            $rut = $persona->getRut();
            $nombres = $persona->getNombres();
            $apellidos = $persona->getApellidos();
            $telefono = $persona->getTelefono();
            $mail = $persona->getEmail();
            $estado = 1;
            
            $preparedStatement->bindParam(1,$rut);
            $preparedStatement->bindParam(2,$nombres);
            $preparedStatement->bindParam(3,$apellidos);
            $preparedStatement->bindParam(4,$mail);
            $preparedStatement->bindParam(5,$telefono);
            $preparedStatement->bindParam(6,$estado);
            
            $preparedStatement->execute();
            
            $id = $this->conexion->lastInsertId();
            
            return $id;
        }else{
            throw new Exception('no se pudo preparar la consulta a la base datos: '.$this->conexion->error);
        }
    }

    /**
     * @param Persona $element
     */
    public function update($element) {
        $query = "update persona set nombres=?, apellidos=?, email=?, telefono=? where id=?";
        $resultado = 0;
        
        $prepareStatement =$this->conexion->prepare($query);
        if($prepareStatement!==false){
            $nombres = $element->getNombres();
            $prepareStatement->bindParam(1,$nombres);
            
            $apellidos = $element->getApellidos();
            $prepareStatement->bindParam(2,$apellidos);
            
            $email = $element->getEmail();
            $prepareStatement->bindParam(3,$email);
            
            $telefono = $element->getTelefono();
            $prepareStatement->bindParam(4,$telefono);
            
            $id = $element->getId();
            $prepareStatement->bindParam(5,$id);
            
            $prepareStatement->execute();
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
            return -1;
        }
        return $resultado;
    }
    
    /**
     * 
     * @param Persona $element
     */
    public function CambiarEstado($element){
        $query = "UPDATE persona set estado=? where id=?";
        
        $stmt = $this->conexion->prepare($query);
        if($stmt!=false){
            $estado = $element->getEstado();
            $stmt->bindParam(1,$estado);
            
            $id = $element->getId();
            $stmt->bindParam(2, $id);
            
            
            $stmt->execute();
            return 0;
        }else{
            throw new Exception('no se pudo preparar la consulta: '.$this->conexion->error);
            return -1;
        }
    }

}
