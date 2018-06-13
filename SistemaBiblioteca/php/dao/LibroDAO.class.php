<?php
include_once '../conexion/DBConexion.class.php';
include_once '../modelo/Libro.class.php';
include_once '../modelo/Categoria.class.php';


class LibroDAO {
    
    private $conexion = null;
    
    function __construct() {
        $this->conexion = DBConexion::getInstance()->getConexion();
    }
    
     /**
     * 
     * @param libro $data
     */
    public function ingresar($data){
        $query = "insert into libro(id, isbn, titulo, autor, editorial, annio, cantidad, categoria_id) values(?,?,?,?,?,?,?,?)";
        $libro = 0;
        
        $preparedStmt = $this->conexion->prepare($query);
        if($preparedStmt !== false){
            $isbn = $data->getIsbn();
            $preparedStmt->bindParam(1, $isbn);
            
            $titulo = $data->getTitulo();
            $preparedStmt->bindParam(2, $titulo);
            
            $autor = $data->getAutor();
            $preparedStmt->bindParam(3, $autor);
            
            $editorial = $data->getEditorial();
            $preparedStmt->bindParam(4, $editorial);
            
            $annio = $data->getAnnio();
            $preparedStmt->bindParam(5, $annio);
            
            $cantidad = $data->getCantidad();
            $preparedStmt->bindParam(6, $cantidad);
            
            $categoria = $data->getCategoria();
            $preparedStmt->bindParam(7, $categoria);
            
            $preparedStmt->execute();
            
            $id = $this->conexion->lastInsertId(); 
            
            return $id;
            
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $libro; 
    }
    
    /**
     * 
     * @param libro $data
     */
    public function modificar($data){
        
        $query = "update libro set";
    }
    
    /**
     * 
     * @param libro $data
     */
    public function obtener($data){
        
    }
    
    /**
     * 
     * @param libro $data
     */
    public function elmiminar($data){
        
    }

}
