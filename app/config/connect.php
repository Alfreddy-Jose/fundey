<?php
class Connect{
    function Conectar(){
        $host = 'localhost';
        $dbname = 'fundey';
        $user = 'root';
		$pass = "";
        try {
            $con = new PDO("mysql:host=$host; dbname=$dbname; user=$user; password=$pass");
            return $con;
        } catch (PDOException $e) {
            echo "Error en: " . $e->getMessage();
        }
    }
    
}
