<?php


    

(!empty($_POST["id"])) ? $id = $_POST["id"] : null;
(!empty($_POST["id2"])) ? $id2 = $_POST["id2"] : null;
(!empty($_POST["disciplina"])) ? $nombreE = $_POST["disciplina"] : null;
(!empty($_POST["modalida"])) ? $modalidadE = $_POST["modalida"] : null;
class DisciplinaController
{
    private $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/disciplinaModel.php";
        $this->model = new DisciplinaModel;
    }
    
    function showDisciplina()
    {
        $array = $this->model->SelectDisciplina();
        echo "
        <thead class='bg-primary'>
            <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>DISCIPLINA</th>
                <th class='text-center'>MODALIDAD</th>";
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
                <td class='text-center'>$row[1]</td>";
                if (!empty($row[2])) {
                echo"
                <td class='text-center'>$row[2]</td>
                ";
                }else{
                    echo"
                <td class='text-center'>NO TIENE</td>";
                }

                if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                 // modal editar
                echo "
                <td class='text-center'>
                <!-- Button trigger modal editar -->
                <button type='button' title='Editar disciplina' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
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
                        <form action='../../controllers/disciplinaController.php' method='POST' class='d-flex flex-column'
                            id='userEdit" . $row[0] . "'>
                            <input type='number' name='id2' hidden id='id2" . $i++ . "'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[0] . "'>
                            <input type='text' name='disciplina' id='disciplina" . $i++ . "'
                                placeholder='Disciplina'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[1] . "'>
                            <input type='text' name='modalida' id='modalida" . $i++ . "'
                                placeholder='Modalidad'
                                class='mx-3 bg-transparent col-11 text-dark input upper'
                                value='" . $row[2] . "'>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='submit' value='Actualizar' class='btn btn-primary' form='userEdit$row[0]'>
                    </div>
                </div>
            </div>
        </div>";

                // modal eliminar
                echo "
            <!-- Button trigger modal eliminar -->
            <button type='button' title='Eliminar disciplina' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalstatico" . $row[0] . "'>
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
                            <form action='../../controllers/disciplinaController.php' method='POST' class='d-flex'>
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

    function ComprobarDisciplinaExiste($disciplina, $modalidad){
        $comprobar = $this->model->ComprobarDisciplinaExiste($disciplina, $modalidad);
        return $comprobar;
    }
    function SaveDisciplina($disciplina, $modalidad)
    {
        $guarder = $this->model->GuardarDisciplina($disciplina, $modalidad);
        ($guarder) ? header("location: ../views/disciplina/disciplina.php?nombre=" .$disciplina) : header("location: ../views/disciplina/disciplina.php?nombre=err");
    }
    function EditDisciplina($id2, $nombreE, $modalidadE)
    {
        $editar = $this->model->editardisciplina($id2, $nombreE, $modalidadE);
        ($editar) ? header("location: ../views/disciplina/disciplina.php?nombreE=" .$nombreE) : header("location: ../views/disciplina/disciplina.php?nombreE=err"); 
    }

    function DeleteDisciplina($id){
        $delete = $this->model->eliminardisciplina($id);
        ($delete) ? header("location: ../views/disciplina/disciplina.php?id=" .$id) : header("location: ../views/disciplina/disciplina.php?id=err");
    }
}
$obj = new DisciplinaController();

if (!empty($_POST["disciplina1"])) {
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $disciplina = $limpiar->limpiarCadena($_POST["disciplina1"]);
    $modalidad = $limpiar->limpiarCadena($_POST["modalidad"]);
    (empty($modalidad))? $modalidad = '': $modalidad = $modalidad;
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ\s]{1,20}$', $disciplina) && $limpiar->verificar_datos('[a-zA-ZÀ-ÿ\s]{1,20}$', $modalidad)) {
        header("location: ../views/disciplina/disciplina.php?form=err");
    }else{
        $comprobar = $obj->ComprobarDisciplinaExiste($disciplina, $modalidad);
        if ($comprobar === false) {
            header("location: ../views/disciplina/disciplina.php?repetido=err");
        }else{
            $obj->SaveDisciplina($disciplina, $modalidad);
        }
    }
}

if (!empty($id)) {
    $obj->DeleteDisciplina(intval($id));
} 

if (!empty($id2) && !empty($nombreE)){
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $nombreE = $limpiar->limpiarCadena($nombreE);
    $modalidadE = $limpiar->limpiarCadena($modalidadE);
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ\s]{1,20}$', $nombreE) && $limpiar->verificar_datos('[a-zA-ZÀ-ÿ\s]{1,20}$', $modalidadE)) {
        header("location: ../views/disciplina/disciplina.php?form=err");
    }else{
    $obj->EditDisciplina(intval($id2), $nombreE, $modalidadE);
    }
} 
