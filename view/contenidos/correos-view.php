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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Enviar mensaje a clientes</div>
                            <form action="<?php echo SERVERURL; ?>controller/correoControlador.php" method="POST" id="mi_formulario">
                                

                                <div class="form-floating mb-3 campo_intermedio" style="margin-top:3%; margin-bottom:0px !important;">
                                    <input name="asunto" type="text" class="form-control cuadro_texto1" id="asunto"
                                        placeholder="asunto" required maxlength="60">
                                    <label for="asunto">Asunto:</label>
                                </div>

                                <div class="form-floating mb-3 campo_intermedio" style="margin-top:3%; margin-bottom:0px !important;">
                                    <textarea class="form-control cuadro_texto1" id="mensaje" name="mensaje" style="height: 100px;" required></textarea>
                                    <label for="mensaje">Mensaje:</label>
                                    <div id="result_mensaje" style="color:red; font-size:15px;"></div>
                                </div>


                                <button type="submit" class="submit" name="enviar_mensaje_masivo" style="margin-top:3% !important ;">Enviar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
