<?php
include_once '../conexion/DBConexion.class.php';
include_once '../modelo/Reserva.class.php';
include_once '../modelo/Libro.class.php';
include_once '../modelo/Persona.class.php';

class ReservaDAO {
    private $conexion = null;
     
    public function __construct() {
        $this->conexion = DBConexion::getInstance()->getConexion();
    }
    
    /**
     * 
     * @param Reserva $data
     */
    public function ingresar($data){
        $query = "insert into(fecha_reserva, persona_id, libro_id) values(?, ?, ?) ";
        $reserva = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $fecha = $data->getFecha_reserva();
            $preparedStmt->bindParam(1, $fecha);
            
            $persona_id = $data->getPersona()->getId();
            $preparedStmt->bindParam(2, $persona_id);
            
            $libro_id = $data->getLibro()->getId();
            $preparedStmt->bindParam(3, $libro_id);
            
            $preparedStmt->execute();
            
            $c = $this->conexion->lastInsertId();
            
            $reserva = $c;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $reserva; 
    }
    
    /**
     * 
     * @param Reserva $data
     */
    public function modificar($data){
        $query = "update reserva set fecha_reserva=?, persona_id=?, libro_id=? where id =?";
        $reserva = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
            $fecha = $data->getFecha_reserva();
            $preparedStmt->bindParam(1, $fecha);
            
            $persona_id = $data->getPersona()->getId();
            $preparedStmt->bindParam(2, $persona_id);
            
            $libro_id = $data->getLibro()->getId();
            $preparedStmt->bindParam(3, $libro_id);
            
            $preparedStmt->execute();
            
            $c = $preparedStmt->rowCount();
            
            $reserva= $c;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $reserva; 
    }
    
    /**
     * 
     * @param Reserva $data
     */
    public function obtener($data){
        $query = "SELECT r.id, r.fecha_reserva, r.persona_id, p.rut, p.nombres, p.apellidos, r.libro_id, l.isbn, l.titulo "
                ." FROM reserva r "
                ." LEFT JOIN persona p on p.id = r.persona_id "
                ." LEFT JOIN libro l on l.id = r.libro_id "
                ." ";
        $reserva = array();
        
        $query2 = '';
        
        if($data->getFecha_reserva() != null){
            $query2 .= " r.fecha_reserva like concat(?,'%') ";
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
            if($data->getFecha_reserva() != null){
                $fecha = $data->getFecha_reserva();
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
                //$d = new categoria($row["id"], $row["codigo"], $row["descripcion"]);
                $persona = new Persona($row["persona_id"], $row["rut"], $row["nombres"], $row["apellidos"], null, null, null, null, null);
                $libro = new Libro($row["libro_id"], $row["isbn"], $row["titulo"], null, null, null, null, null, null, null);
                $r = new Reserva($row["id"], $row["fecha_reserva"], $persona, $libro);
                
                array_push($reserva, $r);
            }
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $reserva; 
    }
    
    /**
     * 
     * @param Reserva $data
     */
    public function eliminar($data){
        $query = "";
        $reserva = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $reserva; 
    }

    
}
