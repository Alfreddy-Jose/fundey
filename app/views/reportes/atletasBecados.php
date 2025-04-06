<?php

require '../plugins/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

ob_start();
require './listadoBecados.php';
$html = ob_get_contents();
ob_get_clean();

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();

/* header('Content-type: aplication/pdf');
echo $dompdf->output(); */

$dompdf->stream("Reporte.pdf", array("Attachment" => false)); 