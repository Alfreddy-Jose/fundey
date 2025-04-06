<?php

if (!empty($_GET["cedula"]) || !empty($_GET["pass"])) {
    if ((!empty($_GET["cedula"]) AND $_GET["cedula"] == "err") || (!empty($_GET["pass"]) AND $_GET["pass"] == "err")) {
        echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>¡USUARIO O CONTRASEÑA INCORRECTO!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
    ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FUNDEY</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="./img/FUNDEY.png" rel="icon">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body class="body-login">
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <h3>Inicio de Sesión</h3>
                        </div>
                        <form action="../controllers/loginController.php" method="POST" id="inicio">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cédula" autocomplete="off" required>
                                <label for="cedula">Cédula</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese Contraseña" autocomplete="off" required>
                                <label for="pass">Contraseña</label>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" form="inicio" >Iniciar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>