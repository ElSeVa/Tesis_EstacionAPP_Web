<?php

class Mapa{
    private $ID;
    private $latitud;
    private $longitud;
    private $ID_Garage;

    function getID(){
        return $this->ID;
    }

    function getLatitud(){
        return $this->latitud;
    }

    function getLongitud(){
        return $this->longitud;
    }

    function getID_Garage(){
        return $this->ID_Garage;
    }

    function __construct($latitud, $longitud, $ID_Garage){
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->ID_Garage = $ID_Garage;
    }

    public function toArray() {
        return [
            'ID' => $this->ID,                
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'ID_Garage' => $this->ID_Garage
        ];
    }

    public static function agregarCoords($array){
        $id = MYSQL::insert('mapa', $array);
        return $id;
    }

    public static function actualizarCoords($array){
        $id = MYSQL::update('mapa', $array);
        return $id;
    }

    public static function eliminarMapa($ID){
        $boolean = MYSQL::delete('mapa', $ID);
        return $boolean;
    }

    public static function fromArray($array) {
        $mapa= new Mapa($array['latitud'], $array['longitud'], $array['ID_Garage']);        

        $mapa->ID = intval($array['ID']);
        
        return $mapa;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('mapa');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Mapa::fromArray($registro);
        }

        return $array;
    }

    
    public static function traerPorIDGarage($ID) {
        $array = MYSQL::select('mapa', 'ID_Garage', $ID);
        if($array) {
            return Mapa::fromArray($array);
        }
        
        return null;
    }

}

?>