
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
                                    <a href="<?php echo SERVERURL;?>home/">Volver al la pantalla principal</a>                                                            
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
                            <div class="clock mt-2">
                                <?php echo date('d/m/Y h:i:s A');?>
                            </div>                     
                            <div class="text-center texto mt-4" style="font-size: 25px;"><i class="bi bi-upc-scan p-2"></i>Inicia tu votación</div>
                                <form class="FormularioAjax1" action="<?php echo SERVERURL; ?>ajax/vigilanteAjax.php" method="POST" data-form="save" autocomplete="off">
                                    <div class="row mt-3 justify-content-md-center">
                                        <div class="form-group col-lg-12 mt-3 m">
                                            <label class="control-label">Ingresa tu número identifiación</label>
                                            <input  id="miInput" class="form-control text-center mt-1" maxlength="10" type="text" name="txtDni_ing" require>   
                                        </div>
                                    </div>                          
                                    <button id="submit-btn" class="btn btn-primary" type="submit" style="display: none;">Enviar</button>
                                </form>
                            <div class="mt-4">
                                <img src="<?php echo SERVERURL;?>view/img/votacion.png" class="img-fluid img1">
                            </div>
                        </div>
                    </div>
                </div>                             
            </div>
        </div> 
    </div>
</section>
<style type="text/css">
    .img1{
        height: 300px;
        width: 400px;
    }
    .m{
        margin: 0 auto;
        text-align: center;
        width: 800px;
    }
    a{
        color: #262d3f;
    }
    .clock {
      font-size: 25px;
      text-align: center;
    }
</style>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var input = document.getElementById('miInput');
        input.focus();
    });
  function submitForm() {
    // Obtener los valores de los campos de entrada
    var identificacion = document.getElementsByName("txtDni_ing")[0].value;

    var formData = new FormData();
    formData.append("txtDni_ing", identificacion);  
 
    if(identificacion.length >= 10) {
      // Obtener el formulario y enviarlo
      var form = document.querySelector(".FormularioAjax1");
      form.submit();
    }
  }
  function updateClock() {
      var clock = document.querySelector('.clock');
      var now = new Date();
      var day = now.getDate();
      var month = now.getMonth() + 1;
      var year = now.getFullYear();
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var seconds = now.getSeconds();
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12;
      day = day < 10 ? '0' + day : day;
      month = month < 10 ? '0' + month : month;
      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      var date = day + '/' + month + '/' + year;
      var time = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
      clock.textContent = date + ' ' + time;
    }

    setInterval(updateClock, 1000);
</script>
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 order-last order-md-first">
        <div class="copyright text-center text-md-start">
          <p class="text-sm">
            <small class="font-weight-bold text-uppercase">&copy; Cuervos anonimos</small>
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="terms d-flex justify-content-center justify-content-md-end">
          
        </div>
      </div>
    </div>
  </div>
</footer>