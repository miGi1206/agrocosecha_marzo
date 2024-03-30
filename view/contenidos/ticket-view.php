<!DOCTYPE html>
<html lang="en">

<head>
    <title>Agrocosecha</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SERVERURL; ?>view/img/Size-16.png">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/templatemo.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/contactanos.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../vista_corp/assets/css/fontawesome.min.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "config\coneccion_tabla.php";?>
    <?php include_once "funciones\carrito.php";?>
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
            background-color: white;
        }

        .fuera-navbar {
            margin-top: 6%;
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
        <?php include "funciones\correo_venta.php";?>
        <!-- Close Header -->
    </div>
    <body>
    <div class="super_container mt-5 pt-5">
        <div class="container mt-5 pt-5">
            <h3>Venta</h3>
            <!-- Mostrar los datos de la venta en una tabla -->
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Número de ticket:</strong></td>
                        <td><?php echo $_SESSION['num_ticket']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fecha de venta:</strong></td>
                        <td><?php echo $_SESSION['fecha_venta']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Dirección de envío:</strong></td>
                        <td><?php echo $_SESSION['direccion']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Productos comprados:</strong></td>
                        <td>
                            <?php foreach ($_SESSION['productos_comprados'] as $producto) : ?>
                                <p><?php echo $producto['nombre']; ?> - Cantidad: <?php echo $producto['cantidad']; ?> - Precio: <?php echo $producto['precio']; ?></p>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Total de la venta:</strong></td>
                        <td>$<?php echo $_SESSION['total_venta']; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Botón para descargar el PDF -->
            <!-- <a href="generar_pdf.php" class="btn btn-primary">Descargar PDF</a> -->
            <form action="" method="post">
                <button class="btn btn-success" 
                    type="submit"
                    name="btnPdf">Validar compra
                </button>
            </form>
        </div>
    </div>
    
    <!-- Pie de página -->
    <?php include "view/inc/foother_home.php";?>
</body>

</html>