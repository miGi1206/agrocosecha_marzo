<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtUsuario_ins']) || isset($_POST['usuarioId_eliminar']) || isset($_POST['usuarioId_up'])){
    require_once "../controller/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();

    /*---------------- Agregar aprendiz ------------------*/
    if (isset($_POST['txtUsuario_ins']) && isset($_POST['txtContraseña_ins']) && isset($_POST['txtIDPersona_ins'])) {
        echo $ins_usuario->agregar_usuario_controlador();
    }

    /*---------------- Elimnar aprendiz ------------------*/
    if (isset($_POST['usuarioId_eliminar'])){
        echo $ins_usuario -> eliminar_usuario_controlador();
    }
    /*---------------- Actualizar usuario ------------------*/
    if (isset($_POST['usuarioId_up'])) {
        echo $ins_usuario->actualizar_usuario_controlador();
    }
}