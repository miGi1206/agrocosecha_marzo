<?php

require_once "mainModel.php";

class productoVIDModelo extends mainModel
{
    /*------------- MODELO AGREGAR IMAGENES PRODUCTO -----------------------*/
    protected static function agregar_producto_video_modelo($datos)
    {
        // Subir las imágenes y guardar sus nombres en la base de datos
        $dir_local_vid = "../view/img/vid_productos";

        if (!file_exists($dir_local_vid)) {
            mkdir($dir_local_img, 0777, true);
        }

        if ($_FILES['txtvideo_reg']['size'] > 0) {
            $video_name = $_FILES['txtvideo_reg']['name'];
            $source_video = $_FILES['txtvideo_reg']['tmp_name'];
            $tamaño_video = $_FILES['txtvideo_reg']['size'];
        
            $nuevo_nombre_video = md5(uniqid(rand()));
            $extension_video = pathinfo($video_name, PATHINFO_EXTENSION);
            $nombre_video = md5(uniqid(rand())) . '_' . $datos['Nombre'] . '.' . $extension_video;
        
            $result_video = $dir_local_vid . '/' . $nombre_video;
        
            move_uploaded_file($source_video, $result_video);
        
            $insert_video_sql = "UPDATE tbl_producto SET video=:video WHERE codigo_producto=:cod_producto";
            $sql_video = mainModel::conectar()->prepare($insert_video_sql);
            $sql_video->bindParam(":video", $nombre_video);
            $sql_video->bindParam(":cod_producto", $datos['codigo_producto']); // Aquí corregimos la variable $sql a $sql_video
            $sql_video->execute();
        }
        return $sql_video;
    }
    
    /*------------- MODELO ELIMINAR PRODUCTO -----------------------*/
    protected static function eliminar_producto_video_modelo($id)
    {
        
        $sql_select_video = mainModel::conectar()->prepare("SELECT video FROM tbl_producto WHERE codigo_producto=:ID");
        $sql_select_video->bindParam(":ID", $id);
        $sql_select_video->execute();
        $video = $sql_select_video->fetchAll(PDO::FETCH_ASSOC);

        // Iterar sobre cada imagen y eliminarla de la carpeta
        foreach ($video as $vid) {
            $ruta_video = "../view/img/vid_productos/{$vid['video']}";
            if (file_exists($ruta_video)) {
                unlink($ruta_video);
            }
        }

        $sql = mainModel::conectar()->prepare("UPDATE tbl_producto SET video= NULL WHERE codigo_producto=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        
        return $sql;
    }
}