
<a href="<?php echo SERVERURL; ?>servicio-list/"><b>Volver</b></a>

<style>
  /* Estilos para la visualización ampliada de la imagen */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.8);
}

.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Estilos para cerrar el modal */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #fff;
    font-size: 30px;
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
    height: auto;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Agrega sombra para resaltar la imagen */
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
    grid-template-columns:repeat(1,1fr);
}

/* Estilos para la imagen en la galería */
.image-item img {
    width: 200px;
    height: auto;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilos para la superposición de botones */
.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Estilos para el botón de eliminar */
.delete-button {
    margin-top:3%;
    background-color: rgba(255, 0, 0, 0.7);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    height:50px;
}

/* Estilos para el botón de eliminar al pasar el ratón */
.delete-button:hover {
    background-color: rgba(255, 0, 0, 1);
}

/* Estilos para mostrar el botón de eliminar al pasar el ratón sobre el ítem */
.image-item:hover .overlay {
    opacity: 1;
}
.boton{
    width: 10%;
    height: 50px;
}


</style>

<?php
    
//!Conectar a la base de datos
include "config\coneccion_tabla.php";
// include "../../controladores/producto/eliminar_imagen.php";

$id_producto = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó un valor válido para 'codigo_imagen'
if ($id_producto !== null) {
    $sqlQuery = "SELECT p.*, f.* FROM tbl_servicio AS p INNER JOIN tbl_imagen AS f
                ON p.codigo_servicio = f.cod_servicio AND p.codigo_servicio = {$id_producto}";

    $result = mysqli_query($conn, $sqlQuery);
    
    // Si hay resultados, mostrar las imágenes
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="image-gallery">';

        while ($data_fotos = mysqli_fetch_array($result)) {
            echo '<div class="image-item">
                    <img style="margin-top:5%;" src="'. SERVERURL . 'view/img/img_servicio/'  . $data_fotos["foto"] . '" alt="" 
                        onclick="ampliarImagen(\''. SERVERURL . 'view/img/img_servicio/'  . $data_fotos["foto"] . '\')">
                    
                        <button class="delete-button" onclick="eliminarImagen(' . $data_fotos["codigo_imagen"] . ')">Eliminar</button>
                </div>';
        }
        echo '</div>';
    } else {
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
