<div class="d-flex justify-content-between py-3 px-5">
    <div>
        <a class="btn btn-outline-primary" href="<?php echo SERVERURL; ?>producto-list/"><b>Volver</b></a>
    </div>
    <div class="form-group col-6">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/imgProductoAjax.php" method="POST"
            data-form="save" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <?php
                include "config\coneccion_tabla.php";

                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_producto WHERE codigo_producto = '$id'";
                    $result = mysqli_query($conn, $sql);
                }
                while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-8" style="display:none;">
                    <input class="form-control" value="'. $row['codigo_producto'] .'" type="text" id="txtcodigo_reg" name="txtcodigo_reg" required>
                    <input class="form-control" value="'. $row['nombre'] .'" type="text" id="txtNombre_reg" name="txtNombre_reg" required>
                </div>';
                
                }?>
                <label class="control-label">Agregar imagen <span style="color:red;">*</span></label>
                <div class="col-8">
                    <input class="form-control" type="file" id="txtfotos_reg" name="txtfotos_reg[]" multiple
                        accept="image/*" required>
                </div>
                <div class="col-4" style="margin-top:-5px;">
                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit"
                        style="font-size: 15px;">Guardar imagen</button>
                </div>

            </div>
        </form>
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/vidProductoAjax.php" method="POST"
        data-form="save" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <?php

                if (isset($_GET['id'])){
                    $id2 = $_GET['id'];
                    $sql2 = "SELECT * FROM tbl_producto WHERE codigo_producto = '$id2'";
                    $result2 = mysqli_query($conn, $sql2);
                }
                while ($row2 = mysqli_fetch_assoc($result2)) {
                echo '<div class="col-8" style="display:none;">
                    <input class="form-control" value="'. $row2['codigo_producto'] .'" type="text" id="txtcodigo2_reg" name="txtcodigo2_reg" required>
                    <input class="form-control" value="'. $row2['nombre'] .'" type="text" id="txtNombre2_reg" name="txtNombre2_reg" required>
                </div>';
                
                }?>
                <label class="control-label">Agregar video <span style="color:red;">*</span></label>
                <div class="col-8">
                    <input class="form-control" type="file" id="txtvideo_reg" name="txtvideo_reg" accept="video/*"
                        required>
                </div>
                <div class="col-4" style="margin-top:-5px;">
                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit"
                        style="font-size: 15px;">Guardar video</button>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
    /* Estilos para la visualización ampliada de la imagen */
    .modal {
        display: none;
        /* Ocultar el modal de forma predeterminada */
        position: fixed;
        /* Posición fija para cubrir toda la ventana */
        z-index: 1000;
        /* Colocar el modal por encima de todo */
        padding-top: 50px;
        /* Espacio sobre el modal */
        left: 0;
        top: 0;
        width: 100%;
        /* Ancho completo */
        height: 100%;
        /* Altura completa */
        overflow: auto;
        /* Habilitar el desplazamiento si la imagen es demasiado grande */
        background-color: rgba(0, 0, 0, 0.8);
        /* Fondo negro con opacidad */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        /* Ancho del contenido */
        max-width: 700px;
        /* Ancho máximo del contenido */
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
        width: 100%;
        /* Ancho completo */
        height: auto;
        /* Altura automática para mantener la relación de aspecto */
        cursor: pointer !important;
        /* Cambiar el cursor a una mano */
    }

    img {
        cursor: pointer;
    }

    /* Estilos para la galería de imágenes */
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 20px auto;
    }

    /* Estilos para cada ítem de la galería */
    .image-item {
        position: relative;
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }

    /* Estilos para la imagen en la galería */
    .image-item img {
        width: 200px;
        height: auto;
        cursor: pointer;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para el botón de eliminar */
    .delete-button {
        margin-top: 3%;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        height: 50px;
    }

    /* Estilos para el botón de eliminar al pasar el ratón */
    .delete-button:hover {
        background-color: rgba(255, 0, 0, 1);
    }

    /* Estilos para mostrar el botón de eliminar al pasar el ratón sobre el ítem */
    .image-item:hover .overlay {
        opacity: 1;
    }

    .boton {
        width: 10%;
        height: 50px;
    }
</style>



<?php
    
    //!Conctarse a la base de datos
    
    // include "../../controladores/producto/eliminar_imagen.php";

    $id_producto = isset($_GET['id']) ? $_GET['id'] : null;

    // Verificar si se proporcionó un valor válido para 'codigo_imagen'
    if ($id_producto !== null) {
        $sqlQuery = "SELECT p.*, f.* FROM tbl_producto AS p INNER JOIN tbl_imagen AS f
                    ON p.codigo_producto = f.cod_producto AND p.codigo_producto = {$id_producto}";

        $result = mysqli_query($conn, $sqlQuery);

        $sqlQuery2 = "SELECT * FROM tbl_producto WHERE codigo_producto = '$id_producto'";

        $result2 = mysqli_query($conn, $sqlQuery2);
        
        if (mysqli_num_rows($result2) > 0) {
            $data_video = mysqli_fetch_assoc($result2);
            if (!empty($data_video['video'])) {
                echo '<h4 style="margin-top:5%;"><center>Video</center></h4>';
                echo '<div style="display:flex; flex-wrap:wrap; margin-top:3%;">';
                echo '<video src="view/img/vid_productos/' . $data_video['video'] . '" controls style="width: 50%; height:auto;"></video>';
                echo '<form class="FormularioAjax" action="' . SERVERURL . 'ajax/vidProductoAjax.php" method="post" data-form="delete" autocomplete="off"> 		
                            <input type="hidden" name="idcodigo2_del" value="' . $data_video['codigo_producto'] . '">
                            <button type="submit" class="btn danger-btn">
                                Eliminar
                            </button>
                        </form>';
                echo '</div>';
            } else {
                echo "<p>No se encontró el video del producto.</p><br>";
            }
        } else {
            echo "<p>No se encontró el video del producto.</p>";
        }
        
        // Si hay resultados, mostrar las imágenes
        if (mysqli_num_rows($result) > 0) {
            echo '<h4 style="margin-top:5%;"><center>Imagenes</center></h4>';
            echo '<div class="image-gallery">';

            while ($data_fotos = mysqli_fetch_array($result)) {     
                echo '<div class="image-item"">
                        <img src="'. SERVERURL . 'view/img/img_productos/'  . $data_fotos["foto"] . '" alt="" 
                            style="width:100px; height:auto;" 
                            onclick="ampliarImagen(\''. SERVERURL . 'view/img/img_productos/'  . $data_fotos["foto"] . '\')">

                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/imgProductoAjax.php" method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="idcodigo_del" value="' . $data_fotos['codigo_imagen'] . '">
                                <button type="submit" class="btn danger-btn">
                                    Eliminar
                                </button>
                            </form>
                    </div>';
            }
            
            echo '</div>';
        }else {
            echo "<p>No se encontraron imágenes del producto.</p>";
        }
        
        
        
    } else {
        echo "<p>No se encontraron imágenes del producto.</p>";
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

<script>
document.querySelector('#txtvideo_reg').addEventListener('change', function() {
    var files = this.files;
    if (files.length > 1) {
        Swal.fire({
            title: 'Solo puedes seleccionar un archivo de video.',
            icon: 'error'
        });
        this.value = ''; // Limpia el campo de entrada para eliminar el archivo seleccionado
    }
});
</script>