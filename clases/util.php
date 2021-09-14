<?php
class Util{
    
    public static function limpiar_inputs($input){    
        return htmlentities(trim(strtolower($input)));       
    }

    public static function limpiar($name){
        return htmlspecialchars(trim($name));
    }

    public static function completarArrayConductor($nombre,$contrasena,$email,$tipoVehiculo,$propietario){
        $array = array("ID"=>"",
                       "Nombre"=>"$nombre",
                       "Contrasena"=>"$contrasena",
                       "Email"=>"$email",
                       "TipoVehiculo"=>"$tipoVehiculo",
                       "Propietario"=>"$propietario");
        return $array;
    }
    public static function completarArrayGarage($nombre,$direccion,$disponibilidad,$telefono,$ID_Conductor){
        $array = array("ID"=>"",
                       "Nombre"=>"$nombre",
                       "Direccion"=>"$direccion",
                       "Disponibilidad"=>"$disponibilidad",
                       "Telefono"=>"$telefono",
                       "ID_Conductor"=>"$ID_Conductor");
        return $array;
    }

    public static function completarArrayEstadia($precio,$horario,$vehiculoPermitido,$ID_Garage){
        $array = array("ID"=>"",
                       "Precio"=>"$precio",
                       "Horario"=>"$horario",
                       "VehiculoPermitido"=>"$vehiculoPermitido",
                       "ID_Garage"=>"$ID_Garage");
        return $array;
    }

    public static function completarArrayMapa($lat,$lng,$ID_Garage){
        $array = array("ID"=>"",
                       "latitud"=>"$lat",
                       "longitud"=>"$lng",
                       "ID_Garage"=>"$ID_Garage");
        return $array;
    }

    public static function Hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
}
?>