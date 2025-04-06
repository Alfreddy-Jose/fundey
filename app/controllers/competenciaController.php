<?php
date_default_timezone_set('America/Caracas');
$id_comp = date("Ymdhis");


(!empty($_POST["codigo_pais"])) ? $id_pais = $_POST["codigo_pais"] : NULL;
(!empty($_POST["id_comp3"])) ? $id_comp3 = $_POST["id_comp3"] : NULL;
(!empty($_POST["id_comp"])) ? $id_competencia = $_POST["id_comp"] : NULL;
(!empty($_POST["nombre2"])) ? $nombreC2 = $_POST["nombre2"] : NULL;
(!empty($_POST["fecha2"])) ? $fechaC2 = $_POST["fecha2"] : NULL;
(!empty($_POST["nivel2"])) ? $CodNC2 = $_POST["nivel2"] : NULL;
(!empty($_POST["estado2"])) ? $estado = $_POST["estado2"] : NULL;


class CompetenciaController 
{
    private  $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/competenciaModels.php";
        $this->model = new CompetenciaModel();
    }

    function SelectPais()
    {
        $array = $this->model->selectpais();
        foreach ($array as $row) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }

    function SelectEstado($id_pais)
    {
        $respuesta =  "<option value='' disabled selected >Seleccione</option>";
        $arreglo = $this->model->selectestado($id_pais);
        foreach ($arreglo as $row) {
            $respuesta .=  "<option value='$row[0]'>$row[1]</option>";
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    function SelectNivelcomp()
    {
        $array = $this->model->selectNivelComp();
        foreach ($array as $row) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }

    function ShowCompetencia()
    {
        $array = $this->model->Competencia();
        echo "
            <thead class='bg-primary'>
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>NOMBRE</th>
                    <th class='text-center'>FECHA</th>
                    <th class='text-center'>PAIS</th>
                    <th class='text-center'>ESTADO</th>
                    <th class='text-center'>NIVEL COMPETENCIA</th>";
                    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                    echo"<th class='text-center'>OPCIONES</th>";
                    }
                echo"
                </tr>
            </thead>
            <tbody>
            ";
        $i = 0;
        $i2 = 0;
        if ($array) {
            foreach ($array as $row) {
                $i++;
                (!empty($row[0])) ? $i2++ : null;
                echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[0] . "</td>
                    <td class='text-center'>" . $row[1] . "</td>
                    <td class='text-center'>" . strtoupper($row[5]) . "</td>
                    <td class='text-center'>" . strtoupper($row[2]) . "</td>
                    <td class='text-center'>" . $row[3] . "</td>
                    ";
                    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                // modal editar
                echo "
                        <td class='text-center'>
                        <!-- Button trigger modal editar -->
                        <button type='button' title='Editar competencia' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[4] . "'>
                            <i class='fa-solid fa-pen-to-square'></i>
                        </button>
                        <!-- Modal Editar -->
                <div class='modal fade' id='staticBackdrop1$row[4]' data-bs-backdrop='static'
                    data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content bg-white'>
                            <div class='modal-header'>
                                <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>EDITAR REGISTRO " . $row[0] . "</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form action='../../controllers/competenciaController.php' method='POST' class='d-flex flex-column'
                                    id='competenciaEditer$row[4]'>
                                        <input type='hidden' name='id_comp' id='id_comp' required value='$row[4]' >
                                    <input type='text' name='nombre2' id='nombre2" . $i . "'
                                        placeholder='Ingrese nombre competencia'
                                        class='mx-3 bg-transparent col-11 text-dark input upper' required
                                        value='" . $row[0] . "'>
                                    <input type='date' name='fecha2' id='fecha2" . $i . "'
                                        class='mx-3 bg-transparent col-11 text-dark input upper' required
                                        value='" . $row[1] . "'>
                                        <div class='d-flex flex-column'>
                                            <label for='pais".$i."'>PAIS</label>
                                                <select class='btn border-dark' name='codigo_pais' id='pais".$i."'>
                                                <option disabled selected >" . $row[5] . "</option>";
                                                    $select = new CompetenciaController();
                                                    $select->SelectPais();
                                                    echo "
                                                </select>
                                            </div>
                                        <div class='d-flex flex-column'>
                                            <label for='estado".$i."'>ESTADO</label>
                                                <select class='btn border-dark' value='' name='estado2' id='estado".$i."'>
                                                    <option value='" . $row[6] . "'>". $row[2] . "</option>";
                                                    echo "
                                                </select>
                                            </div>
                                        <div class='d-flex flex-column'>
                                            <label for='nivel".$i."'>NIVEL DE COMPETENCIA</label>
                                                <select class='btn border-dark' name='nivel2' id='nivel".$i."'>
                                                <option value='" . $row[7] . "'>" . $row[3] . "</option>";
                                                $select->SelectNivelcomp();
                                                    echo "
                                                </select>
                                            </div>
                                    </form>
                                </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                                <input type='submit' value='Actualizar' class='btn btn-primary' form='competenciaEditer$row[4]'>
                            </div>
                        </div>
                    </div>
                </div>
                        ";


                // modal eliminar
                echo "
                        <!-- Button trigger modal eliminar -->
                        <button type='button' title='Eliminar competencia' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#Deletcomp$row[4] '>
                            <i class='fa-solid fa-trash'></i>
                        </button>
                        <!-- Modal Eliminar -->
                <div class='modal fade' id='Deletcomp$row[4]' data-bs-backdrop='static' data-bs-keyboard='false'
                    tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content bg-withe'>
                            <div class='modal-header'>
                                <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>ELIMINAR</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <p>ESTÁ SEGURO DE QUE DESEA ELIMINAR EL REGISTRO $row[0]?</p>
                            </div>
                            <div class='modal-footer'>
                                <form action='../../controllers/competenciaController.php' method='POST' class='d-flex'>
                                    <input type='number' name='id_comp3' id='id_comp3" . $i . "'
                                        class='mx-3 bg-transparent col-12 text-white m-4 p-2' hidden value='$row[4]'>
                                    <button type='button' class='btn btn-light mx-2'
                                        data-bs-dismiss='modal'>Cancelar</button>
                                    <input type='submit' class='btn btn-danger mx-2' value='Eliminar'>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    </td>
                    ";
                }
            }
            echo "
            </tr>
            </tbody>
            ";
        }
        return $array;
    }

    function SaveCompetencia($id_com, $nombreC, $fechaC, $estado, $nivelComp, $lugar)
    {
        $guarder = $this->model->InsertComp($id_com, $nombreC, $fechaC, $estado, $nivelComp, $lugar);
        ($guarder) ? header("location: ../views/competencia/competencia.php?cod=". $nombreC) : header("location: ../views/competencia/competencia.php?cod=err");
    }

    function DeleteCompetencia($id_comp3){
        $delete = $this->model->DeletComp($id_comp3);
        ($delete) ? header("location: ../views/competencia/competencia.php?cod1= bn") : header("location: ../views/competencia/competencia.php?cod1=err");
    }

    function EditCompetencia($nombreC2, $fechaC2, $Codpais2, $CodNC2, $id_competencia)
    {
        $edit = $this->model->UpdateComp($nombreC2, $fechaC2, $Codpais2, $CodNC2, $id_competencia);
        ($edit) ? header("location: ../views/competencia/competencia.php?cod2=". $nombreC2) : header("location: ../views/competencia/competencia.php?cod2=err");
    }
}
$obj = new CompetenciaController();

