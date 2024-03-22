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
require "../config/coneccion_tabla.php";


// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprueba si los datos del formulario están presentes
    if (isset($_POST['enviar_mensaje_masivo'])) {
        // Llama a la función sendEmailContacto() para enviar el correo electrónico
        enviar_mensaje_masivo($_POST, $conn);
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
function enviar_mensaje_masivo($request, $conn)
{
    include "../config/coneccion_tabla.php";
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
        // $mail->addAddress('andresteheran360@gmail.com', 'andres');
        
        // Realizar la consulta SQL para obtener los correos de la tabla tbl_persona
        $query = "SELECT correo FROM tbl_persona";
        $result = mysqli_query($conn, $query);

        // Verificar si la consulta se ejecutó correctamente
        if ($result) {
            // Verificar si se obtuvieron resultados
            if (mysqli_num_rows($result) > 0) {
                // Recorrer los resultados y agregar cada correo al destinatario
                while ($row = mysqli_fetch_assoc($result)) {
                    $mail->addAddress($row['correo']);
                }
            } else {
                // Si no se encontraron correos en la tabla, mostrar un mensaje de error
                echo "No se encontraron correos en la tabla tbl_persona";
            }
        } else {
            // Si hubo un error en la consulta, mostrar un mensaje de error
            echo "Error al ejecutar la consulta: " . mysqli_error($conn);
        }

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
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
            }
            .header {
                background-color: #3AAA3C;
                padding: 15px;
                color: white;
                text-align: center;
                border-radius: 5px 5px 0 0;
            }
            .content {
                padding: 20px;
            }
            .footer {
                background-color: #3AAA3C;
                padding: 10px;
                color: white;
                text-align: center;
                border-radius: 0 0 5px 5px;
            }
            h2 {
                color: #333;
            }
            p {
                color: #555;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
            <h2 style="color:#F8AB14;">AGRO<span style="color:#065F2C;">COSECHA</span></h2>
            </div>
            <div class="content">
                <p><b>Mensaje:</b></p>
                <p>' . nl2br($request['mensaje']) . '</p>
            </div>
            <div class="footer">
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