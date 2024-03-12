<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agrocosecha</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SERVERURL; ?>view/img/Size-16.png">

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/templatemo.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
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
        z-index: 100;
        /* Puedes ajustar la propiedad z-index según tus necesidades */
        background-color:white;
    }
    .fuera-navbar{
        margin-top:6%;
    }
    @media (max-width: 1000px) {
    .fuera-navbar {
        margin-top:10%; 
    }
    }
    @media (max-width: 500px) {
    .fuera-navbar {
        margin-top:15%; 
    }
    }
    </style>
    <div class="contenido-fijo">
    <!-- Header -->
    <?php include "view/inc/navbar-superior.php";?>
    <?php include "view/inc/navbar_menu.php";?>
    <!-- Close Header -->
    </div>
    <!-- Carrusel -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide fuera-navbar" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo SERVERURL; ?>view/img/asddwa.webp" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>Agrocosecha</b></h1>
                                <h3 class="h2">Gallinas</h3>
                                <p>
                                    las gallinas ponedoras se crian principalmente por su capacidad de poner huevos
                                    de manera regular y productiva.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo SERVERURL; ?>view/img/yuca.webp" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-success"><b>Agrocosecha</b></h1>
                                <h3 class="h2">Yuca</h3>
                                <p>
                                    Es un alimento basico en muchas regiones tropicales y se utiliza
                                    en diversas preparaciones culinarias.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo SERVERURL; ?>view/img/arroz.webp" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-success"><b>Agrocosecha</b></h1>
                                <h3 class="h2">Arroz</h3>
                                <p>
                                    El arroz es un cereal cultivado en todo el mundo y es uno de los alimentos más
                                    consumidos a nivel global.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="bi bi-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="bi bi-chevron-right"></i>

        </a>
    </div>
    <!-- Fin carrusel -->

    <!-- Nuestros productos -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1"><b>Nuestros productos</b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-3 p-5 mt-3">
                <a href=""><img src="<?php echo SERVERURL; ?>view/img/arrozcirculo.png"
                        class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Arroz</h5>
            </div>
            <div class="col-6 col-md-3 p-5 mt-3">
                <a href=""><img src="<?php echo SERVERURL; ?>/view/img/gallinacircular.jpg"
                        class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Gallina</h2>
            </div>
            <div class="col-6 col-md-3 p-5 mt-3">
                <a href=""><img src="<?php echo SERVERURL; ?>view/img/pesecircular.webp"
                        class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Peces</h2>
            </div>
            <div class="col-6 col-md-3 p-5 mt-3">
                <a href=""><img src="<?php echo SERVERURL; ?>view/img/yucacircular.webp"
                        class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Yuca</h2>
            </div>
        </div>
    </section>
    <!-- Fin de nuestros productos -->

    <!-- Start Footer -->
    <?php include "view/inc/foother_home.php";?>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="<?php echo SERVERURL; ?>view/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo SERVERURL; ?>view/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo SERVERURL; ?>view/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SERVERURL; ?>view/js/templatemo.js"></script>
    <script src="<?php echo SERVERURL; ?>view/js/custom.js"></script>
    <!-- End Script -->

</body>
</html>