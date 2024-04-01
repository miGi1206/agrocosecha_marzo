<footer id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 border-bottom pb-3 border-light" style="color: #fff;">Agrocosecha</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="bi bi-geo-alt fa-fw"></i>
                            Barriobenjamin sector primero de mayo.
                            calle 6 casa 6 Choco-Colombia
                        </li>
                        <li>
                            <i class="bi bi-telephone fa-fw"></i>
                            314-537-5318
                        </li>
                        <li>
                            <i class="bi bi-envelope fa-fw"></i>
                            agrocoseecha1@gmail.com
                        </li>
                    </ul>
                </div>

                <?php
                $sql_producto_foother = "SELECT nombre FROM tbl_producto";
                $result_producto_foother = mysqli_query($conn,$sql_producto_foother);
                ?>
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light"><b style="color: #fff;">Productos</b></h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php
                        while ($row_producto_foother = mysqli_fetch_assoc($result_producto_foother)){
                            echo "<li>".$row_producto_foother['nombre']."</li>";
                        }
                        ?>
                        
                    </ul>
                </div>

                <?php
                $sql_servicio_foother = "SELECT nombre FROM tbl_servicio";
                $result_servicio_foother = mysqli_query($conn,$sql_servicio_foother);
                ?>
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light"><b style="color: #fff;">Servicios</b></h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php
                        while ($row_servicio_foother = mysqli_fetch_assoc($result_servicio_foother)){
                            echo "<li>".$row_servicio_foother['nombre']."</li>";
                        }
                        ?>
                        
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
    <ul class="list-inline text-left footer-icons">
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/">
                <i class="bi bi-facebook"></i>
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/">
            <i class="bi bi-instagram"></i>
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/">
            <i class="bi bi-twitter"></i>
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/">
            <i class="bi bi-linkedin"></i>
            </a>
        </li>
    </ul>
</div>

            </div>
        </div>

        <div class="w-100 bg-black " >
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2023 Agrocosecha
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>