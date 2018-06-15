<?php
include_once '../conexion/DBConexion.class.php';
include_once '../modelo/Prestamo.class.php';


class PrestamoDAO {
    
    private $conexion = null;
     
    public function __construct() {
        $this->conexion = DBConexion::getInstance()->getConexion();
    }
    
    /**
     * 
     * @param Prestamo $data
     */
    public function ingresar($data){
        $query = "insert into prestamo(fecha_entrega, persona_id, libro_id) values(?,?,?)";
        $prestamo;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $fecha_entrega = $data->getFechaEntrega();
            $preparedStmt->bindParam(1, $fecha_entrega);
            
            $persona_id = $data->getPersona()->getId();
            $preparedStmt->bindParam(2, $persona_id);
            
            $libro_id = $data->getLibro()->getId(); 
            $preparedStmt->bindParam(3, $libro_id);
            
            $preparedStmt->execute();
            
            $id = $this->conexion->lastInsertId(); 
            $prestamo = $id;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $prestamo;
    }
    
    /**
     * 
     * @param Prestamo $data
     */
    public function modificar($data){
        $query = "update prestamo set fecha_entrega=?, persona_id=?, libro_id=? where id=? ";
        $prestamo;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $fecha_entrega = $data->getFechaEntrega();
            $preparedStmt->bindParam(1, $fecha_entrega);
            
            $persona_id = $data->getPersona()->getId();
            $preparedStmt->bindParam(2, $persona_id);
            
            $libro_id = $data->getLibro()->getId(); 
            $preparedStmt->bindParam(3, $libro_id);
            
            $id = $data->getId(); 
            $preparedStmt->bindParam(4, $id);
            
            $preparedStmt->execute();
            $c = $preparedStmt->rowCount();
            
            $categoria = $c;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $prestamo;
    }
    
    public function obtener($data){
        $query = "select * from prestamo";
        $prestamo;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $preparedStmt->execute();
            while ($row = $preparedStmt->fetch(PDO::FETCH_ASSOC)) {
                
            }
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $prestamo;
    }
}
