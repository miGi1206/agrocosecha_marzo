
    <a href="<?php echo SERVERURL; ?>producto-list/"><b>Volver</b></a>

<style>
    /* Estilos para la visualización ampliada de la imagen */
    .modal {
        display: none; /* Ocultar el modal de forma predeterminada */
        position: fixed; /* Posición fija para cubrir toda la ventana */
        z-index: 1000; /* Colocar el modal por encima de todo */
        padding-top: 50px; /* Espacio sobre el modal */
        left: 0;
        top: 0;
        width: 100%; /* Ancho completo */
        height: 100%; /* Altura completa */
        overflow: auto; /* Habilitar el desplazamiento si la imagen es demasiado grande */
        background-color: rgba(0,0,0,0.8); /* Fondo negro con opacidad */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%; /* Ancho del contenido */
        max-width: 700px; /* Ancho máximo del contenido */
    }

    /* Estilos para cerrar el modal */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* Estilos para la imagen en el modal */
    .modal-content img.modal-image {
        width: 100%; /* Ancho completo */
        height: auto; /* Altura automática para mantener la relación de aspecto */
        cursor: pointer !important; /* Cambiar el cursor a una mano */
    }
    img{
        cursor:pointer;
    }
</style>



    <?php
    
    //!Conctarse a la base de datos
    include "config\coneccion_tabla.php";
    // include "../../controladores/producto/eliminar_imagen.php";

    $id_producto = isset($_GET['id']) ? $_GET['id'] : null;

    // Verificar si se proporcionó un valor válido para 'codigo_imagen'
    if ($id_producto !== null) {
        $sqlQuery = "SELECT p.*, f.* FROM tbl_producto AS p INNER JOIN tbl_imagen AS f
                    ON p.codigo_producto = f.cod_producto AND p.codigo_producto = {$id_producto}";

        $result = mysqli_query($conn, $sqlQuery);

        $sqlQuery2 = "SELECT video FROM tbl_producto WHERE codigo_producto = '$id_producto'";

        $result2 = mysqli_query($conn, $sqlQuery2);
        
        if (mysqli_num_rows($result2) > 0) {
            $data_video = mysqli_fetch_assoc($result2);
            if (!empty($data_video['video'])) {
                echo '<h4 style="margin-top:5%;"><center>Video</center></h4>';
                echo '<div style="display:flex; flex-wrap:wrap; margin-top:3%;">';
                echo '<video src="view/img/vid_productos/' . $data_video['video'] . '" controls style="width: 50%; height:auto;"></video>';
                echo '</div>';
            } else {
                echo "<p>No se encontró el video para el código de imagen proporcionado.</p>";
            }
        } else {
            echo "<p>No se encontraron videos para el código de imagen proporcionado.</p>";
        }
        
        // Si hay resultados, mostrar las imágenes
        if (mysqli_num_rows($result) > 0) {
            echo '<h4 style="margin-top:5%;"><center>Imagenes</center></h4>';
            echo '<div style="display:flex; flex-wrap:wrap; margin-top:3%;">';

            while ($data_fotos = mysqli_fetch_array($result)) {     
                echo '<div style="flex-grow:1; flex-basis:200px; padding-top:3%">
                        <img src="'. SERVERURL . 'view/img/img_productos/'  . $data_fotos["foto"] . '" alt="" 
                            style="width:100px; height:auto;" 
                            onclick="ampliarImagen(\''. SERVERURL . 'view/img/img_productos/'  . $data_fotos["foto"] . '\')">
                    </div>';
            }
            

            echo '</div>';
        }else {
            echo "<p>No se encontraron imágenes para el código de imagen proporcionado.</p>";
        }
        
        
        
    } else {
        echo "<p>No se proporcionó un código de imagen válido en la URL.</p>";
    }
    ?>
    </div> 

    <script>
    // Función para mostrar el modal y la imagen ampliada
    function ampliarImagen(src) {
        var modal = document.getElementById('modalImagen'); // Obtener el modal
        var modalImg = document.getElementById("imgAmpliada"); // Obtener la imagen ampliada
        modal.style.display = "block"; // Mostrar el modal
        modalImg.src = src; // Asignar la fuente de la imagen ampliada
    }

    // Función para cerrar el modal
    function cerrarModal() {
        var modal = document.getElementById('modalImagen'); // Obtener el modal
        modal.style.display = "none"; // Ocultar el modal
    }
</script>

<!-- Modal para la imagen ampliada -->
<div id="modalImagen" class="modal" onclick="cerrarModal()">
  <span class="close" title="Cerrar" onclick="cerrarModal()">&times;</span>
  <img class="modal-content" id="imgAmpliada">
</div>
