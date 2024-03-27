<?php include "config\coneccion_tabla.php";?>
<?php include "funciones\carrito.php";?>

<?php

// Verificar si se ha enviado el formulario de pago
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["btnPagar"])) {
    // Conectar a la base de datos
    include_once "config\conexion_tabla.php";

    // Obtener la información del usuario actual
    $cod_persona = $_SESSION['nombre']['codigo_persona'];

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
    $stmt->bind_param("sdddi", $_POST['direccion'], $subtotal, $total, $iva, $cod_persona);
    if ($stmt->execute()) {
        // Obtener el código de la venta recién insertada
        $codigo_venta = $stmt->insert_id;

        // Insertar los detalles de la venta en la base de datos
        foreach ($_SESSION['CARRITO'] as $productoCarrito) {
            $sql = "INSERT INTO tbl_detalle (num_ticket, precio_unitario, cantidad, subtotal, cod_producto, cod_venta) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisdi", $productoCarrito['precio'], $productoCarrito['cantidad'], $total, $productoCarrito['codigo_producto'], 'sdddi');
            $stmt->execute();
        }

        // Vaciar el carrito después de completar la venta
        unset($_SESSION['CARRITO']);
        $mensaje = "<script>alert('La venta se ha realizado');</script>";
    } else {
        $mensaje = "<script>alert('Algo ha salido mal');</script>";
    }
}
?>


