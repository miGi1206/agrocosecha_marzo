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
        try {
            $sql = mainModel::conectar()->prepare("DELETE FROM tbl_servicio WHERE codigo_servicio=:ID");
    
            $sql->bindParam(":ID", $id);
            $sql->execute();
    
            return $sql;
        } catch (PDOException $e) {
            throw $e; // Propagar la excepción hacia arriba
        }
    }
    /*------------- MODELO ACTUALIZAR SERVICIO -----------------------*/
    protected static function datos_servicio_modelo($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_servicio WHERE codigo_servicio =:id");

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