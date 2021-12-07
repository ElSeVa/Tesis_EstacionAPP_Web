<?php
class Util{
    
    public static function limpiar_inputs($input){    
        return htmlentities(trim(strtolower($input)));       
    }

    public static function limpiar($name){
        return htmlspecialchars(trim($name));
    }

    public static function completarArrayConductor($nombre,$contrasena,$email,$tipoVehiculo,$propietario){
        $array = array("id"=>"",
                       "nombre"=>"$nombre",
                       "contrasena"=>"$contrasena",
                       "email"=>"$email",
                       "tipo_vehiculo"=>"$tipoVehiculo",
                       "propietario"=>"$propietario");
        return $array;
    }
    public static function completarArrayGarage($nombre,$direccion,$disponibilidad,$telefono,$id_conductor){
        $array = array("id"=>"",
                       "nombre"=>"$nombre",
                       "direccion"=>"$direccion",
                       "disponibilidad"=>"$disponibilidad",
                       "telefono"=>"$telefono",
                       "id_conductor"=>"$id_conductor");
        return $array;
    }

    public static function completarArrayEstadia($precio,$horario,$vehiculoPermitido,$id_garage){
        $array = array("id"=>"",
                       "precio"=>"$precio",
                       "horario"=>"$horario",
                       "vehiculo_permitido"=>"$vehiculoPermitido",
                       "id_garage"=>"$id_garage");
        return $array;
    }

    public static function completarArrayMapa($lat,$lng,$id_garage){
        $array = array("id"=>"",
                       "latitud"=>"$lat",
                       "longitud"=>"$lng",
                       "id_garage"=>"$id_garage");
        return $array;
    }

    public static function Hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
}
?>