<?php 
require_once "mainModel.php";

class loginModelo extends mainModel{   

    /*----------- modelo para iniciar sesion ------------------*/
        
    protected static function iniciar_sesion_modelo($datos){
        
        // $correo = $datos['Correo'];
        // $contra = SHA1($datos['Contra']);

        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_persona, 
        tbl_usuario,tbl_tipo_usuario WHERE cod_tipo_usuario=codigo_tipo_usuario 
        AND cod_persona=codigo_persona AND usuario=:Correo AND contrasena=:Contra");

        // $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_usuario 
        // JOIN tbl_tipo_usuario ON tbl_usuario.cod_tipo_usuario = tbl_tipo_usuario.codigo_tipo_usuario 
        // LEFT JOIN tbl_persona ON tbl_usuario.cod_persona = tbl_persona.codigo_persona 
        // LEFT JOIN tbl_proveedor ON tbl_usuario.nit_proveedor = tbl_proveedor.nit 
        // WHERE tbl_usuario.usuario = :Correo AND tbl_usuario.contrasena = SHA1(:Contra) 
        // AND (tbl_usuario.cod_persona IS NOT NULL OR tbl_usuario.nit_proveedor IS NOT NULL)");

        $sql->bindParam(":Correo",$datos['Correo']);
        $sql->bindParam(":Contra",$datos['Contra']);

        $sql->execute();

        return $sql;
    }
}