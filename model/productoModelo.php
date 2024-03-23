<?php

require_once "mainModel.php";

class productoModelo extends mainModel
{

    /*------------- MODELO AGREGAR PRODUCTO -----------------------*/
    protected static function agregar_producto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_producto(codigo_producto,nombre,descripcion,precio,stock,fecha_registro)       
                VALUES(:codigo_producto,:Nombre,:descripcion,:precio,:stock, NOW())"); 
        $sql->bindParam(":codigo_producto", $datos['codigo_producto']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":stock", $datos['stock']);
        $sql->execute();


        // Subir las imágenes y guardar sus nombres en la base de datos
        $dir_local_img = "../view/img/img_productos";
        $dir_local_vid = "../view/img/vid_productos";

        if (!file_exists($dir_local_img)) {
            mkdir($dir_local_img, 0777, true);
        }

        if (!file_exists($dir_local_vid)) {
            mkdir($dir_local_vid, 0777, true);
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

        return $sql;
    }

    /*------------- MODELO ELIMINAR PRODUCTO -----------------------*/
    protected static function eliminar_producto_modelo($id)
    {
        
        $sql_select_imagenes = mainModel::conectar()->prepare("SELECT foto FROM tbl_imagen WHERE cod_producto=:ID");
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

        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_producto WHERE codigo_producto=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        
        return $sql;
    }

    /*------------- MODELO ACTUALIZAR PRODUCTO -----------------------*/
    protected static function datos_producto_modelo($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_producto WHERE codigo_producto =:id");

        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_producto_modelo($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_producto SET
            nombre=:Nombre, descripcion=:descripcion, precio=:precio,stock=:stock,
            video=:video WHERE codigo_producto=:id");

        $sql->bindParam(":Nombre", $datos2['Nombre']);
        $sql->bindParam(":descripcion", $datos2['descripcion']);
        $sql->bindParam(":precio", $datos2['precio']);
        $sql->bindParam(":stock", $datos2['stock']);
        $sql->bindParam(":video", $datos2['video']);
        $sql->bindParam(":id", $datos2['id']);
        $sql->execute();
        return $sql;
    }
    
    /*------------- eliminar mesa -----------------------*/
    protected static function eliminar_mesa_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_mesa WHERE tbl_mesa.idmesa=:id"); 

        $sql->bindParam(":id", $id);
        $sql->execute();

        return $sql;
    }
    
}
