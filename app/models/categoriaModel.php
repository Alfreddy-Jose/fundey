<?php

    $server = dirname(__DIR__,1);
    require_once "$server/config/connect.php";
class CategoriaModel extends Connect{
    private $con;

    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function SelectCategoria($disciplina){
        $consultaSQL = "SELECT id_categoria, nombre_categoria FROM categoria WHERE codigo_disciplina = $disciplina ORDER BY nombre_categoria ASC";
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
    function Categoria(){
            $ConsultaSQL = "SELECT categoria.*, disciplina.nombre_disciplina FROM categoria INNER JOIN disciplina ON disciplina.id_disciplina = categoria.codigo_disciplina";
            $respuesta = $this->con->prepare($ConsultaSQL);
            $respuesta->execute();
            $array = $respuesta->fetchAll();
            $i = 0;
            $fila = [];
            foreach($array as $row){
                $fila[$i][0] = $row["id_categoria"]; 
                $fila[$i][1] = $row["nombre_categoria"]; 
                $fila[$i][2] = $row["edad_maxima"]; 
                $fila[$i][3] = $row["edad_minima"]; 
                $fila[$i][4] = $row["codigo_disciplina"]; 
                $fila[$i][5] = $row["nombre_disciplina"]; 
                $fila[$i][6] = $row["monto_categoria"]; 
                $i++;
            }
            return $fila;       
    }

    function Comprobacion($id,$nombreC){

        $ConsultaSQL = "SELECT COUNT(id_categoria) FROM `categoria` INNER JOIN disciplina ON categoria.codigo_disciplina = '$id' WHERE nombre_categoria = '$nombreC'";
        $respuesta = $this->con->prepare($ConsultaSQL);
        $respuesta->execute();
        $array = $respuesta->fetchColumn();
        
        if($array > 0){
            return false;
        }else{
            return true;
        }
    }

    function RegistrarCategoria($nombreC, $edad, $edadm, $codigoD, $monto)
    {
    try{
            $ConsultaSQL = "INSERT INTO categoria(nombre_categoria, edad_minima, edad_maxima, codigo_disciplina, monto_categoria) VALUES ('$nombreC', '$edad', '$edadm', '$codigoD', $monto)";
            $respuesta = $this->con->prepare($ConsultaSQL);
            $respuesta->execute();
            return true;
        }catch(PDOException){
            echo '<script>alert("LA CATEGORÍA YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/categoria/categoria.php";</script>';
            return false;
        }
    }

    function UpdateCategoria($id, $categoria, $disciplina, $edadi, $edadm, $monto) 
    {
        try
        {
            $tiraSQL = "UPDATE categoria SET nombre_categoria = '$categoria', edad_maxima = $edadm, edad_minima = $edadi, monto_categoria = $monto, codigo_disciplina = $disciplina WHERE id_categoria = $id";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        }catch(PDOException){
            echo '<script>alert("LA CATEGORÍA YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/categoria/categoria.php";</script>';
            return false;
        }
    }
    function DelectCategoria($id_categoria){
    try{
            $ConsultaSQL = "DELETE FROM categoria WHERE id_categoria = '$id_categoria'";
            $respuesta = $this->con->prepare($ConsultaSQL);
            $respuesta->execute();
            return true;
    }catch (PDOException) {
            echo '<script>alert("LA CATEGORÍA NO ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/categoria/categoria.php";</script>';
            return false;
        }
    }
}