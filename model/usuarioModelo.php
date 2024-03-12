<?php

require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    /*------------- MODELO AGREGAR APRENDIZ -----------------------*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario(useUser, usePass, tbl_apren_ID)       
                VALUES(:usuario,:contrasena,:aprendiz)");
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":contrasena", $datos['contrasena']);
        $sql->bindParam(":aprendiz", $datos['aprendiz']);
        $sql->execute();
        return $sql;
    }


    /*------------- MODELO ELIMINAR USUARIO -----------------------*/
    protected static function eliminar_usuario_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_usuario WHERE usuarioId =:id");

        $sql->bindParam(":id", $id);
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR USUARIO -----------------------*/
    protected static function datos_usuario_modelo($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_usuario WHERE codigo_usuario  =:id");

        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_usuario SET
        usuario=:usuario, tbl_apren_ID=:idaprendiz WHERE usuarioId =:ID");

        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":idaprendiz", $datos['idaprendiz']);
        $sql->bindParam(":ID", $datos['ID']);
        $sql->execute();
        return $sql;
        
    }/*------------- FIN ACTUALIZAR APRENDIZ -----------------------*/
}