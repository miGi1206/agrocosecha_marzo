<?php 
require_once "mainModel.php";

class servicioModelo extends mainModel
{
    /*------------- MODELO AGREGAR  -----------------------*/
    protected static function agregar_servicio_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_servicio(codigo_servicio,nombre,descripcion,precio,duracion,cod_tipo_servicio,fecha_registro)       
                VALUES(:codigo_servicio,:Nombre,:descripcion,:precio,:duracion,:cod_tipo_servicio,NOW())"); 
        $sql->bindParam(":codigo_servicio", $datos['codigo_servicio']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":duracion", $datos['duracion']);
        $sql->bindParam(":cod_tipo_servicio", $datos['cod_tipo_servicio']);
        $sql->execute();
        
            // Subir las imágenes y guardar sus nombres en la base de datos
    $dir_local2 = "../view/img/img_servicio";

    if (!file_exists($dir_local2)) {
        mkdir($dir_local2, 0777, true);
    }

    foreach ($_FILES['txtfotos_reg']['name'] as $i => $name) {
        if (strlen($_FILES['txtfotos_reg']['name'][$i]) > 1) {
            $file_name = $_FILES['txtfotos_reg']['name'][$i];
            $sourse_foto = $_FILES['txtfotos_reg']['tmp_name'][$i];
            $tamaño_foto = $_FILES['txtfotos_reg']['size'][$i];

            $nuevo_nombre_file = md5(uniqid(rand()));
            $extension_foto = pathinfo($file_name, PATHINFO_EXTENSION);
            $nombre_foto = md5(uniqid(rand())) . '_' . $datos['Nombre'] . '.' . $extension_foto;

            $result_foto = $dir_local2 . '/' . $nombre_foto;

            move_uploaded_file($sourse_foto, $result_foto);

            $insert_image_sql = "INSERT INTO tbl_imagen (foto, cod_servicio) VALUES (:foto, :codigo_servicio)";
            $sql_imagen = mainModel::conectar()->prepare($insert_image_sql);
            $sql_imagen->bindParam(":foto", $nombre_foto);
            $sql_imagen->bindParam(":codigo_servicio", $datos['codigo_servicio']);
            $sql_imagen->execute();           
        }
    }

    return $sql;
    }
    public function listar_servicio()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_tipo_servicio");
        $sql->execute();
        return $sql;
    }
    
    /*------------- MODELO ELIMINAR SERVICIO -----------------------*/
    protected static function eliminar_servicio_modelo($id)
    {     
        $sql_select_imagenes = mainModel::conectar()->prepare("SELECT foto FROM tbl_imagen WHERE cod_servicio=:ID");
        $sql_select_imagenes->bindParam(":ID", $id);
        $sql_select_imagenes->execute();
        $imagenes = $sql_select_imagenes->fetchAll(PDO::FETCH_ASSOC);

        // Iterar sobre cada imagen y eliminarla de la carpeta
        foreach ($imagenes as $imagen) {
            $ruta_imagen = "../view/img/img_servicio/{$imagen['foto']}";
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }  
            $sql = mainModel::conectar()->prepare("DELETE FROM tbl_servicio WHERE codigo_servicio=:ID");
    
            $sql->bindParam(":ID", $id);
            $sql->execute();
    
            return $sql;
    }
    /*------------- MODELO ACTUALIZAR SERVICIO -----------------------*/
    protected static function datos_servicio_modelo($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_servicio,tbl_tipo_servicio WHERE codigo_servicio =:id AND codigo_tipo_servicio =cod_tipo_servicio");

        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_servicio_modelo($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_servicio SET
            nombre=:Nombre, descripcion=:descripcion, precio=:precio,duracion=:duracion,
            cod_tipo_servicio=:cod_tipo_servicio WHERE codigo_servicio=:id");

        $sql->bindParam(":Nombre", $datos2['Nombre']);
        $sql->bindParam(":descripcion", $datos2['descripcion']);
        $sql->bindParam(":precio", $datos2['precio']);
        $sql->bindParam(":duracion", $datos2['duracion']);
        $sql->bindParam(":cod_tipo_servicio", $datos2['cod_tipo_servicio']);
        $sql->bindParam(":id", $datos2['id']);
        $sql->execute();
        return $sql;
    }
}
?>