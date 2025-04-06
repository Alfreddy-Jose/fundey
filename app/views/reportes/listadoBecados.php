<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/FUNDEY/app/views/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/FUNDEY/app/views/css/style.css">
</head>
<body class="for">
    
<?php
if(!isset($_GET['name'])){$_GET['name'] = "";}
if(!isset($_GET['categoria'])){$_GET['categoria'] = "";} 
if(!isset($_GET['disciplina'])){$_GET['disciplina'] = "";} 
    
require '../../controllers/reportesController.php';
        echo'
        <div class="container-fluid my-5">
        <center>
                <img class="cabezera" src="http://'.$_SERVER['HTTP_HOST'].'/FUNDEY/app/views/img/cabezera.png" alt="Imagen de cabezera">
            </center>
            <h1 class="text-dark">LISTA DE BENEFICIARIOS DE BECA</h1>
                <table class=" text-dark table align-middle text-center">';
                $show = new ReportesController();
                $show->showReportes($_GET['name'], $_GET['categoria'], $_GET['disciplina']);
        echo'
            </table> 
        </div>';
?>
</body>
</html>





