<?php

class BecaController
{
    private $model;
    private $modelP; 
    function __construct()
    { 
        $server = dirname(__DIR__, 1);
        require_once "$server/models/becaModel.php";
        require_once "$server/models/PagoModel.php";
        $this->model = new BecaModel();
        $this->modelP = new PagoModel();
    }
    function Comprobarpago(){
        $mes = date('m');
        $ano = date('Y');
        $pago = $this->modelP->ComprobarPago();
        
        if ($pago == NULL) {
            return true;
        }else{
            if(($pago[1] == $mes and $ano == $pago[0])){
            return false;
        }else{
            return true;
        } 
    } 
}
    function Historial($atleta)
    {
    echo"<thead class='bg-primary text-white'>
            <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>FECHA</th>
                <th class='text-center'>CANTIDAD</th>
                <th class='text-center'>CUENTA</th>
            </tr>
        </thead>";
        $historia = $this->modelP->historial($atleta);
        $i = 1;
        foreach ($historia as $filas){
        echo "
                <tbody>
                    <tr>
                        <td class='text-center'>" . $i . "</td>
                        <td class='text-center'>" . $filas[1] . "</td>
                        <td class='text-center'>" . $filas[0] . "</td>
                        <td class='text-center'>" . $filas[2] . "</td>
                    </tr>
                </tbody>";
            $i++;
        }
    }
    function ShowAtletaBecados($name, $codigoC, $codigoD)
    {
        $array = $this->model->AtletasBecados($name, $codigoC, $codigoD);
        
        echo "
            <thead class='bg-primary'>
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>CÉDULA</th>
                    <th class='text-center'>NOMBRE Y APELLIDO</th>
                    <th class='text-center'>DISCIPLINA</th>
                    <th class='text-center'>CATEGORÍA</th>
                    <th class='text-center'>MONTO</th>";
                    if (!($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/listaBecados/listaBecados.php')) {
                        echo"<th class='text-center'>STATUS</th>
                            <th class='text-center'>HISTORIAL</th>";
                    } 
        echo"</tr>
            </thead>
            <tbody>
            ";
            $i = 0;
            $i2 = 0;
            $pago = $this->Comprobarpago();
            if ($array) {
                foreach ($array as $row) {
                    $nivel = $this->model->buscarNivelComp($row[2]);
                    if ($row[9] === 'ACTIVO') {

                            (!empty($row[0])) ? $i2++ : null;
                    echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[8] . '-' . $row[2] . "</td>
                    <td class='text-center'>" . $row[0] . " " . $row[1] . "</td>
                    <td class='text-center'>" . $row[3] . "</td>
                    <td class='text-center'>" . $row[5] . "</td>
                    <td class='text-center'>". $row[10] + $nivel . "</td>";
                    if (!($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/listaBecados/listaBecados.php')) {
                echo"<td class='text-center'>
                        <div class='btn-group' role='group' aria-label='Basic radio data-bs-toggle button group'>
                            <input type='radio' class='btn-check' name='statu". $i++ ."' id='statu1". $i++ ."' autocomplete='off'"; if($pago) {echo "checked";} echo ">
                            <label for='statu1' class='btn btn-outline-primary'>ESPERA</label>
                            
                            <input type='radio' class='btn-check' name='statu". $i++ ."' id='statu2". $i++ ."' autocomplete='off'"; if(!$pago) {echo "checked";} echo ">
                            <label for='statu2' class='btn btn-outline-primary'>PAGAR</label>
                        </div>
                    </td>


                    <td class='text-center'>


                        <!-- Button trigger modal historial -->
                        <button type='button' class='btn btn-success' title='Historial de pagos' data-bs-toggle='modal' data-bs-target='#staticBackdrop" . $row[2] . "'>
                            <i class='fa-regular fa-clipboard'></i>
                        </button>
                        
                        <!-- Modal Historial -->
                        <div class='modal fade' id='staticBackdrop".$row[2]."' data-bs-backdrop='static' data-bs-keyboard='false'
                            tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content bg-withe'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>HISTORIAL DE PAGO DEL ATLETA ".$row[2]."</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <table class='table table-bordered border-primary table-hover text-dark text-center'>";
                                            $this->Historial($row[2]);
                                echo"   </table>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    ";
                } 
            }
        }
            echo "
            </tr>
            </tbody>
            ";
        }
    }

}

