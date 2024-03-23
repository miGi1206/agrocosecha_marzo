<script>
function mostrarContraseña() {
    var x = document.getElementById("contraseña");
    var y = document.getElementById("confirm_password");
    if (x.type === "password" && y.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}
</script>
<?php
include "./model/registrarseModelo.php";
$ins_sexo_usuario = new registrarseModelo();
$sexo = $ins_sexo_usuario->listar_sexo();
?>
<style>
.login-box {
    /* background: linear-gradient(to left, #3AAA3C 50%, #ffffff 50%); */
    padding: 50px;
    margin: 30px auto;
    min-height: 700px;
    box-shadow: 5px 10px 20px rgb(175, 177, 175);
}
</style>
<section class="body1">
    <div class="container">
        <div class="login-box">
            <div class="col-12">
                <img src="<?php echo SERVERURL; ?>view/img/logomaiz1.png" class="img1 img-fluid d-block">
                <div class="logo1" style="color:#3AAA3C !important;" id="textExample">
                    <span style="color:#F8AB14;">Bienv</span>enido
                </div>
            </div>
            <div>
                <div class="col-12" style="margin-top: -3em;">
                    <h3 class="header-title" id="textExample">REGISTRARSE</h3>
                    <form action="<?php echo SERVERURL; ?>ajax/registrarseAjax.php" class="row FormularioAjax" style="margin-top: 2em;" autocomplete="off" method="POST">
                        <div class="row mt-4">
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Identificación <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="11" type="text" id="identificacion"
                                    name="txtDni_ins" require>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Primer nombre <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="text" id="nombre1"
                                    name="txtNombre1_ins" require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Segundo nombre</label>
                                <input class="form-control" maxlength="50" type="text" id="nombre2"
                                    name="txtNombre2_ins" require>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Primer apellido <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="text" id="apellido1"
                                    name="txtApellido1_ins" require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Segundo apellido</label>
                                <input class="form-control" maxlength="50" type="text" id="apellido2"
                                    name="txtApellido2_ins" require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Telefono <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="15" type="text" id="telefono"
                                    name="txtTelefono_ins" require>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Email <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="text" id="correo" name="txtEmail_ins"
                                    require>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Sexo <span style="color:red;">*</span></label>
                                <select class="form-control" id="input-select-sexo" name="txtSexo_ins">
                                    <option></option>
                                    <?php foreach ($sexo as $fila) : ?>
                                    <option value="<?php echo $fila['codigo_sexo']; ?>">
                                        <?php echo $fila['sexo']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Fecha de nacimiento <span
                                        style="color:red;">*</span></label>
                                <input class="form-control" maxlength="30" type="date" name="txtFecha_nacimiento_ins"
                                    require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Direccion <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="text" name="txtDireccion_ins" require>
                            </div>
                        </div>
                        <hr style="margin-top:5%;">
                        <div class="row mt-4">

                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Usuario <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="text" id="usuario"
                                    name="txtUsuario_ins" require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">Contraseña <span style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="password" name="txtContra_ins"
                                    id="contraseña" require>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label class="control-label">confirmar contraseña <span
                                        style="color:red;">*</span></label>
                                <input class="form-control" maxlength="50" type="password" name="txtConfir_contra_ins"
                                    id="confirm_password" require>
                                <span class="error-message" id="error_message"
                                    style="color: red;  font-size: 15px; margin-left: 2% "></span>
                                <span class="exelen" id="exelen"
                                    style="color: #065F2C;  font-size: 15px; margin-left: 2% "></span>
                            </div>

                        </div>
                        <div style="display:grid; justify-content:center;">
                            <div class="mx-2" style="margin-top: 1em;">
                                <input type="checkbox" onclick="mostrarContraseña()"><span class="colorsito"> Ver
                                    Contraseña</span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
    <div class="form-group col-md-4 text-center mt-5">
        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Registrarse</button>
        <a href="<?php echo SERVERURL; ?>home-agro/" class="main-btn success-btn-outline rounded-full btn-hover m-1">Regresar</a>
    </div>
</div>


                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<!-- //! script para mostrar un mensaje de que no puede colocar letras -->
<script>
const identificacion = document.getElementById('identificacion');

let lastValidInputIdentificacion = ''; // Variable para almacenar la última entrada válida

identificacion.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputIdentificacion(textValue)) {
        identificacion.value = lastValidInputIdentificacion; // Restaurar el último valor válido
    } else {
        lastValidInputIdentificacion = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputIdentificacion(text) {
    // Verificar si la cadena solo contiene números y el carácter "-"
    return /^[0-9]*$/.test(text);
}
</script>

<!-- //! Validacion para solo letras y espacios en el campo del primer nombre -->
<script>
const nombre = document.getElementById('nombre1');

let lastValidInputNombre = ''; // Variable para almacenar la última entrada válida

nombre.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputNombre(textValue)) {
        nombre.value =
            lastValidInputNombre; // Restaurar el último valor válido solo si la nueva entrada no es válida
    } else {
        lastValidInputNombre = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputNombre(text) {
    // Verificar si la cadena solo contiene letras y espacios
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/.test(text);
}
</script>

<!-- //! Validacion para solo letras y espacios en el campo del segundo nombre -->
<script>
const nombre2 = document.getElementById('nombre2');

let lastValidInputNombre2 = ''; // Variable para almacenar la última entrada válida

nombre2.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputNombre2(textValue)) {
        nombre2.value =
            lastValidInputNombre2; // Restaurar el último valor válido solo si la nueva entrada no es válida
    } else {
        lastValidInputNombre2 = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputNombre2(text) {
    // Verificar si la cadena solo contiene letras y espacios
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/.test(text);
}
</script>

<!-- //! Validacion para solo letras y espacios en el campo del primer apellido -->
<script>
const apellido = document.getElementById('apellido1');

let lastValidInputApellido = ''; // Variable para almacenar la última entrada válida

apellido.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputApellido(textValue)) {
        apellido.value =
            lastValidInputApellido; // Restaurar el último valor válido solo si la nueva entrada no es válida
    } else {
        lastValidInputApellido = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputApellido(text) {
    // Verificar si la cadena solo contiene letras y espacios
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/.test(text);
}
</script>

<!-- //! Validacion para solo letras y espacios en el campo del segundo apellido -->
<script>
const apellido2 = document.getElementById('apellido2');

let lastValidInputApellido2 = ''; // Variable para almacenar la última entrada válida

apellido2.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputApellido2(textValue)) {
        apellido2.value =
            lastValidInputApellido2; // Restaurar el último valor válido solo si la nueva entrada no es válida
    } else {
        lastValidInputApellido2 = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputApellido2(text) {
    // Verificar si la cadena solo contiene letras y espacios
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/.test(text);
}
</script>

<!-- //! Validacion para solo numeros en el campo del telefono -->
<script>
const telefono = document.getElementById('telefono');

let lastValidInputTelefono = ''; // Variable para almacenar la última entrada válida

telefono.addEventListener('input', (event) => {
    const textValue = event.currentTarget.value;

    if (!isValidInputTelefono(textValue)) {
        telefono.value = lastValidInputTelefono; // Restaurar el último valor válido
    } else {
        lastValidInputTelefono = textValue; // Actualizar la última entrada válida
    }
});

function isValidInputTelefono(text) {
    // Verificar si la cadena solo contiene números
    return /^[0-9]*$/.test(text);
}
</script>

<!-- //! vadidacion para bloquear la tecla espacio en el campo de correo -->
<script>
const correo = document.getElementById('correo');

correo.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault(); // Evitar que se escriba el espacio
    }
});
</script>

