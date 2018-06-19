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
    
    /**
     * 
     * @param Prestamo $data
     * @return array
     * @throws Exception
     */
    public function obtener($data){
        $query = "select pr.id, pr.fecha_entrega, pr.persona_id, p.rut, p.nombres, p.apellidos, "
                . " pr.libro_id, l.isbn, l.titulo  "
                . " from prestamo pr "
                . " LEFT JOIN persona p on p.id = pr.persona_id "
                . " LEFT JOIN libro l on l.id = pr.libro_id ";
        $prestamo = array();
        
        $query2 = '';
        
        if($data->getFechaEntrega() != null){
            $query2 .= " pr.fecha_entrega like concat(?,'%') ";
        }
        
        if($data->getPersona()->getNombres() != null){
            if($query2 != '') $query2 .=" or ";
            $query2 .= " p.nombres like concat(?,'%') ";
        }
        
        if($data->getPersona()->getApellidos() != null){
            if($query2 != '') $query2 .=" or ";
            $query2 .= " p.apellidos like concat(?,'%') ";
        }
        
        if($data->getLibro()->getTitulo() != null){
            if($query2 != '') $query2 .=" or ";
            $query2 .= " l.titulo like concat(?,'%') ";
        }
        
        if($query2 != ''){
            $query2 = ' where '.$query2;
        }
        
        $query .= $query2;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $i = 1;
            if($data->getFechaEntrega() != null){
                $fecha = $data->getFechaEntrega();
                $preparedStmt->bindParam($i++, $fecha);
            }

            if($data->getPersona()->getNombres() != null){
                $nomb = $data->getPersona()->getNombres();
                $preparedStmt->bindParam($i++, $nomb);
            }
            
            if($data->getPersona()->getApellidos() != null){
                $nomb = $data->getPersona()->getApellidos();
                $preparedStmt->bindParam($i++, $nomb);
            }

            if($data->getLibro()->getTitulo() != null){
                $tit = $data->getLibro()->getTitulo();
                $preparedStmt->bindParam($i++, $tit);
            } 
            
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
    
    /**
     * 
     * @param Prestamo $data
     * @return type
     * @throws Exception
     */
    public function eliminar($data){
        $query = "delete from prestamo where id = ?";
        $reserva = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $id = $data->getId();
            $preparedStmt->bindParam(1, $id);
            
            $preparedStmt->execute();
            
            $c = $preparedStmt->rowCount();
            
            $reserva= $c;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $reserva; 
    }


}
