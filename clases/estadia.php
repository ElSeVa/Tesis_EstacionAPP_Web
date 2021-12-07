<?php 

class Estadia{

    private $id;
    private $precio;
    private $horario;
    private $vehiculoPermitido;
    private $id_garage;

    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getHorario(){
        return $this->horario;
    }

    function getVehiculoPermitido(){
        return $this->vehiculoPermitido;
    }

    function getId_Garage(){
        return $this->id_garage;
    }

    function __construct($precio, $horario, $vehiculoPermitido, $id_garage){
        $this->precio = $precio;
        $this->horario = $horario;
        $this->vehiculoPermitido = $vehiculoPermitido;
        $this->id_garage = $id_garage;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'precio' => $this->precio,
            'horario' => $this->horario,
            'vehiculo_permitido' => $this->vehiculoPermitido,
            'id_garage' => $this->id_garage
        ];
    }

    public static function fromArray($array) {
        $garage = Garage::traerPorId($array['id_garage']);
        $registro = new Estadia($array["precio"], $array["horario"], $array['vehiculo_permitido'], $garage->getId());

        $registro->id = intval($array['id']);

        return $registro;
    }

    public static function insertarEstadia($array) {
        $id = MYSQL::insert('estadia', $array);
        return $id;
    }

    public static function editarEstadia($array){
        $id = MYSQL::update('estadia', $array);
        return $id;
    }

    public static function eliminarEstadia($id){
        $boolean = MYSQL::delete('estadia', $id);
        return $boolean;
    }

    public static function traerPorId($id) {
        $array = MYSQL::select('estadia', 'id', $id);
        if($array) {
            return Estadia::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIdGarage($id) {
        $array = MYSQL::select('estadia', 'id_garage', $id);
        if($array) {
            return Estadia::fromArray($array);
        }
        
        return null;
    }

    public static function traerTodoPorIdGarage($id) {
        $registros = MYSQL::selectALLWhere('estadia', 'id_garage', $id);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('estadia');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodoGroupBy($groupBy) {
        $registros = MYSQL::selectGroupBy('estadia', $groupBy);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

    public static function traerTodoPorFiltro($id) {
        $registros = MYSQL::selectALLFilterWhere('estadia', "id_garage", $id, 'vehiculo_permitido');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

    public static function filtroPorVehiculo($vehiculo) {
        $array = MYSQL::select('estadia', 'vehiculo_permitido', $vehiculo);
        if($array) {
            return Estadia::fromArray($array);
        }
        
        return null;
    }

        
    public static function filtrar($horario, $vehiculo, $precio) {
        $registros = MYSQL::selectFilter('estadia', $horario, $vehiculo, $precio);
        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

}

?>