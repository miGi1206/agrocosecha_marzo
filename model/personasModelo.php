<?php

require_once "mainModel.php";

class personasModelo extends mainModel
{

    /*------------- MODELO AGREGAR PERSONAS -----------------------*/
    protected static function agregar_personas_modelo($datos)
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

protected static function agregar_personas_usuario_modelo($datos_usuario)
{
    $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario(usuario,contrasena,cod_persona,cod_tipo_usuario)       
            VALUES(:Usuario,:Contra,:cod_persona,:tipo_usuario)");
    $sql->bindParam(":Usuario", $datos_usuario['Usuario']);
    $sql->bindParam(":Contra", $datos_usuario['Contra']);
    $sql->bindParam(":cod_persona", $datos_usuario['cod_persona']);
    $sql->bindParam(":tipo_usuario", $datos_usuario['tipo_usuario']);
    $sql->execute();
    return $sql;
}

    public function listar_sexo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_sexo");
        $sql->execute();
        return $sql;
    }

    public function listar_tipo_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_tipo_usuario WHERE tipo_usuario != 'proveedor'");
        $sql->execute();
        return $sql;
    }

    /*------------- MODELO ELIMINAR PERSONAS -----------------------*/
    protected static function eliminar_personas_modelo($id)
    {
        try {
            $sql = mainModel::conectar()->prepare("DELETE FROM tbl_persona WHERE identificacion=:ID");
    
            $sql->bindParam(":ID", $id);
            $sql->execute();
    
            return $sql;
        } catch (PDOException $e) {
            throw $e; // Propagar la excepción hacia arriba
        }
    }

    /*------------- MODELO ACTUALIZAR PERSONAS -----------------------*/
    protected static function datos_personas_modelo($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_persona,tbl_sexo WHERE identificacion=:id AND codigo_sexo=cod_sexo ");

        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_personas_modelo($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_persona SET
        identificacion=:identi, primer_nombre=:Nombre1, segundo_nombre=:Nombre2, primer_apellido=:Apellido1, segundo_apellido=:Apellido2,
        telefono=:Telefono, correo=:Correo, cod_sexo=:Sexo, fecha_nacimiento=:Fecha_nacimiento, direccion=:Direccion WHERE identificacion=:ID");

        $sql->bindParam(":identi", $datos2['identi']);
        $sql->bindParam(":Nombre1", $datos2['Nombre1']);
        $sql->bindParam(":Nombre2", $datos2['Nombre2']);
        $sql->bindParam(":Apellido1", $datos2['Apellido1']);
        $sql->bindParam(":Apellido2", $datos2['Apellido2']);
        $sql->bindParam(":Telefono", $datos2['Telefono']);
        $sql->bindParam(":Correo", $datos2['Correo']);
        $sql->bindParam(":Sexo", $datos2['Sexo']);
        $sql->bindParam(":Fecha_nacimiento", $datos2['Fecha_nacimiento']);
        $sql->bindParam(":Direccion", $datos2['Direccion']);
        $sql->bindParam(":ID", $datos2['ID']);
        $sql->execute();
        return $sql;
    }/*------------- FIN ACTUALIZAR PERSONAS -----------------------*/
}