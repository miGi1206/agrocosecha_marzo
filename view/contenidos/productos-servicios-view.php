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

    <style>
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        /* Define el ancho de los botones */
        height: 35%;
        /* Define la altura de los botones */
        background-color: transparent;
        /* Define el color de fondo transparente */
        border: none;
        /* Elimina el borde */


    }

    @media (max-width: 990px) {

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            /* Define el ancho de los botones */
            height: 100%;
            /* Define la altura de los botones */
            background-color: transparent;
            /* Define el color de fondo transparente */
            border: none;
            /* Elimina el borde */


        }
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: green;
        /* Cambia el color de fondo al pasar el ratón sobre las flechas */
        border-radius: 50%;
        background-size: 50%;
        /* Ajusta el tamaño de la imagen de la flecha */
        margin-top: 150%;
        /* Centra verticalmente la flecha */

    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: green;
        /* Cambia el color de fondo al pasar el ratón sobre las flechas */
        border-radius: 50%;
    }
    </style>

    <?php include "config\coneccion_tabla.php";?>
    <?php
$foto = array(); // Inicializa $foto como un array vacío

if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $foto = "SELECT foto FROM tbl_imagen, tbl_producto 
            WHERE tbl_imagen.cod_producto = tbl_producto.codigo_producto 
            AND tbl_producto.codigo_producto = '$busqueda'";
    $result_foto = mysqli_query($conn, $foto);
}
?>

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

            <div class="container pb-5 bg-light" style="width: 80%;">
                <div class="row">
                    <div id="carouselExample" class="carousel slide col-12 col-md-5 my-5">
                        <div class="carousel-inner">
                            <?php
                            $active = true;
                            while ($row_foto = mysqli_fetch_assoc($result_foto)) {
                                echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                                echo '<img src="view/img/img_productos/' . $row_foto["foto"] . '" class="d-block w-100" alt="Product Image">';
                                echo '</div>';
                                $active = false; // Desactivar la clase 'active' después del primer elemento
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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
                                if (isset($_SESSION['tipo_usuario_spm']) && $_SESSION['tipo_usuario_spm'] == "3" && isset($_SESSION['cod_prod_prov_spm']) && $_SESSION['cod_prod_prov_spm'] == $busqueda) {
                                    $sql_stock = "SELECT * 
                                                    FROM tbl_producto AS p 
                                                    JOIN tbl_prov_prod AS pp ON p.codigo_producto = pp.cod_producto 
                                                    WHERE pp.nit_proveedor = '" . $_SESSION['nit_spm'] . "'";
                                    $result_stock = mysqli_query($conn, $sql_stock);
                                    while($fila = mysqli_fetch_assoc($result_stock)){
                                    echo "<p><b>Stock: ". $row['stock'] . "</b></p>";}
                                }
                                
                                ?>

                                <h6>Descripción</h6>
                                <p><?= $row['descripcion']?></p>

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

                <div class="my-5 col-md-12">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="70%" height="315" src="https://www.youtube.com/embed/Q_Xxrp4oNds"
                            title="Siembra y Producción de Arroz Orgánico - TvAgro por Juan Gonzalo Angel"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                    </div>
                </div>

                <!-- <div class="my-5 col-md-12">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/UxeZeUd0Yb0" frameborder="0"
                        allowfullscreen></iframe>

                    <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/JBOmT-Mnm60?si=rpB4_5W3-uPtVAE1" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div> -->
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

    <!-- //TODO: Agregar al carrito -->
    <script>
    function addProducto(id, token) {
        let url = 'carrito/carrito.php';
        let formData = new FormData();
        formData.append('busqueda', id);
        formData.append('token', token);

        fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
    }
    </script>
</body>

</html>