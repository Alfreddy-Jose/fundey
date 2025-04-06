<?php
$server = dirname(__DIR__, 1);
include_once "$server/config/connect.php"; 
class UserModel extends Connect
{
    private $con;
    function __construct()
    {
        $this->con = parent::Conectar();
    }
    function User() 
    {
        $tiraSQL = "SELECT usuario.*, rol.nombre_rol FROM usuario INNER JOIN rol ON rol.id_rol = usuario.codigo_rol ";
        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $datos = $result->fetchAll();
        $i = 0;
        $filas = [];
        foreach ($datos as $dato) { 
            $filas[$i][0] = $dato["cedula"];
            $filas[$i][1] = $dato["nombre"];
            $filas[$i][2] = $dato["apellido"];
            $filas[$i][3] = $dato["pass"];
            $filas[$i][4] = $dato["nombre_usuario"];
            $filas[$i][5] = $dato["nombre_rol"];
            $filas[$i][6] = $dato["nacionalidad"];
            $filas[$i][7] = $dato["codigo_rol"];
            $filas[$i][8] = $dato["foto"];
            $i++;
        }
        return $filas;
    }
    function selectRol()
    {
        $tiraSQL = "SELECT * FROM rol";
        $result = $this->con->prepare($tiraSQL);
        $result->execute();
        $datos = $result->fetchAll();
        $i = 0;
        $filas = [];
        foreach ($datos as $dato) {
                $filas[$i][0] = $dato["id_rol"];
                $filas[$i][1] = $dato["nombre_rol"];
                $i++;
        }
        return $filas;
    }
    function InsertUser($cedula, $nombre, $apellido, $password, $username, $rol, $nacionalidad, $imagen)
    { 
        try {
            $tiraSQL = "INSERT INTO usuario(cedula, nombre, apellido, pass, nombre_usuario, nacionalidad, codigo_rol, foto) VALUES ($cedula, '$nombre', '$apellido', '$password' , '$username', '$nacionalidad', '$rol', '$imagen')";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL USUARIO YA ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/usuarios/usuarios.php";</script>';
            return false;
        }
    }
    function DeleteUser($cedula)
    {
        try {
            $tiraSQL = "DELETE FROM usuario WHERE cedula = '$cedula'";
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL USUARIO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/usuario/usuario.php";</script>';
            return false;
        }
    }
    function EditUser($cedu2, $nombre2, $apellido2, $password2, $username2, $rol2, $nacionalidad2, $imagen2)
    {
        try {
            if ($imagen2 !== "") {
                $tiraSQL = "UPDATE usuario SET nombre = '$nombre2', apellido = '$apellido2', pass = '$password2', nombre_usuario = '$username2', codigo_rol = '$rol2', nacionalidad = '$nacionalidad2', foto = '$imagen2' WHERE cedula = '$cedu2'";
            }else{
                $tiraSQL = "UPDATE usuario SET nombre = '$nombre2', apellido = '$apellido2', pass = '$password2', nombre_usuario = '$username2', codigo_rol = '$rol2', nacionalidad = '$nacionalidad2' WHERE cedula = '$cedu2'";
            } 
            $result = $this->con->prepare($tiraSQL);
            $result->execute();
            return true;
        } catch (PDOException) {
            echo '<script>alert("EL USUARIO NO ESTÁ REGISTRADO"); window.location.href = "/FUNDEY/app/views/usuario/usuario.php";</script>';
            return false;
        }
    }
}
