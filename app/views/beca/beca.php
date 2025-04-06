<?php

    require '../widgets/header.php';

    if(!isset($_POST['name'])){$_POST['name'] = "";}
    if(!isset($_POST['codigoCa'])){$_POST['codigoCa'] = "";} 
    if(!isset($_POST['codigoD'])){$_POST['codigoD'] = "";} 

if (!empty($_GET["txt"])) {
    if ($_GET["txt"] !== "si") {
        echo"
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>¡ERROR!</strong> EL PAGO NO SE REALIZÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        echo"
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>¡PAGO EXITOSO!</strong> EL PAGO SE REALIZÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
if (!empty($_GET["err"])) {
    if ($_GET["err"] == "fecha") {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>¡PAGO YA EXISTENTE!</strong> EL PAGO NO SE REALIZO CORRECTAMENTE, PORQUE YA EXISTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

    
    echo" 
    <div class='container-fluid my-5 scroll'>
        <h2 class='title'>ATLETAS BECADOS</h2>";
        require '../../controllers/becaController.php';
        $pago = new BecaController();
        $compro = $pago->Comprobarpago();
    echo"
        <input type='button' title='Realizar pago'"; if(!$compro){echo" class='btn btn-light my-3' ";}else{echo"class='btn btn-warning my-3' ";}  echo" name='txt' data-bs-toggle='modal' data-bs-target='#pago' value='Pagar' "; if(!$compro){echo"disabled";}echo">
        <table id='myTable' class='table  table-bordered border-primary align-middle table-hover text-dark text-center'> ";
            $pago->ShowAtletaBecados($_POST['name'], $_POST['codigoCa'], $_POST['codigoD']);
    echo"
        </table>
    </div>";
    
    echo"
    <!-- Modal Fecha de pago -->
    <div class='modal fade position-absolute' id='pago' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content '>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5 text-dark' id='staticBackdropLabel'>FECHA DEL PAGO</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <form action='/FUNDEY/app/controllers/pagoController.php' method='POST' id='txt'>
                        <label class='label' for='fecha_pago'>Ingrese fecha del pago</label>
                        <input type='date' class='mx-3 bg-transparent col-11 text-dark input upper' name='fecha_pago' id='fecha_pago' required>
                        <input type='text' name='nombre' value='".$_POST["name"]."' hidden>
                        <input type='text' name='disciplina' value='".$_POST["codigoD"]."' hidden>
                        <input type='text' name='categoria' value='".$_POST["codigoCa"]."' hidden>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                    <input type='submit' class='btn btn-primary' data-bs-dismiss='modal' name='archivo' value='Pagar' form='txt'>
                </div>
            </div>
        </div>
    </div>
    
    <form action='../reportes/reportes.php' method='POST' id='reporte'>
        <input type='text' name='nombre' value='".$_POST["name"]."' hidden>
        <input type='text' name='disciplina' value='".$_POST["codigoD"]."' hidden>
        <input type='text' name='categoria' value='".$_POST["codigoCa"]."' hidden>
    </form>";
    if ($_POST['codigoD'] !== "")  { 
        $se->selectCategoria1($_POST['codigoD']);
    } 
    require "../widgets/footer.php"; 