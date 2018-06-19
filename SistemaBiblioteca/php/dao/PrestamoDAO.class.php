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
        $query = "insert into prestamo(fecha_entrega, persona_id, libro_id) values(DATE_ADD(NOW(), INTERVAL 7 DAY),?,?)";
        $prestamo;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $persona_id = $data->getPersona()->getId();
            $preparedStmt->bindParam(1, $persona_id);
            
            $libro_id = $data->getLibro()->getId(); 
            $preparedStmt->bindParam(2, $libro_id);
            
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
        $query = "select pr.id, pr.fecha_entrega, pr.persona_id, p.rut, p.nombres, p.apellidos, "
                . " pr.libro_id, l.isbn, l.titulo  "
                . " from prestamo pr "
                . " LEFT JOIN persona p on p.id = pr.persona_id "
                . " LEFT JOIN libro l on l.id = pr.libro_id ";
        $prestamo = array();
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $preparedStmt->execute();
            while ($row = $preparedStmt->fetch(PDO::FETCH_ASSOC)) {
                $persona = new Persona($row["persona_id"], $row["rut"], $row["nombres"], $row["apellidos"], null, null, null, null, null);
                $libro = new Libro($row["libro_id"], $row["isbn"], $row["titulo"], null, null, null, null, null, null, null);
                
                $p = new Prestamo($row["id"], $row["fecha_entrega"], $persona, $libro);
            
                array_push($prestamo, $p); 
            }
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $prestamo;
    }
}
