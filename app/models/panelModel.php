<?php
$server = dirname(__DIR__, 1);
require_once "$server/config/connect.php";
class PanelModel extends connect
{

        private $con;

        function __construct()
        {
                $this->con = parent::Conectar();
        }

        function ContarAtletasIn()
        {

                $consultaSQL = "SELECT COUNT(1) FROM atleta WHERE statu = 'INACTIVO'";
                $resultado = $this->con->prepare($consultaSQL);
                $resultado->execute();
                $enviar = $resultado->fetchColumn();
                return $enviar;
        }
        function ContarAtletasAc()
        {

                $consultaSQL = "SELECT COUNT(1) FROM atleta WHERE statu = 'ACTIVO'";
                $resultado = $this->con->prepare($consultaSQL);
                $resultado->execute();
                $enviar = $resultado->fetchColumn();
                return $enviar;
        }
        function ContarAtletasTotal()
        {

                $consultaSQL = "SELECT COUNT(1) FROM atleta";
                $resultado = $this->con->prepare($consultaSQL);
                $resultado->execute();
                $enviar = $resultado->fetchColumn();
                return $enviar;
        }
        function ContarUsuarios()
        {

                $consultaSQL = "SELECT COUNT(1) FROM usuario";
                $resultado = $this->con->prepare($consultaSQL);
                $resultado->execute();
                $enviar = $resultado->fetchColumn();
                return $enviar;
        }
}
