<nav class="container pb-5 bg-light" id="container_nav">

    <h5 class="h4 text-success" style="color:#28a745;" id="h5">Productos</h5>

    <ul id="container_ul">
        <form action="" method="GET">
        <?php
        //TODO: Consulta SQL para traer todos los datos de los administradores
        $sql_producto = "SELECT * FROM `tbl_producto`";
        $result_producto = mysqli_query($conn,$sql_producto);

        //* Ciclo para mostrar los registros
        while ($row = mysqli_fetch_assoc($result_producto)){ 
        ?>
        <form action="" method="GET">
            <div class="form-floating mb-3" style="margin-top:15px; margin-bottom:0px !important;" class="logo_nav A">
                <button style="width:100%; height:50px !important; margin-top:0px !important; border-radius:100px;" class="A"
                    type="submit" name="busqueda" value="<?= $row['codigo_producto']?>"><?= $row['nombre']?></button>
            </div>
        </form>
        <?php    
        }
        ?>
            
        </form>
    </ul>

    <h5 class="h4 text-success" style="color:#28a745;" id="h5">Alquiler</h5>

    <ul id="container_ul">
        <form action="" method="GET">
        <?php
        //TODO: Consulta SQL para traer todos los datos de los administradores
        $sql_alquiler = "SELECT * FROM `tbl_servicio`,`tbl_tipo_servicio` WHERE tbl_servicio.cod_tipo_servicio = tbl_tipo_servicio.codigo_tipo_servicio
        AND tbl_tipo_servicio.tipo_servicio='alquiler de equipos'";
        $result_alquiler = mysqli_query($conn,$sql_alquiler);

        //* Ciclo para mostrar los registros
        while ($row = mysqli_fetch_assoc($result_alquiler)){ 
        ?>
        <form action="" method="GET">
            <div class="form-floating mb-3" style="margin-top:15px; margin-bottom:0px !important;" class="logo_nav A">
                <button style="width:100%; height:50px !important; margin-top:0px !important; border-radius:100px;" class="A"
                    type="submit" name="busqueda2" value="<?= $row['codigo_servicio']?>"><?= $row['nombre']?></button>
            </div>
        </form>
        <?php    
        }
        ?>
            
        </form>
    </ul>

    <h5 class="h4 text-success" style="color:#28a745;" id="h5">Servicios</h5>

    <ul id="container_ul">
        <form action="" method="GET">
        <?php
        //TODO: Consulta SQL para traer todos los datos de los administradores
        $sql_personal = "SELECT * FROM `tbl_servicio`,`tbl_tipo_servicio` WHERE tbl_servicio.cod_tipo_servicio = tbl_tipo_servicio.codigo_tipo_servicio
        AND tbl_tipo_servicio.tipo_servicio='servicios personales'";
        $result_personal = mysqli_query($conn,$sql_personal);

        //* Ciclo para mostrar los registros
        while ($row = mysqli_fetch_assoc($result_personal)){ 
        ?>
        <form action="" method="GET">
            <div class="form-floating mb-3" style="margin-top:15px; margin-bottom:0px !important;" class="logo_nav A">
                <!-- <input name="busqueda" type="button" class="form-control cuadro_texto1" id="nombre" placeholder="Nombre" value="<?= $row['nombre']?>" requered readonly> -->
                <button style="width:100%; height:50px !important; margin-top:0px !important; border-radius:100px;" class="A"
                    type="submit" name="busqueda3" value="<?= $row['codigo_servicio']?>"><?= $row['nombre']?></button>
            </div>
        </form>
        <?php    
        }
        ?>
            
        </form>
    </ul>

</nav>