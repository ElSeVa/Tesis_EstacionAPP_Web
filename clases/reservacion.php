<?php

class Reservacion{
    
    private $ID;
    private $Precio;
    private $Estadia;
    private $Cantidad;
    private $Fecha_inicio;
    private $Fecha_final;
    private $Estado;
    private $ID_Garage;
    private $ID_Conductor;
    
    function __construct($Precio, $Estadia, $Cantidad, $Fecha_inicio, $Fecha_final, $Estado, $ID_Conductor, $ID_Garage) {
        $this->Precio = $Precio;
        $this->Estadia = $Estadia;
        $this->Cantidad = $Cantidad;
        $this->Fecha_inicio = $Fecha_inicio;
        $this->Fecha_final = $Fecha_final;
        $this->Estado = $Estado;
        $this->ID_Conductor = $ID_Conductor;
        $this->ID_Garage = $ID_Garage;
    }

    function getID(){
        return $this->ID;
    }

    function getPrecio(){
        return $this->Precio;
    }

    function getEstadia(){
        return $this->Estadia;
    }

    function getCantidad(){
        return $this->Cantidad;
    }

    function getFecha_inicio(){
        return $this->Fecha_inicio;
    }

    function getFecha_final(){
        return $this->Fecha_final;
    }

    function getEstado(){
        return $this->Estado;
    }

    function getID_Conductor(){
        return $this->ID_Conductor;
    }

    function getID_Garage(){
        return $this->ID_Garage;
    }

    public static function fromArray($array){
        $reservacion = New Reservacion($array['Precio'], $array['Estadia'], $array['Cantidad'], $array['Fecha_inicio'], $array['Fecha_final'], $array['Estado'], $array['ID_Conductor'], $array['ID_Garage']);
        $reservacion->ID = $array['ID'];
        return $reservacion;
    }

    public static function traerTodoPorID($ID){
        $registros = MYSQL::selectALL('reservacion');
        $array = array();
        foreach($registros as $registro) {
            if($registro['ID_Garage'] == $ID && $registro['Estado'] == "Esperando"){
                $array[] = Reservacion::fromArray($registro);
            }
        }
        return $array;
    }

    public static function traerPorLimit($ID, $limit_inicio, $limit_final){
        $registros = MYSQL::selectLimitAll('reservacion', $limit_inicio, $limit_final);
        $array = array();
        foreach($registros as $registro) {
            if($registro['Estado'] == "Esperando" && $registro['ID_Garage'] == $ID){
                $array[] = Reservacion::fromArray($registro);
            }
        }
        return $array;
    }

    public static function insertarReserva($array) {
        $id = MYSQL::insert('reservacion', $array);
        return $id;
    }

    public static function eliminarReserva($ID){
        $boolean = MYSQL::delete('reservacion', $ID);
        return $boolean;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('reservacion');
        $array = array();
        foreach($registros as $registro) {
            $array[] = Reservacion::fromArray($registro);
        }

        return $array;
    }

    public static function traerPorId($ID) {
        $array = MYSQL::select('reservacion', 'ID', $ID);
        if($array) {
            return Reservacion::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIDC($ID) {
        $array = MYSQL::select('reservacion', 'ID_Conductor', $ID);
        if($array) {
            return Reservacion::fromArray($array);
        }
        
        return null;
    }

    public static function actualizarReserva($array){
        $id = MYSQL::update('reservacion', $array);
        return $id;
    }

}

?>