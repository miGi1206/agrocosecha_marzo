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
                        <h2></h2>
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
                                    <a href="#0">servicio</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Crear servicio
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Crear servicio</div>
                            <form class="" action="<?php echo SERVERURL; ?>ajax/servicioAjax.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">              
                                        <label class="control-label">Codigo: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="11" type="text" id="txtcodigo_reg" name="txtcodigo_reg" required>
                                        <div id="codigo_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre:<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" id="txtNombre_reg" name="txtNombre_reg" required>
                                        <div id="nombre_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Descripción: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="txtdescripcion_reg" name="txtdescripcion_reg">
                                        <div id="descripcion_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Precio:</label>
                                        <input class="form-control" maxlength="50" type="text" id="txtprecio_reg" name="txtprecio_reg">
                                        <div id="precio_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Duración por hora: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="txtduracion_reg"
                                            name="txtduracion_reg" require>
                                            <div id="duracion_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Tipos de servicio:<span style="color:red;">*</span></label>
                                        <select class="form-control" id="input-select-servicio" name="txtservicio_reg">
                                            <option></option>
                                            <?php foreach ($servicio as $fila) : ?>
                                            <option value="<?php echo $fila['codigo_tipo_servicio']; ?>">
                                                <?php echo $fila['tipo_servicio']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Imagenes: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="file" id="txtfotos_reg"
                                            name="txtfotos_reg[]" multiple accept="image/*" required>
                                    </div>
                                </div>
                        </div>      
                                <div class="form-group col-md-4 mx-auto mt-5"> <!-- Se agrega la clase mx-auto para centrar horizontalmente -->
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Guardar datos</button>
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar área</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- validacion para que el codigo solo tenga numeros -->
<script>
   document.getElementById('txtcodigo_reg').addEventListener('input', function(event) {
        var inputValue = event.target.value;
        var numbers = /^[0-9]+$/;
        var errorDiv = document.getElementById('codigo_error');

        if (!inputValue.match(numbers)) {
            errorDiv.textContent = 'El campo debe contener solo números.';
            event.target.value = inputValue.replace(/\D/g, '');
        } else {
            errorDiv.textContent = '';
        }
    });
</script>
<!-- validacion de duracion -->
<script>
    document.getElementById('txtduracion_reg').addEventListener('input', function(event) {
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

<!-- validacion para que el nombre solo tenga lestras -->
<script>
    document.getElementById('txtNombre_reg').addEventListener('input', function(event) {
        var inputValue = event.target.value;
        var lettersAndSpaces = /^[a-zA-Z\s]*$/;
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
    document.getElementById('txtdescripcion_reg').addEventListener('blur', function(event) {
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
    document.getElementById('txtprecio_reg').addEventListener('blur', function(event) {
        var inputValue = event.target.value.trim();
        var errorDiv = document.getElementById('precio_error');
        var pricePattern = /^\d+(\.\d{1,2})?$/;

        if (!pricePattern.test(inputValue) && inputValue !== '') {
            errorDiv.textContent = 'Por favor, introduce un precio válido.';
            event.target.value = '';
        } else {
            errorDiv.textContent = '';
        }
    });
</script>