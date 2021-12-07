<?php

class Resena{

    private $id;
    private $usuario;
    private $texto;
    private $valoracion;
    private $id_garage;
    
    function __construct($usuario,$texto,$valoracion,$id_garage) {
        $this->usuario = $usuario;
        $this->texto = $texto;
        $this->valoracion = $valoracion;
        $this->id_garage = $id_garage;        
    }

    public function getId() {
        return $this->id;
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
    
    public function getId_Garage(){
        return $this->id_garage;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'usuario' => $this->usuario,
            'texto' => $this->texto,
            'valoracion' => $this->valoracion,
            'id_garage' => $this->id_garage
        ];
    }

    public static function fromArray($array) {
        $resena = new Resena($array["usuario"],$array["texto"],$array['valoracion'], $array['id_garage']);
        
        $resena->id = $array['id'];
        
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
        $array = MYSQL::select('resena', 'id', $id);
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

    public static function traerTodoOrderBYID($id, $traerId, $order) {
        $registros = MYSQL::selectALLOrderBYWhere('resena', $traerId, $id, $order);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Resena::fromArray($registro);
        }

        return $array;
    }

    public static function calcularValoracion($idGarage){
        $registros = MYSQL::selectALL('resena');
        foreach($registros as $registro) {
            if($registro['id_garage'] == $idGarage){
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