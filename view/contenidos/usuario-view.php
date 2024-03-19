<?php
include "./model/usuarioModelo.php";
$ins_personas = new usuarioModelo();
$personas = $ins_personas->listar_persona();
$tipo_usuario = $ins_personas->listar_tipo_usuario();
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
                                    <a href="<?php echo SERVERURL; ?>home/">Principal</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#0">Usuario</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Crear Usuario
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
                                    class="bi bi-person-plus lead p-1"></i>Crear Usuario</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php"
                                method="POST" data-form="save" autocomplete="off">
                                <div class="row mt-4">
                                    
                                <div class="form-group col-md-4 mt-3">
                                    <label for="input-persona-sexo"  class="control-label">Identificacion de la persona<span style="color:red;">*</span></label>
                                    <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                    <select class="form-control selectpicker" data-live-search="true"  name="txtIDpersona_ins" id="input-persona-sexo" required >
                                        <option value="">Seleccione una persona</option>
                                        <?php
                                        
                                        // Llenar las opciones del menú desplegable con los proveedores obtenidos
                                        foreach ($personas as $rowPersona ) {
                                            // Mostrar tanto el nombre como el apellido del proveedor en la opción del menú desplegable
                                            echo '<option value="' . $rowPersona['codigo_persona'] . '">' . $rowPersona['identificacion'] . ' - '. $rowPersona['primer_nombre'] . ' ' . $rowPersona['primer_apellido'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>  

                                    <!-- <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">identificacion de la persona<span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-sexo" name="txtIDpersona_ins">
                                            <option></option>
                                            <?php foreach ($personas as $fila) : ?>
                                            <option value="<?php echo $fila['codigo_persona']; ?>">
                                                <?php echo $fila['identificacion'] . " - " . $fila['primer_nombre'] ." ".$fila['primer_apellido']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> -->
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Tipo de usuario<span style="color:red;">*</span></label>
                                        <select class="form-control" id="tipo_usuario" name="txtTipo_usuario_ins">
                                            <option></option>
                                            <?php foreach ($tipo_usuario as $fila2) : ?>
                                            <option value="<?php echo $fila2['codigo_tipo_usuario']; ?>">
                                                <?php echo $fila2['tipo_usuario'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
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