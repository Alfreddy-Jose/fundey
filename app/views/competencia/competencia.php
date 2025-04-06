<?php
require_once "../widgets/header.php";


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
<strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO SE ELIMINÓ CORRECTAMENTE.
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

echo '
<!-- Form Start -->

<h2 class="title text-center"> GESTIONAR COMPETENCIA </h2>';
require '../../controllers/competenciaController.php';
$select = new CompetenciaController();
if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
echo'
<div class="container-fluid pt-4 px-4">
    <div class="row d-flex justify-content-center g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="rounded for h-100 p-4">

                <form action="../../controllers/competenciaController.php" id="formulario" method="POST">
                    <div class="mb-3" id="grupo__competencia">
                        <label for="nombre" class="form-label">Nombre</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control border-0 input formulario__input upper" id="nombre" name="competencia" placeholder="Ingrese nombre competencia" required>
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">La competencia solo debo llevar letras.</p>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control border-0 input" id="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">Pais</label>
                        <select name="codigo_pais" id="pais" class="form-select form-select-md border-0 upper" aria-label=".form-select-md example" required>
                            <option value="" disabled selected>Seleccione el país</option>';
                            $select->SelectPais();
                        echo'
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select form-select-md border-0 upper" aria-label=".form-select-md example" required>
                            <option value="" disabled selected>Seleccione el estado</option>
                        </select>
                    </div>
                    <div class="mb-3" id="grupo__modalidad">
                        <label for="lugar" class="form-label">Localidad</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control border-0 input formulario__input upper" id="lugar" name="lugar" placeholder="Ingrese la localidad" required>
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">La localidad solo debo llevar letras y espacios.</p>
                    </div>
                    <div class="mb-3">
                        <label for="competencia" class="form-label">Nivel de Competencia</label>
                        <select name="id_nivelcomp" id="competencia" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                            <option value="" disabled selected>Seleccione el nivel de competencia</option>';
                            $select->SelectNivelComp();
                            echo'
                        </select>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-12 d-flex justify-content-center my-4 formulario__grupo-btn-enviar">
            <div class="rounded for p-3 formulario__grupo">
                <button type="submit" form="formulario" class="btn btn-primary formulario__grupo Padre__button-boton" name="btnregistrar" value="ok">Enviar</button>
                <button type="reset" form="formulario" class="btn btn-light Padre__button-boton">Limpiar</button>
            </div>
        </form>
    </div>
</div>';    
}
    echo'<div class="container-fluid my-5 scroll">
    <table id="myTable" class="table table-bordered border-primary align-middle table-hover text-dark text-center"> ';

    $array = $select->ShowCompetencia(); 
    echo"
    </table>
    </div>";



require_once '../widgets/footer.php';?>