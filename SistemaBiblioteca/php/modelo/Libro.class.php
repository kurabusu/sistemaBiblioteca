<?php

class Libro{
 
    private $id;
    private $isbn;
    private $titulo;
    private $autor;
    private $editorial;
    private $annio;
    private $cantidad;
    /**
     *
     * @var categoria 
     */
    private $categoria;
    private $metodoBuscar;
    private $palabraBusca;
    
    function __construct($id, $isbn, $titulo, $autor, $editorial, $annio, $cantidad, $categoria, $metodoBuscar, $palabraBusca) {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->annio = $annio;
        $this->cantidad = $cantidad;
        $this->categoria = $categoria;
        $this->metodoBuscar = $metodoBuscar;
        $this->palabraBusca = $palabraBusca;
    }
    
    function getMetodoBuscar() {
        return $this->metodoBuscar;
    }

    function getPalabraBusca() {
        return $this->palabraBusca;
    }

    function setMetodoBuscar($metodoBuscar) {
        $this->metodoBuscar = $metodoBuscar;
    }

    function setPalabraBusca($palabraBusca) {
        $this->palabraBusca = $palabraBusca;
    }

        
    function getId() {
        return $this->id;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getEditorial() {
        return $this->editorial;
    }

    function getAnnio() {
        return $this->annio;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setEditorial($editorial) {
        $this->editorial = $editorial;
    }

    function setAnnio($annio) {
        $this->annio = $annio;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }



}