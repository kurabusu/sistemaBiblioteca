<?php
include_once '../conexion/DBConexion.class.php';
include_once '../modelo/Categoria.class.php';


Class CategoriaDAO {
    
    private $conexion = null;
     
    public function __construct() {
        $this->conexion = DBConexion::getInstance()->getConexion();
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function ingresar($data){
        $query = "insert into categoria(codigo, descripcion) values(?, ?)";
        $categoria = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $codigo = $data->getCodigo();
            $preparedStmt->bindParam(1, $codigo);
            
            $descripcion = $data->getDescripcion();
            $preparedStmt->bindParam(2, $descripcion);
            $preparedStmt->execute();
            
            $id = $this->conexion->lastInsertId(); 
            
            return $id;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $categoria; 
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function modificar($data){
        $query = "update categoria set codigo=?, descripcion=? where id=? ";
        $categoria = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $codigo = $data->getCodigo();
            $preparedStmt->bindParam(1, $codigo);
            
            $descripcion = $data->getDescripcion();
            $preparedStmt->bindParam(2, $descripcion);
            
            $id = $data->getId();
            $preparedStmt->bindParam(3, $id);
            
            $preparedStmt->execute();
            $c = $preparedStmt->rowCount();
            
            $categoria = $c;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        return $categoria; 
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function obtener($data){
        $query = "SELECT id, codigo, descripcion FROM categoria where 1=1 ";
        
        if($data->getCodigo() !== null){
            $query .= " and codigo like concat(?,'%') ";
        }
        
        if($data->getDescripcion() !== null){ 
            $query .= " or descripcion like concat(?,'%')";
        }
        //print_r($query);
        $lista = array();
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){ 
            $i = 1;
            if($data->getCodigo() !== null){
                $codigo = $data->getCodigo();
                $preparedStmt->bindParam($i++, $codigo);
            }

            if($data->getDescripcion() !== null){
                $descripcion = $data->getDescripcion();
                $preparedStmt->bindParam($i++, $descripcion); 
            }
            
            $preparedStmt->execute();
            while ($row = $preparedStmt->fetch(PDO::FETCH_ASSOC)) {
                $d = new categoria($row["id"], $row["codigo"], $row["descripcion"]);
                array_push($lista, $d);
            }
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        return $lista; 
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function elmiminar($data){
        
    }
    
}

