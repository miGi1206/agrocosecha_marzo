<?php
include "./model/personasModelo.php";
$ins_sexo_usuario = new personasModelo();
$sexo = $ins_sexo_usuario->listar_sexo();
$tipo_usuario = $ins_sexo_usuario->listar_tipo_usuario();
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Agrocosecha</h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="#0">Personas</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Crear Personas
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30 text-center">
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i
                                    class="bi bi-person-plus lead p-1"></i>Crear Personas</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/personasAjax.php"
                                method="POST" data-form="save" autocomplete="off">
                                <div class="row">
                                    <span style="color:red;">Campos obligatorios (*)</span>
                                </div>
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
                                        <input class="form-control" maxlength="50" type="text" id="correo"
                                            name="txtEmail_ins" require>
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
                                        <label class="control-label">Fecha de nacimiento <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="30" type="date"
                                            name="txtFecha_nacimiento_ins" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Direccion <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="txtDireccion_ins"
                                            require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Tipo de usuario <span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-tipo-usuario"
                                            name="txtTipo_usuario_ins">
                                            <option></option>
                                            <?php foreach ($tipo_usuario as $fila2) : ?>
                                            <option value="<?php echo $fila2['codigo_tipo_usuario']; ?>">
                                                <?php echo $fila2['tipo_usuario']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
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
                                        <label class="control-label">confirmar contraseña <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="password"
                                            name="txtConfir_contra_ins" id="confirm_password" require>
                                        <span class="error-message" id="error_message"
                                            style="color: red;  font-size: 15px; margin-left: 2% "></span>
                                        <span class="exelen" id="exelen"
                                            style="color: #065F2C;  font-size: 15px; margin-left: 2% "></span>
                                    </div>
                                    <div class="mx-2" style="margin-top: 1em;">
                                            <input type="checkbox" onclick="mostrarContraseña()"><span
                                                class="colorsito"> Ver Contraseña</span>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 mt-5 justify-content-center" style="width:100%;">
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1"
                                            type="submit" style="font-size: 15px;">Guardar Datos</button>
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1"
                                            type="reset" style="font-size: 15px;">Vaciar Area</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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