if (!empty($_POST['competencia']) and !empty($_POST['fecha']) and !empty($_POST['estado']) and !empty($_POST['lugar']) and !empty($_POST['id_nivelcomp'])) {
    require '../config/cadenas.php';
    $cadenas = new LimpiarCadenas();
    $competencia = $cadenas->limpiarCadena($_POST['competencia']);
    $lugar = $cadenas->limpiarCadena($_POST['lugar']);
    if ($cadenas->verificar_datos('[a-zA-ZÀ-ÿ\s\d]{1,40}$', $competencia) || $cadenas->verificar_datos('[a-zA-ZÀ-ÿ\s\d]{1,40}$', $lugar)) {
        header('location: ../views/competencia/competencia.php?form=err');
    }else{
        $obj->SaveCompetencia($id_comp, $competencia , $_POST['fecha'], $_POST['estado'], $_POST['id_nivelcomp'], $lugar);
    }
}
if (!empty($id_comp3)) {
    $obj->DeleteCompetencia($id_comp3);
}
if (!empty($nombreC2) and !empty($fechaC2) and !empty($estado) and !empty($CodNC2) and !empty($id_competencia)) {
    require '../config/cadenas.php';
    $cadenas = new LimpiarCadenas();
    $nombreC2 = $cadenas->limpiarCadena($nombreC2);
    if ($cadenas->verificar_datos('[a-zA-ZÀ-ÿ\s\d]{1,40}$', $nombreC2)) {
        header('location: ../views/competencia/competencia.php?form=err');
    }else{
        $obj->EditCompetencia($nombreC2, $fechaC2, $estado, $CodNC2, $id_competencia); 
    }
}
if (!empty($id_pais)){
    $obj->SelectEstado($id_pais);
}