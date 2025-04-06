<?php 
$server = dirname(__DIR__, 1);
include_once "$server/config/connect.php";
class PropietarioModel extends Connect{
    private $con;

    function __construct()
    {
        $this->con = parent::Conectar(); 
    }
    function SelectBanco(){
        $consultaSQL = "SELECT * FROM banco";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $fila = [];
        foreach($array as $row){
            $fila [$i][0] = $row["id_banco"];
            $fila [$i][1] = $row["nombre_banco"];
            $i++;
        }
        return $fila;
    } 

    function buscador($cedula){
        $tiraSQL = "SELECT codigo_propietario, codigo_banco, numero_cuenta, tipo_cuenta, propietario.nacionalidad_propietario, propietario.nombre_propietario, propietario.apellido_propietario, banco.id_banco, banco.nombre_banco FROM cuenta INNER JOIN propietario ON cuenta.codigo_propietario = propietario.cedula_propietario INNER JOIN banco ON cuenta.codigo_banco = banco.id_banco WHERE codigo_propietario LIKE ?";
        $result = $this->con->prepare($tiraSQL);
        $result->execute([$cedula]);
        $atleta = $result->fetchAll();

        $filas = [];
        $i = 0;
        foreach($atleta as $row){
            $filas [$i][0] = $row["nombre_propietario"];
            $filas [$i][1] = $row["apellido_propietario"];
            $filas [$i][2] = $row["id_banco"];
            $filas [$i][3] = $row["nombre_banco"];
            $filas [$i][4] = $row["numero_cuenta"];
            $filas [$i][5] = $row["tipo_cuenta"];
            $filas [$i][6] = $row["nacionalidad_propietario"];
            $i++;
        }
        return $filas;
    }

    function atletaCuenta($cedula){
        $consultaSQL = "SELECT cedula, nombre, apellido FROM atleta WHERE cedula = $cedula";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $fila = [];
    foreach($array as $row){
            $fila [$i][0] = $row["cedula"];
            $fila [$i][1] = $row["nombre"];
            $fila [$i][2] = $row["apellido"];
            $i++;
        }
        return $fila;
    }
    function Propietario(){
        $consultaSQL = "SELECT * FROM cuenta INNER JOIN propietario ON cedula_propietario = codigo_propietario";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $fila = [];
    foreach($array as $row){
            $fila [$i][0] = $row["cedula_propietario"];
            $fila [$i][1] = $row["nombre_propietario"];
            $fila [$i][2] = $row["apellido_propietario"];
            $fila [$i][3] = $row["nacionalidad_propietario"];
            $fila [$i][5] = $row["numero_cuenta"];
            $fila [$i][6] = $row["tipo_cuenta"];
            $fila [$i][7] = $row["codigo_banco"];
            $i++;
        }
        return $fila;
    }

    function InsertPropietario($cedula, $nombre, $apellido, $nacionalidad){
        try {
            $tiraSQL = "INSERT INTO propietario(cedula_propietario, nombre_propietario, apellido_propietario, nacionalidad_propietario) VALUES ($cedula, '$nombre', '$apellido', '$nacionalidad')";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL PROPIETARIO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }
    function InsertCuenta($numCuenta, $tipoCuenta, $codatleta, $codpropietario, $codbanco){
        try {
            $tiraSQL = "INSERT INTO cuenta(numero_cuenta, tipo_cuenta, codigo_atleta, codigo_propietario, codigo_banco) VALUES ($numCuenta, '$tipoCuenta', $codatleta, $codpropietario, '$codbanco')";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("LA CUENTA NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function DeletPropietario($cedula){
        try {
            $tiraSQL = "DELETE FROM propietario WHERE cedula_propietario = '$cedula'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL PROPIETARIO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function UpdatePropietario($cedula, $nombreP, $apellidoP, $nacionalidadP, $codigoC){
        try {
            $tiraSQL = "UPDATE atleta SET nombre = '$nombreP', apellido = '$apellidoP', fecha_nacimiento = '$nacionalidadP', codigo_usuario = '$codigoC' WHERE cedula = $cedula";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL PROPIETARIO NO ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }

    function buscarPropietario($cedula){
        try {
            $consultaSQL = "SELECT COUNT(1) FROM cuenta WHERE codigo_propietario = '$cedula'";
            $resultado = $this->con->prepare($consultaSQL);
            $resultado->execute();
            $array = $resultado->fetchColumn();
            
            if ($array > 0) {
                return true;
            }else {
                return false;
            }

        } catch (PDOException) {
            echo '<script>alert("EL PROPIETARIO NO ESTÁ REGISTRADA"); window.location.href = "/FUNDEY/app/views/atleta/atleta.php";</script>';
            return false;
        }
    }
    
    function asignarPropietario($cedula)
    {
        $consultaSQL = "SELECT * FROM cuenta WHERE codigo_propietario = $cedula";
        $resultado = $this->con->prepare($consultaSQL);
        $resultado->execute();
        $array = $resultado->fetchAll();
        $i = 0;
        $fila = [];
        foreach($array as $row){
            $fila [$i][0] = $row["numero_cuenta"];
            $fila [$i][1] = $row["tipo_cuenta"];
            $fila [$i][2] = $row["codigo_banco"];
            $i++;
        }
        return $fila;
    }
}

?>