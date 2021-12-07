<?php
class Garage{
    private $id;
    private $nombre;
    private $direccion;
    private $disponibilidad;
    private $telefono;
    private $id_conductor;

    function __construct($nombre,$direccion,$disponibilidad,$telefono,$id_conductor) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->disponibilidad = $disponibilidad;
        $this->telefono = $telefono;
        $this->id_conductor = $id_conductor;
    }

    function getId(){ 
        return $this->id; 
    }

    function getId_Conductor(){ 
        return $this->id_conductor; 
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
            'id' => $this->id,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'disponibilidad' => $this->disponibilidad,
            'telefono' => $this->telefono,
            'id_conductor' => $this->id_conductor
        ];
    }

    public static function fromArray($array) {
        $garage= new Garage($array["nombre"],$array["direccion"],$array["disponibilidad"],$array['telefono'], $array['id_conductor']);
        
        $garage->id = $array['id'];
        $garage->nombre = $array['nombre'];
        $garage->direccion = $array['direccion'];
        $garage->disponibilidad = $array['disponibilidad'];
        $garage->telefono = $array['telefono'];
        $garage->id_conductor = $array['id_conductor'];
        
        return $garage;
    }

    public static function insertarGarage($array) {
        $id = MYSQL::insert('garage', $array);
        return $id;
    }

    public static function eliminarGarage($id){
        $boolean = MYSQL::delete('garage', $id);
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

    public static function traerPorId($id) {
        $array = MYSQL::select('garage', 'id', $id);
        if($array) {
            return Garage::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIDC($id) {
        $array = MYSQL::select('garage', 'id_conductor', $id);
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