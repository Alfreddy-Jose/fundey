<?php
session_start(); 
(!empty($_POST["cedula"])) ? $user = $_POST["cedula"] : null;
(!empty($_POST["pass"])) ? $pass = $_POST["pass"] : null;
if (empty($user)) {
    echo ("<meta http-equiv='refresh' content='0; url=../views/login.php'>");
} else {
    echo ("<meta http-equiv='refresh' content='0; url=../views/login.php?cedula=err&pass=err'>");
}  
class LoginController 
{
    private $model;
    function __construct()
    {
        include_once "../models/userModel.php";
        $this->model = new UserModel();
    }
    function VerifyUser($user, $pass)
    {
        $array = $this->model->User();
        foreach ($array as $row) {
            if ($row[0] === $user and password_verify($pass, $row[3])) {
                $_SESSION["cedula"] = $row[0];
                $_SESSION["nombre"] = $row[1];
                $_SESSION["apellido"] = $row[2];
                $_SESSION["pass"] = $row[3];
                $_SESSION["nombre_usuario"] = $row[4];
                $_SESSION["rol"] = $row[5];
                $_SESSION["codigo_rol"] = $row[7];
                $_SESSION["foto"] = $row[8];
                header("location: ../views/panel.php");
            } else {
                if ($row[0] !== $user and (password_verify($pass, $row[3]) === true)) {
                    echo ("<meta http-equiv='refresh' content='0; url=../views/login.php?cedula=err'>");
                } else if ((password_verify($pass, $row[3]) !== true) and $row[0] === $user) {
                    echo ("<meta http-equiv='refresh' content='0; url=../views/login.php?pass=err'>");
                }
            }
        }
    }
}
if (!empty($user) and !empty($pass)) {
    $obj = new LoginController();
    $obj->VerifyUser(intval($user), $pass);
}