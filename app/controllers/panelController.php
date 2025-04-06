<?php


class PanelController
{
    private $model;

    function __construct()
    {
        $server = dirname(__DIR__, 1);
        require_once "$server/models/panelModel.php";
        $this->model = new PanelModel();
    }

    function Inactivos()
    {

        $inactivos = $this->model->ContarAtletasIn();
        echo '
        <h6 class="mb-0 letras">' . "$inactivos" . '</h6>';
    }
    function Activos()
    {

        $activos = $this->model->ContarAtletasAc();
        echo '
        <h6 class="mb-0 letras">' . "$activos" . '</h6>';
    }

    function Total()
    {

        $total = $this->model->ContarAtletasTotal();
        echo '
        <h6 class="mb-0 letras">' . "$total" . '</h6>';
    }
    function Usuarios()
    {

        $usuarios = $this->model->ContarUsuarios();
        echo '
        <h6 class="mb-0 letras">' . "$usuarios" . '</h6>';
    }
}
