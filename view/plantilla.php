<!DOCTYPE html>
<html lang="es">
<?php
session_start(['name' => 'SPM']);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo COMPANY; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SERVERURL; ?>view/img/Size-16.png">
    <?php include "./view/inc/css.php"; ?>
</head>

<body>
    <?php
    $peticionAjax = false;
    require_once "./controller/vistasControlador.php";
    $IV = new vistasControlador();
    $vistas = $IV->obtener_vistas_controlador();

    if ($vistas == "contactanos" || $vistas == "home-agro" || $vistas == "404" || $vistas == "login" || $vistas == "quienes-somos" || $vistas == "productos-servicios" || $vistas == "registrarse") {
        require_once "./view/contenidos/" . $vistas . "-view.php";
    } else {
        $pagina = explode("/", $_GET['views']);
        require_once "./controller/loginControlador.php";
        $lc = new loginControlador();

        if (
            !isset($_SESSION['token_spm']) || !isset($_SESSION['cod_persona_spm']) || !isset($_SESSION['primer_nombre_spm']) ||
            !isset($_SESSION['primer_apellido_spm']) || !isset($_SESSION['id_spm']) || !isset($_SESSION['telefono_spm'])
        ) {
            echo $lc->forzar_cierre_sesion_controlador();
            exit();
        }
    ?>
        <?php include "view/inc/sidebar.php"; ?>
        <main class="main-wrapper">
            <?php include "view/inc/nav.php"; ?>
            <div id="content">
                <?php include $vistas; ?>
                <?php include "view/inc/foother.php"; ?>
            </div>
        </main>
    <?php
        include "./view/inc/LogOut.php";
    }
    include "./view/inc/js.php"; ?>
</body>

</html>