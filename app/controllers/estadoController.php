<?php

(!empty($_POST["id"])) ? $id = $_POST["id"] : null;
(!empty($_POST["estadoE"])) ? $estadoE = $_POST["estadoE"] : null;
(!empty($_POST["id2"])) ? $id2 = $_POST["id2"] : null;
(!empty($_POST["paisE"])) ? $paisE = $_POST["paisE"] : null;
class EstadoController
{
    private $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/estadoModel.php";
        $this->model = new EstadoModel;
    }

    function SelectPais()
    {
        $array = $this->model->selectpais();
        foreach ($array as $row) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }
    
    function showEstado()
    {
        $array = $this->model->Estado();
        echo "
        <thead class='bg-primary'>
            <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>PAIS</th>
                <th class='text-center'>ESTADO</th>";

                if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                echo"<th class='text-center'>OPCIONES</th>";
                }
        echo"
            </tr>
        </thead>
        <tbody>";
        $i = 0;
        $i2 = 0;
        if ($array) {
            foreach ($array as $row) {
                (!empty($row[1])) ? $i2++ : null;
                echo "
            <tr>
                <td class='text-center'>" . $i2 . "</td>
                <td class='text-center'>".strtoupper($row[3])."</td>
                <td class='text-center'>".strtoupper($row[1])."</td>";

                if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                    
                 // modal editar
                echo "
                <td class='text-center'>
                <!-- Button trigger modal editar -->
                <button type='button' title='Editar pais' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
                    <i class='fa-solid fa-pen-to-square'></i>
                </button>
            <!-- Modal Editar -->
        <div class='modal fade' id='staticBackdrop1" . $row[0] . "' data-bs-backdrop='static'
            data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-scrollable'>
                <div class='modal-content bg-white'>
                    <div class='modal-header'>
                        <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>EDITAR REGISTRO " . $row[1] . "</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='../../controllers/estadoController.php' method='POST' class='d-flex flex-column'
                            id='paisEdit" . $row[0] . "'>
                            <div class='d-flex flex-column'>
                                <label for='disciplina'>PAÍS</label>
                                <input type='number' value='$row[0]' name='id2' hidden>
                                <select class='btn border-dark' name='paisE'  id='pais" . $i++ . "' aria-label='.form-select-md example'>
                                    <option value='$row[2]' >$row[3]</option>
                                </select>
                            </div>
                            <input type='text' name='estadoE' id='estado" . $i++ . "'
                                placeholder='Estado'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[1] . "'>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='submit' value='Actualizar' class='btn btn-primary' form='paisEdit$row[0]'>
                    </div>
                </div>
            </div>
        </div>";

                // modal eliminar
                echo "
            <!-- Button trigger modal eliminar -->
            <button type='button' title='Eliminar pais' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalstatico" . $row[0] . "'>
                <i class='fa-solid fa-trash'></i>
            </button>

            <!-- Modal Eliminar -->
            <div class='modal fade' id='modalstatico$row[0]' data-bs-backdrop='static' data-bs-keyboard='false'
                tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content bg-withe'>
                        <div class='modal-header'>
                            <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>ELIMINAR</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <p>ESTÁ SEGURO DE QUE DESEA ELIMINAR EL REGISTRO $row[1]?</p>
                        </div>
                        <div class='modal-footer'>
                            <form action='../../controllers/estadoController.php' method='POST' class='d-flex'>
                                <input type='number' name='id' id='id" . $i++ . "'
                                    class='mx-3 bg-transparent col-12 text-white m-4 p-2' hidden value='$row[0]'>
                                <button type='button' class='btn btn-light mx-2'
                                    data-bs-dismiss='modal'>Cancelar</button>
                                <input type='submit' class='btn btn-danger mx-2' value='Eliminar'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>";
            }
        }
            echo "
        </tr>
    </tbody>
    ";
        }
    }

    function ComprobarEstadoExiste($estado, $pais){
        $comprobar = $this->model->ComprobarEstadoExiste($estado, $pais);
        return $comprobar;
    }
    function SaveEstado($estado, $pais)
    {
        $guarder = $this->model->GuardarEstado($estado, $pais);
        ($guarder) ? header("location: ../views/estado/estado.php?nombre=" .$estado) : header("location: ../views/estado/estado.php?nombre=err");
    }
    function EditEstado($id2, $estadoE, $paisE)
    {
        $editar = $this->model->editarestado($id2, $estadoE, $paisE);
        ($editar) ? header("location: ../views/estado/estado.php?nombreE=" .$estadoE) : header("location: ../views/estado/estado.php?nombreE=err"); 
    }

    function DeleteEstado($id){
        $delete = $this->model->eliminarestado($id);
        ($delete) ? header("location: ../views/estado/estado.php?id=" .$id) : header("location: ../views/estado/estado.php?id=err");
    }
}

$obj = new EstadoController();

if (!empty($_POST["estado"]) && !empty($_POST['pais'])) {
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $estado = $limpiar->limpiarCadena($_POST["estado"]);
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,20}$', $estado)) {
        header('location: ../views/estado/estado.php?form=err');
    }else{
        $comprobar = $obj->ComprobarEstadoExiste($estado, $_POST['pais']);
        if ($comprobar === false) {
            header("location: ../views/estado/estado.php?repetido=err");
        }else{
            $obj->SaveEstado($estado, $_POST['pais']);
        }
    }
}

if (!empty($id)) {
    $obj->DeleteEstado(intval($id));
} 

if (!empty($id2) && !empty($paisE) && !empty($estadoE)){
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $nombreE = $limpiar->limpiarCadena($estadoE);
    $modalidadE = $limpiar->limpiarCadena($paisE);
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,20}$', $estadoE)) {
        header('location: ../views/estado/estado.php?form=err');
    }else{
        $obj->EditEstado(intval($id2), $estadoE, $paisE);
    }
} 