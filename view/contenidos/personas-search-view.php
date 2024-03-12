<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Busqueda de personas</h2>
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
                                    Buscar Personas
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
                            <?php if (!isset($_SESSION['busqueda_personas']) && empty(($_SESSION['busqueda_personas']))) { ?>
                                <center>
                                    <h6 class="mb-10 texto">¿Qué personas estas buscando?</h6>
                                </center>
                                <form class="FormularioAjax1" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default">
                                    <div class="input-group mt-5">
                                        <input type="hidden" name="modulo" value="personas">
                                        <input class="form-control" type="search" name="Horarios_search" placeholder="Ingresa una Identificacion">
                                        <button class="btn btn-outline-secondary" type="submit" name="accion" value="buscarPersona" id="button-addon2"><i class="bi bi-search lead p-1"></i></button>
                                    </div>
                                </form>
                            <?php
                            } else { ?>
                                <div class="text-center mt-4">
                                    <h4>Resultado de la busqueda de "<strong><?php echo $_SESSION['busqueda_personas']; ?></strong>"</h4>
                                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" class="form-neon FormularioAjax" method="POST" data-form="search" autocomplete="off">
                                        <input type="hidden" name="modulo" value="personas">
                                        <input type="hidden" name="eliminar_busqueda" value="eliminar">
                                        <button type="submit" class="main-btn danger-btn-outline rounded-full btn-hover mb-3 mt-4">Eliminar</button>
                                    </form>
                                </div>
                                <?php
                                require_once  "./controller/personasControlador.php";
                                $ins_personas = new personasControlador();
                                echo $ins_personas->paginador_personas_controlador($pagina[1], 5, "", $pagina[0], $_SESSION['busqueda_personas']);
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>