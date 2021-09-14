<?php 

class Estadia{

    private $ID;
    private $precio;
    private $horario;
    private $vehiculoPermitido;
    private $ID_Garage;

    function getID(){
        return $this->ID;
    }

    function setID($ID){
        $this->ID = $ID;
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

    function getID_Garage(){
        return $this->ID_Garage;
    }

    function __construct($precio, $horario, $vehiculoPermitido, $ID_Garage){
        $this->precio = $precio;
        $this->horario = $horario;
        $this->vehiculoPermitido = $vehiculoPermitido;
        $this->ID_Garage = $ID_Garage;
    }

    public function toArray() {
        return [
            'ID' => $this->ID,
            'Precio' => $this->precio,
            'Horario' => $this->horario,
            'VehiculoPermitido' => $this->vehiculoPermitido,
            'ID_Garage' => $this->ID_Garage
        ];
    }

    public static function fromArray($array) {
        $garage = Garage::traerPorId($array['ID_Garage']);
        $registro = new Estadia($array["Precio"], $array["Horario"], $array['VehiculoPermitido'], $garage->getID());

        $registro->ID = intval($array['ID']);

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

    public static function eliminarEstadia($ID){
        $boolean = MYSQL::delete('estadia', $ID);
        return $boolean;
    }

    public static function traerPorId($ID) {
        $array = MYSQL::select('estadia', 'ID', $ID);
        if($array) {
            return Estadia::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIdGarage($ID) {
        $array = MYSQL::select('estadia', 'ID_Garage', $ID);
        if($array) {
            return Estadia::fromArray($array);
        }
        
        return null;
    }

    public static function traerTodoPorIdGarage($ID) {
        $registros = MYSQL::selectALLWhere('estadia', 'ID_Garage', $ID);

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

    public static function traerTodoPorFiltro($ID) {
        $registros = MYSQL::selectALLFilterWhere('estadia', "ID_Garage", $ID, 'VehiculoPermitido');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Estadia::fromArray($registro);
        }

        return $array;
    }

    public static function filtroPorVehiculo($vehiculo) {
        $array = MYSQL::select('estadia', 'VehiculoPermitido', $vehiculo);
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