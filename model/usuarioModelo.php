<?php

require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    /*------------- MODELO AGREGAR USUARIO -----------------------*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario(usuario, contrasena, cod_persona, cod_tipo_usuario)       
                VALUES(:usuario,:contrasena,:persona, :tipo_usuario)");
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":contrasena", $datos['contrasena']);
        $sql->bindParam(":persona", $datos['persona']);
        $sql->bindParam(":tipo_usuario", $datos['tipo_usuario']);
        $sql->execute();
        return $sql;
    }
    public function listar_persona()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_persona");
        $sql->execute();
        return $sql;
    }

    public function listar_tipo_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_tipo_usuario WHERE tipo_usuario != 'proveedor'");
        $sql->execute();
        return $sql;
    }


    /*------------- MODELO ELIMINAR USUARIO -----------------------*/
    protected static function eliminar_usuario_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_usuario WHERE codigo_usuario =:id");

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