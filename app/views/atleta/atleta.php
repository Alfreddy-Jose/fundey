<?php require_once '../widgets/header.php';
echo "
<!-- Start Table -->";

                    

if (!empty($_GET["comp"])) {
if ($_GET["comp"] !== "mal") {
    echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡ASIGNACION DE COMPETENCIA!</strong> SE ASIGNARON LAS COMPETENCIAS CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
"; 
}else {
    echo"
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ASIGNCION DE COMPETENCIA!</strong>LAS COMPETENCIAS NO SE ASIGNARON CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
}

if (!empty($_GET["cod3"])) {
if ($_GET["cod3"] === "err") {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡CAMBIO DE STATUS!</strong> EL CAMBIO DE STATUS NO SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
"; 
}else {
    echo"
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡CAMBIO DE STATUS!</strong> EL CAMBIO DE STATUS SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
}

if (!empty($_GET["cod"])) {
if ($_GET["cod"] == "err") {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡REGISTRO FALLIDO!</strong> EL REGISTRO NO SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
    echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡REGISTRO EXITOSO!</strong> EL REGISTRO " . $_GET['cod'] . " SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["cod1"])) {
if ($_GET["cod1"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ERROR!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['cod1'] . " SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["cod2"])) {
if ($_GET["cod2"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN FALLIDA!</strong> EL REGISTRO NO SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['cod2'] . " SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}

if (!empty($_GET["codP"])) {
if ($_GET["codP"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ERROR!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['codP'] . " SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}

echo"

    <div class='container-fluid my-5 scroll'>
    <h2 class='title'>ADMINISTRAR ATLETA</h2>";
    if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440){
        echo"<a href='/FUNDEY/app/views/atleta/agregar_atleta.php' class='btn btn-primary my-3'>Agregar</a>";
    }
    echo"<table id='myTable' class='table  table-bordered border-primary align-middle table-hover text-dark text-center'> ";
        require_once '../../controllers/atletaController.php';
        $atleta = new AtletaController();
        $array = $atleta->ShowAtleta();
    echo '
        </table>
    </div>
';
    
require_once '../widgets/footer.php';?>