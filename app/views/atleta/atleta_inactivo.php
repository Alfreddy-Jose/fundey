<?php
require_once '../widgets/header.php';

if (!empty($_GET["cod3"])) {
if ($_GET["cod3"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ERROR!</strong> EL CAMBIO NO SE REALIZÓ CORRECTAMENTE .
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡CAMBIO EXITOSO!</strong> EL CAMBIO DEL REGISTRO " . $_GET['cod3'] . " SE RALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}

echo"
    <div class='container-fluid my-5 scroll'>
        <h2 class='title'>ATLETAS SUSPENDIDOS</h2>
        <table id='myTable' class='table  table-bordered border-primary align-middle table-hover text-dark text-center'> ";
        require_once '../../controllers/atletaController.php';
        $atleta = new AtletaController();
        $atleta->ShowAtletaInactivo();
    echo '
        </table>
    </div>
';

require_once '../widgets/footer.php';