<!-- //! vadidacion para bloquear la tecla espacio en el campo de usuario -->
<script>
const usaurio = document.getElementById('usuario');

usuario.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault(); // Evitar que se escriba el espacio
    }
});
</script>

<!-- //! vadidacion para bloquear la tecla espacio en el campo de contraseña -->
<script>
const contraseña = document.getElementById('contraseña');

contraseña.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault(); // Evitar que se escriba el espacio
    }
});
</script>

<!-- //! vadidacion para bloquear la tecla espacio en el campo de confirmar contraseña -->
<script>
const confirm_password = document.getElementById('confirm_password');

confirm_password.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault(); // Evitar que se escriba el espacio
    }
});
</script>

<!-- //! vadidacion para confirma contraseña-->
<script>
function validarContraseña() {
    var password = document.getElementById("contraseña").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var error_message = document.getElementById("error_message");
    var exelen = document.getElementById("exelen");
    if (password === "" || confirm_password === "") {
        error_message.textContent = "";
        exelen.textContent = "";
        return; // Salir de la función si los campos están vacíos
    }
    if (password !== confirm_password) {
        error_message.textContent = "Las contraseñas no coinciden.";
        exelen.textContent = "";
    } else {
        error_message.textContent = ""; // Limpiar el mensaje de error si las contraseñas coinciden
        exelen.textContent = "Las contraseñas coinciden.";
    }
}

// Asignar la función validarContraseña a los eventos oninput de los campos de contraseña
document.getElementById("contraseña").oninput = validarContraseña;
document.getElementById("confirm_password").oninput = validarContraseña;
</script>