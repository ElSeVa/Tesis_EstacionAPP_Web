<?php 
class Conductor{
    private $ID;
    private $nombre;
    private $contrasena;
    private $email;
    private $tipoVehiculo;
    private $propietario;
    
    
    function __construct($nombre,$passwordPlano,$email,$tipoVehiculo,$propietario) {
        $this->nombre = $nombre;
        $this->contrasena = password_hash($passwordPlano, PASSWORD_DEFAULT);
        $this->email= $email;
        $this->tipoVehiculo = $tipoVehiculo;
        $this->propietario = $propietario;
    }
            

    public function getID() {
        return $this->ID;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPassword() {
        return $this->contrasena;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getTipoVehiculo(){
        return $this->tipoVehiculo;
    }

    public function getPropietario(){
        return $this->propietario;
    }
    
    public function toArray() {
        return [
            'ID' => $this->ID,
            'Nombre' => $this->nombre,
            'Contrasena' => $this->contrasena,
            'Email' => $this->email,
            'TipoVehiculo' => $this->tipoVehiculo,
            'Propietario' => $this->propietario
        ];
    }
    
    public static function fromArray($array) {
        $conductor = new Conductor($array["Nombre"],null,$array["Email"],$array['TipoVehiculo'], $array['Propietario']);
        
        $conductor->ID = $array['ID'];
        $conductor->nombre = $array['Nombre'];
        $conductor->contrasena = $array['Contrasena'];
        $conductor->email = $array['Email'];
        $conductor->tipoVehiculo = $array['TipoVehiculo'];
        $conductor->propietario = $array['Propietario'];
        
        return $conductor;
    }
    
    public static function insertarConductor($array) {
        $id = MYSQL::insert('conductor', $array);
        return $id;
    }

    public static function actualizarConductor($array) {
        $id = MYSQL::update('conductor', $array);
        return $id;
    }

    public static function traerPorId($ID) {
        $array = MYSQL::select('conductor', 'ID', $ID);
        if($array) {
            return Conductor::fromArray($array);
        }
        
        return null;
    }
    
    public static function traerPorEmail($email) {
        $array = MYSQL::select('conductor', 'Email', $email);
        if($array) {
            return Conductor::fromArray($array);
        }
        
        return null;
    }
    
    public function validoPassword($passwordPlano) {
        return password_verify($passwordPlano, $this->contrasena);
    }
}
?>