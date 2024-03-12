<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['token']) && isset($_POST['nombre'])) {
   require_once "../controller/loginControlador.php";
   $ins_login = new loginControlador();

   echo $ins_login->cerrar_sesion_controlador();
} else {
   session_start(['name' => 'SPM']);
   session_unset();
   session_destroy();
   header("Location: " . SERVERURL . "home-agro/");
   exit();
}
