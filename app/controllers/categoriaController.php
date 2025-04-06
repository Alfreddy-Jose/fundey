<?php

(!empty($_POST['id'])) ? $id_categoria = $_POST['id'] : NULL;
(!empty($_POST['disciplina'])) ? $id_disciplina = $_POST['disciplina'] : NULL;
(!empty($_POST['id1'])) ? $id_categoria1 = $_POST['id1'] : NULL;
(!empty($_POST['disciplina1'])) ? $id_disciplina1 = $_POST['disciplina1'] : NULL;
(!empty($_POST['categoria1'])) ? $categoria1 = $_POST['categoria1'] : NULL;
(!empty($_POST['edadi1'])) ? $edadi1 = $_POST['edadi1'] : NULL;
(!empty($_POST['edadm1'])) ? $edadm1 = $_POST['edadm1'] : NULL;
(!empty($_POST['monto1'])) ? $monto1 = $_POST['monto1'] : NULL;


class CategoriaController
{
    private $model;
    private $modelD;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/categoriaModel.php";
        require_once "$server/models/disciplinaModel.php";
        $this->modelD = new DisciplinaModel();
        $this->model = new CategoriaModel();
    }


    function selectCategoria($id_disciplina)
    {
        $respuesta = "<option value='' disabled selected >Seleccione la categoría</option>";
        $selec = $this->model->SelectCategoria($id_disciplina);
        foreach ($selec as $row) {
            $respuesta .=  "<option value='$row[0]'>$row[1]</option>";
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function selectdisciplina()
    {
        $array = $this->modelD->SelectDisciplina();
        foreach ($array as $row) {
            echo "<option value='$row[0]'>$row[1] $row[2]</option>";
        }
    }

    function ShowCategoria()
    {
        $array = $this->model->Categoria();
        echo "
            <thead class='bg-primary'>
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>DISCIPLINA</th>
                    <th class='text-center'>CATEGORIA</th>
                    <th class='text-center'>EDAD MÍNIMA Y MÁXIMA</th>
                    <th class='text-center'>MONTO</th>";
        if ($_SESSION["codigo_rol"] === 2220 || $_SESSION['codigo_rol'] === 4440) {
            echo "<th class='text-center'>OPCIONES</th>";
        }
        echo "
                </tr>
            </thead>
            <tbody>
            ";
        $i = 0;
        $i2 = 0;
        if ($array) {
            foreach ($array as $row) {
                (!empty($row[0])) ? $i2++ : null;
                echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[5] . "</td>
                    <td class='text-center'>" . $row[1] . "</td>
                    <td class='text-center'>" . $row[3] . " - " . $row[2] . "</td>
                    <td class='text-center'>" . $row[6] . "</td>
                    ";
                if ($_SESSION["codigo_rol"] === 2220 || $_SESSION['codigo_rol'] === 4440) {

                    // modal editar
                    echo "
                <td class='text-center'>
                <!-- Button trigger modal editar -->
                <button type='button' title='Editar categoria' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
                    <i class='fa-solid fa-pen-to-square'></i>
                </button>
                <!-- Modal Editar -->
            <div class='modal fade' id='staticBackdrop1" . $row[0] . "' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-scrollable'>
                    <div class='modal-content bg-white'>
                        <div class='modal-header'>
                            <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>EDITAR REGISTRO " . $row[1] . "</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form action='../../controllers/categoriaController.php' method='POST' class='d-flex flex-column' id='userEdit" . $row[0] . "'>
                                <input type='number' name='id1' id='id1" . $i++ . "' placeholder='Cédula' class='mx-3 bg-transparent col-12 text-dark input' required value='" . $row[0] . "' hidden readonly>
                                <div class='d-flex flex-column'>
                                    <label for='disciplina1'>DISCIPLINA</label>
                                    <select class='btn border-dark' name='disciplina1'>";
                                    $this->selectdisciplina();
                                    echo "</select>
                                </div>
                                <input type='text' name='categoria1' id='categoria1" . $i++ . "' placeholder='Categoría' class='mx-3 bg-transparent col-11 text-dark input upper' required value='" . $row[1] . "'>
                                <input type='number' name='edadi1' id='edadi1" . $i++ . "' placeholder='Edad Minima' class='mx-3 bg-transparent col-11 text-dark input' value='" . $row[3] . "' required>
                                <input type='number' name='edadm1' id='edadm1" . $i++ . "' placeholder='Edad Máxima' class='mx-3 bg-transparent col-11 text-dark input' value='" . $row[2] . "' required>
                                <input type='number' name='monto1' id='monto1" . $i++ . "' placeholder='Monto' class='mx-3 bg-transparent col-11 text-dark input' value='" . $row[6] . "' required>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                            <input type='submit' value='Actualizar' class='btn btn-primary' form='userEdit$row[0]'>
                        </div>
                    </div>
                </div>
            </div>
                                ";

            // modal eliminar
            echo "
            <!-- Button trigger modal eliminar -->
            <button type='button' title='Eliminar categoria' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#staticBackdrop" . $row[0] . "'>
                <i class='fa-solid fa-trash'></i>
            </button>
            <!-- Modal Eliminar -->
            <div class='modal fade' id='staticBackdrop$row[0]' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
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
                            <form action='../../controllers/categoriaController.php' method='POST' class='d-flex'>
                                <input type='number' name='id' id='id" . $i++ . "' class='mx-3 bg-transparent col-12 text-white m-4 p-2' hidden value='$row[0]'>
                                <button type='button' class='btn btn-light mx-2' data-bs-dismiss='modal'>Cancelar</button>
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
    }

    function Com($id_disciplina, $nombreC)
    {
        $guarder = $this->model->Comprobacion($id_disciplina, $nombreC);
        return $guarder;
    }
    function GuardarCategoria($nombreC, $edad, $edadm, $disciplina, $monto)
    {
        $guarder = $this->model->RegistrarCategoria($nombreC, $edad, $edadm, $disciplina, $monto);
        ($guarder) ? header("location: ../views/categoria/categoria.php?categoria=" . $nombreC) : header("location: ../views/categoria/categoria.php?categoria=err");
    }

    function EditarCategoria($id, $nombreC, $disciplina, $edad, $edadm, $monto)
    {
        $editar = $this->model->UpdateCategoria($id, $nombreC, $disciplina, $edad, $edadm, $monto);
        ($editar) ? header("location: ../views/categoria/categoria.php?categori1=" . $nombreC) : header("location: ../views/categoria/categoria.php?categori1=err");
    }
    function eliminarcategoria($id_categoria)
    {
        $eliminar = $this->model->DelectCategoria($id_categoria);
        ($eliminar) ?  header("location: ../views/categoria/categoria.php?categori=" . $id_categoria) : header("location: ../views/categoria/categoria.php?categori=err");
    }
}

$obj = new CategoriaController();

if (!empty($_POST["nombreC"]) && !empty($_POST["disciplina"]) && !empty($_POST["edad"]) && !empty($_POST["edadm"])) {
    $comprobar = $obj->Com($id_disciplina, ucfirst($_POST['nombreC']));
    if ($comprobar == true) {
        require '../config/cadenas.php';
        $cadenas = new LimpiarCadenas();
        $nombre = $cadenas->limpiarCadena(($_POST["nombreC"]));
        $edad = $cadenas->limpiarCadena($_POST["edad"]);
        $edadm = $cadenas->limpiarCadena($_POST["edadm"]);
        $disciplina = $cadenas->limpiarCadena($_POST["disciplina"]);
        $monto = $cadenas->limpiarCadena($_POST["monto"]);
        if ($cadenas->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $nombre) || $cadenas->verificar_datos('\d{1,2}$', $edad) || $cadenas->verificar_datos('\d{1,2}$', $edadm) || $cadenas->verificar_datos('\d{1,10}$', $monto)) {
            header("location: ../views/categoria/categoria.php?form=err");
        } else {
            $obj->GuardarCategoria((ucfirst($nombre)), $edad, $edadm, $disciplina, $monto);
        }
    } else {
        header("location: ../views/categoria/categoria.php?repetido=err");
    }
}
if (
    !empty($id_categoria1) && !empty($id_disciplina1) && !empty($edadi1)
    && !empty($edadm1) && !empty($monto1) && !empty($categoria1)
) {
    require '../config/cadenas.php';
    $cadenas = new LimpiarCadenas();
    $id_categoria1 = $cadenas->limpiarCadena($id_categoria1);
    $categoria1 = $cadenas->limpiarCadena($categoria1);
    $id_disciplina1 = $cadenas->limpiarCadena($id_disciplina1);
    $edadi1 = $cadenas->limpiarCadena($edadi1);
    $edadm1 = $cadenas->limpiarCadena($edadm1);
    $monto1 = $cadenas->limpiarCadena($monto1);
    if ($cadenas->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $categoria1) || $cadenas->verificar_datos('\d{1,2}$', $edadi1) || $cadenas->verificar_datos('\d{1,2}$', $edadm1) || $cadenas->verificar_datos('\d{1,10}$', $monto1)) {
        header("location: ../views/categoria/categoria.php?form=err");
    } else {
        $obj->EditarCategoria(intval($id_categoria1), $categoria1, intval($id_disciplina1), intval($edadi1), intval($edadm1), $monto1);
    }
}
if (!empty($id_categoria)) {
    $obj->eliminarcategoria($id_categoria);
}

if (!empty($id_disciplina)) {
    $obj->selectCategoria($id_disciplina);
}
