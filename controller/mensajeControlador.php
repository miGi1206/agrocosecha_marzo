<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mensaje</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";



// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprueba si los datos del formulario están presentes
    if (isset($_POST['enviar_mensaje'])) {
        // Llama a la función sendEmailContacto() para enviar el correo electrónico
        sendEmailContacto($_POST);
    } else {
        echo '<script>
        Swal.fire({
            title: "No pudimos encontrar los datos del formulario",
            text: "",
            icon: "error",
            timer: 4000,
            timerProgressBar: true,
            backdrop: false
        }).then(function() {
            history.back(); // Regresa a la página anterior
        });
    </script>';
    }
} else {
    echo '<script>
                Swal.fire({
                    title: "El formulario no se ha enviado correctamente",
                    text: "",
                    icon: "error",
                    timer: 4000,
                    timerProgressBar: true,
                    backdrop: false
                }).then(function() {
                    history.back(); // Regresa a la página anterior
                });
            </script>';
}

// Función para enviar el correo electrónico
function sendEmailContacto($request)
{
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
        $mail->setFrom($request['correo1'], $request['nombre1']);
        $mail->addAddress('trabajadoragrocosecha@gmail.com', 'Trabajador Agrocosecha');

        // Contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = $request['asunto'];
        $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $request['asunto'] . '</title>
        <style>
            body {
                font-family: Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                background-color: #fff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #3AAA3C;
                padding: 20px;
                text-align: center;
                color: #fff;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            .content {
                padding: 30px;
            }
            p {
                line-height: 1.6;
                color: #333;
            }
            .footer {
                background-color: #3AAA3C;
                padding: 20px;
                text-align: center;
                color: #fff;
            }
            .footer p {
                margin: 0;
                font-size: 14px;
                color: #fff !important
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
            <h1>AGRO<span style="color:#F8AB14;">COSECHA</span></h1>
            </div>
            <div class="content">
                <p><b>Nombre:</b> ' . $request['nombre1'] . '</p>
                <p><b>Teléfono:</b> ' . $request['telefono1'] . '</p>
                <p><b>Municipio:</b> ' . $request['nombre3'] . '</p>
                <p><b>Mensaje:</b></p>
                <p>' . nl2br($request['mensaje']) . '</p>
                <p>Para responder, contactarse con: <a href="mailto:' . $request['correo1'] . '">' . $request['correo1'] . '</a></p>
            </div>
            <div class="footer">
            <p>Contacto: <a href="mailto:trabajadoragrocosecha@gmail.com" style="color: #fff; text-decoration: none;">trabajadoragrocosecha@gmail.com</a> | Teléfono: 314-537-5318</p>
            </div>
        </div>
    </body>
    </html>';

        // Envío del correo electrónico
        $mail->send();
        echo '<script>
                Swal.fire({
                    title: "Mensaje enviado. Pronto te responderemos",
                    text: "",
                    icon: "success",
                    timer: 4000,
                    timerProgressBar: true,
                    backdrop: false
                }).then(function() {
                    history.back(); // Regresa a la página anterior
                });
            </script>';
    } catch (Exception $e) {
        echo '<script>
        Swal.fire({
            title: "No pudimos enviar el mensaje",
            text: "",
            icon: "error",
            timer: 4000,
            timerProgressBar: true,
            backdrop: false
        }).then(function() {
            history.back(); // Regresa a la página anterior
        });
    </script>';
    }
}
?>
</body>
</html>