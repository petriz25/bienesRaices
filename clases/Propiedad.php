<?php

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;
    protected static $columnasBD=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $vendedorId;

    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar(){

    //Datos sanitizados
        $atributos = $this->sanitizarAtributos();

    //Insertar en la base de datos
    $query = "INSERT INTO propiedad ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";
    
    $resultado=self::$db->query($query);

    debuguear($resultado);
}

//Identificar y unir los atributos de la BD
public function atributos(){
    $atributos = [];
    foreach(self::$columnasBD as $columna){
        if($columna === 'id')continue;
        $atributos[$columna] = $this->$columna;
    }
    return $atributos;
}

public function sanitizarAtributos(){
    $atributos = $this->atributos();
    $sanitizado =[];
    foreach($atributos as $key=>$value){
        $sanitizado[$key]=self::$db->escape_string($value);
    }
    return $sanitizado;
}

}