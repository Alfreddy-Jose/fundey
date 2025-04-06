<?php
$server = dirname(__DIR__, 1);
include_once "$server/config/connect.php";


class AtletaModel extends connect 
{
    private $con;

    function __construct() {
        $this->con = parent::Conectar();
    }

    function SelectCategoria(){
        $consultaSQL = "SELECT id_categoria, nombre_categoria FROM categoria ORDER BY nombre_categoria ASC";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $filas = [];
        foreach($array as $row){
            $filas [$i][0] = $row["id_categoria"];
            $filas [$i][1] = $row["nombre_categoria"];
            $i++;
        }
        return $filas;
    }

    function SelectCompetencia(){
        $consultaSQL = "SELECT * FROM competencia";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $filas = [];
        $i = 0;
        foreach($array as $row){
            $filas [$i][0] = $row["id_competencia"];
            $filas [$i][1] = $row["nombre_competencia"];
            $i++;
        }
        return $filas;
    }
    function SelectNivelCompA(){
        $consultaSQL = "SELECT nombre_nivelcomp, id_nivelcomp FROM nivel_competencia";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $filas = [];
        $i = 0;
        foreach($array as $row){
            $filas [$i][0] = $row["id_nivelcomp"];
            $filas [$i][1] = $row["nombre_nivelcomp"];
            $i++;
        }
        return $filas;
    }

    function competenciaAsing($atleta){
        $consultaSQL = "SELECT atleta_competencia.*, competencia.nombre_competencia FROM atleta_competencia INNER JOIN competencia ON competencia.id_competencia = atleta_competencia.codigo_competencia WHERE codigo_atleta = $atleta";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $filas = [];
        $i = 0;
        foreach($array as $row){
            $filas [$i][0] = $row["id_atlecomp"];
            $filas [$i][1] = $row["nombre_competencia"];
            $filas [$i][2] = $row["codigo_competencia"];
            $i++;
        }
        return $filas;
    }

    function competenciasDisp($atleta){
        $consultaSQL = "SELECT * FROM `competencia` WHERE id_competencia NOT IN (SELECT codigo_competencia FROM atleta_competencia WHERE codigo_atleta = $atleta)";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $filas = [];
        $i = 0;
        foreach($array as $row){
            $filas [$i][0] = $row["id_competencia"];
            $filas [$i][1] = $row["nombre_competencia"];
            $i++;
        }
        return $filas;
    }

    function Atleta(){
        $consultaSQL = "SELECT atleta.*, categoria.nombre_categoria, disciplina.nombre_disciplina FROM atleta INNER JOIN categoria ON atleta.codigo_categoria = categoria.id_categoria INNER JOIN disciplina ON categoria.codigo_disciplina = disciplina.id_disciplina";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
            $filas = []; 
            foreach($array as $row){
                $filas [$i][0] = $row["cedula"]; 
                $filas [$i][1] = $row["nombre"];
                $filas [$i][2] = $row["apellido"];
                $filas [$i][3] = $row["fecha_nacimiento"];
                $filas [$i][4] = $row["sexo"];
                $filas [$i][5] = $row["nombre_categoria"];
                $filas [$i][7] = $row["codigo_usuario"];
                $filas [$i][8] = $row["codigo_categoria"];
                $filas [$i][9] = $row["nacionalidad"];
                $filas [$i][11] = $row["statu"];
                $filas [$i][12] = $row["nombre_disciplina"];
                $filas [$i][13] = $row["asunto"];
                $i++;
            }
            return $filas;
    }

