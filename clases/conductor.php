<?php 
class Conductor{
    private $id;
    private $nombre;
    private $contrasena;
    private $email;
    private $tipo_vehiculo;
    private $propietario;
    
    
    function __construct($nombre,$passwordPlano,$email,$tipo_vehiculo,$propietario) {
        $this->nombre = $nombre;
        $this->contrasena = password_hash($passwordPlano, PASSWORD_DEFAULT);
        $this->email= $email;
        $this->tipo_vehiculo = $tipo_vehiculo;
        $this->propietario = $propietario;
    }
            

    public function getId() {
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPassword() {
        return $this->contrasena;
    }

    public function setPassword($contrasena){
        $this->contrasena = $contrasena;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getTipo_Vehiculo(){
        return $this->tipo_vehiculo;
    }

    public function getPropietario(){
        return $this->propietario;
    }
    
    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'contrasena' => $this->contrasena,
            'email' => $this->email,
            'tipo_vehiculo' => $this->tipo_vehiculo,
            'propietario' => $this->propietario
        ];
    }
    
    public static function fromArray($array) {
        $conductor = new Conductor($array["nombre"],null,$array["email"],$array['tipo_vehiculo'], $array['propietario']);
        
        $conductor->id = $array['id'];
        $conductor->nombre = $array['nombre'];
        $conductor->contrasena = $array['contrasena'];
        $conductor->email = $array['email'];
        $conductor->tipo_vehiculo = $array['tipo_vehiculo'];
        $conductor->propietario = $array['propietario'];
        
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

    public static function traerPorId($id) {
        $array = MYSQL::select('conductor', 'id', $id);
        if($array) {
            return Conductor::fromArray($array);
        }
        
        return null;
    }
    
    public static function traerPorEmail($email) {
        $array = MYSQL::select('conductor', 'email', $email);
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