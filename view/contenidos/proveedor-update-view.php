<?php
include "./model/proveedorModelo.php";
$ins_sexo_usuario = new proveedorModelo();
$productoVinculado = $ins_sexo_usuario->listar_producto();
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Proveedor</h2>
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
                                    <a href="<?php echo SERVERURL; ?>proveedor-list/">Lista de proveedores</a>
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
                            require_once "./controller/proveedorControlador.php";
                            $ins_proveedor = new proveedorControlador();

                            $datos_proveedor = $ins_proveedor->datos_proveedor_controlador($pagina[1]);

                            if ($datos_proveedor->rowCount() == 1) {
                                $campos = $datos_proveedor->fetch();
                            ?>
                            <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php"
                                method="POST" data-form="update" autocomplete="off">
                                <input type="hidden" name="proveedor_nit_up" value="<?php echo $pagina[1]; ?>">
                                <div class="row">
                                    <span style="color:red;">Campos obligatorios (*)</span>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">NIT</label>
                                        <input class="form-control" maxlength="11" type="text"
                                            name="updateNit" value="<?php echo $campos['nit']; ?>"
                                            pattern="[0-9]{1,11}" readonly require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre Razon Social <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateNombrerazonsocial" id="nombre_razonsocial"
                                            value="<?php echo $campos['nombre_razonsocial']; ?>" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Teléfono<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="15" type="text" name="updateTelefono" id="telefono"
                                            value="<?php echo $campos['telefono']; ?>" pattern="[0-9]{1,15}" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Email <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateCorreo" id="correo"
                                            value="<?php echo $campos['correo']; ?>" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Sexo <span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-producto" name="updateProductoVinculado">
                                            <?php foreach ($productoVinculado as $filaP) : ?>
                                            <?php $selected = ($campos['nombre'] == $filaP['codigo_producto']) ? 'selected' : ''; ?>
                                            <option value="<?php echo $filaP['codigo_producto']; ?>"
                                                <?php echo $selected; ?>>
                                                <?php echo $filaP['nombre']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Persona de contacto</label>
                                        <input class="form-control" maxlength="50" type="text" name="updatePersonaContacto" id="nom_per_contacto"
                                            value="<?php echo $campos['nom_per_contacto']; ?>" >
                                    </div>
                                    
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Teléfon de conctato<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="15" type="text" name="updateTelefonoContacto" id="tel_contacto"
                                            value="<?php echo $campos['tel_contacto']; ?>" pattern="[0-9]{1,15}" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Email <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" name="updateCorreoContacto" id="correo_contacto"
                                            value="<?php echo $campos['correo_contacto']; ?>" require>
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
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/.test(text);
}
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
document.getElementById('tel_contacto').addEventListener('input', function () {
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

<!-- validaicon persona de contacto  -->
<script>
document.getElementById('nom_per_contacto').addEventListener('input', function () {
    // Filtra solo letras y espacios
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});
</script>