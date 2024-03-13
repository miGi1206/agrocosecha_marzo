<?php

require_once "mainModel.php";

class registrarseModelo extends mainModel
{

    /*------------- MODELO AGREGAR PERSONAS -----------------------*/
    protected static function agregar_registro_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_persona(codigo_persona,identificacion,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,
        telefono,correo,cod_sexo,fecha_nacimiento,direccion,fecha_creacion)       
                VALUES(:cod_persona,:Identi,:Nombre1,:Nombre2,:Apellido1,:Apellido2,:Telefono,:Correo,:Sexo,:Fecha_nacimiento,:Direccion,NOW())");
        $sql->bindParam(":cod_persona", $datos['cod_persona']);
        $sql->bindParam(":Identi", $datos['Identi']);
        $sql->bindParam(":Nombre1", $datos['Nombre1']);
        $sql->bindParam(":Nombre2", $datos['Nombre2']);
        $sql->bindParam(":Apellido1", $datos['Apellido1']);
        $sql->bindParam(":Apellido2", $datos['Apellido2']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Correo", $datos['Correo']);
        $sql->bindParam(":Sexo", $datos['Sexo']);
        $sql->bindParam(":Fecha_nacimiento", $datos['Fecha_nacimiento']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        // Nota: No se enlaza :Fecha_creacion, ya que se utiliza NOW() para establecer la fecha actual automáticamente.
        $sql->execute();
        return $sql;
    }

    protected static function agregar_registro_usuario_modelo($datos_usuario)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario(usuario,contrasena,cod_persona,cod_tipo_usuario)       
                VALUES(:Usuario,:Contra,:cod_persona,'2')");
        $sql->bindParam(":Usuario", $datos_usuario['Usuario']);
        $sql->bindParam(":Contra", $datos_usuario['Contra']);
        $sql->bindParam(":cod_persona", $datos_usuario['cod_persona']);
        $sql->execute();
        return $sql;
    }

    public function listar_sexo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_sexo");
        $sql->execute();
        return $sql;
    }
}