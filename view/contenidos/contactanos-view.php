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
<!-- Start Content Page -->
<div class="contenedor fuera-navbar">
        <h2>Contactanos</h2>
        <p class="contactanos">Nuestro equipo comercial y técnico está a tu disposición para responder tus dudas,
            opiniones y necesidades o
            para darte una asesoría completa sobre un producto o servicio de tu interés.</p>
    </div>
    <!-- Start Contact -->
    <div class="formulario-contacto">
        <div style="text-align: center;">
            <h3 class="text-success h1 formulario"><b>formulario de contacto</b></h3>
        </div>
        <form action="<?php echo SERVERURL; ?>controller/mensajeControlador.php" method="POST" id="mi_formulario">
            <div class="form-floating mb-3 campo_intermedio" style="margin-top:15px; margin-bottom:0px !important;">
                <input name="nombre1" type="text" class="form-control cuadro_texto1" id="nombre1" placeholder="nombre1"
                    required maxlength="50">
                <label for="nombre1">nombres:</label>
                <div id="result_nombre1" style="color:red; font-size:15px;"></div>
            </div>

            <div class="form-floating mb-3" style="margin-top: 3%;">
                <input name="telefono1" type="text" class="form-control cuadro_texto1" id="telefono1"
                    placeholder="telefono1" required maxlength="15">
                <label for="telefono1">Telefono:</label>
                <div id="result_telefono1" style="color:red; font-size:15px;"></div>
            </div>

            <div class="form-floating mb-3 campo_intermedio" style="margin-top:3%; margin-bottom:0px !important;">
                <input name="correo1" type="email" class="form-control cuadro_texto1" id="correo1"
                    placeholder="Correo1" required maxlength="30">
                <label for="correo1">Correo electronico:</label>
            </div>

            <div class="form-floating mb-3 campo_intermedio" style="margin-top: 3%; margin-bottom:0px !important;">
                <input name="nombre3" type="text" class="form-control cuadro_texto1" id="nombre3" placeholder="nombre3"
                    required maxlength="50">
                <label for="nombre3">Municipio:</label>
            </div>

            <div class="form-floating mb-3 campo_intermedio" style="margin-top:3%; margin-bottom:0px !important;">
                <input name="asunto" type="text" class="form-control cuadro_texto1" id="asunto"
                    placeholder="asunto" required maxlength="60">
                <label for="asunto">Asunto:</label>
            </div>

            <div class="form-floating mb-3 campo_intermedio" style="margin-top:3%; margin-bottom:0px !important;">
                <textarea class="form-control cuadro_texto1" id="mensaje" name="mensaje" style="height: 100px;" required></textarea>
                <label for="mensaje">Mensaje:</label>
                <div id="result_mensaje" style="color:red; font-size:15px;"></div>
            </div>


            <button type="submit" class="submit" onclick="enviarYVaciarFormulario()" name="enviar_mensaje" style="margin-top:3% !important ;">Enviar</button>

        </form>
    </div>

    <!-- JavaScript para manejar las acciones del botón -->
    <script>
    async function enviarYVaciarFormulario() {
        // Agrega la lógica para enviar el formulario aquí
        await enviarFormulario();

        // Espera un breve período antes de vaciar el área
        setTimeout(() => {
            // Restablece los valores y la validación
            document.getElementById('nombre1').value = '';
            document.getElementById('telefono1').value = '';
            document.getElementById('correo1').value = '';
            document.getElementById('nombre3').value = '';
            document.getElementById('asunto').value = '';
            document.getElementById('mensaje').value = '';

            // También puedes restablecer la validación si es necesario
            result_nombre1.innerHTML = '';
            result_telefono1.innerHTML = '';
            result_nombre3.innerHTML = '';
            result_mensaje.innerHTML = '';
        }, 100); // Puedes ajustar el tiempo de espera según tus necesidades
    }

    async function enviarFormulario() {
        // Obtén los datos del formulario
        const formData = new FormData(document.getElementById('mi_formulario'));

        try {
            // Realiza la solicitud POST a la URL deseada
            const response = await fetch('<?php echo SERVERURL; ?>controller/mensajeControlador.php', {
                method: 'POST',
                body: formData
            });

            // Maneja la respuesta si es necesario
            if (response.ok) {
                // Puedes agregar lógica adicional aquí si es necesario
                console.log('Formulario enviado exitosamente');
            } else {
                console.error('Error al enviar el formulario');
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    }
</script>


    <!-- End Contact -->


    <!-- Start Footer -->
    <?php include "view/inc/foother_home.php";?>
    <!-- End Footer -->

    <!-- Start Script -->
    <!-- validacion de nombre -->
    <script>
    const nombre1 = document.getElementById('nombre1');
    const result_nombre1 = document.getElementById('result_nombre1');

    let lastValidInputNombre1 = ''; // Variable para almacenar la última entrada válida

    nombre1.addEventListener('input', (event) => {
        const textValue = event.currentTarget.value;

        if (!isValidInputNombre1(textValue)) {
            nombre1.value =
                lastValidInputNombre1; // Restaurar el último valor válido solo si la nueva entrada no es válida
            return result_nombre1.innerHTML = `El nombre no puede contener números ni caracteres especiales`;
        } else {
            lastValidInputNombre1 = textValue; // Actualizar la última entrada válida
        }
        result_nombre1.innerHTML = '';
    });

    function isValidInputNombre1(text) {
        // Verificar si la cadena solo contiene letras y espacios
        return /^[A-Za-zñÑ\s]*$/.test(text);
    }
    </script>

    <!-- validacion del telefono -->
    <script>
    const telefono1 = document.getElementById('telefono1');
    const result_telefono1 = document.getElementById('result_telefono1');

    let lastValidInputTelefono1 = ''; // Variable para almacenar la última entrada válida

    telefono1.addEventListener('input', (event) => {
        const textValue = event.currentTarget.value;

        if (!isValidInputTelefono1(textValue)) {
            telefono1.value = lastValidInputTelefono1; // Restaurar el último valor válido
            return result_telefono1.innerHTML = `Este campo solo permite números`;
        } else {
            lastValidInputTelefono1 = textValue; // Actualizar la última entrada válida
        }
        result_telefono1.innerHTML = '';
    });
1
    function isValidInputTelefono1(text) {
        // Verificar si la cadena solo contiene números
        return /^[0-9]*$/.test(text);
    }
    </script>
    <!-- validacion de correo -->
    <script>
    const correo1 = document.getElementById('correo1');

    correo1.addEventListener('keydown', (event) => {
        if (event.key === ' ') {
            event.preventDefault(); // Evitar que se escriba el espacio
        }
    });
    </script>
    <!-- alidacion de municipio -->
    <script>
    const nombre3 = document.getElementById('nombre3');
    const result_nombre3 = document.getElementById('result_nombre3');

    let lastValidInputNombre3 = ''; // Variable para almacenar la última entrada válida

    nombre3.addEventListener('input', (event) => {
        const textValue = event.currentTarget.value;

        if (!isValidInputNombre1(textValue)) {
            nombre3.value =
                lastValidInputNombre3; // Restaurar el último valor válido solo si la nueva entrada no es válida
            return result_nombre3.innerHTML = `El nombre no puede contener números ni caracteres especiales`;
        } else {
            lastValidInputNombre3 = textValue; // Actualizar la última entrada válida
        }
        result_nombre3.innerHTML = '';
    });

    function isValidInputNombre1(text) {
        // Verificar si la cadena solo contiene letras y espacios
        return /^[A-Za-zñÑ\s]*$/.test(text);
    }
    </script>

    <script src="view/js/jquery-1.11.0.min.js"></script>
    <script src="view/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="view/js/bootstrap.bundle.min.js"></script>
    <script src="view/js/templatemo.js"></script>
    <script src="view/js/custom.js"></script>
    <!-- End Script -->
</body>
</html>