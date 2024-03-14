<?php
session_start(['name' => 'SPM']);
require_once "../config/APP.php";

if (isset($_POST['Horarios_search']) || isset($_POST['eliminar_busqueda'])) {
    $data_url = [
        "personas" => "personas-search/",
        "usuario" => "usuario-search/",
        "proveedor" => "proveedor-search/",
        "producto" => "producto-search/",
        "servicio"=> "servicio-search/",
    ];

    if (isset($_POST['modulo'])) {   
        $modulo = $_POST['modulo'];
        if (!isset($data_url[$modulo])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No podemos continuar con la busqueda debido a un error",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    } else {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No podemos continuar con la busqueda",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    $name_var = "busqueda_" . $modulo;

    if (isset($_POST['Horarios_search'])) {
        if ($_POST['Horarios_search'] == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Por favor introduce un termino para empezar",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $_SESSION[$name_var] = $_POST['Horarios_search'];
    }

    if (isset($_POST['eliminar_busqueda'])) {
        unset($_SESSION[$name_var]);
    }

    $url = $data_url[$modulo];

    $alerta = [
        "Alerta" => "redireccionar",
        "URL" => SERVERURL . $url
    ];
    echo json_encode($alerta);
} else {
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}