<?php

class ManualesController{
    function manualSistema($file){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.basename($file).'"');
            header('Content-Length:'.filesize($file));
            readfile($file);
        }else {
            die("El archivo no existe.");
        }
    }
}



$class = new ManualesController();

if(!empty($_GET['manual'])){
    if($_GET['manual'] == 'sistema'){
        $addres = '../views/Manuales/ManualSistemaFundey.pdf';
        $class->manualSistema($addres);  
    }else{
        $addres = '../views/Manuales/ManualUsuarioFundey.pdf';
        $class->manualSistema($addres);
    }
}
