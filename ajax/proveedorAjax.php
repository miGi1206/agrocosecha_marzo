<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtNit_ins']) || isset($_POST['proveedor_eliminar']) || isset($_POST['proveedor_nit_up'])){
    require_once "../controller/proveedorControlador.php";
    $ins_proveedor = new proveedorControlador();

    /*---------------- Agregar proveedor ------------------*/
    if (isset($_POST['txtNit_ins']) && isset($_POST['txtRazonSocial_ins'])) {
        echo $ins_proveedor->agregar_proveedor_controlador();
    }

    if (isset($_POST['txtUsuario_ins']) && isset($_POST['txtContra_ins']) && isset($_POST['txtConfir_contra_ins'])) {
        echo $ins_proveedor->agregar_proveedor_usuario_controlador();
    }

    /*---------------- Elimnar proveedor ------------------*/
    if (isset($_POST['proveedor_eliminar'])){
        echo $ins_proveedor -> eliminar_proveedor_controlador();
    }
    /*---------------- Actualizar proveedor ------------------*/
    if(isset($_POST['proveedor_nit_up'])){
        echo $ins_proveedor -> actualizar_proveedor_controlador();
    }

}
