<?php 


(!empty($_POST["cedula1"])) ? $cedu = $_POST["cedula1"] : null;
(!empty($_POST["cedula2"])) ? $cedula2 = $_POST["cedula2"] : null;
(!empty($_POST["cedula3"])) ? $cedula3 = $_POST["cedula3"] : null;
(!empty($_POST["statu2"])) ? $statu2 = $_POST["statu2"] : null;
(!empty($_POST["asunto"])) ? $asunto = $_POST["asunto"] : null;
(!empty($_POST["nacionalidad2"])) ? $nacionalidad2 = $_POST["nacionalidad2"] : null;
(!empty($_POST["nombre2"])) ? $nombre2 = $_POST["nombre2"] : null;
(!empty($_POST["apellido2"])) ? $apellido2 = $_POST["apellido2"] : null;
(!empty($_POST["fecha2"])) ? $fecha2 = $_POST["fecha2"] : null; 
(!empty($_POST["sexo2"])) ? $sexo2 = $_POST["sexo2"] : null;
(!empty($_POST["categoria2"])) ? $categoria2 = $_POST["categoria2"] : null;
(!empty($_POST["coduser2"])) ? $coduser2 = $_POST["coduser2"] : null;
(!empty($_POST["disciplina2"])) ? $disciplina2 = $_POST["disciplina2"] : null;

if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/controllers/atletaController.php'){
    echo session_start();
} 

if (!empty($_POST['btnregistrar'])) {
    
    $cedula1 = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fech_nac = $_POST["fecha"];
    $sexo = $_POST["sexo"];
    $categoria = $_POST["codigoCa"];
    (!empty($_POST["codigoCo"])) ? $competencia = $_POST["codigoCo"] : $competencia = null;
    $nacionalidad = $_POST["nacionalidad"];
    $disciplina = $_POST["disciplina"];
    $statu = $_POST["statu"];
    $codigoU1 = $_SESSION["cedula"];
    ($competencia !== null) ? $idCompAtleta = $_POST["cedula"] +  $competencia : $idCompAtleta = $_POST["cedula"] + date("Ymdhis");
}

