<?php

class Reservacion{
    
    private $id;
    private $precio;
    private $estadia;
    private $cantidad;
    private $fecha_inicio;
    private $fecha_final;
    private $estado;
    private $id_garage;
    private $id_conductor;
    
    function __construct($precio, $estadia, $cantidad, $fecha_inicio, $fecha_final, $estado, $id_conductor, $id_garage) {
        $this->precio = $precio;
        $this->estadia = $estadia;
        $this->cantidad = $cantidad;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->estado = $estado;
        $this->id_conductor = $id_conductor;
        $this->id_garage = $id_garage;
    }

    function getId(){
        return $this->id;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getEstadia(){
        return $this->estadia;
    }

    function getCantidad(){
        return $this->cantidad;
    }

    function getFecha_inicio(){
        return $this->fecha_inicio;
    }

    function getFecha_final(){
        return $this->fecha_final;
    }

    function getEstado(){
        return $this->estado;
    }

    function getId_Conductor(){
        return $this->id_conductor;
    }

    function getId_Garage(){
        return $this->id_garage;
    }

    public static function fromArray($array){
        $reservacion = New Reservacion($array['precio'], $array['estadia'], $array['cantidad'], $array['fecha_inicio'], $array['fecha_final'], $array['estado'], $array['id_conductor'], $array['id_garage']);
        $reservacion->id = $array['id'];
        return $reservacion;
    }

    public static function traerTodoPorID($id){
        $registros = MYSQL::selectALL('reservacion');
        $array = array();
        foreach($registros as $registro) {
            if($registro['id_garage'] == $id && $registro['estado'] == "Esperando"){
                $array[] = Reservacion::fromArray($registro);
            }
        }
        return $array;
    }

    public static function traerPorLimit($id, $limit_inicio, $limit_final){
        $registros = MYSQL::selectLimitAll('reservacion', $limit_inicio, $limit_final);
        $array = array();
        foreach($registros as $registro) {
            if($registro['estado'] == "Esperando" && $registro['id_garage'] == $id){
                $array[] = Reservacion::fromArray($registro);
            }
        }
        return $array;
    }

    public static function insertarReserva($array) {
        $id = MYSQL::insert('reservacion', $array);
        return $id;
    }

    public static function eliminarReserva($id){
        $boolean = MYSQL::delete('reservacion', $id);
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

    public static function traerPorId($id) {
        $array = MYSQL::select('reservacion', 'id', $id);
        if($array) {
            return Reservacion::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIDC($id) {
        $array = MYSQL::select('reservacion', 'id_conductor', $id);
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