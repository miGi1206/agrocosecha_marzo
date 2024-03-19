<?php
include "./model/proveedorModelo.php";
$ins_sexo_usuario = new proveedorModelo();
$productoLista = $ins_sexo_usuario->listar_producto();
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
                                    <a href="#0">Proveedores</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Crear proveedor
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
                                    class="bi bi-person-plus lead p-1"></i>Crear Proveedor</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php"
                                method="POST" data-form="save" autocomplete="off">
                                <div class="row">
                                    <span style="color:red;">Campos obligatorios (*)</span>
                                </div>
                                <div class="row mt-4">
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">NIT <span style="color:red;">*</span></label>
                                    <input class="form-control" maxlength="15" type="text" id="nit" name="txtNit_ins" pattern="[0-9-]{1,15}" required oninput="validateNit(this)">
                                </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre Razon social<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="100" type="text" id="nombre_razonsocial"
                                            name="txtRazonSocial_ins" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Teléfono <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="15" type="text" id="telefono" name="txtTelefono_ins" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Email <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="correo"
                                            name="txtEmail_ins" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Producto-proveedor <span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-tipo-usuario"
                                            name="txtProductoVinculado_ins">
                                            <option></option>
                                            <?php foreach ($productoLista as $filaP) : ?>
                                            <option value="<?php echo $filaP['codigo_producto']; ?>">
                                                <?php echo $filaP['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Persona contacto<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="30" type="text" id="personaContacto"
                                            name="txtPersonaContacto_ins" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Teléfono contacto <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="15" type="text" id="telefonoContacto" name="txtTelefonoContacto_ins" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Email contacto<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="EmailContacto"
                                            name="txtEmailContacto_ins" require>
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
                                            type="reset" style="font-size: 15px;">Vaciar Área</button>
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
function validateNit(input) {
    // Filtra solo números y el carácter especial "-"
    input.value = input.value.replace(/[^0-9-]/g, '');
}
</script>

<!-- //! Validacion para solo letras y espacios en el campo del primer nombre -->
<script>
const nombre = document.getElementById('nombre_razonsocial');

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
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/.test(text);
}
</script>

<!-- validacion persodna de contacto -->
<script>
document.getElementById('personaContacto').addEventListener('input', function () {
    // Filtra solo letras y espacios
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});
</script>

<!-- //! Validacion para solo numeros en el campo del telefono -->
<script>
document.getElementById('telefono').addEventListener('input', function () {
    // Filtra solo números
    this.value = this.value.replace(/[^0-9]/g, '');

    // Limita la longitud a 10 caracteres
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});
</script>
<script>
document.getElementById('telefonoContacto').addEventListener('input', function () {
    // Filtra solo números
    this.value = this.value.replace(/[^0-9]/g, '');

    // Limita la longitud a 10 caracteres
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});
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

<script>
const correocontacto = document.getElementById('EmailContacto');

correocontacto.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault(); // Evitar que se escriba el espacio
    }
});
</script>

<!-- //! vadidacion para bloquear la tecla espacio en el campo de usuario -->
<script>
const usuario = document.getElementById('usuario');

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