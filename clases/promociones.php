<?php
class Promociones{

    private $id;
    private $id_conductor;
    private $id_promo;
    private $id_garage;

    function __construct($id_conductor,$id_promo,$id_garage){
        $this->id_conductor = $id_conductor;
        $this->id_promo = $id_promo;
        $this->id_garage = $id_garage;
    }

    function getId(){
        return $this->id;
    }

    function getId_Conductor(){
        return $this->id_conductor;
    }

    function getId_Promo(){
        return $this->id_promo;
    }

    function getId_Garage(){
        return $this->id_garage;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'id_conductor' => $this->id_conductor,
            'id_promo' => $this->id_promo,
            'id_garage' => $this->id_garage
        ];
    }

    public static function fromArray($array){
        $promociones = New Promociones($array["id_conductor"], $array["id_promo"], $array["id_garage"]);
        $promociones->id = $array['id'];
        return $promociones;
    }

    public static function traerPorId($id) {
        $array = MYSQL::select('promociones', 'id', $id);
        if($array) {
            return Promociones::fromArray($array);
        }
        
        return null;
    }

    public static function traerPorIdconductor($idConductor) {
        $registros = MYSQL::selectALLWhere('promociones', 'id_conductor', $idConductor);

        $array = array();
        foreach($registros as $registro) {
            $array[] = Promociones::fromArray($registro);
        }                

        return $array;
    }

    public static function traerTodo() {
        $registros = MYSQL::selectALL('promociones');

        $array = array();
        foreach($registros as $registro) {
            $array[] = Promociones::fromArray($registro);
        }

        return $array;
    }

    public static function insertarPromociones($array) {
        $id = MYSQL::insert('promociones', $array);
        return $id;
    }

    public static function editarPromociones($array){
        $id = MYSQL::update('promociones', $array);
        return $id;
    }

    public static function eliminarPromociones($id){
        $boolean = MYSQL::delete('promociones', $id);
        return $boolean;
    }


}
?>
