<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtDni_ins'])){
    require_once "../controller/registrarseControlador.php";
    $ins_registrarse = new registrarseControlador();

    /*---------------- AGREGAR PERSONAS ------------------*/
    if (isset($_POST['txtDni_ins']) && isset($_POST['txtNombre1_ins']) && isset($_POST['txtNombre2_ins'])
    && isset($_POST['txtApellido1_ins']) && isset($_POST['txtApellido2_ins']) && isset($_POST['txtTelefono_ins'])
    && isset($_POST['txtEmail_ins']) && isset($_POST['txtSexo_ins']) && isset($_POST['txtFecha_nacimiento_ins'])
    && isset($_POST['txtDireccion_ins'])) {
        echo $ins_registrarse->agregar_registro_controlador();
    }

    /*---------------- AGREGAR USUARIOS ------------------*/
    if (isset($_POST['txtUsuario_ins']) && isset($_POST['txtContra_ins']) && isset($_POST['txtConfir_contra_ins'])) {
        echo $ins_registrarse->agregar_registro_usuario_controlador();
    }
}