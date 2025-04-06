<?php

require '../widgets/header.php';

require '../../controllers/atletaController.php'; 
$enviar = new AtletaController();
    if(!empty($_POST['Todos'])){
        $_POST['name'] = "";
        $_POST['categoria'] = "";
        $_POST['disciplina'] = "";
    }else{
    if(!isset($_POST['name'])){$_POST['name'] = "";}
    if(!isset($_POST['categoria'])){$_POST['categoria'] = "";} 
    if(!isset($_POST['disciplina'])){$_POST['disciplina'] = "";}
    } 


echo'
        <div class="container-fluid my-5">
            <h2 class="title">ATLETAS BECADOS</h2>
            <h3 class="title">Filtrar por:</h3>
            <form action="../../views/listaBecados/listaBecados.php" method="POST" class="container-fluid d-flex justify-content-evenly mb-4" id="buscar">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="rounded for p-3">
                        <label for="name" class="label">Nombre Apellido</label>
                        <input class="form-control border-0" name="name" id="name" type="text" placeholder="Buscar">
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="rounded for p-3">
                        <label for="disciplina" class="label">Disciplina</label>
                        <select name="disciplina" id="disciplina" class="form-select form-select-md border-0" aria-label=".form-select-md example">
                            <option value="" disabled selected > Seleccione la disciplina </option>';
                            $enviar->selectdisciplina(); 
                    echo'
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="rounded for p-3">
                        <label for="categoria" class="label">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select form-select-md border-0">
                            <option value="">Seleccione la categoría</option>
                        </select>
                    </div>
                </div> 
                <div class="d-flex justify-content-end">
                    <input type="submit" value="Buscar" form="buscar" class="btn m-2 btn-primary">
                    <input type="reset" value="Limpiar" form="buscar" class="btn m-2 btn-light">
                    <input type="submit" value="Todos" class="btn m-2 btn-dark">
                </div>
            </div>
        </form>
</div>';


require '../../controllers/becaController.php';
    echo'
        <a target="_blank" href="/FUNDEY/app/views/reportes/atletasBecados.php?name='.$_POST['name'].'&&categoria='.$_POST['categoria'].'&&disciplina='.$_POST['disciplina'].'" class="btn m-3 btn-warning">Ver en <i class="fas fa-file-pdf"></i></a>
        <div class="container-fluid scroll">
            <table id="myTable" class="table table-bordered table-hover border-primary text-center text-dark">';
                $show = new BecaController();
                $show->ShowAtletaBecados($_POST['name'], $_POST['categoria'], $_POST['disciplina']);
        echo'</table>
        </div>    
    ';







require '../widgets/footer.php';