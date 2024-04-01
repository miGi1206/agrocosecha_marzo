<?php

if ($peticionAjax) {
    require_once "../model/productoVIDModelo.php";
} else {
    require_once "./model/productoVIDModelo.php";
}

class productoVIDControlador extends productoVIDModelo
{
    /*------------- CONTROLADOR AGREGAR VIDEO PRODUCTO -----------------------*/
    public function agregar_producto_video_controlador()
    {
        $codigo = mainModel::limpiar_cadena($_POST['txtcodigo2_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['txtNombre2_reg']);
        $video = $_FILES['txtvideo_reg']; // Obtener información de las imágenes
        
        /* Verificando integridad de los datos */
        if ($video == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $check_producto_video = mainModel::ejecutar_consulta_simple("SELECT codigo_producto FROM tbl_producto WHERE codigo_producto='$codigo' AND video != ''");
        if ($check_producto_video->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Ya hay un video en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        $datos_productoVID_add = [
            "codigo_producto" => $codigo,
            "video" => $video,
            "Nombre" => $nombre,
        ];
    
        $agregar_productoVID = productoVIDModelo::agregar_producto_video_modelo($datos_productoVID_add);
        if ($agregar_productoVID->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Video guardado",
                "Texto" => "El video se han guardado exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido guardar el video.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }

    /*------------- CONTROLADOR ELIMINAR VIDEO PRODUCTO --------------------*/
    public function eliminar_producto_video_controlador()
    {
        $id = mainModel::limpiar_cadena($_POST['idcodigo2_del']);

        $check_producto_video = mainModel::ejecutar_consulta_simple("SELECT codigo_producto FROM tbl_producto WHERE codigo_producto='$id'");
        if ($check_producto_video->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El video que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_producto_video = productoVIDModelo::eliminar_producto_video_modelo($id);

        if ($eliminar_producto_video->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el video exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar el video",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}
