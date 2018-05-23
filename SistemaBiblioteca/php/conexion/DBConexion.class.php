<?php

class DBConexion {
    private $USER = "";
    private $PASSWORD = "";
    private $DSN = 'mysql:host=localhost;dbname=db_biblioteca;charset=utf8';
    
    private static $instance;
    private $cnx;
    
    private function __construct() {
        $this->cnx = new PDO($this->DSN, $this->$USER, $this->$PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }
    
    public function getInstance(){
        if (!self::$instance instanceof self ){
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function getConexion(){
        return $this->cnx;
    }
}
