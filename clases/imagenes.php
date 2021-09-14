<?php

class Imagenes{

    private $ID;
    private $tipo;
    private $imagen;
    private $ID_Garage;

    function __construct($tipo, $imagen, $ID_Garage) {
        $this->tipo = $tipo;
        $this->imagen = $imagen;
        $this->ID_Garage = $ID_Garage;
    }

    public function setID($id){
        $this->ID = $id;
    }

    public function getID() {
        return $this->ID;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getID_Garage(){
        return $this->ID_Garage;
    }

    public function toArray() {
        return [
            'ID' => $this->ID,
            'tipo' => $this->tipo,
            'imagen' => $this->imagen,
            'ID_Garage' => $this->ID_Garage
        ];
    }

    public static function fromArray($array) {
        $img = new Imagenes($array["tipo"],$array["imagen"],$array["ID_Garage"]);
        
        $img->ID = $array['ID'];
        
        return $img;
    }

    public static function insertarImagen($array) {
        $id = MYSQL::insert('imagenes', $array);
        return $id;
    }

    public static function actualizarImagen($array) {
        $id = MYSQL::update('imagenes', $array);
        return $id;
    }
    
    public static function eliminarImagen($ID){
        $boolean = MYSQL::delete('imagenes', $ID);
        return $boolean;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('imagenes');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Imagenes::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodoID_Garage($ID) {
        $registros = MYSQL::selectALLWhere('imagenes', 'ID_Garage', $ID);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Imagenes::fromArray($registro);
        }

        return $array;
    }

    public static function traerPorId($ID) {
        $array = MYSQL::select('imagenes', 'ID', $ID);
        if($array) {
            return Imagenes::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorId_Garage($ID) {
        $array = MYSQL::select('imagenes', 'ID_Garage', $ID);
        if($array) {
            return Imagenes::fromArray($array);
        }
        
        return null;
    }

}


?>