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
        
        // Realizar la consulta SQL para obtener los correos de la tabla tbl_persona
        $query = "SELECT primer_nombre, correo, cod_tipo_usuario FROM tbl_persona join tbl_usuario on tbl_persona.codigo_persona = tbl_usuario.cod_persona 
        where cod_tipo_usuario='2'";
        $result = mysqli_query($conn, $query);

        // Verificar si la consulta se ejecutó correctamente
        if ($result) {
            // Verificar si se obtuvieron resultados
            if (mysqli_num_rows($result) > 0) {
                // Recorrer los resultados y agregar cada correo al destinatario
                while ($row = mysqli_fetch_assoc($result)) {
                    $nombre = $row['primer_nombre'];
                    try {
                        $mail->addAddress($row['correo'], $nombre);
                        // Contenido del correo electrónico
                        $mensaje = '
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
                                    <p>Hola, <strong>'.$nombre.' </strong></p>
                                    <p><strong>Mensaje:</strong></p>
                                    <p>' . nl2br($request['mensaje']) . '</p>
                                </div>
                                <div class="footer">
                                <p>Contacto: <a href="mailto:trabajadoragrocosecha@gmail.com" style="color: #fff; text-decoration: none;">trabajadoragrocosecha@gmail.com</a> | Teléfono: 123-456-7890</p>
                                </div>
                            </div>
                        </body>
                        </html>
                        ';
                        $mail->isHTML(true);
                        $mail->Subject = $request['asunto'];
                        $mail->Body = $mensaje;
                        // Envío del correo electrónico
                        $mail->send();
                    } catch (Exception $e) {
                        // Captura la excepción si no se puede enviar el correo a un destinatario específico
                        continue; // Continúa con el siguiente destinatario
                    }
                }
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
            } else {
                // Si no se encontraron correos en la tabla, mostrar un mensaje de error
                echo "No se encontraron correos en la tabla tbl_persona";
            }
        } else {
            // Si hubo un error en la consulta, mostrar un mensaje de error
            echo "Error al ejecutar la consulta: " . mysqli_error($conn);
        }
    } catch (Exception $e) {
        echo '<script>
        Swal.fire({
            title: "No pudimos enviar el mensaje",
            text: "",
            icon: "error",
            timer: 4000,
            timerProgressBar: true,
            backdrop: false
        }).then(function(){
            history.back(); // Regresa a la página anterior
        });
    </script>';
    }
}
?>
</body>
</html>