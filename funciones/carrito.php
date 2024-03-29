<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<?php
$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar':
            if(is_numeric($_POST['codigo_producto'])){
                $codigo_producto=($_POST['codigo_producto']);
            }else{
                $mensaje.= "Ups, codigo incorrecto".$codigo_producto;
            }
            if(is_string($_POST['nombre'])){
                $nombre=($_POST['nombre']);
            }else{
                $mensaje.= "Ups, nombre incorrecto".$nombre;
                break;
            }
            if(is_numeric($_POST['precio'])){
                $precio=($_POST['precio']);
            }else{
                $mensaje.= "Ups, precio incorrecto".$precio;
                break;
            }
            if(is_numeric($_POST['cantidad'])){
                $cantidad=($_POST['cantidad']);
            }else{
                $mensaje.= "Ups, cantidad incorrecto".$cantidad;
                break;
            }

            // Verificar si el producto ya está en el carrito
            $encontrado = false;
            foreach ($_SESSION['CARRITO'] as $indice => $productoCarrito) {
                if ($productoCarrito['codigo_producto'] == $codigo_producto) {
                    // Si el producto está en el carrito, incrementamos la cantidad
                    $_SESSION['CARRITO'][$indice]['cantidad'] += $cantidad;
                    $encontrado = true;
                    break;
                }
            }

            // Si el producto no está en el carrito, lo agregamos
            if (!$encontrado) {
                $productoCarrito = array(
                    'codigo_producto' => $codigo_producto,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
                );
                $_SESSION['CARRITO'][] = $productoCarrito;
            }

            $mensaje= print_r($_SESSION,true);
            break;
            case 'SumarCantidad':
                if(is_numeric($_POST['codigo_producto'])){
                    $codigo_producto=($_POST['codigo_producto']);
                    // Encontrar el producto en el carrito y aumentar la cantidad
                    foreach($_SESSION['CARRITO'] as $indice=>$productoCarrito){
                        if($productoCarrito['codigo_producto']==$codigo_producto){
                            $_SESSION['CARRITO'][$indice]['cantidad']++;
                            break;
                        }
                    }
                }
                break;

            case 'RestarCantidad':
                if(is_numeric($_POST['codigo_producto'])){
                    $codigo_producto=($_POST['codigo_producto']);
                    // Encontrar el producto en el carrito y disminuir la cantidad
                    foreach($_SESSION['CARRITO'] as $indice=>$productoCarrito){
                        if($productoCarrito['codigo_producto']==$codigo_producto){
                            if($_SESSION['CARRITO'][$indice]['cantidad'] > 1){
                                $_SESSION['CARRITO'][$indice]['cantidad']--;
                            }
                            break;
                        }
                    }
                }
                break;


        case 'Eliminar':
            if(is_numeric($_POST['codigo_producto'])){
                $codigoEliminar=($_POST['codigo_producto']);
                foreach($_SESSION['CARRITO'] as $indice=>$productoCarrito){
                    if($productoCarrito['codigo_producto']==$codigoEliminar){
                        unset($_SESSION['CARRITO'][$indice]);
                        // Detener el bucle después de eliminar el producto
                        break;
                    }
                }
                // Restablecer los índices del array después de la eliminación
                $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']);
                // echo '<script>
                // Swal.fire({
                //     title: "Producto eliminado del carrito",
                //     text: "",
                //     icon: "error",
                //     timer: 500,
                //     timerProgressBar: true,
                //     backdrop: false
                // })
                // </script>';
            }
        break;

        case 'proceder':
            // Obtener la información del usuario actual
            $cod_persona = $_SESSION['cod_persona_spm'];
            $direccion = $_SESSION['direccion_spm'];

            // Calcular el subtotal y el total de la venta
            $subtotal = 0;
            foreach ($_SESSION['CARRITO'] as $productoCarrito) {
                $subtotal += $productoCarrito['precio'] * $productoCarrito['cantidad'];
            }
            $iva = $subtotal * 0.12;
            $total = $subtotal + $iva;
            $num_ticket = rand(10000, 99999);
            // Insertar la venta en la base de datos
            $sql = "INSERT INTO tbl_venta (ticket, fecha_venta, direccion, sub_total, total_venta, iva, cod_persona) VALUES (?, NOW(), ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isdddi", $num_ticket, $direccion, $subtotal, $total, $iva, $cod_persona);
            if ($stmt->execute()) {
                // Obtener el código de la venta recién insertada
                $codigo_venta = $stmt->insert_id;

                // Insertar los detalles de la venta en la base de datos
                foreach ($_SESSION['CARRITO'] as $productoCarrito) {
                    $cod_producto = $productoCarrito['codigo_producto'];
                    $num_ticket = rand(10000, 99999);

                    // Calcula el subtotal para este producto
                    $subtotal_producto = $productoCarrito['precio'] * $productoCarrito['cantidad'];

                    // Inserta los datos en la tabla tbl_detalle
                    $sql = "INSERT INTO tbl_detalle (precio_unitario, cantidad, subtotal, cod_producto, cod_venta) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("dddii", $productoCarrito['precio'], $productoCarrito['cantidad'], $subtotal_producto, $cod_producto, $codigo_venta);
                    $stmt->execute();
                }
                unset($_SESSION['CARRITO']);
                echo '<script>
                Swal.fire({
                    title: "La compra ha sido realizada",
                    text: "",
                    icon: "info",
                    timer: 8000,
                    timerProgressBar: true,
                    backdrop: false
                })
                </script>';
            } else {
                $mensaje = "<script>alert('Algo ha salido mal');</script>";
            }
        break;
        
    }
}
?>
