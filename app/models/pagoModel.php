<?php
$server = dirname(__DIR__, 1);
include_once "$server/config/connect.php";
class PagoModel extends Connect
{
    private $con;

    public function __construct() {
        $this->con = parent::Conectar();
    }

    function guardarPago($codigoA,$monto,$fechaP, $numeroC)
    {
        try{
            $consultaSQL = "INSERT INTO pago(codigo_atleta, monto, fecha_emision, concepto, numero_cuenta) VALUES ($codigoA, $monto,'$fechaP','Beca', $numeroC)";
            $resultado = $this->con->prepare($consultaSQL);
            $resultado->execute();
            return true;
        }catch(PDOException){
/*             echo '<script>alert("EL PAGO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/beca/beca.php";</script>'; */
            return false;
        }
    }

    function historial($atleta){

            $consultaSQL = "SELECT * FROM pago WHERE codigo_atleta = $atleta";
            $result = $this->con->prepare($consultaSQL);
            $result->execute();
            $array = $result->fetchAll();

            $i = 0;
            $filas = [];
            foreach ($array as $row) {
                $filas[$i][0] = $row["monto"];
                $filas[$i][1] = $row["fecha_emision"];
                $filas[$i][2] = $row["numero_cuenta"];
                $i++;
            }
        return $filas;
    }
    function fechaPago(){

            $consultaSQL = "SELECT fecha_emision FROM pago";
            $result = $this->con->prepare($consultaSQL);
            $result->execute();
            $array = $result->fetchAll();

            $i = 0;
            $filas = [];
            foreach ($array as $row) {
                $filas[$i][0] = $row["fecha_emision"]; 
                $i++;
            }
        return $filas;
    }

    function ComprobarPago(){

        $consultaSQL = "SELECT fecha_emision FROM `pago` WHERE id_pago=(SELECT MAX(id_pago) FROM pago);";
        $result = $this->con->prepare($consultaSQL);
        $result->execute();
        $array = $result->fetchObject();
        if ($array == NULL) {
            return $array;
        }else{
            $resultado = $array->fecha_emision;
            return explode('-', $resultado);           
        }
    }
} 
