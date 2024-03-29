<!-- //! Segundo navbar, MENU de opciones -->
<?php
    include "config\coneccion_tabla.php";
?>
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
        <a class="navbar-brand text-success logo align-self-center" href="<?php echo SERVERURL; ?>home-agro/">
            <img src="<?php echo SERVERURL; ?>view/img/nombre_logo.png" alt="" class="logo" style="width:60% !important;">
        </a>
        </div>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
            // Realiza una consulta SQL para obtener el primer ID de la base de datos
            $sql_obtener_primer_id = "SELECT codigo_producto FROM tbl_producto ORDER BY codigo_producto ASC LIMIT 1";
            $resultado = mysqli_query($conn, $sql_obtener_primer_id);

            if ($row = mysqli_fetch_assoc($resultado)) {
                // Obtiene el ID
                $primer_id = $row['codigo_producto'];
            }
        ?>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SERVERURL;?>home-agro/">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo SERVERURL;?>productos-servicios?busqueda=<?php echo $primer_id; ?>">Productos y Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SERVERURL;?>quienes-somos/">Quienes somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SERVERURL;?>contactanos/">Contactanos</a>
                    </li>
                    <?php
                        if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "2"){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SERVERURL;?>checkout/">Carrito(
                                    <?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);?>)    
                                </a>
                            </li>
                    <?php } ?>
                </ul>
            </div>

            <!-- //TODO: Funcion para mostrar la opcion de iniciar sesion -->
            <?php if (!isset($_SESSION['codigo_usuario_spm'])) { ?>
            <div class="navbar align-self-center d-flex">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo SERVERURL; ?>login/">iniciar sesión</a>
                    </li>
                </ul>
            </div>
            <?php

            //TODO: Funcion si no se cumple la anterior; Muestra un icono de usuario, si es administrador 
            //todo: muestra una opcion para ir a las tablas de los clientes, proveedores y otros administradores
            } else { 
                //* Asegúrate de definir $nombre aunque sea como una cadena vacía
                $nombre = isset($_SESSION['usuario_spm']) ? $_SESSION['usuario_spm'] : '';
            ?>
                <div class="navbar align-self-center d-flex">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "3") { ?>
                                    <i class="bi bi-person text-dark"></i> <?php echo $_SESSION['nombre_razonsocial_spm']; ?>
                                <?php }else { ?>
                                    <i class="bi bi-person text-dark"></i> <?php echo $_SESSION['primer_nombre_spm']; ?>
                                <?php } ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                                <?php
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "1") { ?>
                                    <a class="dropdown-item" href="<?php echo SERVERURL;?>personas-list/">Admin</a>
                                <?php } ?>
                                <a href="" class="btn-exit-system2 dropdown-item"><i class="lni lni-exit"></i>Cerrar sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php }?>
        </div>
    </div>
</nav>
<?php include "./view/inc/LogOut.php"; ?>