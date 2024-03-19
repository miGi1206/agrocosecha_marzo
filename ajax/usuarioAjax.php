<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtUsuario_ins']) || isset($_POST['usuarioId_eliminar'])){
    require_once "../controller/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();

    /*---------------- AGREGAR USUARIOS ------------------*/
    if (isset($_POST['txtUsuario_ins']) && isset($_POST['txtContra_ins']) && isset($_POST['txtConfir_contra_ins'])
    && isset($_POST['txtIDpersona_ins']) && isset($_POST['txtTipo_usuario_ins'])) {
        echo $ins_usuario->agregar_usuario_controlador();
    }

    /*---------------- ELIMINAR USUARIO ------------------*/
    if (isset($_POST['usuarioId_eliminar'])){
        echo $ins_usuario -> eliminar_usuario_controlador();
    }
    /*---------------- ACTUALIZAR USUARIO ------------------*/
    if (isset($_POST['usuarioId_up'])) {
        echo $ins_usuario->actualizar_usuario_controlador();
    }
}