class AtletaController 
{
    private $model;
    private $modelD;
    
    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/atletaModel.php";
        require_once "$server/models/disciplinaModel.php";
        $this->model = new AtletaModel();
        $this->modelD = new DisciplinaModel();
        
    }
    
    function selectdisciplina()
    {
        $array = $this->modelD->SelectDisciplina();
        foreach($array as $row){
            echo "<option value='$row[0]'>$row[1] $row[2]</option>";
        }
    }
    function selectnivel()
    {
        $array = $this->model->SelectNivelCompA();
        foreach($array as $row){
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }

    function buscador(){
        $campo = $_POST["cedula"];
        $html = "";
        $array = $this->model->buscador($campo);
        if(!empty($array)){
            $html = "true";
        }
        echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }

    function selectCategoria()
    {   
        
        $selec = $this->model->SelectCategoria();
        foreach ($selec as $row){
            echo "<option value='$row[0]'>$row[1]</option>";
        }
        
    }
    function selectCompetencia()
    {
        $selec = $this->model->SelectCompetencia();
        foreach ($selec as $row) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }

    function competenciasAtleta($atleta){
        $comAsig = $this->model->competenciaAsing($atleta);
        echo "
            <h5 class='text-light'>Competencias asignadas al atleta</h5>";
        if ($comAsig) {
            foreach ($comAsig as $asignadas) {
                echo"
                    <ul class='mb-3 lista'>
                        <li>$asignadas[1]</li>
                    </ul>
                ";
            }
        }else {
            echo "
                <ul class='mb-3 lista'>
                    <li>ACTUALMENTE EL ATLETA NO TIENE COMPETENCIAS ASIGNADAS</li>
                </ul>
            ";
        }
    }

    function AsignarCompetencia($atleta)
    {
        $selec = $this->model->competenciasDisp($atleta);
        $comAsig = $this->model->competenciaAsing($atleta);
        $j = 0;
        echo"
        <h5 class='text-light'>Competencias asignadas al atleta</h5>";
        if ($comAsig) {
            foreach ($comAsig as $asignadas) {
                echo"
                    <ul class='mb-3 lista'>
                        <li>$asignadas[1]</li>
                    </ul>
                ";
            }
        }else {
            echo "
                <ul class='mb-3 lista'>
                    <li>ACTUALMENTE EL ATLETA NO TIENE COMPETENCIAS ASIGNADAS</li>
                </ul>
            ";
        }

        echo"<h5 class='text-light'>Competencias disponibles para asignar</h5>";
        $j = 0;
        if ($selec) {
            foreach ($selec as $row){
                echo"
                <div class='container-fluid d-flex justify-content-start p-1'>
                    <input type='checkbox' class='form-check-input mx-3' name='competencia1[]' id='$row[0]".$j++."' value='$row[0]'>
                    <label for='$row[0]".$j++."'>$row[1]</label> <br>
                </div>";
            }
        }else {
            echo "
                <ul class='mb-3 lista'>
                    <li>ACTUALMENTE EL ATLETA NO TIENE COMPETENCIAS DISPONIBLES</li>
                </ul>
            ";
        }
    }

    function ShowAtleta()
    {
        
        $array = $this->model->Atleta();
        echo "
            <thead class='bg-primary'>
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>CÉDULA</th>
                    <th class='text-center'>NOMBRE</th>
                    <th class='text-center'>APELLIDO</th>
                    <th class='text-center'>COMPETENCIAS</th>
                    <th class='text-center'>NIVEL COMPETENCIA</th>
                    <th class='text-center'>DISCIPLINA</th>
                    <th class='text-center'>CATEGORÍA</th>";
                    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                    echo"<th class='text-center'>STATUS</th>
                        <th class='text-center'>OPCIONES</th>";
                    }
                    echo"
                </tr>
            </thead>
            <tbody>";
            $i = 0;
            $i2 = 0;
            if ($array) {
                foreach ($array as $row) {
                    $i++;
                    if ($row[11] === 'ACTIVO') {
                        (!empty($row[0])) ? $i2++ : null; 
                    echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[9] . '-' . $row[0] . "</td>
                    <td class='text-center'>" . $row[1] . "</td>
                    <td class='text-center'>" . $row[2] . "</td>";
                    echo'
                        <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalvercomp' .$row[0]. '">VER</button>
                        </div>
                    
                        <!-- Modal Ver Competencias --> 
                    <div class="modal fade position-absolute" id="modalvercomp' .$row[0]. '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">¡COMPETENCIAS!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">';
                                $this->competenciasAtleta($row[0]);
                                echo'
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light mx-2"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>';
                    $nivelA = $this->model->buscarNivelComp($row[0]);
                    if (empty($nivelA)) {
                        $nivelA = "NO TIENE";
                    }
                    echo"
                    <td class='text-center'>". $nivelA ."</td>
                    <td class='text-center'>" . $row[12] . "</td>
                    <td class='text-center'>" . $row[5] . "</td>
                    ";
                    $mostrar = $this->model->buscarAtleta($row[0]);
                    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                    if ($mostrar) {
                    echo'<td class="text-center>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <p>REGISTRO INCOMPLETO</p>
                                <a href="/FUNDEY/app/views/atleta/propietario_cuenta.php?cod='.$row[0].'" class="btn btn-outline-primary">COMPLETAR</button>
                            </div>
                        </td>';
                    }else{
                //modal cambio
                echo'
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-primary">ACTIVO</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalstatus1' .$row[0]. '">INACTIVO</button>
                        </div>
                    
                        <!-- Modal Cambiar Statu --> 
                    <div class="modal fade position-absolute" id="modalstatus1' .$row[0]. '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">¡CAMBIO DE STATUS '.$row[0].'!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Ingrese motivo de inactividad</p>
                                    <form action="../../controllers/atletaController.php" method="POST" class="d-flex" id="cambio'.$row[0].'">
                                        <textarea type="text" class="form-control" name="asunto" id="asunto' . $i . '" required></textarea>
                                        <input type="number" name="cedula3" id="cedula3' . $i . '"
                                            class="mx-3" hidden value="' .$row[0]. '">
                                        <input type="text" name="statu2" id="statu2"
                                            class="mx-3" hidden value="INACTIVO">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light mx-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <input type="submit" class="btn btn-primary mx-2" form="cambio'.$row[0].'" value="Aceptar">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                ';
                    }
                    // modal editar
                    echo "
                    <td class='text-center'>
                    <!-- Button trigger modal editar -->
                        <button type='button' title='Editar atleta' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </button>
                    <!-- Modal Editar -->
                    <div class='modal fade' id='staticBackdrop1" . $row[0] . "' data-bs-backdrop='static'
                        data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-scrollable'>
                            <div class='modal-content bg-white'>
                                <div class='modal-header'>
                                    <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>EDITAR REGISTRO " . $row[0] . "</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form action='../../controllers/atletaController.php' method='POST' class='d-flex flex-column'
                                id='atletaEdit" . $row[0] . "'>
                                <div class='cedulerNacio col-11 position-relative'>
                                    <select name='nacionalidad2' id='nacionalidad" . $i . "'
                                    class='position-absolute end-0 nacio z-5 btn btn-success' hidden readonly>
                                        <option value='V'>V</option>
                                        <option value='E'>E</option>
                                    </select>
                                    <input type='number' name='cedula2' id='cedula" . $i . "' placeholder='Cédula'
                                    class='mx-3 bg-transparent col-12 text-dark input' required
                                    value='" . $row[0] . "' hidden readonly>
                                </div>
                                <input type='number' name='coduser2' id='coduser2" . $i . "' placeholder='Cédula'
                                class='mx-3 bg-transparent col-12 text-dark input' required
                                value='" . $row[7] . "' hidden readonly>
                                <input type='text' name='nombre2' id='nombre" . $i . "'
                                placeholder='Nombre'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[1] . "'>
                                <input type='text' name='apellido2' id='apellido" . $i . "'
                                placeholder='Apellido'
                                class='mx-3 bg-transparent col-11 text-dark input upper' required
                                value='" . $row[2] . "'>
                                <input type='date' name='fecha2' id='fecha" . $i . "'
                                value='".$row[3]."' class='mx-3 bg-transparent col-11 text-dark input' required>
                                
                                <div class='d-flex flex-column'>
                                    <label for='sexo2'>SEXO</label>
                                    <select class='btn border-dark' name='sexo2' id='sexo2'>
                                        <option value='Femenino'>Femenino</option>
                                        <option value='Masculino'>Masculino</option>
                                    </select>
                                </div>
                                <div class='d-flex flex-column'>
                                    <label for='disciplina".$i."'>DISCIPLINA</label>
                                    <select class='btn border-dark' name='disciplina2' id='disciplina".$i."'>
                                        <option disabled selected >" . $row[12] . "</option>";
                                        $this->selectdisciplina();
                                        echo "
                                    </select>
                                </div>
                                <div class='d-flex flex-column'>
                                    <label for='categoria".$i."'>CATEGORÍA</label>
                                    <select class='btn border-dark' name='categoria2' id='categoria".$i."'>
                                        <option value='".$row[8]."'>". $row[5] . "</option>
                                    </select>
                                </div> 
                                <div class='d-flex flex-column'>
                                    <label for='nivel2".$i."'>NIVEL COMPETENCIA</label>
                                    <select class='btn border-dark' name='nivel2' id='nivel2".$i."'>
                                    <option value='' disabled selected>$nivelA</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                            <input type='submit' value='Actualizar' class='btn btn-primary' form='atletaEdit$row[0]'>
                        </div>
                    </div>
                </div>
            </div>"; 
                                    
                                    
                                    // modal competencia
                                    echo "
                        <!-- Button trigger modal competencia -->
                        <button type='button' title='Asignar competencias' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalasunto$row[0]'>
                            <i class='fa-solid fa-trophy'></i>
                        </button>

                        <!-- Modal Competencia -->
                        <div class='modal fade' id='modalasunto$row[0]' data-bs-backdrop='static' data-bs-keyboard='false'
                            tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content bg-withe'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>ASIGNAR COMPETENCIAS</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='../../controllers/atletaController.php' id='comp$row[0]' method='POST'>";             
                                            $this->AsignarCompetencia($row[0]);
                                            echo"
                                            <input type='number' name='atleta' value='$row[0]' hidden readonly>
                                        </form>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-light mx-2'
                                        data-bs-dismiss='modal'>Cancelar</button>
                                        <input type='submit' class='btn btn-danger mx-2' form='comp$row[0]' value='Actualizar' name='AsingComp'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>";         
                }
            }
        } 
            echo "
            </tr>
            </tbody>
            ";
        } else {
                '<tr>
                    <td colspan="7" class="text-center">No hay registros actualmente</td>
                </tr>';
        }
        return $array;
    }
    
    function ShowAtletaInactivo(){
        $array = $this->model->Atleta();
        echo "
            <thead class='bg-primary'>
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>CÉDULA</th>
                    <th class='text-center'>NOMBRE</th>
                    <th class='text-center'>APELLIDO</th>
                    <th class='text-center'>DISCIPLINA</th>
                    <th class='text-center'>CATEGORÍA</th>
                    <th class='text-center'>ASUNTO</th>";
                    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
                echo"<th class='text-center'>STATUS</th>";
                    }
            echo"        
                </tr>
            </thead>
            <tbody>";
            $i = 0;
            $i2 = 0;
            if ($array) {
                foreach ($array as $row) {
                    if ($row[11] == 'INACTIVO'){
                        (!empty($row[0])) ? $i2++ : null;
                    echo "
                <tr>
                    <td class='text-center'>" . $i2 . "</td>
                    <td class='text-center'>" . $row[9] . '-' . $row[0] . "</td>
                    <td class='text-center'>" . $row[1] . "</td>
                    <td class='text-center'>" . $row[2] . "</td>
                    <td class='text-center'>" . $row[12] . "</td>
                    <td class='text-center'>" . $row[5] . "</td>
                    ";
                    echo'
                    <td class="text-center">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalasunto' .$row[0]. '">VER</button>
                        </div>
                    </td>
                    ';
                    //Estatus
                    if($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440){
                echo'
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-primary">INACTIVO</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalstatus' .$row[0]. '">ACTIVO</button>
                    </div>';
                    }
                    echo'
                            <!-- Modal Cambiar Statu -->
                    <div class="modal fade position-absolute" id="modalstatus' .$row[0]. '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">¡ADVERTENCIA!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>ESTÁ SEGURO DE CAMBIAR EL STATUS DEL REGISTRO ' .$row[0]. '?</p>
                                </div>
                                <div class="modal-footer">
                                <form action="../../controllers/atletaController.php" method="POST" class="d-flex">
                                    <input type="number" name="cedula3" id="cedula3' . $i++ . '"
                                        class="mx-3 bg-transparent col-12 text-white m-4 p-2" hidden value="' .$row[0]. '">
                                    <input type="text" name="statu2" id="statu2' . $i++ . '"
                                        class="mx-3 bg-transparent col-12 text-white m-4 p-2" hidden value="ACTIVO">
                                    <input type="text" name="asunto" id="asunto' . $i++ . '"
                                        class="mx-3" hidden value=" ">
                                    <button type="button" class="btn btn-light mx-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <input type="submit" class="btn btn-primary mx-2" value="Aceptar">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                            <!-- Modal Mostrar Asunto -->
                    <div class="modal fade position-absolute" id="modalasunto' .$row[0]. '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">¡MOTIVO DE INACTIVIDAD DEL REGISTRO '.$row[0].'!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>' .$row[13]. '</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light mx-2"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>';
                }
            }
        }
    }

    function SaveAtleta($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoCo, $codigoU1, $nacionalidad, $statu, $idCompAtleta, $nivelcomp)
    {
        if ($codigoCo !== null) {
            $guarder = $this->model->InsertarAtleta($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoCo,  $codigoU1, $nacionalidad, $statu, $idCompAtleta, $nivelcomp);
        }else {
            $guarder = $this->model->InsertarAtleta2($cedula, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoU1, $nacionalidad, $statu, $idCompAtleta);
        }
        
        ($guarder) ? header("location: ../views/atleta/propietario_cuenta.php?cod=". $cedula) : header("location: ../views/atleta/atleta.php?cod=err");
    }

    function DeleteAtleta($cedu){
        $delete = $this->model->DeletAtleta($cedu);
        ($delete) ? header("location: ../views/atleta/atleta.php?cod1=".$cedu) : header("location: ../views/atleta/atleta.php?cod1=err");
    }

    function EditAtleta($cedula2, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoU, $nacionalidad2)
    {
        $edit = $this->model->UpdateAtleta($cedula2, $nombreA, $apellido, $fechaN, $sexo, $codigoCa, $codigoU, $nacionalidad2);
        ($edit) ? header("location: ../views/atleta/atleta.php?cod2=". $cedula2) : header("location: ../views/atleta/atleta.php?cod2=err");
    }

    function CambiarStatu($cedula3, $statu, $asunto)
    {
        $cambiar = $this->model->cambiarStatu($cedula3, $statu, $asunto);
        ($cambiar) ? header("location: ../views/atleta/atleta_inactivo.php?cod3=". $cedula3) : header("location: ../views/atleta/atleta.php?cod3=err");
    }

    function selccionarNivelComp($competencia){
        $nivelcomp = $this->model->seleccionarNivelcomp($competencia);
        return $nivelcomp;
    }

    function insertarCompetencias($competencia, $atletas)
    {
        $competencias = $competencia;
        $atleta = $atletas;

        foreach ($competencias as $comp) {
            $compatleta = $comp + $atleta;
            $save = $this->model->insertCompetencia($compatleta, $atleta, $comp);
            if ($save == false) {
                header('location: location: ../views/atleta/atleta.php?comp=mal');
            }
        }

        $rango = 0;
        $id_nivel = 0;
        $nivel = $this->model->busquedaMayorNivel($atleta);
        foreach ($nivel as $row) {
            if ($rango < $row[1]) {
                $id_nivel = $row[0];
                $rango = $row[1];
            }
        }

        $rangoA = $this->model->buscarRangoNivel($atleta);
        if ($rangoA) {
            if ($rangoA < $rango) {
                $this->model->updateNivel($id_nivel, $atleta);
            }
            
            ($save) ? header("location: ../views/atleta/atleta.php?comp=bien") : header("location: ../views/atleta/atleta.php?comp=mal");
        }else {
            $this->model->updateNivel($id_nivel, $atleta);
            ($save) ? header("location: ../views/atleta/atleta.php?comp=bien") : header("location: ../views/atleta/atleta.php?comp=mal"); 
        }
    }
}


    $obj = new AtletaController();
    if (!empty($cedula1) and !empty($nombre) and !empty($apellido) and !empty($sexo) and !empty($fech_nac) and !empty($categoria) and !empty($codigoU1) and !empty($nacionalidad) and !empty($disciplina)){
        require '../config/cadenas.php';
        $limpiar = new LimpiarCadenas();
        $cedula1 = $limpiar->limpiarCadena($cedula1);
        $nombre = $limpiar->limpiarCadena($nombre);
        $apellido = $limpiar->limpiarCadena($apellido);
        $fech_nac = $limpiar->limpiarCadena($fech_nac);
        ($competencia !== null) ? $nivelcomp = $obj->selccionarNivelComp($competencia) : $nivelcomp = null;
        if ($limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $nombre) || $limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $apellido) || $limpiar->verificar_datos('\d{7,8}$', $cedula1)) {
            header('location: ../views/atleta/agregar_atleta.php?form=err');
        }else{
            $obj->SaveAtleta(intval($cedula1), $nombre, $apellido, $fech_nac, $sexo, $categoria, $competencia, intval($codigoU1), $nacionalidad, $statu, $idCompAtleta, $nivelcomp);
        }
    } 


    if (!empty($cedu)) {
        $obj->DeleteAtleta(intval($cedu));
    } 

    if (!empty($cedula2) and !empty($nombre2) and !empty($apellido2) and !empty($fecha2) and !empty($sexo2) and !empty($categoria2) and !empty($coduser2) and !empty($nacionalidad2)) {
        require '../config/cadenas.php';
        $limpiar = new LimpiarCadenas();
        $cedula2 = $limpiar->limpiarCadena($cedula2);
        $nombre2 = $limpiar->limpiarCadena($nombre2);
        $apellido2 = $limpiar->limpiarCadena($apellido2);
        $fecha2 = $limpiar->limpiarCadena($fecha2);
        $obj->EditAtleta($cedula2, $nombre2, $apellido2, $fecha2, $sexo2, $categoria2, $coduser2, $nacionalidad2);
    }

    if (!empty($cedula3) and !empty($statu2) and !empty($asunto)) {
        $obj->CambiarStatu(intval($cedula3), $statu2, $asunto);
    }

    if (!empty($_POST["competencia1"]) and !empty($_POST['atleta'])){
        $obj->insertarCompetencias($_POST["competencia1"], $_POST['atleta']);
    }else {
        if (!empty($_POST['AsingComp']) and empty($_POST['competencia1']) and isset($_POST['atleta'])) {
            header("location: ../views/atleta/atleta.php?comp=bien");
        }
    }