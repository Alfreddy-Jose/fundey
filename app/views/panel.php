<?php require_once "./widgets/header.php"; 
echo'

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center justify-content-between p-4 cartas">
                <i class="fa fa-face-grin fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Atletas Activos</p>';
                    require '../controllers/panelController.php';
                    $mostrar = new PanelController();
                    $mostrar->Activos();
                    echo'
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center justify-content-between p-4 cartas">
                <i class="fa-solid fa-face-frown fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Atletas Inactivos</p>';
                    $mostrar->Inactivos();
                echo'
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center justify-content-between p-4 cartas">
                <i class="fa-solid fa-user fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">N° de Usuarios</p>';
                    $mostrar->Usuarios();
            echo'</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center justify-content-between p-4 cartas">
                <i class="fa-solid fa-person fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Atletas</p>';
                    $mostrar->Total();
            echo'</div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<div class="container d-flex align-items-center justify-content-center p-3">
    <h1 class="mx-2 text-dark bienvenida">Bienvenido al Sistema de Control de Becados</h1>
    <img src="./img/FUNDEY.png" class="log" alt="logo fundey">
</div>';

    require_once "./widgets/footer.php"; 