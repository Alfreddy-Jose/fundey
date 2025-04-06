<?php
require_once '../widgets/header.php';

if (!empty($_GET["form"])) {
    if ($_GET["form"] == "err") {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>¡FORMATO DE CAMPOS INCORRECTO!</strong> POR FAVOR LLENAR LOS CAMPOS CORRECTAMENTE.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

if (!empty($_GET['cod'])) {
    $cod = $_GET['cod']; 
} 

if (!empty($_GET["buscar"])) {
    if ($_GET["buscar"] == "err") {
    echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>BUSQUEDA EXITOSA!</strong> EL PROPIETARIO NO ESTÁ REGISTRADO.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }else {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>¡BUSQUEDA EXITOSA!</strong> EL PROPIETARIO YA ESTÁ REGISTRADO.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
}

if (!isset($_GET['res'])) {
    echo '
    <div class="container-fluid d-flex justify-content-center align-items-center conatle">
        <div class="col-sm-6 col-xl-4 d-flex justify-content-center">
            <form action="../atleta/propietario_cuenta.php" method="GET">
                <div class="rounded for p-3 formulario__grupo" id="opc">
                    <p class="mb-2 text-center">Tienes Cuenta Bancaria?</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="res" id="si"
                            value="SI" required>
                        <label class="form-check-label" for="si">SI</label>
                    </div>
                    <div class="form-check form-check-inline No">
                        <label class="form-check-label" for="no">NO</label>
                        <input class="form-check-input" type="radio" name="res" id="no"
                            value="NO" required>
                    </div>
                    <input type="number" name="cod" id="cod" value="'.$cod.'" hidden required>
                    <input type="submit" value="Siguiente" class="btn btn-primary d-block m-auto">
                </div>
            </form>    
        </div>
    </div>'; 
}

if (!empty($_GET['res'])) {
    $res = $_GET['res']; 
}



if(!empty($res)){
    require '../../controllers/propietarioController.php';
    $met = new PropietarioController();
    $met->AtletaCuenta($cod, $res);
} 

