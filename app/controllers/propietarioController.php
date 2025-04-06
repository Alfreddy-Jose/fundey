<?php

(!empty($_GET["cod"])) ? $cod = $_GET['cod'] : null;
(!empty($_GET["id"])) ? $codatleta = $_GET['id'] : null;
(!empty($_POST["cedula1"])) ? $cedu = $_POST["cedula1"] : null;

class PropietarioController
{
    private $model; 
    private $cont;
    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/propietarioModel.php";
        require_once "$server/controllers/atletaController.php";
        $this->cont = new AtletaController();
        $this->model = new PropietarioModel();
    }
    function selectBanco()
    {
        $selec = $this->model->SelectBanco();
        foreach ($selec as $row) {
            echo "<option value='$row[0]'>$row[0] - $row[1]</option>";
        }
    }

    function buscador($campo){
        $html = "";
        $array = $this->model->buscador($campo);
        if (!empty($array)) {
            $html = $array;
            foreach($html as $row){
                $html[0][4] = "$row[4]";
            }
        }
        echo json_encode($html, JSON_UNESCAPED_UNICODE);
        return $array;
    }
    function AtletaCuenta($cod, $res)
    {
        
        $array = $this->model->atletaCuenta($cod);
        foreach ($array as $row){
            echo '
        <div class="container-fluid pt-4 px-4">';
                require '../widgets/marcador.php';
            echo'<h2 class="title">GESTIONAR PROPIETARIO DE LA CUENTA</h2>
                <a href="#" class="btn btn-danger atras my-3">Volver</a>
                <form action="../../controllers/propietarioController.php?id='.$cod.'" method="POST" class="row g-4" id="formulario">
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__cedulaP">
                            <label for="cedula" class="label">Cédula</label>
                            <div class="formulario__grupo-input">
                                <div class="position-relative">
                                    <select name="nacionalidadP" id="nacionalidad" onclick="values()" class="position-absolute end-0 nacio z-5 btn text-primary" required>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                    <input minlength="7" maxlength="8" class="form-control border-0 input pro
                                    formulario__input" type="number"'; if ($res == 'SI') { echo 'value="'.$row[0].'" readonly ';}
                                echo'placeholder="Ingrese su cédula" name="cedulaP" id="cedula" required>
                                    <p id="lista">El propietario existe. Desea asignarlo nuevamente.</p>
                                    <div class="d-flex justify-content-start">
                                        <button type="submit" form="buscar" class="btn btn-danger" id="buscar" name="buscar" data-bs-toggle="modal" data-bs-target="#modalAsignarP"><i class="fa-solid fa-user-plus"></i></button>
                                    </div>
                                    <i class="formulario__validacion-estado fas fa-times-circle" hidden></i>
                            </div>
                            <p class="formulario__input-error">La cédula tiene que ser de 7 a 8 digitos.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__nombre">
                            <label for="nombre" class="label formulario__label">Nombre</label>
                            <div class="formulario__grupo-input">
                                <input type="text" '; if ($res == 'SI') { echo 'value="'.$row[1].'" readonly';}
                            echo' class="form-control border-0 input formulario__input upper" name="nombreP" id="nombre" placeholder="Ingrese su nombre" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El nombre solo debe tener letras.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__apellido">
                            <label for="apellido" class="label formulario__label">Apellido</label>
                            <div class="formulario__grupo-input">
                                <input type="text" '; if ($res == 'SI') { echo 'value="'.$row[2].'" readonly ';}
                            echo'" class="form-control border-0 input formulario__input upper" name="apellidoP" id="apellido" placeholder="Ingrese su apellido" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El apellido solo debe tener letras.</p>
                        </div>
                    </div>
                    <div id="registrarP"></div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for  p-3">
                            <label for="banco" class="label">Banco</label>
                            <div class="formulario__grupo-input">
                                <select name="banco" id="banco" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                                    <option value="" disabled selected>Seleccione el banco</option>';                                   
                                    $this->selectBanco();  
                                echo '
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__cuenta">
                            <label for="numeroC" class="label formulario__label">Número de Cuenta</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control border-0 input formulario__input" name="numeroC" id="cuenta" placeholder="Ingrese número de cuenta" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El numero de cuenta debe contener 20 dígitos.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__contraseña2">
                            <label for="tipo" class="label formulario__label">Tipo de Cuenta</label>
                            <div id="inp">
                                <select name="tipoC" id="tipo" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                                    <option value="" selected disabled>Seleccione el tipo de cuenta</option>
                                    <option value="A">Ahorro</option>
                                    <option value="C">Corriente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                        <!-- Modal Asignar Propietario -->
                    <div class="modal fade position-absolute" id="modalAsignarP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">¡ADVERTENCIA!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>ESTÁ SEGURO DE ASIGNAR EL PROPIETARIO?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light mx-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <input type="button" data-bs-dismiss="modal" onclick="values()" class="btn btn-primary mx-2" value="Asignar">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4  formulario__grupo-btn-enviar">
                        <div class="rounded for  p-3 formulario__grupo">
                            <input type="submit" value="Enviar" form="formulario" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#Existe">
                            <input type="reset" value="Limpiar" id="limpiar" form="formulario" class="btn btn-light px-2">
                        </div>
                    </div>
                </form>';
            require_once '../widgets/footer.php';
    echo'</div>';
        }//end foreach
    }//end método


    function BuscarPropietario($cedulaB, $cedulaA)
    {
        $buscar = $this->model->buscarPropietario($cedulaB);
        ($buscar) ? header("location: ../views/atleta/asignar_propietario.php?cedulaB=".$cedulaB."&cedulaA=".$cedulaA) : header('location: ../views/atleta/asignar_propietario.php');
    } 

    function SavePropietario($cedula, $nombre, $apellido, $nacionalidad)
    {
        $guarderP = $this->model->InsertPropietario($cedula, $nombre, $apellido, $nacionalidad);
        return $guarderP;
    }

    function SaveCuenta($numeroC, $tipoC, $codatleta, $codpropietario, $banco)
    {
        $registro = $this->model->InsertCuenta($numeroC, $tipoC, $codatleta, $codpropietario, $banco);
        ($registro) ? header("location: ../views/atleta/atleta.php?cod=" . $codatleta) : $this->cont->DeleteAtleta($codatleta) and $this->DeletePropietario($codpropietario) and header("location: ../views/atleta/atleta.php?cod=err");
    }

    function DeletePropietario($cedu)
    {
        $delete = $this->model->DeletPropietario($cedu);
        ($delete) ? header("location: ../views/atleta/atleta.php?codP=" . $cedu) : header("location: ../views/atleta/atleta.php?cod1=err");
    }

    function EditCompetencia($nombreC2, $fechaC2, $Codpais2, $CodNC2, $id_competencia)
    {
        $edit = $this->model->UpdatePropietario($nombreC2, $fechaC2, $Codpais2, $CodNC2, $id_competencia);
        ($edit) ? header("location: ../views/competencia/competencia.php?cod2=" . $nombreC2) : header("location: ../views/competencia/competencia.php?cod2=err");
    }

}

