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
    <?php include "config\coneccion_tabla.php";?>
    <?php include "funciones\carrito.php";?>
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
        <!-- Close Header -->
    </div>

<body>
    <div class="super_container  mt-5 pt-5">
        <div class="container mt-5 pt-5">
            <p><h3>Lista del carrito</h3></p>
            <?php if(!empty($_SESSION['CARRITO'])){?>
                <table class="table table-light table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Descripción</th>
                            <th width="15%">Precio</th>
                            <th width="20%">Cantidad</th>
                            <th width="20%">Total</th>
                            <th width="5%">--</th>
                        </tr>
                        <?php $total=0;?>
                        <?php foreach($_SESSION['CARRITO'] as $indice=>$productoCarrito){?>
                        <tr>
                            <td width="40%"><?php echo $productoCarrito['nombre']?></td>
                            <td width="15%"><?php echo $productoCarrito['precio']?></td>
                            <td width="20%">
                                <form action="" method="POST">
                                    <button class="btn btn-secondary btn-sm" type="submit" name="btnAccion" value="RestarCantidad">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <?php echo $productoCarrito['cantidad']; ?>
                                    <button class="btn btn-secondary btn-sm" type="submit" name="btnAccion" value="SumarCantidad">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <input type="hidden" name="codigo_producto" value="<?php echo $productoCarrito['codigo_producto']; ?>">
                                </form>
                            </td>
                            <td width="20%"><?php echo number_format($productoCarrito['precio']*$productoCarrito['cantidad'],2);?></td>
                            <td width="5%">
                                <form action="" method="POST">
                                    <input type="hidden" name="codigo_producto" value="<?php echo $productoCarrito['codigo_producto'];?>">
                                    <button class="btn btn-danger" 
                                    type="submit"
                                    name="btnAccion"
                                    value="Eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total=$total+($productoCarrito['precio']*$productoCarrito['cantidad']);?>
                        <?php }?>
                        <tr>
                            <td colspan="3" align="right"><h3>Total</h3></td>
                            <td align="right"><h3>$<?php echo number_format($total,2);?></h3></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <form action="" method="POST">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit"
                                    name="btnAccion"
                                    value="proceder">Proceder a pagar >></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

            <?php }else{?>
                <div class="alert alert-success">
                    No hay productos en el carrito
                </div>

            <?php }?>
        </div>
    </div>
    
    <!-- Start Footer -->
    <?php include "view/inc/foother_home.php";?>
    <!-- End Footer -->
    </div>
    
    


</body>

</html>