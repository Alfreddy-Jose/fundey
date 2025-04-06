<?php
    
    if(!isset($_POST['nombre'])){$_POST['nombre'] = "";}
    if(!isset($_POST['categoria'])){$_POST['categoria'] = "";} 
    if(!isset($_POST['disciplina'])){$_POST['disciplina'] = "";}
    ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8"> 
    <title>FUNDEY</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php
    echo'
    <!-- Favicon -->
    <link href="http://'.$_SERVER['HTTP_HOST'].'/FUNDEY/app/views/img/FUNDEY.png" rel="icon">

    <!-- styles css -->
    <link rel="stylesheet" href="http://'.$_SERVER['HTTP_HOST'].'/FUNDEY/app/views/css/style.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="http://'.$_SERVER['HTTP_HOST'].'/FUNDEY/app/views/css/bootstrap.min.css" rel="stylesheet">';
    ?>
</head>

<body class="for">
        <div class='container-fluid'>
            <center>
                <img class='cabezera' src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/FUNDEY/app/views/img/cabezera.png" alt="Imagen de cabezera">
            </center>
            <h1 class='text-dark'>LISTA DE BENEFICIARIOS DE BECA</h1>
            <table class='table table-bordered border-dark align-middle text-center text-dark'>
                <?php require '../../controllers/reportesController.php';
                $show = new ReportesController();
                $show->showReportes($_POST['nombre'], $_POST['categoria'], $_POST['disciplina']);?>
            </table>
        </div>
</body>

</html> 

<?php
    $html = ob_get_clean();

    require '../plugins/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);

    $dompdf -> loadHtml($html);
    $dompdf->setPaper("A4", "landscape");
    $dompdf-> render();
    $dompdf->stream("Reporte.pdf", array("Attachment" => false));  
?>