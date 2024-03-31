
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
                                    <a href="">Detalles</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Lista de detalles
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="card-style mb-30">
                <center>
                    <h6 class="texto"><i class="bi bi-person-check-fill p-1"></i>Detalles</h6>
                </center>
                <p class="text-sm mb-20 mt-3">
                    Visualiza tus registros.
                </p>
                <div class="table-responsive text-center">
                    <?php
                    require_once  "./controller/detalleControlador.php";
                    $ins_detalle = new detalleControlador();
                    echo $ins_detalle->paginador_detalle_controlador($pagina[1], 5, "", $pagina[0], "");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'vista_corp\leer+-.php';?>