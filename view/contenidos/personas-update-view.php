<?php
include "./model/personasModelo.php";
$ins_sexo_usuario = new personasModelo();
$sexo = $ins_sexo_usuario->listar_sexo();
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Control de ingreso y salida</h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Personas</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>personas-list/">Lista de personas</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Actualizar informacion
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
                                    class="bi bi-person-plus p-1"></i>Actualiza tu información</div>
                            <h6 class="text-center texto mt-2" id="selected-person"></h6>
                            <?php
                            require_once "./controller/personasControlador.php";
                            $ins_personas = new personasControlador();

                            $datos_personas = $ins_personas->datos_personas_controlador($pagina[1]);

                            if ($datos_personas->rowCount() == 1) {
                                $campos = $datos_personas->fetch();
                            ?>
                            <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/personasAjax.php"
                                method="POST" data-form="update" autocomplete="off">
                                <input type="hidden" name="personas_id_up" value="<?php echo $pagina[1]; ?>">
                                <div class="row">
                                    <span style="color:red;">Campos obligatorios (*)</span>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Identificación</label>
                                        <input class="form-control" maxlength="11" type="text"
                                            name="updateIdentificacion" value="<?php echo $campos['identificacion']; ?>"
                                            pattern="[0-9]{1,11}" readonly require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Primer nombre <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateNombre1" id="nombre1"
                                            value="<?php echo $campos['primer_nombre']; ?>" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Segundo nombre</label>
                                        <input class="form-control" maxlength="50" type="text" name="updateNombre2" id="nombre2"
                                            value="<?php echo $campos['segundo_nombre']; ?>" >
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Primer pellido <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateApellido1" id="apellido1"
                                            value="<?php echo $campos['primer_apellido']; ?>" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Segundo pellido</label>
                                        <input class="form-control" maxlength="50" type="text" name="updateApellido2" id="apellido2"
                                            value="<?php echo $campos['segundo_apellido']; ?>" >
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Número de celular <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="15" type="text" name="updateTelefono" id="telefono"
                                            value="<?php echo $campos['telefono']; ?>" pattern="[0-9]{1,15}" require>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Email <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateEmail" id="correo"
                                            value="<?php echo $campos['correo']; ?>" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Sexo <span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-sexo" name="updateSexo">
                                            <?php foreach ($sexo as $fila) : ?>
                                            <?php $selected = ($campos['sexo'] == $fila['codigo_sexo']) ? 'selected' : ''; ?>
                                            <option value="<?php echo $fila['codigo_sexo']; ?>"
                                                <?php echo $selected; ?>>
                                                <?php echo $fila['sexo']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Fecha de nacimiento <span style="color:red;">*</span></label>
                                        <input class="form-control" type="date" name="updateFecha_nacimiento"
                                            value="<?php echo $campos['fecha_nacimiento']; ?>" require>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Dirección <span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="updateDireccion" maxlength="50"
                                            value="<?php echo $campos['direccion']; ?>" require>
                                    </div>
                                </div>

                                <div class="form-group text-align-end mt-3">
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1"
                                        type="submit" style="font-size: 15px;">Actualizar Datos</button>
                                </div>
                        </div>
                        </form>
                        <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h4 class="alert-heading">Ocurrio un error</h4>
                            <p class="mb-0">Lo sentimos, no podemos mostrar la informacion solicitada</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

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