$obj = new PropietarioController();

if (!empty($_POST['nombreP']) and !empty($_POST['apellidoP']) and !empty($_POST['cedulaP']) and !empty($_POST['nacionalidadP']) and !empty($_POST['numeroC'])  and !empty($_POST['tipoC'])  and !empty($_POST['banco']) and !isset($_POST['asignar'])) { 

        $pb = $obj->SavePropietario(intval($_POST['cedulaP']), $_POST['nombreP'], $_POST['apellidoP'], $_POST['nacionalidadP']);

    if ($pb == true) {
        $codpropietario = $_POST['cedulaP'];
            $obj->SaveCuenta(intval($_POST['numeroC']), $_POST['tipoC'], intval($codatleta), intval($codpropietario), $_POST['banco']);
        
    }else {
        $objA = new AtletaController();
        $objA->DeleteAtleta(intval($codatleta));
        header("location: ../views/atleta/atleta.php?cod=err");
    }
}


if (!empty($_POST['cedulaB']) and !empty($_POST['cedulaA'])) {
    $obj->BuscarPropietario($_POST['cedulaB'], $_POST['cedulaA']); 
}

if (!empty($_POST['cedula'])) {
    $obj->buscador($_POST['cedula']);
}

if (!empty($_POST['numeroC']) and !empty($_POST['tipoC']) and !empty($_POST['banco']) 
    and !empty($_POST['cedulaP']) and !empty($codatleta) and isset($_POST['asignar'])) {
    $obj->SaveCuenta($_POST['numeroC'], $_POST['tipoC'], $codatleta, $_POST['cedulaP'], $_POST['banco']);
}
