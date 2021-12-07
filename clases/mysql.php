<?php
class MYSQL{
    
    private static $mysqli;
    
    public static function abrirDB(){
        if(!self::$mysqli) {
            self::$mysqli = new mysqli( 'localhost', 'root', '', 'tesis' );
        }

    return self::$mysqli;

    }
    
    public static function closeDB(){
        self::$mysqli->close();
    }
    
    public static function selectALL($tabla) {
        $mysqli = self::abrirDB();

        $consulta = $mysqli->query("SELECT * FROM $tabla");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectLimitAll($tabla, $limit_begin, $limit_end) {
        $mysqli = self::abrirDB();

        $consulta = $mysqli->query("SELECT * FROM $tabla ORDER BY id DESC LIMIT $limit_begin, $limit_end");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectFilter($tabla, $horario, $vehiculo, $precio) {
        $mysqli = self::abrirDB();
        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE horario = '$horario' AND vehiculo_permitido = '$vehiculo' ORDER BY precio $precio");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectALLWhere($tabla, $condicion, $valor) {
        $mysqli = self::abrirDB();

        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE $condicion = '" .$valor. "'");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectGroupBy($tabla, $valor) {
        $mysqli = self::abrirDB();

        $consulta = $mysqli->query("SELECT * FROM $tabla GROUP BY $valor");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectALLFilterWhere($tabla, $condicion, $valor, $filtrar) {
        $mysqli = self::abrirDB();

        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE $condicion = '" .$valor. "' GROUP BY $filtrar");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectALLOrderBYWhere($tabla, $condicion, $valor, $order) {
        $mysqli = self::abrirDB();
        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE $condicion = '" .$valor. "' ORDER BY id $order ");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public static function selectALLFrecuent($tabla, $condicion, $valor) {
        $mysqli = self::abrirDB();
        $consulta = $mysqli->query("SELECT c.id, c.nombre, c.tipo_vehiculo, COUNT(*) as frecuencia FROM $tabla as r INNER JOIN conductor as c ON r.id_conductor = c.id WHERE $condicion = $valor GROUP BY r.id_garage, r.id_conductor ORDER BY frecuencia DESC");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        $resultado = array();
        while ($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        return $resultado;
    }


    
    public static function select($tabla, $condicion, $valor){
        $mysqli = self::abrirDB();
                
        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE $condicion = '" .$valor. "' LIMIT 1");
        if (!$consulta) {
            echo "Falló la consulta MySQL: " . $mysqli->error;
            exit;
        }

        if ($consulta->num_rows > 0) {
            return $consulta->fetch_assoc();
        }

        return null;   
    }

    
    public static function insert($tabla, $array){
        $mysqli = self::abrirDB();
            
        if(!$array['id']){
            $array = array_filter($array, function($value) { return $value !== null; });

            $campos = implode(', ', array_keys($array));
            $valores = implode(', ', array_map(function($valor){ return "'$valor'"; }, $array));

            if (!$mysqli->query("INSERT INTO $tabla ($campos) VALUES ($valores)")){
                echo "1 Falló la inserción MySQL: " . $mysqli->error;
                exit;
            }

            return $mysqli->insert_id;
        }
    }
    
    public static function update($tabla, $array){
        $mysqli = self::abrirDB();
        $valores = array();
        foreach($array as $campo => $valor){
            $valores[] = "$campo = '". $valor ."'";
        }

        $valores = implode(', ', $valores);
        if (!$mysqli->query("UPDATE $tabla SET $valores WHERE id = {$array['id']}")){
            echo "2 Falló la actualización MySQL: " . $mysqli->error;
            exit;
        }

        return $array['id'];
    }

    public static function delete($tabla, $id){
        $mysqli = self::abrirDB();
         
        if (!$mysqli->query("DELETE FROM $tabla WHERE id = $id")){
            echo "3 Falló la actualización MySQL: " . $mysqli->error;
            exit;
        }

        return true;
    }
    
}

?>