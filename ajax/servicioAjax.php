<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtcodigo_reg']) || isset($_POST['idcodigo_del']) || isset($_POST['updateservicios'])){
    require_once "../controller/servicioControlador.php";
    $ins_servicio = new servicioControlador();

    /*---------------- Agregar servicio ------------------*/
    if (isset($_POST['txtcodigo_reg'])) {
        echo $ins_servicio-> agregar_servicio_controlador();
    }
    /*---------------- ELIMINAR servicio ------------------*/
    if (isset($_POST['idcodigo_del'])){
        echo $ins_servicio -> eliminar_servicio_controlador(); 
    }
     /*---------------- ACTUALIZAR servicio ------------------*/
     if(isset($_POST['updateservicios'])){
        echo $ins_servicio -> actualizar_servicio_controlador();
    }


}