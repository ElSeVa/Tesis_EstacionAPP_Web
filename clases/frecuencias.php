<?php

class Frecuencia{

    private $id;
    private $nombre;
    private $tipo_vehiculo;
    private $frecuencia;

    function __construct($nombre, $tipo_vehiculo, $frecuencia){
        $this->nombre = $nombre;
        $this->tipo_vehiculo = $tipo_vehiculo;
        $this->frecuencia = $frecuencia;
    }

    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getTipo_Vehiculo(){
        return $this->tipo_vehiculo;
    }

    function getFrecuencia(){
        return $this->frecuencia;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'tipo_vehiculo' => $this->tipo_vehiculo,
            'frecuencia' => $this->frecuencia
        ];
    }

    public static function fromArray($array){
        $frecuencia = New Frecuencia($array["nombre"], $array["tipo_vehiculo"], $array["frecuencia"]);
        $frecuencia->id = $array['id'];
        return $frecuencia;
    }

    public static function traerTodoPorFrecuencia($idGarage) {
        $registros = MYSQL::selectALLFrecuent('reservacion','r.id_garage',$idGarage);
        $array = array();
        foreach($registros as $registro) {
            $array[] = Frecuencia::fromArray($registro);
        }

        return $array;
    }
}

?>