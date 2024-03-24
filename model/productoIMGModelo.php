<?php

require_once "mainModel.php";

class productoIMGModelo extends mainModel
{
    /*------------- MODELO AGREGAR IMAGENES PRODUCTO -----------------------*/
    protected static function agregar_producto_imagenes_modelo($datos)
    {
        // Subir las imágenes y guardar sus nombres en la base de datos
        $dir_local_img = "../view/img/img_productos";

        if (!file_exists($dir_local_img)) {
            mkdir($dir_local_img, 0777, true);
        }

        foreach ($_FILES['txtfotos_reg']['name'] as $i => $name) {
            if (strlen($_FILES['txtfotos_reg']['name'][$i]) > 1) {
                $file_name = $_FILES['txtfotos_reg']['name'][$i];
                $sourse_foto = $_FILES['txtfotos_reg']['tmp_name'][$i];
                $tamaño_foto = $_FILES['txtfotos_reg']['size'][$i];

                $nuevo_nombre_file = md5(uniqid(rand()));
                $extension_foto = pathinfo($file_name, PATHINFO_EXTENSION);
                $nombre_foto = md5(uniqid(rand())) . '_' . $datos['Nombre'] . '.' . $extension_foto;

                $result_foto = $dir_local_img . '/' . $nombre_foto;

                move_uploaded_file($sourse_foto, $result_foto);

                $insert_image_sql = "INSERT INTO tbl_imagen (foto, cod_producto) VALUES (:foto, :codigo_producto)";
                $sql_imagen = mainModel::conectar()->prepare($insert_image_sql);
                $sql_imagen->bindParam(":foto", $nombre_foto);
                $sql_imagen->bindParam(":codigo_producto", $datos['codigo_producto']);
                $sql_imagen->execute();
                
            }
        }

        return $sql_imagen;
    }
    
    /*------------- MODELO ELIMINAR PRODUCTO -----------------------*/
    protected static function eliminar_producto_imagenes_modelo($id)
    {
        
        $sql_select_imagenes = mainModel::conectar()->prepare("SELECT foto FROM tbl_imagen WHERE codigo_imagen=:ID");
        $sql_select_imagenes->bindParam(":ID", $id);
        $sql_select_imagenes->execute();
        $imagenes = $sql_select_imagenes->fetchAll(PDO::FETCH_ASSOC);

        // Iterar sobre cada imagen y eliminarla de la carpeta
        foreach ($imagenes as $imagen) {
            $ruta_imagen = "../view/img/img_productos/{$imagen['foto']}";
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }

        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_imagen WHERE codigo_imagen=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        
        return $sql;
    }
}