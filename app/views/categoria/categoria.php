<?php
$server = dirname(__DIR__, 1);
require_once "$server/widgets/header.php";

if (!empty($_GET["form"])) {
    if ($_GET["form"] == "err") {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>¡FORMATO DE CAMPOS INCORRECTO!</strong> POR FAVOR LLENAR LOS CAMPOS CORRECTAMENTE.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

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
if (!empty($_GET["categoria"])) {
    if ($_GET["categoria"] == "err") {
        echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>¡REGISTRO FALLIDO!</strong> EL REGISTRO NO SE REALIZÓ CORRECTAMENTE.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
    } else {
        echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>¡REGISTRO EXITOSO!</strong> EL REGISTRO " . $_GET['categoria'] . " SE REALIZÓ CORRECTAMENTE.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
    }
    }
if (!empty($_GET["categori"])) {
    if ($_GET["categori"] == "err") {
        echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>¡ELIMINACIÓN FALLIDA!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
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
if (!empty($_GET["categori1"])) {
    if ($_GET["categori1"] == "err") {
        echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>¡ERROR!</strong> EL REGISTRO NO SE EDITÓ CORRECTAMENTE.
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
    
    <form action="../../controllers/categoriaController.php" method="POST" id="formulario">
    <div class="container-fluid pt-4 px-4">
    <h2 class="title">GESTIONAR CATEGORÍA</h2>';
    if ($_SESSION["codigo_rol"] === 2220 || $_SESSION['codigo_rol'] === 4440) {
        echo'
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for  p-3">
                            <label for="disciplina" class="label">Disciplina</label>
                            <select name="disciplina" id="disciplina" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                                <option value="" disabled selected >Seleccione la disciplina</option>';
                                require "../../controllers/categoriaController.php";
                                $select = new CategoriaController();
                                $select->selectdisciplina(); 
                            echo '
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__apellido">
                            <label for="nombreC" class="label formulario__label">Nombre de la Categoría</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control border-0 input formulario__input upper" name="nombreC" id="nombreC" placeholder="Ingrese la categoría" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La categoría solo debe tener letras.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__edad">
                            <label for="edad" class="label formulario__label">Edad Mínima</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control border-0 input formulario__input" name="edad" id="edad" placeholder="Ingrese edad mínima" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La edad miníma solo debe contener 1 o 2 dígitos.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__edadm">
                            <label for="edadm" class="label formulario__label">Edad Máxima</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control border-0 input formulario__input" name="edadm" id="edadm" placeholder="Ingrese edad máxima" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La edad máxima solo debe contener 1 o 2 dígitos.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="rounded for p-3 formulario__grupo" id="grupo__monto">
                            <label for="monto" class="label formulario__label">Monto</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control border-0 input formulario__input" name="monto" id="monto" placeholder="Ingrese el monto" required>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El monto solo debe contener dígitos.</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4  formulario__grupo-btn-enviar">
                        <div class="rounded for  p-3 formulario__grupo">
                            <input type="submit" value="Enviar" form="formulario" name="btnregistrar" class="btn btn-primary px-2">
                            <input type="reset" value="Limpiar" form="formulario" class="btn btn-light px-2">
                        </div>
                    </div>
                </div>
        </div>
</form> ';
}
echo"
    <div class='container-fluid my-5 scroll'>
        <table id='myTable' class='table  table-bordered border-primary align-middle table-hover text-dark text-center'> ";
        require_once '../../controllers/categoriaController.php';
        $categoria = new CategoriaController();
        $categoria->ShowCategoria();
        echo '
        </table>
    </div>';


require_once "$server/widgets/footer.php";
?>
