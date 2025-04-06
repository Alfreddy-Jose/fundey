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
echo '
<!-- Formulario -->



<form action="../../controllers/atletaController.php" method="POST" id="formulario">
<div class="container-fluid pt-4 px-4">';
require '../widgets/marcador.php';
echo'<h2 class="title">ADMINISTRAR ATLETA</h2>
    <a href="/FUNDEY/app/views/atleta/atleta.php" class="btn btn-danger my-3">Volver</a>
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__cedula">
                    <label for="cedula" class="label formulario__label">Cédula</label>
                    <div class="formulario__grupo-input">
                        <div class="cedulerNacio position-relative">
                            <select name="nacionalidad" id="nacionalidad" class="position-absolute end-0 nacio z-5 btn btn-darked text-primary" required>
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <input minlength="7" maxlength="8" class="form-control border-0 input
                        formulario__input" type="number" placeholder="Ingrese su cédula" name="cedula" id="cedula" required>
                    </div>
                    <p class="formulario__input-error">La cédula tiene que ser de 7 a 8 digitos.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="label formulario__label">Nombre</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="form-control border-0 input formulario__input upper" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El nombre solo debe tener letras.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__apellido">
                    <label for="apellido" class="label formulario__label">Apellido</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="form-control border-0 input formulario__input upper" name="apellido" id="apellido" placeholder="Ingrese su apellido" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El apellido solo debe tener letras.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__contraseña">
                    <label for="fecha" class="label formulario__label">Fecha de Nacimiento</label>
                    <div class="formulario__grupo-input">
                        <input type="date" class="form-control border-0 input formulario__input" name="fecha" id="fecha" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 caracteres.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__contraseña2">
                    <label for="sexo" class="label formulario__label">Sexo</label>
                    <div class="formulario__grupo-input">
                        <select name="sexo" id="sexo" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                            <option disabled selected>Seleccione el sexo</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for  p-3">
                    <label for="disciplina" class="label">Disciplina</label>
                    <select name="disciplina" id="disciplina" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                        <option value="" disabled selected>Seleccione la disciplina</option>';
                        require "../../controllers/categoriaController.php";
                        $select = new CategoriaController();
                        $select->selectdisciplina(); 
                    echo '
                    </select>
                </div> 
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for  p-3">
                    <label for="categoria" class="label">Categoría</label>
                        <select name="codigoCa" id="categoria" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                            <option value="" disabled selected>Seleccione la categoría</option>
                        </select>
                </div>
            </div>
                        <div class="col-sm-6 col-xl-4">
                        <div class="rounded for  p-3">
                        <label for="comptencia" class="label">Competencia</label>
                        <select name="codigoCo" id="competencia" class="form-select form-select-md border-0" aria-label=".form-select-md example">
                            <option value="" disabled selected>Seleccione la competencia</option>';
                                require "../../controllers/atletaController.php";
                                $select = new AtletaController();
                                $select->SelectCompetencia(); 
                    echo '
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <input type="text" class="form-control border-0 input formulario__input" name="statu" id="statu" value="ACTIVO" hidden required>
            </div>

            <div class="col-sm-6 col-xl-4  formulario__grupo-btn-enviar">
                <div class="rounded for  p-3 formulario__grupo">
                    <input type="submit" value="Siguiente" form="formulario" name="btnregistrar" class="btn btn-primary px-2">
                    <input type="reset" value="Limpiar" form="formulario" class="btn btn-light px-2">
                </div>
            </div>
        </div>
    </div>
</form> ';
        require_once '../widgets/footer.php';    

