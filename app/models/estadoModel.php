<?php
$server = dirname(__DIR__, 1);
require_once "$server/config/connect.php";
class EstadoModel extends Connect
{
    private $con;

    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function Estado()
    {
        $tiraSQL = "SELECT estado.*, pais.paisnombre FROM estado INNER JOIN pais ON estado.codigo_pais = pais.id_pais ORDER BY estadonombre ASC";
        $respuesta = $this->con->prepare($tiraSQL);
        $respuesta->execute();
        $array = $respuesta->fetchAll();
        $fila = [];
        $i = 0;
        foreach($array as $row)
        {
            $fila[$i][0] = $row["id_estado"];
            $fila[$i][1] = $row["estadonombre"];
            $fila[$i][2] = $row["codigo_pais"];
            $fila[$i][3] = $row["paisnombre"];
            $i++;
        }
        return $fila;
    }
    
    function selectpais(){
        $consultaSQL = "SELECT * FROM pais ORDER BY paisnombre ASC";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $filas = [];
        foreach ($array as $pais){
            $filas[$i][0] = $pais["id_pais"];
            $filas[$i][1] = $pais["paisnombre"];
            $i++;
        }
        return $filas;
    }

    function ComprobarEstadoExiste($estado, $pais){
        $consultaSQL = "SELECT COUNT(id_estado) FROM estado WHERE codigo_pais = $pais && estadonombre = '$estado'";
        $respuesta = $this->con->prepare($consultaSQL);
        $respuesta->execute();
        $array = $respuesta->fetchColumn();
        
        if($array > 0){
            return false;
        }else{
            return true;
        }
    }
    function GuardarEstado($nombre, $codigo_pais)
    {
        try{$tiraSQL = "INSERT INTO estado(estadonombre, codigo_pais) VALUES ('$nombre', '$codigo_pais')";
        $tiraSQL = $this->con->prepare($tiraSQL);
        $tiraSQL->execute();
        return true;
        }catch(PDOException){
            echo '<script>alert("EL ESTADO YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/estado/estado.php";</script>';
            return false;
        }
    }

    function eliminarestado($id){
        try {
            $tiraSQL = "DELETE FROM estado WHERE id_estado = '$id'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL ESTADO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/estado/estado.php";</script>';
            return false;
        }
    }

    function editarestado($id, $nombre, $codigo_pais)
    {
        try{
        $consultaSQL = "UPDATE estado SET estadonombre = '$nombre', codigo_pais = '$codigo_pais' WHERE id_estado = '$id'";
        $resultado = $this->con->prepare($consultaSQL); 
        $resultado->execute();
        return true;
        } catch(PDOException) {
            echo '<script>alert("EL ESTADO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/estado/estado.php";</script>';
            return false;
        }
    }
}