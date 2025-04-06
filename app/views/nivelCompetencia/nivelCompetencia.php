<?php 
require '../widgets/header.php';

if (!empty($_GET["form"])) {
if ($_GET["form"] == "err") {
    echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>¡FORMATO DE CAMPOS INCORRECTO!</strong> POR FAVOR LLENAR LOS CAMPOS CORRECTAMENTE.
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
<strong>¡REGISTRO EXITOSO!</strong> EL REGISTRO SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["cod2"])) {
if ($_GET["cod2"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ERROR!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["cod1"])) {
if ($_GET["cod1"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN FALLIDA!</strong> EL REGISTRO NO SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN EXITOSA!</strong> EL REGISTRO SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}

echo'
<!-- Formulario --> 
<h2 class="title">GESTIONAR EL NIVEL DE COMPETENCIA</h2>';
if ($_SESSION["codigo_rol"] === 2220 || $_SESSION['codigo_rol'] === 4440) {
echo'
<form action="../../controllers/nivelController.php" method="POST" class="formulario" id="formulario">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__nombre">
                    <label for="nivel" class="label formulario__label">Nivel</label>
                    <select name="nivel" id="nivel" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                        <option value="" disabled selected >Seleccione la disciplina</option>';
                        require "../../controllers/nivelController.php";
                        $select = new NivelController();
                        $select->SelectNivel(); 
                    echo '
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__monto">
                    <label for="monto" class="label formulario__label">Monto</label>
                    <div class="formulario__grupo-input">
                        <input type="number" class="form-control border-0 input formulario__input upper" pattern="\d{1,10}$" name="monto" id="monto" placeholder="Ingrese el monto" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El monto solo debe contener dígitos.</p>
                </div>
            </div>

        <div class="col-sm-6 col-xl-4  formulario__grupo-btn-enviar">
                <div class="rounded for  p-3 formulario__grupo">
                    <input type="submit" value="Enviar" form="formulario" class="btn btn-primary px-2">
                    <input type="reset" value="Limpiar" form="formulario" class="btn btn-light px-2">
                </div>
            </div>
        </div>
    </div>
</form> 
<!-- Fin del formulario --> ';
}
echo'
<div class="container-fluid my-5 scroll">
    <table id="myTable" class="table table-bordered border-primary align-middle table-hover text-dark text-center">';
    require_once "../../controllers/nivelController.php";
    $mostrar = new NivelController();
    $mostrar->MostrarNivel();
echo "
    </table>
</div>";

require "../widgets/footer.php"; 