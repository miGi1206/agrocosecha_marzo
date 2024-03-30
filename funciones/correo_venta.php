<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor\autoload.php";
require "config\coneccion_tabla.php";

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si el botón de PDF ha sido presionado
    if (isset($_POST['btnPdf'])) {

        $nombreCliente = $_SESSION['primer_nombre_spm'];
        $correoCliente = $_SESSION['correo_spm'];
        // Almacenar los datos de la venta en variables
        $numTicket = $_SESSION['num_ticket'];
        $fechaVenta = $_SESSION['fecha_venta'];
        $direccionEnvio = $_SESSION['direccion'];
        $productosComprados = $_SESSION['productos_comprados'];
        $totalVenta = $_SESSION['total_venta'];

        // Llama a la función enviarCorreoVenta() para enviar el correo electrónico con la información de la compra
        enviarCorreoVenta($numTicket, $fechaVenta, $direccionEnvio, $productosComprados, $totalVenta);
    } else {
        echo "Error: El formulario no ha sido enviado correctamente";
    }
}

// Función para enviar el correo electrónico con la información de la compra
function enviarCorreoVenta($numTicket, $fechaVenta, $direccionEnvio, $productosComprados, $totalVenta)
{
    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'trabajadoragrocosecha'; // Correo electrónico desde el que se enviará el mensaje
        $mail->Password = 'mnmx jnid dmoc wilv'; // Contraseña del correo electrónico
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('trabajadoragrocosecha@gmail.com', 'trabajadoragrocosecha');
        $mail->addAddress($_SESSION['correo_spm'], $nombreCliente); // Agrega la dirección de correo electrónico del cliente

        // Construir el cuerpo del mensaje del correo electrónico
        $mensaje = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalles de la compra</title>
            <style>
                /* Estilos CSS para el correo electrónico */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    color: #333;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    text-align: center; /* Para centrar el contenido */
                }
                h2 {
                    color: #007bff;
                }
                ul {
                    list-style: none;
                    padding: 0;
                }
                ul li {
                    margin-bottom: 10px;
                }
                strong {
                    font-weight: bold;
                }
                p {
                    margin-bottom: 15px;
                }
                .confirmacion {
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                    border-radius: 5px;
                    padding: 10px;
                    margin-top: 20px;
                    text-align: center; /* Para centrar el texto */
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Su compra ha sido validada</h2>
                <p><strong>Número de ticket:</strong> ' . $numTicket . '</p>
                <p><strong>Fecha de venta:</strong> ' . $fechaVenta . '</p>
                <p><strong>Dirección de envío:</strong> ' . $direccionEnvio . '</p>
                <h3>Productos comprados:</h3>
                <ul>';

        foreach ($productosComprados as $producto) {
            $mensaje .= '<li>' . $producto['nombre'] . ' - Cantidad: ' . $producto['cantidad'] .' - Precio: '. $producto['precio'].'</li>';
        }

        $mensaje .= '</ul>
                    <p><strong>Total de la venta(IVA):</strong> $' . $totalVenta . '</p>
                    <div class="confirmacion">
                        <p>Su compra ha sido confirmada. Gracias por su compra.</p>
                    </div>
                </div>
            </body>
            </html>';



        // Configurar el contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = 'Detalles de tu compra en Agrocosecha';
        $mail->Body = $mensaje;

        // Enviar el correo electrónico
        $mail->send();

        // Mostrar un mensaje de éxito
        echo '<script>
                Swal.fire({
                    title: "Mensaje de confirmación enviado",
                    text: "",
                    icon: "info",
                    timer: 8000,
                    timerProgressBar: true,
                    backdrop: false
                }).then(function() {
                    setTimeout(function() {
                        window.location.href = "' . SERVERURL . 'home-agro/";
                    }, 100);
                });
            </script>';
    } catch (Exception $e) {
        // Mostrar un mensaje de error si no se pudo enviar el correo electrónico
        echo '<script>
        alert("No se pudo enviar el correo al cliente. Por favor, inténtelo de nuevo más tarde: ' . $_SESSION['correo_spm'] . '");
        window.history.back(); // Regresar a la página anterior
        </script>';

    }
}
?>
