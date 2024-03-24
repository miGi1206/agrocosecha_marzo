<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtcodigo2_reg']) || isset($_POST['idcodigo2_del'])) {
    require_once "../controller/productoVIDControlador.php";
    $ins_producto_video = new productoVIDControlador();

    /*---------------- Agregar producto ------------------*/
    if (isset($_POST['txtcodigo2_reg'])) {
        echo $ins_producto_video->agregar_producto_video_controlador();
    }

    /*---------------- Eliminar producto ------------------*/
    if (isset($_POST['idcodigo2_del'])) {
        echo $ins_producto_video->eliminar_producto_video_controlador();
    }
}
?>
