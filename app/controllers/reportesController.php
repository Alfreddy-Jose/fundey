<?php
date_default_timezone_set('America/Caracas');
    if(!isset($_POST['nombre'])){$_POST['nombre'] = "";}
    if(!isset($_POST['categoria'])){$_POST['categoria'] = "";} 
    if(!isset($_POST['disciplina'])){$_POST['disciplina'] = "";}
    
class ReportesController
{
    private $model;

    function __construct() 
    { 
        $server = dirname(__DIR__,1);
        require_once "$server/models/becaModel.php";
        $this->model = new BecaModel();
    }
    
    function showReportes($name,$codigoC,$codigoD){

        $array = $this->model->AtletasBecados($name, $codigoC, $codigoD);
        echo "
            <thead>
            <tr>
                <th class='amarillo'></th>
                <th class='amarillo'></th>
                <th class='amarillo'><h6 class='text-dark'>DATOS</h6></th>
                <th class='amarillo'></th>
                <th class='amarillo'><h6 class='text-dark'>DEL</h6></th>
                <th class='amarillo'></th>
                <th class='amarillo'><h6 class='text-dark'>ATLETA</h6></th>
                <th class='amarillo'></th>
                <th class='bg-success'><h6 class='text-dark'>PROPIETARIO</h6></th>
                <th class='bg-success'><h6 class='text-dark'>DE</h6></th>
                <th class='bg-success'><h6 class='text-dark'>LA</h6></th>
                <th class='bg-success'><h6 class='text-dark'>CUENTA</h6></th>
                <th class='bg-success'></th>
            </tr>
            <tr>
                    <th class='text-center head'>ID</th>
                    <th class='text-center head'>DISCIPLINA</th>
                    <th class='text-center head'>NOMBRE</th>
                    <th class='text-center head'>CÉDULA</th>
                    <th class='text-center head'>SEXO</th>
                    <th class='text-center head'>EDAD</th>
                    <th class='text-center head'>CATEGORÍA</th>
                    <th class='text-center head'>NOMBRE APELLIDO</th>
                    <th class='text-center head'>CÉDULA</th>
                    <th class='text-center head'>NÚMERO CUENTA</th>
                    <th class='text-center head'>BANCO</th>
                    <th class='text-center head'>TIPO.C</th>
                    <th class='text-center head'>TOTAL</th>
                </tr>
            </thead>
            <tbody>
            ";
            $monto = 0;
            $i2 = 0;
            if ($array) {
                foreach ($array as $row) {
                    if ($row[9] === 'ACTIVO') {
                        
                        (!empty($row[0])) ? $i2++ : null;
                        $fechaNacimiento = $row[19];
                        $hoy = date("Y-m-d");
                        $fechaNacimientoTimestamp = strtotime($fechaNacimiento);
                        $hoyTimestamp = strtotime($hoy);
                        $diferenciaEnSegundos = $hoyTimestamp-$fechaNacimientoTimestamp;
                        $edad = floor($diferenciaEnSegundos/(60*60*24*365));
                        $nivel = $this->model->buscarNivelComp($row[2]);
                        echo "
                        <tr class='body'>
                            <td class='td'>" . $i2 . "</td>
                            <td class='td'>" . $row[3] . "</td>
                            <td class='td'>" . $row[0]. " " .$row[1]. "</td>
                            <td class='td'>" . $row[2] . "</td>
                            <td class='td'>" . $row[4] . "</td>
                            <td class='td'> ". $edad ." </td>
                            <td class='td'>" . $row[5] . "</td>
                            <td class='td'>" . $row[12] . ' ' . $row[13] . "</td>
                            <td class='td'>" . $row[14] . "</td>
                            <td class='td'>" . $row[16] . "</td>
                            <td class='td'>" . $row[17] . "</td>
                            <td class='td'>" . $row[18] . "</td>
                            <td class='td'>". $row[10] + $nivel ." </td>
                        </tr>
                    </tbody>";
                        $monto = $monto + ($row[10] + $nivel);
                    
                }

            }
            echo"
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='td'><h6>MONTO</h6></td>
                    <td class='td'><h6>".$monto."</h6></td>
                    <td class='td'><h6>CANTIDAD DE ATLETAS</h6></td>
                    <td class='td'><h6>".$i2."</h6></td>
                    <td class='td'></td>
                </tfoot>
            ";
        }
    }
}



