<?php

class Imagenes{

    private $id;
    private $tipo;
    private $imagen;
    private $id_garage;

    function __construct($tipo, $imagen, $id_garage) {
        $this->tipo = $tipo;
        $this->imagen = $imagen;
        $this->id_garage = $id_garage;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getId_Garage(){
        return $this->id_garage;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'imagen' => $this->imagen,
            'id_garage' => $this->id_garage
        ];
    }

    public static function fromArray($array) {
        $img = new Imagenes($array["tipo"],$array["imagen"],$array["id_garage"]);
        
        $img->id = $array['id'];
        
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
    
    public static function eliminarImagen($id){
        $boolean = MYSQL::delete('imagenes', $id);
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

    public static function traerTodoID_Garage($id) {
        $registros = MYSQL::selectALLWhere('imagenes', 'id_garage', $id);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Imagenes::fromArray($registro);
        }

        return $array;
    }

    public static function traerPorId($id) {
        $array = MYSQL::select('imagenes', 'id', $id);
        if($array) {
            return Imagenes::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorId_Garage($id) {
        $array = MYSQL::select('imagenes', 'id_garage', $id);
        if($array) {
            return Imagenes::fromArray($array);
        }
        
        return null;
    }

}


?>