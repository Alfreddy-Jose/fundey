<?php require_once '../widgets/header.php';

if ($_SESSION['codigo_rol'] !== 2220) {
    echo'<meta http-equiv="refresh" content="0; url=../panel.php">';
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

if (!empty($_GET["tamaño"])) {
if ($_GET["tamaño"] == "err") {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡TAMAÑO DE LA IMAGEN!</strong> EL TAMAÑO DE LA IMAGEN DEBE DE SER MENOR DE 5MB.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["img"])) {
if ($_GET["img"] == "err") {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡FORMATO DE IMAGEN!</strong> LA IMAGEN NO CUMPLE CON EL FORMATO CORRESPONDIENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["Cedula0"])) {
if ($_GET["Cedula0"] == "err") {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡REGISTRO FALLIDO!</strong> EL REGISTRO NO SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
    echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡REGISTRO EXITOSO!</strong> EL REGISTRO " . $_GET['Cedula0'] . " SE REALIZÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["Cedula1"])) {
if ($_GET["Cedula1"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡ERROR!</strong> EL REGISTRO NO SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡ELIMINACIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['Cedula1'] . " SE ELIMINÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}
if (!empty($_GET["Cedula2"])) {
if ($_GET["Cedula2"] == "err") {
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN FALLIDA!</strong> EL REGISTRO NO SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
} else {
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>¡EDICIÓN EXITOSA!</strong> EL REGISTRO " . $_GET['Cedula2'] . " SE EDITÓ CORRECTAMENTE.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
}
}

echo '
<!-- Formulario -->
<h2 class="title">GESTIONAR USUARIO</h2>

<form action="../../controllers/userController.php" method="POST" class="formulario" id="formulario" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4">
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
                        <i class="formulario__validacion-estado fas fa-times-circle" hidden></i>
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
                    <p class="formulario__input-error">El Nombre solo debe tener letras.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__apellido">
                    <label for="apellido" class="label formulario__label">Apellido</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="form-control border-0 input formulario__input upper" name="apellido" id="apellido" placeholder="Ingrese su apellido" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Apellido solo debe tener letras.</p>
                </div>
            </div> 
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__contraseña">
                    <label for="password3" class="label formulario__label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <div class="position-relative">
                        <button type="button" class="position-absolute end-0 z-5 btn text-dark" id="ojo2">
                        <i class="fa-regular fa-eye fa-fade"></i></button>
                        </div>
                        <input class="form-control border-0 input formulario__input" type="password" 
                        placeholder="Ingrese su contraseña" name="contraseña" id="password3" required>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 caracteres.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__contraseña2">
                    <label for="contraseña2" class="label formulario__label">Verificar Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" placeholder="Repetir contraseña" class="form-control border-0 input formulario__input" name="contraseña2" id="contraseña2" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo" id="grupo__usuario">
                    <label for="usuario" class="label formulario__label">Nombre de Usuario</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="form-control border-0 input formulario__input upper" name="usuario" id="usuario" placeholder="Ingrese usuario" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El usuario solo debe tener letras, números y guion_bajo.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for p-3 formulario__grupo">
                    <label for="foto" class="label">Foto de Perfil (Opcional)</label>
                    <input type="file" class="form-control border-0 input formulario__input" name="img" id="foto">
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="rounded for  p-3">
                    <label for="id_rol" class="label">Rol</label>
                    <select name="id_rol" id="id_rol" class="form-select form-select-md border-0" aria-label=".form-select-md example" required>
                        <option value="" disabled selected>Seleccione el rol</option>';
                        require "../../controllers/userController.php";
                        $select = new UserController();
                        $select->SelectRol(); 
                    echo'
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4  formulario__grupo-btn-enviar">
                <div class="rounded for  p-3 formulario__grupo">
                    <input type="submit" title="Enviar datos de los campos" value="Enviar" form="formulario" name="btnregistrar" class="btn btn-primary px-2">
                    <input type="reset" title="Eliminar datos de los campos" value="Limpiar" form="formulario" class="btn btn-light px-2">
                </div>
            </div>
        </div>
    </div>
</form> 

<!-- Fin del formulario --> 

    <div class="container-fluid my-5 scroll">
        <table id="myTable" class="table table-bordered border-primary align-middle table-hover text-dark text-center"> ';

            $usuario = new UserController();
            $usuario->showUser();
            echo'
        </table>
    </div>';

    require_once "../widgets/footer.php"; ?>