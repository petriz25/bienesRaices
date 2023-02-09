<?php

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;
    protected static $columnasBD=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','vendedorId'];
    

    //Errores 
    protected static $errores = [];

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
    $query = " INSERT INTO propiedad ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";
    
    $resultado = self::$db->query($query);

    return $resultado;
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

//Subida de archivos
public function setImagen($imagen){

    //Asignar al atributo de imagen el nombre de la imagen
    if($imagen){
        $this->imagen = $imagen;
    }
}

public static function getErrores(){
    return self::$errores;
}

public function validar(){
    if(!$this->titulo){
        self::$errores[]="Debes de añadir el titulo";
    }
    if(!$this->precio){
        self::$errores[]="Debes de añadir el precio";
    }
    if(!$this->habitaciones){
        self::$errores[]="Debes de añadir el numero de habitaciones";
    }
    if(!$this->wc){
        self::$errores[]="Debes de añadir el numero de baños";
    }
    if(!$this->estacionamiento){
        self::$errores[]="Debes de añadir el numero de estacionamientos";
    }
    if(!$this->vendedorId){
        self::$errores[]="Debes seleccionar el vendedor";
    }
    if(!$this->imagen){
    self::$errores[]= "Debes agregar una imagen";
    }

    return self::$errores;
}

//Listar todas las propiedades 
    public static function all(){
    $query = "SELECT * FROM propiedad";
    
    $resultado = self::consultarSQL($query);

    return $resultado;

    }

    public static function consultarSQL($query){
        //Consultamos la base de datos
        $resultado = self::$db->query($query);
        
        //Iterar los resultados 
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }
        return $objeto;
        
    }

}