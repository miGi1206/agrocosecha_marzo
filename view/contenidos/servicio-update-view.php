<?php
include "./model/servicioModelo.php";
$ins_servicio = new servicioModelo();
$servicio = $ins_servicio->listar_servicio();

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
                                    <a href="#">servicio</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>servicio-list/">Lista de servico</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Actualiza servicio
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus p-1"></i>Actualiza la información de los servicio</div>
                            <h6 class="text-center texto mt-2" id="selected-person"></h6>
                            <?php
                            require_once "./controller/servicioControlador.php";
                            $ins_servicio = new servicioControlador();

                            $datos_servicio = $ins_servicio->datos_servicio_controlador($pagina[1]);

                            if ($datos_servicio->rowCount() == 1) {
                                $campos = $datos_servicio->fetch();
                            ?>
                                <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/servicioAjax.php" method="POST" data-form="update" autocomplete="off">
                                    <input type="hidden" name="updateservicios" value="<?php echo $pagina[1]; ?>">
                                    <div class="row mt-4">

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Codigo: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="11" type="text" id="updatecodigo" name="updatecodigo" required value="<?php echo $campos['codigo_servicio']; ?>" disabled>
                                        <div id="codigo_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre:<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" id="updateNombre" name="updateNombre" required value="<?php echo $campos['nombre']; ?>">
                                        <div id="nombre_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Descripción: <span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" id="updatedescripcion" name="updatedescripcion" value="<?php echo $campos['descripcion']; ?>">
                                        <div id="descripcion_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Precio: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="updateprecio" name="updateprecio" value="<?php echo $campos['precio']; ?>">
                                        <div id="precio_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Duración: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="updateduracion"
                                            name="updateduracion" require value="<?php echo $campos['duracion']; ?>" >
                                            <div id="duracion_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Servicio<span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-servicio" name="updateservicio">
                                            <?php foreach ($servicio as $fila) : ?>
                                            <?php $selected = ($campos['tipo_servicio'] == $fila['codigo_tipo_servicio ']) ? 'selected' : ''; ?>
                                            <option value="<?php echo $fila['codigo_tipo_servicio']; ?>"    
                                                <?php echo $selected; ?>>
                                                <?php echo $fila['tipo_servicio']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                            </div>
                                <div class="form-group text-align-end mt-3">
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Actualizar Datos</button>
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
<!-- alidacion de codgio -->
<script>
    var codigoInput = document.getElementById('updatecodigo');
    var codigoError = document.getElementById('codigo_error');
    
   

    // Agregamos un evento click para mostrar el mensaje de error si se intenta hacer clic en el campo
    codigoInput.addEventListener('click', function() {
        if (codigoInput.value.trim().length > 0) {
            codigoError.textContent = 'Este campo no puede ser modificado.';
        }
    });
</script>
<!-- validacion para que el nombre solo tenga lestras -->
<script>
    document.getElementById('updateNombre').addEventListener('input', function(event) {
        var inputValue = event.target.value;
        var lettersAndSpaces = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
        var errorDiv = document.getElementById('nombre_error');

        if (!inputValue.match(lettersAndSpaces)) {
            errorDiv.textContent = 'El campo solo debe contener letras y espacios.';
            event.target.value = inputValue.replace(/[^a-zA-Z\s]/g, '');
        } else {
            errorDiv.textContent = '';
        }
    });
</script>
<!-- validacion para que la descripcion no este vacia -->
<script>
    document.getElementById('updatedescripcion').addEventListener('blur', function(event) {
        var inputValue = event.target.value.trim();
        var errorDiv = document.getElementById('descripcion_error');

        if (inputValue === '') {
            errorDiv.textContent = 'Este campo es obligatorio.';
        } else {
            errorDiv.textContent = '';
        }
    });
</script>
<!-- validacion de precio  -->
<script>
    document.getElementById('updateprecio').addEventListener('blur', function(event) {
        var inputValue = event.target.value.trim();
        var errorDiv = document.getElementById('precio_error');
        var pricePattern = /^\d+(\.\d{1,2})?$/;

        // Verificar si el valor ingresado no coincide con el patrón de precio y no está vacío
        if (!pricePattern.test(inputValue) && inputValue !== '') {
            errorDiv.textContent = 'Por favor, introduce un precio válido.';
            event.target.value = ''; // Limpiar el valor del campo
        } else {
            errorDiv.textContent = ''; // Limpiar el mensaje de error
        }
    });

    // Agregar un evento keypress para prevenir la entrada de espacio
    document.getElementById('updateprecio').addEventListener('keypress', function(event) {
        // Verificar si la tecla presionada es un espacio
        if (event.key === ' ') {
            event.preventDefault(); // Prevenir la acción predeterminada si es un espacio
        }
    });
</script>

<!-- validacion para duracion -->
<script>
    document.getElementById('updateduracion').addEventListener('input', function(event) {
        var inputValue = event.target.value;
        var numbers = /^[0-9]+$/;
        var errorDiv = document.getElementById('duracion_error');

        if (!inputValue.match(numbers)) {
            errorDiv.textContent = 'El campo debe contener solo números.';
            event.target.value = inputValue.replace(/\D/g, '');
        } else {
            errorDiv.textContent = '';
            // Limitar la longitud del valor a 3 caracteres
            event.target.value = inputValue.substring(0, 3);
        }
    });
</script>