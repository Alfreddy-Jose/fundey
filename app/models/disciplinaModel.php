<?php
$server = dirname(__DIR__, 1);
require_once "$server/config/connect.php";
class DisciplinaModel extends Connect
{
    private $con;

    function __construct()
    {
        $this->con = parent::Conectar();
    }

    function SelectDisciplina()
    {
        $tiraSQL = "SELECT * FROM disciplina ORDER BY nombre_disciplina ASC";
        $respuesta = $this->con->prepare($tiraSQL);
        $respuesta->execute();
        $array = $respuesta->fetchAll();
        $fila = [];
        $i = 0;
        foreach($array as $row)
        {
            $fila[$i][0] = $row["id_disciplina"];
            $fila[$i][1] = $row["nombre_disciplina"];
            $fila[$i][2] = $row["modalidad"];
            $i++;
        }
        return $fila;
    }
    
    function ComprobarDisciplinaExiste($disciplina, $modalidad){

        $consulta = "SELECT count(id_disciplina) FROM disciplina WHERE nombre_disciplina = '$disciplina' && modalidad = '$modalidad'";
        $resultado = $this->con->prepare($consulta);
        $resultado->execute();
        $array = $resultado->fetchColumn();
        
        if($array > 0){
            return false;
        }else{
            return true;
        }
    }

    function GuardarDisciplina($nombre, $modalidad)
    {
        try{$tiraSQL = "INSERT INTO disciplina(nombre_disciplina, modalidad) VALUES ('$nombre', '$modalidad')";
        $tiraSQL = $this->con->prepare($tiraSQL);
        $tiraSQL->execute();
        return true;
        }catch(PDOException){
            echo '<script>alert("LA DISCIPLINA YA ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/disciplina/disciplina.php";</script>';
            return false;
        }
    }

    function eliminardisciplina($id){
        try {
            $tiraSQL = "DELETE FROM disciplina WHERE id_disciplina = '$id'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA DISCIPLINA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/disciplina/disciplina.php";</script>';
            return false;
        }
    }

    function editardisciplina($id, $nombre, $modalidad)
    {
        try{
        $consultaSQL = "UPDATE disciplina SET nombre_disciplina = '$nombre', modalidad = '$modalidad' WHERE id_disciplina='$id'";
        $resultado = $this->con->prepare($consultaSQL); 
        $resultado->execute();
        return true;
        } catch(PDOException) {
            echo '<script>alert("LA DISCIPLINA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/disciplina/disciplina.php";</script>';
            return false;
        }
    }
}

?>