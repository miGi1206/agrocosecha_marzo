<?php

if ($peticionAjax) {
    require_once "../model/imgservicioModelo.php";
} else {
    require_once "./model/imgservicioModelo.php";
}

class imgservicioControlador extends imgservicioModelo
{
    /*------------- CONTROLADOR AGREGAR IMAGENES servicio -----------------------*/
    public function agregar_servicio_imagen_controlador()
    {
        $codigo = mainModel::limpiar_cadena($_POST['txtcodigo_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['txtNombre_reg']);
        $fotos = $_FILES['txtfotos_reg']; // Obtener información de las imágenes
        
        /* Verificando integridad de los datos */
        if ($fotos == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        $datos_productoIMG_add = [
            "codigo_servicio" => $codigo,
            "imagenes" => $fotos,
            "Nombre" => $nombre,
        ];
    
        $agregar_productoIMG = imgservicioModelo::agregar_servicio_imagenes_modelo($datos_productoIMG_add);
        if ($agregar_productoIMG->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Imagenes guardadas",
                "Texto" => "Las imagenes se han guardado exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido guardar las imagenes.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }

    /*------------- CONTROLADOR ELIMINAR IMAGEN PRODUCTO --------------------*/
    public function eliminar_servicio_imagen_controlador()
    {
        $id = mainModel::limpiar_cadena($_POST['idcodigo_del']);

        $check_producto_imagen = mainModel::ejecutar_consulta_simple("SELECT codigo_imagen FROM tbl_imagen WHERE codigo_imagen='$id'");
        if ($check_producto_imagen->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La imagen que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_producto_imagen = imgservicioModelo::eliminar_servicio_imagenes_modelo($id);

        if ($eliminar_producto_imagen->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado la imagen exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar la imagen",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}
