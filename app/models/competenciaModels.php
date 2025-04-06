<?php
$server = dirname(__DIR__, 1);
include_once "$server/config/connect.php";

class CompetenciaModel extends Connect
{
    private $con;
    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function Competencia(){
        $tiraSQL = "SELECT competencia.*, nivel_competencia.nombre_nivelcomp, estado.estadonombre, pais.paisnombre FROM competencia INNER JOIN nivel_competencia ON nivel_competencia.id_nivelcomp = competencia.codigo_nivelcomp INNER JOIN estado ON estado.id_estado = competencia.codigo_estado INNER JOIN pais ON pais.id_pais = estado.codigo_pais";
        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $datos = $result->fetchAll();
        $i=0;
        $filas=[];
        foreach($datos as $row){
            $filas[$i][0] = $row["nombre_competencia"];
            $filas[$i][1] = $row["fecha_competencia"];
            $filas[$i][2] = $row["estadonombre"];
            $filas[$i][3] = $row["nombre_nivelcomp"];
            $filas[$i][4] = $row["id_competencia"];
            $filas[$i][5] = $row["paisnombre"];
            $filas[$i][6] = $row["codigo_estado"];
            $filas[$i][7] = $row["codigo_nivelcomp"];
            $i++;
        }
        return $filas;
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

    function selectestado($id_pais){
        $consultaSQL = "SELECT id_estado, estadonombre FROM estado WHERE codigo_pais = $id_pais ORDER BY estadonombre ASC";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $filas = [];
        foreach ($array as $estado){
            $filas[$i][0] = $estado["id_estado"];
            $filas[$i][1] = $estado["estadonombre"];
            $i++;
        }
        return $filas;
    }

    function selectNivelComp(){
        $consultaSQL = "SELECT * FROM nivel_competencia";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $filas = [];
        foreach ($array as $row){
            $filas[$i][0] = $row["id_nivelcomp"];
            $filas[$i][1] = $row["nombre_nivelcomp"];
            $i++;
        }
        return $filas;
    }

    function InsertComp($id_comp, $nombreC, $fechaC, $codEstado, $codNC, $lugar ){
        try {
            $tiraSQL = "INSERT INTO competencia(id_competencia, nombre_competencia, fecha_competencia, codigo_estado, codigo_nivelcomp, lugar) VALUES ('$id_comp','$nombreC', '$fechaC', '$codEstado', '$codNC', '$lugar')";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA COMPETENCIA YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/competencia/competencia.php";</script>';
            return false;
        }

    }

    function DeletComp($id_comp3){
        try {
            $tiraSQL = "DELETE FROM competencia WHERE id_competencia = '$id_comp3'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA COMPETENCIA NO ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/competencia/competencia.php";</script>';
            return false;
        }
    }

    function UpdateComp($nombreC2, $fechaC2, $codEstado2, $codNC2, $id_competencia){
        try {
            $tiraSQL = "UPDATE competencia SET nombre_competencia = '$nombreC2', fecha_competencia = '$fechaC2', codigo_estado = '$codEstado2', codigo_nivelcomp = '$codNC2' WHERE id_competencia = $id_competencia";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA COMPETENCIA NO ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/competencia/competencia.php";</script>';
            return false;
        }
    }
}