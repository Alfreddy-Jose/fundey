<?php
echo '
<div class="container-fluid m-4 d-flex justify-content-center">
    <div class="container col-ms-6 col-lg-4">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <p class="nav-link '; 
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/agregar_atleta.php'){ echo 'active'; }
            echo'">Paso 1</p>
            </li>
            <li class="nav-item">
                <p class="nav-link '; 
                if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/propietario_cuenta.php'){ echo 'active'; }
            echo' ">Paso 2</p>
            </li>
        </ul>
    </div>
</div>
';