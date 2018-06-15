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
     * @return array
     * @throws Exception
     */
    public function obtenerISBN($isbn){
        $arUser = array();
        $query= "SELECT l.id,"
                . "l.isbn,"
                . "l.titulo,"
                . "l.autor,"
                . "l.editorial,"
                . "l.annio,"
                . "l.cantidad,"
                . "l.categoria_id,"
                . "c.id,"
                . "c.codigo,"
                . "c.descripcion"
                . "FROM libro l"
                . "JOIN categoria c ON c.id = l.categoria_id"
                . "WHERE l.isbn=?";
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(1,$isbn);
            
            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $categoria = new Categoria($row['id'],$row['codigo'], $row['descripcion']);
                $libro = new Libro($row['id'],
                        $row['isbn'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['annio'],
                        $row['cantidad'],
                        $categoria);
                array_push($arUser, $libro);
            }
        }else{
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
    }
    
    /**
     * 
     * @return array
     * @throws Exception
     */
    public function obtenerTitulo($titulo){
        $arUser = array();
        $query= "SELECT l.id,"
                . "l.isbn,"
                . "l.titulo,"
                . "l.autor,"
                . "l.editorial,"
                . "l.annio,"
                . "l.cantidad,"
                . "l.categoria_id,"
                . "c.id,"
                . "c.codigo,"
                . "c.descripcion"
                . "FROM libro l"
                . "JOIN categoria c ON c.id = l.categoria_id"
                . "WHERE l.titulo=?";
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(1,$titulo);
            
            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $categoria = new Categoria($row['id'],$row['codigo'], $row['descripcion']);
                $libro = new Libro($row['id'],
                        $row['isbn'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['annio'],
                        $row['cantidad'],
                        $categoria);
                array_push($arUser, $libro);
            }
        }else{
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
    }
    /**
     * 
     * @return array
     * @throws Exception
     */
    public function obtenerAutor($autor){
        $arUser = array();
        $query= "SELECT l.id,"
                . "l.isbn,"
                . "l.titulo,"
                . "l.autor,"
                . "l.editorial,"
                . "l.annio,"
                . "l.cantidad,"
                . "l.categoria_id,"
                . "c.id,"
                . "c.codigo,"
                . "c.descripcion"
                . "FROM libro l"
                . "JOIN categoria c ON c.id = l.categoria_id"
                . "WHERE l.autor=?";
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(1,$autor);
            
            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $categoria = new Categoria($row['id'],$row['codigo'], $row['descripcion']);
                $libro = new Libro($row['id'],
                        $row['isbn'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['annio'],
                        $row['cantidad'],
                        $categoria);
                array_push($arUser, $libro);
            }
        }else{
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
    }
    
    /**
     * 
     * @return array
     * @throws Exception
     */
    public function obtenerEditorial($editorial){
        $arUser = array();
        $query= "SELECT l.id,"
                . "l.isbn,"
                . "l.titulo,"
                . "l.autor,"
                . "l.editorial,"
                . "l.annio,"
                . "l.cantidad,"
                . "l.categoria_id,"
                . "c.id,"
                . "c.codigo,"
                . "c.descripcion"
                . "FROM libro l"
                . "JOIN categoria c ON c.id = l.categoria_id"
                . "WHERE l.editorial=?";
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $preparedStatement->bindParam(1,$editorial);
            
            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $categoria = new Categoria($row['id'],$row['codigo'], $row['descripcion']);
                $libro = new Libro($row['id'],
                        $row['isbn'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['annio'],
                        $row['cantidad'],
                        $categoria);
                array_push($arUser, $libro);
            }
        }else{
            throw new Exception('No se pudo realizar la consulta'.$this->conexion->error);
        }
        return $arUser;
    }
    /**
     * 
     * @param libro $data
     */
    public function elmiminar($data){
        
    }

}
