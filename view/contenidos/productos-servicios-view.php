<!DOCTYPE html>
<html lang="en">
<head>
<title>Agrocosecha</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/agrocosecha_final/vista_corp/assets/img/Size-16.png">

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/templatemo.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/sidebar_proser.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php include "config\coneccion_tabla.php";?>

    <style>
    .contenido-fijo {
        position: fixed;
        top: 0;
        /* Puedes ajustar la posición superior según tus necesidades */
        left: 0;
        /* Puedes ajustar la posición izquierda según tus necesidades */
        width: 100%;
        /* Establecer el ancho al 100% para que ocupe todo el ancho de la pantalla */
        z-index: 1000;
        /* Puedes ajustar la propiedad z-index según tus necesidades */
        background-color: white;
    }

    .fuera-navbar {
        margin-top: 10%;
    }

    @media (max-width: 1000px) {
        .fuera-navbar {
            margin-top: 10%;
        }
    }

    @media (max-width: 500px) {
        .fuera-navbar {
            margin-top: 15%;
        }
    }
    </style>
    <div class="contenido-fijo">
        <!-- Header -->
        <?php include "view/inc/navbar-superior.php";?>
        <?php include "view/inc/navbar_menu.php";?>
        <!-- Close Header -->
    </div>

    <!-- Close Header -->

    <!-- Start Content -->
    <div class="container py-3 fuera-navbar">
        <div class="row" id="div">

            <!--Inicio de sidebar-->
            <?php include "view/inc/sidebar_proser.php"?>
            <!--Fin del sidebar-->

            <div class="container pb-5 bg-light" style="width: 70%;">
                <div class="row">
                    <div class="col-lg-5 mt-5">
                        <div class="card mb-3">
                            <img class="card-img img-fluid" src="<?php echo SERVERURL; ?>view/img/arroz.jpg"
                                alt="Card image cap" id="product-detail">
                        </div>
                        <div class="row">
                            <!--Start Controls-->
                            <div class="col-1 align-self-center">
                                <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                    <i class="text-dark bi bi-chevron-left"></i>
                                </a>
                            </div>
                            <!--End Controls-->
                            <!--Start Carousel Wrapper-->
                            <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                                data-bs-ride="carousel">
                                <!--Start Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/principio_arroz (1).jpg"
                                                        alt="Product Image 1">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/2Face_arroz.jpg"
                                                        alt="Product Image 2">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/3face_arroz.png"
                                                        alt="Product Image 3">
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/.First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/4face_arroz.png"
                                                        alt="Product Image 4">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/5face_arroz.png"
                                                        alt="Product Image 5">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/6face_arroz.png"
                                                        alt="Product Image 6">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/arroz.jpg"
                                                        alt="Product Image 7">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="<?php echo SERVERURL; ?>view/img/ultimaface_arroz.png "
                                                        alt="Product Image 8">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.Third slide-->
                                </div>
                                <!--End Slides-->
                            </div>
                            <!--End Carousel Wrapper-->
                            <!--Start Controls-->
                            <div class="col-1 align-self-center" style="margin-top:-4%;">
                                <a href="#multi-item-example" role="button" data-bs-slide="next">
                                    <i class="text-dark bi bi-chevron-right"></i>
                                </a>
                            </div>
                            <!--End Controls-->

                        </div>
                    </div>
                    <!-- col end -->
                    <?php
                    $productos="";
                    if (isset($_GET['busqueda'])){
                        $busqueda = $_GET['busqueda'];
                        $productos = "WHERE tbl_producto.codigo_producto = '$busqueda'";
                    }
                    ?>
                    <?php
                    $alquiler="";
                    if (isset($_GET['busqueda2'])){
                        $alquiler_equipos = $_GET['busqueda2'];
                        $alquiler = "WHERE tbl_servicio.codigo_servicio = '$alquiler_equipos'";
                    }
                    ?>

                    <?php
                    $servicio_personal="";
                    if (isset($_GET['busqueda3'])){
                        $personal = $_GET['busqueda3'];
                        $servicio_personal = "WHERE tbl_servicio.codigo_servicio = '$personal'";
                    }
                    ?>

                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                            <?php
                                $productos = "";
                                $alquiler = "";

                                if (isset($_GET['busqueda'])) {
                                    $busqueda = $_GET['busqueda'];
                                    $productos = "WHERE tbl_producto.codigo_producto = '$busqueda'";
                                    $sql_producto = "SELECT * FROM `tbl_producto` $productos";
                                    $result_producto = mysqli_query($conn, $sql_producto);

                                    while ($row = mysqli_fetch_assoc($result_producto)) {
                            ?>
                                <h1 class="h2"><?= $row['nombre']?></h1>

                                <!-- //! Mostrar el precio y stock solo cuando se halla iniciado sesion como cliente -->
                                <?php
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "2") {
                                            echo "<p><b>Precio: $". $row['precio'] . "</b></p>";
                                            echo "<p><b>Stock: ". $row['stock'] . "</b></p>";
                                }
                                ?>

                                <h6>Descripción</h6>
                                <p><?= $row['descripcion']?></p>

                                <!-- //! Mostrar el boton de comprar  -->
                                <?php
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "2") {
                                    echo '<div class="navbar align-self-center d-flex">
                                                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                                                        <li class="nav-item">
                                                            <button class="nav-link" href="#"
                                                                style="background-color:#3aaa3c; border-radius:5px; padding:5%; color:white;  width: 130px;"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModalToggle2"
                                                                aria-expanded="false" role="button"><i class="bi bi-cart-fill text-black"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
                                                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                    
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                    
                                                            <div class="modal-body">
                                                                <div class="z-flex2">
                    
                                                                    <!-- inicio del formulario -->
                                                                    <form method="POST" action="">
                                                                        <img src="/agrocosecha_final/vista_corp/assets/img/nombre_logo.png"
                                                                            class="col-sm-6" id="ini_logo3" style="margin: auto">
                                                                        <h5 class="modal-title" id="exampleModalToggleLabel"
                                                                            style="margin-bottom: 5%; color: #065F2C;"><b>Comprar</b></h5>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="number" class="form-control cuadro_texto2"
                                                                                id="floatingInput" name="cantidad" placeholder="cantidad"
                                                                                required>
                                                                            <label for="floatingInput">Cantidad</label>
                                                                        </div>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control cuadro_texto2"
                                                                                id="floatingInput" name="direccion" placeholder="direccion"
                                                                                required>
                                                                            <label for="floatingInput">Dirección</label>
                                                                        </div>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="number" class="form-control cuadro_texto2"
                                                                                id="floatingInput" name="telefono" placeholder="direccion"
                                                                                required>
                                                                            <label for="floatingInput">Telefono</label>
                                                                        </div>
                                                                        <button type="submit" class="btn-iniciar2" style="padding:1% 5%; ">
                                                                            Comprar</button>
                                                                    </form>
                                                                    <!-- fin del formulario  -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                
                                }
                                ?>
                                <?php
                                    }
                                }elseif (isset($_GET['busqueda2'])) {
                                    $alquiler_equipos = $_GET['busqueda2'];
                                    $alquiler = "WHERE tbl_servicio.codigo_servicio = '$alquiler_equipos'";
                                    $sql_alquiler = "SELECT * FROM `tbl_servicio` $alquiler";
                                    $result_alquiler = mysqli_query($conn, $sql_alquiler);

                                    while ($row = mysqli_fetch_assoc($result_alquiler)) {
                            ?>
                                <h1 class="h2"><?= $row['nombre']?></h1>

                                <?php
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "2") {
                                            echo "<p><b>Precio: $". $row['precio'] . "</b></p>";
                                            echo "<p><b>Duración: ". $row['duracion'] . "</b></p>";
                                }
                                ?>
                                <!-- <p><b>Precio: <?= $row['precio']?></b></p>
                                <p><b>Duración: <?= $row['duracion']?> horas</b></p> -->
                                <h6>Descripción</h6>
                                <p><?= $row['descripcion']?></p>
                                <?php
                                    }
                                }elseif (isset($_GET['busqueda3'])) {
                                    $personal = $_GET['busqueda3'];
                                    $servicio_personal = "WHERE tbl_servicio.codigo_servicio = '$personal'";
                                    $sql_servicio_personal = "SELECT * FROM `tbl_servicio` $servicio_personal";
                                    $result_personal = mysqli_query($conn, $sql_servicio_personal);

                                    while ($row = mysqli_fetch_assoc($result_personal)) {
                            ?>
                                <h1 class="h2"><?= $row['nombre']?></h1>
                                <p><b>Precio: <?= $row['precio']?></b></p>
                                <p><b>Duración: <?= $row['duracion']?> horas</b></p>
                                <h6>Descripción</h6>
                                <p><?= $row['descripcion']?></p>
                                <?php
                                    }
                            }
                            ?>
                            </div>

                        </div>
                    </div>

                </div>

                <div>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/UxeZeUd0Yb0" frameborder="0"
                        allowfullscreen></iframe>

                    <!-- <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/JBOmT-Mnm60?si=rpB4_5W3-uPtVAE1" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe> -->
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- End Content -->

    <!-- Start Footer -->
    <?php include "view/inc/foother_home.php";?>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="view/js/jquery-1.11.0.min.js"></script>
    <script src="view/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="view/js/bootstrap.bundle.min.js"></script>
    <script src="view/js/templatemo.js"></script>
    <script src="view/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>