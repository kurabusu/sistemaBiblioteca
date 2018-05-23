<?php

class DBConexion {
    private $USER = "root";
    private $PASSWORD = "";
    private $DSN = 'mysql:host=localhost;dbname=db_biblioteca;charset=utf8';
    
    private static $instancia;
    private $cnx;
    
    private function __construct() {
        $this->cnx = new PDO($this->DSN, $this->USER, $this->PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }
    
    public static function getInstance(){
        if (!self::$instancia instanceof self ){
            self::$instancia = new self;
        }
        return self::$instancia;
    }
    
    public function getConexion(){
        return $this->cnx;
    }
}
