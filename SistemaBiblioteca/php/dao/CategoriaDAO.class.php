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
        
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function obtener($data){
        
    }
    
    /**
     * 
     * @param categoria $data
     */
    public function elmiminar($data){
        
    }
    
}
