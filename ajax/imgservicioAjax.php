<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtcodigo_reg']) || isset($_POST['idcodigo_del'])) {
    require_once "../controller/imgservicioControlador.php";
    $ins_servicio_imagen = new imgservicioControlador();

    /*---------------- Agregar servicio ------------------*/
    if (isset($_POST['txtcodigo_reg'])) {
        echo $ins_servicio_imagen->agregar_servicio_imagen_controlador();
    }

    /*---------------- Eliminar servicio ------------------*/
    if (isset($_POST['idcodigo_del'])) {
        echo $ins_servicio_imagen->eliminar_servicio_imagen_controlador();
    }
}
?>
