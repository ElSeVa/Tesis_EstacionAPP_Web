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

        $consulta = $mysqli->query("SELECT * FROM $tabla ORDER BY ID DESC LIMIT $limit_begin, $limit_end");
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
        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE Horario = '$horario' AND VehiculoPermitido = '$vehiculo' ORDER BY Precio $precio");
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
        $consulta = $mysqli->query("SELECT * FROM $tabla WHERE $condicion = '" .$valor. "' ORDER BY ID $order ");
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
            
        if(!$array['ID']){
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
        if (!$mysqli->query("UPDATE $tabla SET $valores WHERE ID = {$array['ID']}")){
            echo "2 Falló la actualización MySQL: " . $mysqli->error;
            exit;
        }

        return $array['ID'];
    }

    public static function delete($tabla, $id){
        $mysqli = self::abrirDB();
         
        if (!$mysqli->query("DELETE FROM $tabla WHERE ID = $id")){
            echo "3 Falló la actualización MySQL: " . $mysqli->error;
            exit;
        }

        return true;
    }
    
}

?>