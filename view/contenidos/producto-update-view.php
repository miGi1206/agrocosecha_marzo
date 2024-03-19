
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
                                    <a href="#">productos</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>producto-list/">Lista de productos</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Actualiza productos
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus p-1"></i>Actualiza la información de tus productos</div>
                            <h6 class="text-center texto mt-2" id="selected-person"></h6>
                            <?php
                            require_once "./controller/productoControlador.php";
                            $ins_producto = new productoControlador();

                            $datos_producto = $ins_producto->datos_producto_controlador($pagina[1]);

                            if ($datos_producto->rowCount() == 1) {
                                $campos = $datos_producto->fetch();
                            ?>
                                <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off">
                                    <input type="hidden" name="updateproducto" value="<?php echo $pagina[1]; ?>">
                                    <div class="row mt-4">

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre:<span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="11" type="text" id="updateNombre"
                                            name="updateNombre"  required  value="<?php echo $campos['nombre']; ?>" >
                                            <div id="nombre_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">descripción: <span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" id="updatedescripcion"
                                            name="updatedescripcion" required  value="<?php echo $campos['descripcion']; ?>">
                                            <div id="descripcion_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">precio: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="updateprecio"
                                            name="updateprecio" required  value="<?php echo $campos['precio']; ?>">
                                            <div id="precio_error" style="color: red;"></div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Stock: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="updatetstock"
                                            name="updatetstock" required  value="<?php echo $campos['stock']; ?>">
                                            <div id="stock_error" style="color: red;"></div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">video: <span style="color:red;">*</span></label>
                                        <input class="form-control" maxlength="50" type="text" id="updatetvideo"
                                            name="updatetvideo"  value="<?php echo $campos['video']; ?>" required>
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
<!-- validacion para que el nombre solo tenga lestras -->
<script>
    document.getElementById('updateNombre').addEventListener('input', function(event) {
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

        if (!pricePattern.test(inputValue) && inputValue !== '') {
            errorDiv.textContent = 'Por favor, introduce un precio válido.';
            event.target.value = '';
        } else {
            errorDiv.textContent = '';
        }
    });
</script>
<!-- validacion para que el stock solo tenga numeros -->
<script>
   document.getElementById('updatetstock').addEventListener('input', function(event) {
        var inputValue = event.target.value;
        var numbers = /^[0-9]+$/;
        var errorDiv = document.getElementById('stock_error');

        if (!inputValue.match(numbers)) {
            errorDiv.textContent = 'El campo debe contener solo números.';
            event.target.value = inputValue.replace(/\D/g, '');
        } else {
            errorDiv.textContent = '';
        }
    });
</script>