    function InsertarAtleta($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoCo, $codigoU, $nacionalidad, $statu, $idCompAtleta, $nivelcomp){
        try{
            $consultaSQL = "INSERT INTO atleta(cedula, nombre, apellido, sexo, fecha_nacimiento, codigo_categoria, codigo_usuario, nacionalidad, statu, codigo_nivelcompA) VALUES ($cedula, '$nombreA', '$apellido', '$sexo', '$fechaN', '$codigoCa', '$codigoU', '$nacionalidad', '$statu', $nivelcomp)";
            $resultado = $this->con->prepare($consultaSQL);
            $resultado->execute();

            $tiraSQL = "INSERT INTO atleta_competencia(id_atlecomp, codigo_atleta, codigo_competencia) VALUES ('$idCompAtleta', $cedula, $codigoCo)";
            $resul = $this->con->prepare($tiraSQL);
            $resul->execute();

            return true;
        } catch(PDOException){
            echo '<script>alert("EL ATLETA YA ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    } 
    function InsertarAtleta2($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoU, $nacionalidad, $statu, $idCompAtleta){
        try{
            $consultaSQL = "INSERT INTO atleta(cedula, nombre, apellido, sexo, fecha_nacimiento, codigo_categoria, codigo_usuario, nacionalidad, statu) VALUES ($cedula, '$nombreA', '$apellido', '$sexo', '$fechaN', '$codigoCa', '$codigoU', '$nacionalidad', '$statu')";
            $resultado = $this->con->prepare($consultaSQL);
            $resultado->execute();

            $tiraSQL = "INSERT INTO atleta_competencia(id_atlecomp, codigo_atleta) VALUES ('$idCompAtleta', $cedula)";
            $resul = $this->con->prepare($tiraSQL);
            $resul->execute();

            return true;
        } catch(PDOException){
            echo '<script>alert("EL ATLETA YA ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function DeletAtleta($cedula){
        try {
            $tiraSQL = "DELETE FROM atleta WHERE cedula = '$cedula'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL ATLETA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function UpdateAtleta($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoU, $nacionalidad){
        try {
            $tiraSQL = "UPDATE atleta SET nombre = '$nombreA', apellido = '$apellido', fecha_nacimiento = '$fechaN', sexo = '$sexo', codigo_categoria = '$codigoCa', codigo_usuario = '$codigoU', nacionalidad = '$nacionalidad' WHERE cedula = $cedula";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true; 
        } catch (PDOException) {
            echo '<script>alert("EL ATLETA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function cambiarStatu($cedula, $statu, $asunto)
    {
        try {
            $tiraSQL = "UPDATE atleta SET statu = '$statu', asunto = '$asunto' WHERE cedula = $cedula";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL ATLETA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function buscarAtleta($cedula)
    {
        $tiraSQL = "SELECT COUNT(id_cuenta) FROM cuenta WHERE codigo_atleta = $cedula";
        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $caja = $result->fetchColumn();

        if ($caja > 0) {
            return false;
        }else{
            return true;
        }
    }

    function buscador($cedula){
        $tiraSQL = "SELECT cedula_propietario, nombre_propietario, apellido_propietario FROM propietario WHERE cedula_propietario LIKE ?";
        $result = $this->con->prepare($tiraSQL);
        $result->execute([$cedula . '%']);
        $atleta = $result->fetchAll();

        $filas = [];
        $i = 0;
        foreach($atleta as $row){
            $filas [$i][0] = $row["cedula_propietario"];
            $filas [$i][1] = $row["nombre_propietario"];
            $filas [$i][2] = $row["apellido_propietario"];
            $i++;
        }
        return $filas;
    }
    function insertCompetencia($id_atlecomp, $atleta, $competencia){
        try {
            $tiraSQL = "INSERT INTO atleta_competencia (id_atlecomp, codigo_atleta, codigo_competencia) VALUES ($id_atlecomp, $atleta, $competencia)";
            $resultado = $this->con->prepare($tiraSQL);
            $resultado->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA COMPETENCIA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function seleccionarNivelcomp($competencia){
        $tiraSQL = "SELECT codigo_nivelcomp FROM competencia WHERE id_competencia = $competencia";
        $resultado = $this->con->prepare($tiraSQL);
        $resultado->execute();
        $nivel = $resultado->fetchObject();
        $nivelcomp = $nivel->codigo_nivelcomp;

        return $nivelcomp;
    }

    function updateNivel($nivel, $atleta){
        try {
            $tiraSQL = "UPDATE atleta SET codigo_nivelcompA = $nivel WHERE cedula = $atleta";
            $resultado = $this->con->prepare($tiraSQL);
            $resultado->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA COMPETENCIA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function busquedaMayorNivel($cedula){
        $tiraSQL = "SELECT atleta_competencia.codigo_competencia, competencia.codigo_nivelcomp, nivel_competencia.rango, nivel_competencia.id_nivelcomp FROM atleta_competencia INNER JOIN competencia ON atleta_competencia.codigo_competencia = competencia.id_competencia INNER JOIN nivel_competencia ON competencia.codigo_nivelcomp = nivel_competencia.id_nivelcomp WHERE codigo_atleta = $cedula";
        $resultado = $this->con->prepare($tiraSQL);
        $resultado->execute();
        $rango = $resultado->fetchAll();
        $filas = [];
        $i = 0;
        foreach($rango as $row){
            $filas [$i][0] = $row["id_nivelcomp"];
            $filas [$i][1] = $row["rango"];
            $i++;
        }
        return $filas;
    }

    function buscarRangoNivel($atleta){
        $tiraSQL = "SELECT atleta.codigo_nivelcompA, nivel_competencia.rango FROM atleta INNER JOIN nivel_competencia ON atleta.codigo_nivelcompA = nivel_competencia.id_nivelcomp WHERE cedula = $atleta";
        $resultado = $this->con->prepare($tiraSQL);
        $resultado->execute();
        $nivel = $resultado->fetchObject();
        $rango = $nivel->rango;

        if($rango > 1){
            return $rango;
        }else{
            $rango = false;
        }
    }
    
    function buscarNivelComp($atleta){
        $tiraSQL = "SELECT atleta.codigo_nivelcompA, nivel_competencia.nombre_nivelcomp  FROM atleta INNER JOIN nivel_competencia ON nivel_competencia.id_nivelcomp = atleta.codigo_nivelcompA WHERE cedula = $atleta";
        $resultado = $this->con->prepare($tiraSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();

        $fila = 0;
        if ($array) {
            foreach($array as $row){
                $fila = $row['nombre_nivelcomp'];
            }
        }else{
            $fila = null;
        }
        return $fila;
    }
}