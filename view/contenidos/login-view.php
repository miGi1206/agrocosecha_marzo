<?php
if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    require_once "./controller/loginControlador.php";
    $ins_login = new loginControlador();
    echo $ins_login->iniciar_sesion_controlador();
}
?>
<script>
    function mostrarContraseña() {
        var x = document.getElementById("contraseña");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<style>
    .login-box {
        background-image: radial-gradient(ellipse farthest-corner at 10px 40px , #fff 47%, rgba(0, 255, 0, 0) 0%, #3AAA3C 35%);
        padding: 50px;
        margin: 30px auto;
        min-height: 700px;
        box-shadow: 5px 10px 20px rgb(175, 177, 175);
    }
</style>
<section class="body1">
    <div class="container">
        <div class="login-box">
            <div class="col-sm-5 mt-3">
                <img src="<?php echo SERVERURL; ?>view/img/logomaiz1.png" class="img1 img-fluid d-block">
                <div class="logo1" style="color:#3AAA3C !important;" id="textExample">
                    <span style="color:#F8AB14;">Bienv</span>enido
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5" style="margin-top: -3em;">
                    <h3 class="header-title" id="textExample">LOGIN</h3>
                    <form action="" class="login-form" style="margin-top: 2em;" autocomplete="off" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control mb-4" maxlength="50" name="usuario_log" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <input type="password" id="contraseña" class="form-control" maxlength="50" name="clave_log" placeholder="Contraseña">
                        </div>
                        <div class="mx-2" style="margin-top: -1em;">
                            <input type="checkbox" onclick="mostrarContraseña()"><span class="colorsito"> Ver Contraseña</span>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo SERVERURL; ?>registrarse/" >¿No tienes cuenta?</a>
                        </div>
                        <div class="form-group mt-5" style="text-align: center;">
                            <button type="submit" class="btn btn-outline-success">Ingresar</button>
                            <a href="<?php echo SERVERURL; ?>home-agro/" class="btn btn-outline-success">Regresar</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-7" style="margin-top: -10em; margin-left:-5%;">
                    <img src="<?php echo SERVERURL; ?>view/img/logomaiz2.png" class="votacion img-fluid d-block">
                </div>
            </div>
        </div>
    </div>
    </div>
</section>