<?php
date_default_timezone_set('America/Caracas');
$fecha = date('his');

if(!isset($_POST['nombre'])){$_POST['nombre'] = "";}
if(!isset($_POST['categoria'])){$_POST['categoria'] = "";} 
if(!isset($_POST['disciplina'])){$_POST['disciplina'] = "";}

class PagoController
{

    private $modelB;
    private $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require "$server/models/pagoModel.php";
        require "$server/models/becaModel.php";
        $this->modelB = new becaModel(); 
        $this->model = new PagoModel(); 
    }

    function CrearTxt($fecha, $name, $codigoC, $codigoD){

        $array = $this->modelB->AtletasBecados($name, $codigoC, $codigoD);
        foreach ($array as $row) {
            $nivel = $this->modelB->buscarNivelComp($row[2]);
            $monto = $row[10] + $nivel; 

            //Guardando los datos en la tabla de pago
            $codigoA = $row[2];
            $numeroC = $row[16];
            (!empty($_POST['fecha_pago'])) ? $fechaP = $_POST['fecha_pago'] : NULL;
            $pago = $this->model->guardarPago($codigoA, $monto, $fechaP, $numeroC);

            $arreglo = $this->modelB->sumaMonto($row[14]);
            
            if(!empty($arreglo)){
                
                $monto = 0;
                $j = 0;
                
                foreach($arreglo as $fila){
                    $monto += $fila[0] + $fila[1];
                    $j++;
                }
                
            }else{
                $monto = $row[10]+$nivel;
            }

            if ($pago) {
                //Realizando documento txt
                $namefile = '../views/Archivos/Beca'.$fecha.'.txt';
                $file = fopen($namefile, 'a+') or die('Error al intentar crear el archivo');
                $pagina = file_get_contents($namefile);
                $cedula = $row[14];
                $buscar = strpos($pagina, $cedula);

                if ($buscar !== false) {
                    continue;
                }

                fwrite($file, "$row[15]");
                fwrite($file, $row[14]);
                fwrite($file, $row[16]);
                fwrite($file, $monto);
                fwrite($file, "$row[12] ");
                fwrite($file, $row[13]);
                fwrite($file, "\n");
            }
        }

        fclose($file);
        $this->descargarTxt($namefile);
    }

    function descargarTxt($file){
        if (file_exists($file)) {
            header('Content-Type: txt/plain');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length:'.filesize($file));
            readfile($file);
        }else {
            die("El archivo no existe.");
        }
    }
}
$obj = new PagoController();
$obj->CrearTxt($fecha, $_POST['nombre'], $_POST['categoria'], $_POST['disciplina']);