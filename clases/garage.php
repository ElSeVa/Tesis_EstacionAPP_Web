<?php
class Garage{
    private $ID;
    private $nombre;
    private $direccion;
    private $disponibilidad;
    private $telefono;
    private $ID_Conductor;

    function __construct($nombre,$direccion,$disponibilidad,$telefono,$ID_Conductor) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->disponibilidad = $disponibilidad;
        $this->telefono = $telefono;
        $this->ID_Conductor = $ID_Conductor;
    }

    function getID(){ 
        return $this->ID; 
    }

    function getID_Conductor(){ 
        return $this->ID_Conductor; 
    }

    function getNombre(){ 
        return $this->nombre; 
    }

    function getDireccion(){ 
        return $this->direccion; 
    }

    function getDisponibilidad(){ 
        return $this->disponibilidad; 
    }

    function getTelefono(){ 
        return $this->telefono; 
    }

    public function toArray() {
        return [
            'ID' => $this->ID,
            'Nombre' => $this->nombre,
            'Direccion' => $this->direccion,
            'Disponibilidad' => $this->disponibilidad,
            'Telefono' => $this->telefono,
            'ID_Conductor' => $this->ID_Conductor
        ];
    }

    public static function fromArray($array) {
        $garage= new Garage($array["Nombre"],$array["Direccion"],$array["Disponibilidad"],$array['Telefono'], $array['ID_Conductor']);
        
        $garage->ID = $array['ID'];
        $garage->nombre = $array['Nombre'];
        $garage->direccion = $array['Direccion'];
        $garage->disponibilidad = $array['Disponibilidad'];
        $garage->telefono = $array['Telefono'];
        $garage->ID_Conductor = $array['ID_Conductor'];
        
        return $garage;
    }

    public static function insertarGarage($array) {
        $id = MYSQL::insert('garage', $array);
        return $id;
    }

    public static function eliminarGarage($ID){
        $boolean = MYSQL::delete('garage', $ID);
        return $boolean;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('garage');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Garage::fromArray($registro);
        }

        return $array;
    }

    public static function traerPorId($ID) {
        $array = MYSQL::select('garage', 'ID', $ID);
        if($array) {
            return Garage::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIDC($ID) {
        $array = MYSQL::select('garage', 'ID_Conductor', $ID);
        if($array) {
            return Garage::fromArray($array);
        }
        
        return null;
    }

    public static function actualizarGarage($array){
        $id = MYSQL::update('garage', $array);
        return $id;
    }


}



?>