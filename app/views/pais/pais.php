<?php
require_once '../widgets/header.php';


if (!empty($_GET["repetido"])) {
    if ($_GET["repetido"] == "err") {
        echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>¡EL REGISTRO YA EXISTE!</strong> EL REGISTRO YA EXISTE EN LA BASE DE DATOS.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
    }
}

if (!empty($_GET["form"])) {
    if ($_GET["form"] == "err") {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>¡FORMATO DE CAMPOS INCORRECTO!</strong> POR FAVOR LLENAR LOS CAMPOS CORRECTAMENTE.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

if (!empty($_GET["nombre"])) {
    if ($_GET["nombre"] == "err") {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>¡REGISTRO FALLIDO!</strong> EL REGISTRO NO SE REALIZÓ CORRECTAMENTE.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else { 
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>¡REGISTRO EXITOSO!</strong> EL REGISTRO " . $_GET['nombre'] . " SE REALIZÓ CORRECTAMENTE.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
if (!empty($_GET["id"])) {
        if ($_GET["id"] == "err") {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>¡ERROR!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO SE ELIMINÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }

    if (!empty($_GET["nombreE"])) {
        if ($_GET["nombreE"] == "err") {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>¡EDICIÓN FALLIDA!</strong> EL REGISTRO NO SE EDITÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>¡EDICIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['nombreE'] . " SE EDITÓ CORRECTAMENTE.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }

echo'
<!-- Formulario -->
<h2 class="title">GESTIONAR PAÍS</h2>';
if ($_SESSION['codigo_rol'] === 2220 || $_SESSION['codigo_rol'] === 4440) {
echo'
<form action="../../controllers/paisController.php" method="POST" class="formulario" id="formulario">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="label formulario__label">País</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="form-control border-0 input formulario__input upper" name="pais" id="nombre" placeholder="Ingrese nombre del pais" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El nombre del país solo debe tener letras.</p>
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
<!-- Fin del formulario -->';
}
echo'
<div class="container-fluid my-5 scroll">
    <table id="myTable" class="table table-bordered border-primary align-middle table-hover text-dark text-center">';
    
    require_once '../../controllers/paisController.php';
    $tabla = new PaisController();
    $tabla->showPais();

echo "
    </table>
</div>";

require_once '../widgets/footer.php';
?>