<?php

class Mapa{
    private $id;
    private $latitud;
    private $longitud;
    private $id_garage;

    function getId(){
        return $this->id;
    }

    function getLatitud(){
        return $this->latitud;
    }

    function getLongitud(){
        return $this->longitud;
    }

    function getId_Garage(){
        return $this->id_garage;
    }

    function __construct($latitud, $longitud, $id_garage){
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->id_garage = $id_garage;
    }

    public function toArray() {
        return [
            'id' => $this->id,                
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'id_garage' => $this->id_garage
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

    public static function eliminarMapa($id){
        $boolean = MYSQL::delete('mapa', $id);
        return $boolean;
    }

    public static function fromArray($array) {
        $mapa= new Mapa($array['latitud'], $array['longitud'], $array['id_garage']);        

        $mapa->id = intval($array['id']);
        
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

    
    public static function traerPorIDGarage($id) {
        $array = MYSQL::select('mapa', 'id_garage', $id);
        if($array) {
            return Mapa::fromArray($array);
        }
        
        return null;
    }

}

?>