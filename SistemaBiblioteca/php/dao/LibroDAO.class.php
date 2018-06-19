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
        $query = "insert into libro(isbn, titulo, autor, editorial, annio, cantidad, categoria_id) values(?,?,?,?,?,?,?)";
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
        
        $query = "update libro set isbn=?, titulo=?, autor=?, editorial=?, annio=?"
                . ", cantidad=?, categoria_id=? WHERE id=?";
        $l=0;
        
        $preparedStmt= $this->conexion->prepare($query);
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
            
            $id = $data->getId();
            $preparedStmt->bindParam(8, $id);
            $preparedStmt->execute();
            
            $c = $preparedStmt->rowCount();
            
            $l = $c;   
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        return $l;    
    }

    /**
     * 
     * @param Libro $data
     * @return array
     * @throws Exception
     */
    public function obtener($data){
        $arUser = array();
        $query= "SELECT l.id, l.isbn, l.titulo, l.autor, l.editorial, l.annio,"
                . " l.cantidad, l.categoria_id, c.id as 'idcategoria', c.codigo, c.descripcion"
                . " FROM libro l "
                . " LEFT JOIN categoria c ON c.id = l.categoria_id";
        
        $query2 = "";
        
        if($data->getIsbn() != null){
            $query2 .= " l.isbn like concat(?,'%')";
        }
        
        if($data->getTitulo() != null){
            if($query2 != '') $query2.=" or ";
            $query2 .= " l.titulo like concat(?,'%')";
        }
        
        if($data->getAutor() != null){
            if($query2 != '') $query2.=" or ";
            $query2 .= " l.autor like concat(?,'%')";
        }
        
        if($data->getEditorial() != null){
            if($query2 != '') $query2.=" or ";
            $query2 .= " l.editorial like concat(?,'%')";
        }
              
        if($query2 != ''){
            $query .= " WHERE ". $query2;    
        }      
       
        $preparedStatement = $this->conexion->prepare($query);
        if($preparedStatement != false){
            $i = 1;
            if($data->getIsbn() != null){
                $isbn = $data->getIsbn();
                $preparedStatement->bindParam($i++,$isbn);
            }

            if($data->getTitulo() != null){
                $tit = $data->getTitulo();
                $preparedStatement->bindParam($i++,$tit);
            }
            
            if($data->getAutor() != null){
                $aut = $data->getAutor();
                $preparedStatement->bindParam($i++,$aut);
            }
            
            if($data->getEditorial() != null){
                $edi = $data->getEditorial();
                $preparedStatement->bindParam($i++,$edi);
            } 

            $preparedStatement->execute();
            foreach ($preparedStatement->fetchAll(PDO::FETCH_ASSOC) as $row){
                $categoria = new Categoria($row['idcategoria'],$row['codigo'], $row['descripcion']);
                $libro = new Libro($row['id'],
                        $row['isbn'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['annio'],
                        $row['cantidad'],
                        $categoria,
                        null,null);
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
        $query = "delete from libro where id=?";
        $libro=0;
        
        $preparedStmt= $this->conexion->prepare($query);
        
        if($preparedStmt !== false){
            $id = $data->getId();
            $preparedStmt->bindParam(1, $id);
            $preparedStmt->execute();
            $c = $preparedStmt->rowCount();
            
            $libro= $c;
        }else{
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $libro;
    }

}
