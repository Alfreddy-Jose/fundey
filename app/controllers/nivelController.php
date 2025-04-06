<?php
(!empty($_POST['id2']) ? $id2 = $_POST['id2'] : NULL);
(!empty($_POST['id1']) ? $id1 = $_POST['id1'] : NULL);
(!empty($_POST['monto1']) ? $monto1 = $_POST['monto1'] : NULL);
Class NivelController{ 

    private $model;

    function __construct()
    {
        $server = dirname (__DIR__, 1);
        require_once "$server/models/nivelModel.php";
        $this->model = new NivelModel();
    }

    function SelectNivel(){
        $array = $this->model->nivelCompetencia();
        foreach($array as $row){
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }

    function MostrarNivel()
    {
        $array = $this->model->nivelCompetencia();
        echo'
        <thead class="bg-primary">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">NIVEL</th>
                <th class="text-center">MONTO</th>';
                if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                echo'<th class="text-center">OPCIONES</th>';
                }
        echo'
            </tr>
        </thead>
        <tbody>';
        $i = 0;
        $i2 = 0;
        if ($array) {
            foreach ($array as $row) {
                (!empty($row[0])) ? $i2++ : null;
                echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[1] . "</td>
                    <td class='text-center'>" . $row[2] . "</td>";
                    if ($_SESSION["codigo_rol"] === 2220 || $_SESSION['codigo_rol'] === 4440){
                 // modal editar
                echo "
                <td class='text-center'>
                    <!-- Button trigger modal editar -->
                    <button type='button' title='Editar nivel de competencia' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
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
                                    <form action='../../controllers/nivelController.php' method='POST' class='d-flex flex-column'
                                        id='userEdit" . $row[0] . "'>
                                        <input type='text' name='id1' id='id1" . $i++ . "'
                                            placeholder='id1'
                                            class='mx-3 bg-transparent col-11 text-dark input upper' hidden readonly required
                                            value='" . $row[0] . "'>
                                        <div class='d-flex flex-column'>
                                            <label for='Roles'>NIVEL DE COMPETENCIA</label>
                                            <select class='btn border-dark' name='nivel1'>
                                                <option disabled selected readonly>".$row[1]."</option>
                                            </select>
                                        </div>
                                        <input type='text' name='monto1' id='monto1" . $i++ . "'
                                            placeholder='Monto'
                                            class='mx-3 bg-transparent col-11 text-dark input upper' required
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
                    <button type='button' title='Eliminar nivel de competencia' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalstatico" . $row[0] . "'>
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
                                    <form action='../../controllers/nivelController.php' method='POST' class='d-flex'>
                                        <input type='number' name='id2' id='id2" . $i++ . "'
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
        </tbody>";
        }
    }

    function SaveNivel($nivel, $monto)
    {
        $guardar = $this->model->InsertarNivel($nivel, $monto);
        ($guardar) ? header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod='.$nivel) : header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod=err');
    }

    function EditNivel($nivel, $monto)
    {
        $editar = $this->model->InsertarNivel($nivel, $monto);
        ($editar) ?  header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod1='.$nivel) : header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod1=err');
    }

    function DeleteNivel($id)
    {
        $delet = $this->model->DeletNivel($id);
        ($delet) ? header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod2='.$id) : header('location: /FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php?cod2=err');
    }

}//end class

$obj = new NivelController();

if (!empty($_POST['nivel']) && !empty($_POST['monto'])){
    require '../config/cadenas.php';
    $cadenas = new LimpiarCadenas();
    $nivel = $_POST['nivel'];
    $monto = $cadenas->limpiarCadena($_POST['monto']);
    if ($cadenas->verificar_datos('\d{2,10}$', $monto)) {
        header("location: ../views/nivelCompetencia/nivelCompetencia.php?form=err");
    }else{
        $obj->SaveNivel($nivel, $monto);   
    }
}
if(!empty($id1) && !empty($monto1)){
    require '../config/cadenas.php';
    $cadenas = new LimpiarCadenas();
    $monto1 = $cadenas->limpiarCadena($monto1);
    if ($cadenas->verificar_datos('\d{2,10}$', $monto1)) {
        header("location: ../views/nivelCompetencia/nivelCompetencia.php?form=err");
    }else{
        $obj->EditNivel($id1, $monto1);
    }
}
if(!empty($id2)){
    $obj->DeleteNivel(intval($id2));
}
