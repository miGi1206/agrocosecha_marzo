<?php
require_once "./model/vistasModelos.php";
class vistasControlador extends vistasModelos
{
    public function obtener_plantilla_controlador()
    {
        return require_once "./view/plantilla.php";
    }
    public function obtener_vistas_controlador()
    {
        if (isset($_GET['views'])) {
            $ruta = explode("/", $_GET['views']);
            $respuesta = vistasModelos::obtener_vistas_modelos($ruta[0]);
        } else {
            $respuesta = "home-agro";
        }
        return $respuesta;
    }
}
