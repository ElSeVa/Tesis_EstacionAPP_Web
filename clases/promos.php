<?php

class Promos{

    private $id;
    private $tipo_promo;
    private $descripcion;
    private $id_garage;

    function __construct($tipo_promo,$descripcion,$id_garage) {
        $this->tipo_promo = $tipo_promo;
        $this->descripcion = $descripcion;
        $this->id_garage = $id_garage;
    }

    function getId(){ 
        return $this->id; 
    }

    function setId($id){ 
        $this->id = $id;
    }

    function getTipo_Promo(){ 
        return $this->tipo_promo; 
    }

    function getDescripcion(){ 
        return $this->descripcion; 
    }

    function getId_Garage(){ 
        return $this->id_garage; 
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'tipo_promo' => $this->tipo_promo,
            'descripcion' => $this->descripcion,
            'id_garage' => $this->id_garage
        ];
    }

    public static function fromArray($array) {
        $promos= new Promos($array["tipo_promo"],$array["descripcion"],$array["id_garage"]);
        
        $promos->id = $array['id'];
        
        return $promos;
    }

    public static function insertarPromos($array) {
        $id = MYSQL::insert('promos', $array);
        return $id;
    }

    public static function eliminarPromos($id){
        $boolean = MYSQL::delete('promos', $id);
        return $boolean;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('promos');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Promos::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodoId_Garage($id) {
        $registros = MYSQL::selectALLWhere('promos', 'id_garage', $id);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Promos::fromArray($registro);
        }

        return $array;
    }

    public static function traerPorId($id) {
        $array = MYSQL::select('promos', 'id', $id);
        if($array) {
            return Promos::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorId_Garage($id) {
        $array = MYSQL::select('promos', 'id_garage', $id);
        if($array) {
            return Promos::fromArray($array);
        }
        
        return null;
    }

    public static function actualizarPromos($array){
        $id = MYSQL::update('promos', $array);
        return $id;
    }

}
?>