<?php

require_once "mainModel.php";

class productoModelo extends mainModel
{

    /*------------- MODELO AGREGAR MESA -----------------------*/
    protected static function agregar_producto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_producto(codigo_producto,nombre,descripcion,precio,stock,video,fecha_registro)       
                VALUES(:codigo_producto,:Nombre,:descripcion,:precio,:stock,:video, NOW())"); 
        $sql->bindParam(":codigo_producto", $datos['codigo_producto']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":stock", $datos['stock']);
        $sql->bindParam(":video", $datos['video']);
        $sql->execute();
        return $sql;
    }
    /*------------- MODELO ELIMINAR APRENDIZ -----------------------*/
    protected static function eliminar_producto_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_producto WHERE codigo_producto=:ID");

        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR MESA -----------------------*/
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
