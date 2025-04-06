<?php

(!empty($_POST["id"])) ? $id = $_POST["id"] : null;
(!empty($_POST["id2"])) ? $id2 = $_POST["id2"] : null;
(!empty($_POST["pais1"])) ? $pais2 = $_POST["pais1"] : null;
class PaisController
{
    private $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/paisModel.php";
        $this->model = new PaisModel;
    }
    
    function showPais()
    {
        $array = $this->model->Pais();
        echo "
        <thead class='bg-primary'>
            <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>PAIS</th>";
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
                        <form action='../../controllers/paisController.php' method='POST' class='d-flex flex-column'
                            id='paisEdit" . $row[0] . "'>
                            <input type='number' name='id2' hidden id='id2" . $i++ . "'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[0] . "'>
                            <input type='text' name='pais1' id='pais1" . $i++ . "'
                                placeholder='País'
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
                            <form action='../../controllers/paisController.php' method='POST' class='d-flex'>
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

    function ComprobarPaisExiste($pais){
        $comprobar = $this->model->ComprobarPaisExiste($pais);
        return $comprobar;
    }
    function SavePais($nombre)
    {
        $guarder = $this->model->GuardarPais($nombre);
        ($guarder) ? header("location: ../views/pais/pais.php?nombre=" .$nombre) : header("location: ../views/pais/pais.php?nombre=err");
    }
    function EditPais($id2, $nombre)
    {
        $editar = $this->model->editarpais($id2, $nombre);
        ($editar) ? header("location: ../views/pais/pais.php?nombreE=" .$nombre) : header("location: ../views/pais/pais.php?nombreE=err"); 
    }

    function DeletePais($id){
        $delete = $this->model->eliminarpais($id);
        ($delete) ? header("location: ../views/pais/pais.php?id=" .$id) : header("location: ../views/pais/pais.php?id=err");
    }
}
$obj = new PaisController();

if (!empty($_POST["pais"])) {
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $pais = $limpiar->limpiarCadena($_POST["pais"]);
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,20}$', $pais)) {
        header("location: ../views/pais/pais.php?form=err");
    } else {
        $comprobar = $obj->ComprobarPaisExiste($pais);
        if ($comprobar === false) {
            header("location: ../views/pais/pais.php?repetido=err");
        }else{
            $obj->SavePais($pais);
        }
    }
}

if (!empty($id)) {
    $obj->DeletePais(intval($id));
} 

if (!empty($id2) && !empty($pais2)){
    require "../config/cadenas.php";
    $limpiar = new LimpiarCadenas();
    $pais2 = $limpiar->limpiarCadena($pais2);
    if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,20}$', $pais2)) {
        header("location: ../views/pais/pais.php?form=err");
    } else {
    $obj->EditPais(intval($id2), $pais2);
    }
} 
