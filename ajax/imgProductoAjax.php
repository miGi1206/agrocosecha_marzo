<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtcodigo_reg']) || isset($_POST['idcodigo_del'])) {
    require_once "../controller/productoIMGControlador.php";
    $ins_producto_imagen = new productoIMGControlador();

    /*---------------- Agregar producto ------------------*/
    if (isset($_POST['txtcodigo_reg'])) {
        echo $ins_producto_imagen->agregar_producto_imagen_controlador();
    }

    /*---------------- Eliminar producto ------------------*/
    if (isset($_POST['idcodigo_del'])) {
        echo $ins_producto_imagen->eliminar_producto_imagen_controlador();
    }
}
?>
