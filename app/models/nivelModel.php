<?php
$server = dirname(__DIR__, 1);
require_once "$server/config/connect.php";

class NivelModel extends Connect{

    private $con;
    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function nivelCompetencia()
    {
        $tiraSQL = "SELECT * FROM nivel_competencia";
        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $array = $result->fetchAll();
        $i = 0;
        $fila = [];
        foreach ($array as $row){
            $fila[$i][0] = $row['id_nivelcomp'];
            $fila[$i][1] = $row['nombre_nivelcomp'];
            $fila[$i][2] = $row['monto_nivelcomp'];
            $fila[$i][3] = $row['rango'];
            $i++;
        }
        return $fila;
    }
    function InsertarNivel($nivel, $monto)
    {
        try {
            $tiraSQL = "UPDATE nivel_competencia SET monto_nivelcomp = $monto WHERE id_nivelcomp = $nivel";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL NIVEL DE COMPETENCIA YA ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }
    function DeletNivel($id)
    {
        try {
            $tiraSQL = "DELETE FROM nivel_competencia WHERE id_nivelcomp = $id";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL NIVEL DE COMPETENCIA YA ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }
}//end class