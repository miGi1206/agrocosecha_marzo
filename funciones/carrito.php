<?php
$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar':
            if(is_numeric($_POST['codigo_producto'])){
                $codigo_producto=($_POST['codigo_producto']);
                $mensaje.= "Ok, codigo correcto".$codigo_producto."</br>";
            }else{
                $mensaje.= "Ups, codigo incorrecto".$codigo_producto;
            }
            if(is_string($_POST['nombre'])){
                $nombre=($_POST['nombre']);
                $mensaje.= "Ok, nombre correcto".$nombre."</br>";
            }else{
                $mensaje.= "Ups, nombre incorrecto".$nombre;
                break;
            }
            if(is_numeric($_POST['precio'])){
                $precio=($_POST['precio']);
                $mensaje.= "Ok, precio correcto".$precio."</br>";
            }else{
                $mensaje.= "Ups, precio incorrecto".$precio;
                break;
            }
            if(is_numeric($_POST['cantidad'])){
                $cantidad=($_POST['cantidad']);
                $mensaje.= "Ok, cantidad correcto".$cantidad."</br>";
            }else{
                $mensaje.= "Ups, cantidad incorrecto".$cantidad;
                break;
            }
            if(!isset($_SESSION['CARRITO'])){

                $productoCarrito=array(
                    'codigo_producto'=>$codigo_producto,
                    'nombre'=>$nombre,
                    'precio'=>$precio,
                    'cantidad'=>$cantidad
                );
                $_SESSION['CARRITO'][0]=$productoCarrito;
            }else{
                $numeroProductos=count($_SESSION['CARRITO']);
                $productoCarrito=array(
                    'codigo_producto'=>$codigo_producto,
                    'nombre'=>$nombre,
                    'precio'=>$precio,
                    'cantidad'=>$cantidad
                );

                //$_SESSION['CARRITO'][$numeroProductos]=$productoCarrito;
                array_push($_SESSION['CARRITO'], $productoCarrito);
            }
            $mensaje= print_r($_SESSION,true);


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
                echo "<script>alert('Elemento eliminado');</script>";
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

            // Insertar la venta en la base de datos
            $sql = "INSERT INTO tbl_venta (fecha_venta, direccion, sub_total, total_venta, iva, cod_persona) VALUES (NOW(), ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdddi", $direccion, $subtotal, $total, $iva, $cod_persona);
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
                    $sql = "INSERT INTO tbl_detalle (num_ticket, precio_unitario, cantidad, subtotal, cod_producto, cod_venta) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("idddii", $num_ticket, $productoCarrito['precio'], $productoCarrito['cantidad'], $subtotal_producto, $cod_producto, $codigo_venta);
                    $stmt->execute();
                }


                // Vaciar el carrito después de completar la venta
                unset($_SESSION['CARRITO']);
                $mensaje = "<script>alert('La venta se ha realizado');</script>";
            } else {
                $mensaje = "<script>alert('Algo ha salido mal');</script>";
            }
        break;
        
    }
}