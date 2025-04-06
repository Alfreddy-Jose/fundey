<?php
date_default_timezone_set('America/Caracas');
session_start();
    if (empty($_SESSION["cedula"]) && $_SERVER['PHP_SELF'] != "/FUNDEY/index.php") {
        header("Location: /FUNDEY");
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
    <link href="/FUNDEY/app/views/img/FUNDEY.png" rel="icon">

    <!-- styles css -->
    <link rel="stylesheet" href="/FUNDEY/app/views/css/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="/FUNDEY/app/views/plugins/fontawesome/css/all.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/FUNDEY/app/views/css/bootstrap.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" href="/FUNDEY/app/views/plugins/datatables/datatable.min.css">

</head>

<body>
    
<?php
if($_SERVER['PHP_SELF'] !== '/FUNDEY/app/views/reportes/reportes.php'){
echo '
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar navbar-dark">
            <a href="/FUNDEY/app/views/panel.php" class="navbar-brand mx-4 mb-3" ';

            if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
            }
        echo'>
                <h3 class="text-primary"><img src="/FUNDEY/app/views/img/FUNDEY.png" class="logo me-2" alt="Logo de fundey">FUNDEY</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">';
                    if ($_SESSION['foto'] != '' ) {
                        echo'
                        <img class="rounded-circle fotos" src="/FUNDEY/app/views/usuarios/'.$_SESSION['foto'].'">';
                    }else{
                        echo'
                        <i class="fa-solid fa-user-large icono"></i>';
                    }
                echo'
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>    
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 letras">'.$_SESSION["nombre_usuario"].'</h6>
                    <span class="letras">'.$_SESSION["rol"].'</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="/FUNDEY/app/views/panel.php" class="nav-item nav-link ';
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/panel.php') {
                    echo 'active';
                }
                echo'" ';
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                    echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                }
            echo'><i class="fa-solid fa-house me-2"></i>Dashboard</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/atleta.php' || $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/atleta_inactivo.php') {
                        echo 'active';
                    }
                echo'" data-bs-toggle="dropdown"><i class="fa-solid fa-people-group me-2"></i>Atletas</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/FUNDEY/app/views/atleta/atleta.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/atleta.php') {
                            echo 'active';
                        }
                    echo'" ';
                    
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>Administrar Atletas</a>
                        <a href="/FUNDEY/app/views/atleta/atleta_inactivo.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/atleta_inactivo.php') {
                            echo 'active';
                        }
                    echo'" ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>Atletas Suspendidos</a>
                    </div>
                </div>


                <a href="/FUNDEY/app/views/beca/beca.php" class="nav-item nav-link ';
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/beca/beca.php') {
                    echo 'active';
                }
                echo'" ';
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                    echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                }
                echo'><i class="fa-solid fa-money-check-dollar me-2"></i>Generar pago</a>';


            echo'<div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/competencia/competencia.php' || $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/disciplina/disciplina.php' ||
                    $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/categoria/categoria.php' || $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php' ||
                    $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/pais/pais.php' || $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/estado/estado.php' ||  $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/usuarios/usuarios.php') {
                        echo 'active';
                    }
                echo'" data-bs-toggle="dropdown"><i class="fa-solid fa-gear me-2"></i>Configuración</a>
                <div class="dropdown-menu bg-transparent border-0">';
                    if ($_SESSION['codigo_rol'] === 2220) {
                echo'<a href="/FUNDEY/app/views/usuarios/usuarios.php" class="dropdown-item ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/usuarios/usuarios.php') {
                        echo 'active';}
                        echo'" ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                            echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                        }
                        echo'>Usuario</a>';
                    }
                echo'<a href="/FUNDEY/app/views/disciplina/disciplina.php" class="dropdown-item ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/disciplina/disciplina.php') {
                        echo 'active';}
                        echo'" ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                            echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                        }
                        echo'>Disciplina</a>
                        <a href="/FUNDEY/app/views/categoria/categoria.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/categoria/categoria.php') {
                            echo 'active';}
                    echo'" ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                                echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                            }
                    echo'>Categoría</a>
                        <a href="/FUNDEY/app/views/competencia/competencia.php"
                        class="dropdown-item '; 
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/competencia/competencia.php') {
                            echo 'active';} 
                            echo'" ';
                            if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                                echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                            }
                        echo'>Competencia</a>
                        <a href="/FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/nivelCompetencia/nivelCompetencia.php') {
                            echo 'active';}
                    echo'" ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>Nivel Competencia</a>
                        <a href="/FUNDEY/app/views/pais/pais.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/pais/pais.php') {
                            echo 'active';}
                    echo'" ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>País</a>
                        <a href="/FUNDEY/app/views/estado/estado.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/estado/estado.php') {
                            echo 'active';}
                    echo'" ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>Estado</a>
                    </div>
                </div>
                
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle ';
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/listaBecados/listaBecados.php') {
                        echo 'active';
                    }
                echo'" data-bs-toggle="dropdown"><i class="fa-regular fa-clipboard me-2"></i>Reportes</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/FUNDEY/app/views/listaBecados/listaBecados.php" class="dropdown-item ';
                        if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/listaBecados/listaBecados.php') {
                            echo 'active';
                        }
                    echo'" ';
                    
                    if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                        echo 'data-bs-toggle="modal" data-bs-target="#modalregistro"';
                    }
                echo'>Atletas Becados</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
            
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar lateral navbar-expand navbar-dark sticky-top px-4 py-0">
            <a href="/FUNDEY/app/views/panel.php" class="navbar-brand d-flex d-lg-none me-4">
                <img src="/FUNDEY/app/views/img/FUNDEY.png" class="logo me-2" alt="Logo de fundey">
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>';
            if ($_SERVER['PHP_SELF'] !== '/FUNDEY/app/views/atleta/propietario_cuenta.php') {
                
            
        echo'<div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">';
                    if ($_SESSION['foto'] !== '' ) {
                        echo'
                        <img class="rounded-circle fotos me-lg-2" src="/FUNDEY/app/views/usuarios/'.$_SESSION['foto'].'"';
                    }else{
                        echo'
                        <i class="fa-solid fa-user-large icon"></i>';
                    }
                        echo'
                        <span class="d-none d-lg-inline-flex letras">'.$_SESSION["nombre_usuario"].'</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0">

                        <!-- Button trigger modal Cerrar Sesion -->
            
                        <a href="/FUNDEY/app/controllers/manualesController.php?manual=usuario" target="_blank" class="dropdown-item">
                            Acerca del sistema
                        </a>';
                if ($_SESSION['codigo_rol'] === 2220) {            
                    echo'<a href="/FUNDEY/app/controllers/manualesController.php?manual=sistema" target="_blank" class="dropdown-item">
                            Manual del Sistema
                        </a>';
                        }
                    echo'    
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>';
            }
    echo'</nav>
        <!-- Navbar End -->';

        if (!empty($_SESSION["cedula"]) && $_SERVER['PHP_SELF'] != "/FUNDEY/index.php") {
    echo " 
    <!-- Modal Cerrar Sesion -->
    <div class='modal fade position-absolute' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5 text-dark' id='staticBackdropLabel'>CIERRE DE SESIÓN</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <p>ESTÁ SEGURO DE QUE DESEA CERRAR SESIÓN?</p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                    <a class='btn btn-primary' href='/FUNDEY'>Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
    
        <!-- Modal Terminar Registro -->
    <div class='modal fade position-absolute' id='modalregistro' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5 text-dark' id='staticBackdropLabel'>REGISTRO INCOMPLETO</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <p>ES OBLIGATORIO TEMINAR EL REGISTRO!</p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>";
    }
}