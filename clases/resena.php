<?php

class Resena{

    private $ID;
    private $usuario;
    private $texto;
    private $valoracion;
    private $ID_Garage;
    
    function __construct($usuario,$texto,$valoracion,$ID_Garage) {
        $this->usuario = $usuario;
        $this->texto = $texto;
        $this->valoracion = $valoracion;
        $this->ID_Garage = $ID_Garage;        
    }

    public function getID() {
        return $this->ID;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getTexto() {
        return $this->texto;
    }
    
    public function getValoracion() {
        return $this->valoracion;
    }
    
    public function getID_Garage(){
        return $this->ID_Garage;
    }

    public function toArray() {
        return [
            'ID' => $this->ID,
            'Usuario' => $this->usuario,
            'Texto' => $this->texto,
            'Valoracion' => $this->valoracion,
            'ID_Garage' => $this->ID_Garage
        ];
    }

    public static function fromArray($array) {
        $resena = new Resena($array["Usuario"],$array["Texto"],$array['Valoracion'], $array['ID_Garage']);
        
        $resena->ID = $array['ID'];
        
        return $resena;
    }

    public static function insertarResena($array) {
        $id = MYSQL::insert('resena', $array);
        return $id;
    }

    public static function actualizarResena($array) {
        $id = MYSQL::update('resena', $array);
        return $id;
    }

    public static function traerPorId($id) {
        $array = MYSQL::select('resena', 'ID', $id);
        if($array) {
            return Resena::fromArray($array);
        }
        
        return null;
    }
    
    public static function traerTodo() {
        $registros = MYSQL::selectALL('resena');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Resena::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodoOrderBYID($ID, $traerID, $order) {
        $registros = MYSQL::selectALLOrderBYWhere('resena', $traerID, $ID, $order);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Resena::fromArray($registro);
        }

        return $array;
    }

    public static function calcularValoracion($idGarage){
        $registros = MYSQL::selectALL('resena');
        foreach($registros as $registro) {
            if($registro['ID_Garage'] == $idGarage){
                $array[] = Resena::fromArray($registro);
            }
        }
        if(!empty($array)){
            $total_resenas = count($array);
            $suma_valoracion = 0;
            foreach($array as $resena){
                $suma_valoracion += $resena->getValoracion();
            }
            
            $total = $suma_valoracion / $total_resenas;
            $total = ceil($total);
            return $total;
        }
        return 0;
    }



}

?>