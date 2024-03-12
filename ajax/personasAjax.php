<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['txtDni_ins']) || isset($_POST['personas_eliminar']) || isset($_POST['personas_id_up'])){
    require_once "../controller/personasControlador.php";
    $ins_personas = new personasControlador();

    /*---------------- AGREGAR PERSONAS ------------------*/
    if (isset($_POST['txtDni_ins']) && isset($_POST['txtNombre1_ins']) && isset($_POST['txtNombre2_ins'])
    && isset($_POST['txtApellido1_ins']) && isset($_POST['txtApellido2_ins']) && isset($_POST['txtTelefono_ins'])
    && isset($_POST['txtEmail_ins']) && isset($_POST['txtSexo_ins']) && isset($_POST['txtFecha_nacimiento_ins'])
    && isset($_POST['txtDireccion_ins'])) {
        echo $ins_personas->agregar_personas_controlador();
    }

    /*---------------- AGREGAR USUARIOS ------------------*/
    if (isset($_POST['txtUsuario_ins']) && isset($_POST['txtContra_ins']) && isset($_POST['txtConfir_contra_ins'])) {
        echo $ins_personas->agregar_personas_usuario_controlador();
    }

    /*---------------- ELIMINAR PERSONAS ------------------*/
    if (isset($_POST['personas_eliminar'])){
        echo $ins_personas -> eliminar_personas_controlador();
    }
    /*---------------- ACTUALIZAR PERSONAS ------------------*/
    if(isset($_POST['personas_id_up'])){
        echo $ins_personas -> actualizar_personas_controlador();
    }

}