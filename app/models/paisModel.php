<?php
$server = dirname(__DIR__, 1);
require_once "$server/config/connect.php";
class PaisModel extends Connect
{
    private $con;

    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function Pais()
    {
        $tiraSQL = "SELECT * FROM pais ORDER BY paisnombre ASC";
        $respuesta = $this->con->prepare($tiraSQL);
        $respuesta->execute();
        $array = $respuesta->fetchAll();
        $fila = [];
        $i = 0;
        foreach($array as $row)
        {
            $fila[$i][0] = $row["id_pais"];
            $fila[$i][1] = $row["paisnombre"];
            $i++;
        }
        return $fila;
    }
    
    function ComprobarPaisExiste($pais){
        $consultaSQL = "SELECT count(id_pais) FROM pais WHERE paisnombre = '$pais'";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchColumn();
        
        if($array > 0){
            return false;
        }else{
            return true;
        }
    }

    function GuardarPais($nombre)
    {
        try{$tiraSQL = "INSERT INTO pais(paisnombre) VALUES ('$nombre')";
        $tiraSQL = $this->con->prepare($tiraSQL);
        $tiraSQL->execute();
        return true;
        }catch(PDOException){
            echo '<script>alert("EL PAIS YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/pais/pais.php";</script>';
            return false;
        }
    }

    function eliminarpais($id){
        try {
            $tiraSQL = "DELETE FROM pais WHERE id_pais = '$id'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL PAIS NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/pais/pais.php";</script>';
            return false;
        }
    }

    function editarpais($id, $nombre)
    {
        try{
        $consultaSQL = "UPDATE pais SET paisnombre = '$nombre' WHERE id_pais='$id'";
        $resultado = $this->con->prepare($consultaSQL); 
        $resultado->execute();
        return true;
        } catch(PDOException) {
            echo '<script>alert("EL PAIS NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/pais/pais.php";</script>';
            return false;
        }
    }
}