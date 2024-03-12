<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtcodigo_reg']) || isset($_POST['idcodigo_del']) || isset($_POST['updateproducto'])){
    require_once "../controller/productoControlador.php";
    $ins_producto = new productoControlador();

    /*---------------- Agregar mesa ------------------*/
    if (isset($_POST['txtcodigo_reg'])) {
        echo $ins_producto-> agregar_producto_controlador();
    }

    /*---------------- Elimnar aprendiz ------------------*/
    if (isset($_POST['idcodigo_del'])){
        echo $ins_producto -> eliminar_producto_controlador();
    }
    /*---------------- Actualizar aprendiz ------------------*/
    if(isset($_POST['updateproducto'])){
        echo $ins_producto -> actualizar_producto_controlador();
    }

}
