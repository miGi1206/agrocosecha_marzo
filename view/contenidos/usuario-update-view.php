
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>agrocosecha</h2>
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Crear Usuario</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Usuario</label>
                                        <input class="form-control" maxlength="20" type="text" name="txtUsuario_ins" id="bloqueo">
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Contraseña</label>
                                        <input class="form-control" maxlength="100" type="password" name="txtContraseña_ins" id="bloqueo2">
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Identificacion del aprendiz</label>
                                        <input class="form-control" maxlength="11" type="text" name="txtIDAprendiz_ins" id="bloqueo3">
                                    </div>

                                </div>

                                <div class="row">
                                    
                                    <div class="form-group col-md-4 mt-5 justify-content-center" style="width:100%;">
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Guardar Datos</button>
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar Area</button>
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

<!-- //! Validacion bloquear la tecla de espacio -->
<script>
    // Obtén el elemento del campo de usuario por su ID
    var usuarioInput = document.getElementById('bloqueo');

    // Agrega un listener para el evento keypress
    usuarioInput.addEventListener('keypress', function (event) {
        // Verifica si la tecla presionada es la tecla de espacio (código 32)
        if (event.keyCode === 32) {
            // Evita que se ejecute la acción predeterminada (insertar el espacio)
            event.preventDefault();
        }
    });
</script>
<script>
    // Obtén el elemento del campo de contraseña por su ID
    var usuarioInput = document.getElementById('bloqueo2');

    // Agrega un listener para el evento keypress
    usuarioInput.addEventListener('keypress', function (event) {
        // Verifica si la tecla presionada es la tecla de espacio (código 32)
        if (event.keyCode === 32) {
            // Evita que se ejecute la acción predeterminada (insertar el espacio)
            event.preventDefault();
        }
    });
</script>
<script>
    // Obtén el elemento del campo de identificacion del aprendiz por su ID
    var usuarioInput = document.getElementById('bloqueo3');

    // Agrega un listener para el evento keypress
    usuarioInput.addEventListener('keypress', function (event) {
        // Verifica si la tecla presionada es la tecla de espacio (código 32)
        if (event.keyCode === 32) {
            // Evita que se ejecute la acción predeterminada (insertar el espacio)
            event.preventDefault();
        }
    });
</script>

<!-- //! Validacion para solo numeros en el campo de identificacion de aprendiz -->
<script>
    const idAprendiz = document.getElementById('bloqueo3');

// Listener para el evento input
idAprendiz.addEventListener('input', function(event) {
    // Se utiliza event.target.value para obtener el valor actual del input
    const currentValue = event.target.value;
    
    // Permite solo números
    const onlyNums = currentValue.replace(/[^0-9]/g, '');
    
    // Actualiza el valor del input con la versión filtrada que solo contiene números
    event.target.value = onlyNums;
});
</script>