<?php
    require '../widgets/header.php';

    if (isset($_GET['cedulaA']) and isset($_GET['cedulaB'])) {
    echo '
        <div class="container-fluid d-flex justify-content-center mt-5">
            <div class="container rounded for col-sm-6 col-lg-5 p-3">
                <p class="text-center text-dark">EL PROPIETARIO YA ESTÁ REGISTRADO, DESEA ASIGNARLO NUEVAMENTE?</p>
                    <form method="POST" action="../../controllers/propietarioController.php" id="asignar">';    
                        require '../../controllers/propietarioController.php';
                        $asignar = new PropietarioController();
                        $asignar->asignarPropietario($_GET['cedulaA'], $_GET['cedulaB']);
                echo'</form>
                <center>
                    <a href="#" class="btn btn-light atras">Volver</a>
                    <button type="submit" class="btn btn-primary" form="asignar">Asignar</button>
                </center>

            </div>
            
        </div>';
    }

    if (!isset($_GET['cedulaA'])) {
        echo'
            <div class="container-fluid d-flex justify-content-center mt-5">
                <div class="container rounded for col-sm-6 col-lg-5 p-3">
                    <p class="text-center text-dark">EL PROPIETARIO NO ESTÁ REGISTRADO</p>

                    <center>
                        <a href="#" class="btn btn-light atras">Volver</a>
                    </center>
                    
                </div>
                
            </div>
        ';
    }

    require "../widgets/footer.php"; 
    ?> 