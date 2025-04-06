<?php
$server = dirname(__DIR__, 1);
    require_once "$server/config/connect.php";
class BecaModel extends Connect 
{
    private $con;
    function __construct(){
        $this->con = parent::Conectar(); 
    }

    function AtletasBecados($name, $codigoC, $codigoD) 
    {
        if($name == ""){$name = " ";}
        $akeyword = explode(" ",$name);

        if($name == "" and $codigoC == "" and $codigoD == ""){
            $tiraSQL = "SELECT * FROM `cuenta` INNER JOIN atleta ON codigo_atleta = cedula INNER JOIN categoria ON atleta.codigo_categoria = categoria.id_categoria INNER JOIN disciplina ON categoria.codigo_disciplina = disciplina.id_disciplina INNER JOIN propietario ON propietario.cedula_propietario = cuenta.codigo_propietario INNER JOIN banco ON banco.id_banco = cuenta.codigo_banco";
        }else{
            $tiraSQL = "SELECT * FROM `cuenta` INNER JOIN atleta ON codigo_atleta = cedula INNER JOIN categoria ON atleta.codigo_categoria = categoria.id_categoria INNER JOIN disciplina ON categoria.codigo_disciplina = disciplina.id_disciplina INNER JOIN propietario ON propietario.cedula_propietario = cuenta.codigo_propietario INNER JOIN banco ON banco.id_banco = cuenta.codigo_banco";
            if($name !== ""){
                $tiraSQL .= ' WHERE (nombre LIKE LOWER("%'.$akeyword[0].'%") OR apellido LIKE LOWER("%'.$akeyword[0].'%"))';

                for($i = 1; $i < count($akeyword); $i++){
                    if (!empty($akeyword[$i])) {
                        $tiraSQL .= ' OR nombre LIKE "%'.$akeyword[$i].'%" OR apellido LIKE "%'.$akeyword[$i].'%"';
                    }

                }
            }
            if($codigoC !== ""){
                $tiraSQL .= " AND codigo_categoria = ".$codigoC."";
            }
            if($codigoD !== ""){
                $tiraSQL .= " AND categoria.codigo_disciplina = ".$codigoD."";
            }
        }
        

        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $array = $result->fetchAll();
        $i = 0;
        $filas = [];
        foreach($array as $row){
            $filas[$i][0] = $row['nombre'];
            $filas[$i][1] = $row['apellido'];
            $filas[$i][2] = $row['cedula'];
            $filas[$i][3] = $row['nombre_disciplina'];
            $filas[$i][4] = $row['sexo'];
            $filas[$i][5] = $row['nombre_categoria'];
            $filas[$i][8] = $row['nacionalidad'];
            $filas[$i][9] = $row['statu'];
            $filas[$i][10] = $row['monto_categoria'];
            $filas[$i][12] = $row['nombre_propietario'];
            $filas[$i][13] = $row['apellido_propietario'];
            $filas[$i][14] = $row['cedula_propietario'];
            $filas[$i][15] = $row['nacionalidad_propietario'];
            $filas[$i][16] = $row['numero_cuenta'];
            $filas[$i][17] = $row['nombre_banco'];
            $filas[$i][18] = $row['tipo_cuenta'];
            $filas[$i][19] = $row['fecha_nacimiento'];
            $i++; 
        }
        return $filas;
    }

    function sumaMonto($cedula){
        $consultaSQL = "SELECT COUNT(id_cuenta) FROM cuenta WHERE codigo_propietario = $cedula";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchColumn();

        if($array > 1){
            $tiraSQL = "SELECT cuenta.*, categoria.monto_categoria, nivel_competencia.monto_nivelcomp FROM `cuenta` INNER JOIN atleta ON codigo_atleta = cedula INNER JOIN categoria ON atleta.codigo_categoria = categoria.id_categoria INNER JOIN atleta_competencia ON atleta.cedula = atleta_competencia.codigo_atleta INNER JOIN competencia ON atleta_competencia.codigo_competencia = competencia.id_competencia INNER JOIN nivel_competencia ON competencia.codigo_nivelcomp = nivel_competencia.id_nivelcomp WHERE codigo_propietario = $cedula";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            $array1 = $result->fetchAll();
            $i = 0;
            $fila = [];

            foreach($array1 as $row){
                $fila[$i][0] = $row['monto_categoria']; 
                $fila[$i][1] = $row['monto_nivelcomp'];
                $i++;
            }
            return $fila;
        }else{
            $fila = [];
            return $fila;
        }
    }

    function buscarNivelComp($atleta){
        $tiraSQL = "SELECT atleta.codigo_nivelcompA, nivel_competencia.monto_nivelcomp  FROM atleta INNER JOIN nivel_competencia ON nivel_competencia.id_nivelcomp = atleta.codigo_nivelcompA WHERE cedula = $atleta";
        $resultado = $this->con->prepare($tiraSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();

        $fila = 0;
        if ($array) {
            foreach($array as $row){
                $fila = $row['monto_nivelcomp'];
            }
        }else{
            $fila = null;
        }
        return $fila;
    }
}


