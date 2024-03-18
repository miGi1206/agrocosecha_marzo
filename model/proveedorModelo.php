<?php

require_once "mainModel.php";

class proveedorModelo extends mainModel
{

    /*------------- MODELO AGREGAR PROVEEDOR -----------------------*/
    protected static function agregar_proveedor_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_proveedor(nit,nombre_razonsocial,telefono,correo,nom_per_contacto,tel_contacto,correo_contacto)       
                VALUES(:nit,:nombre_razonsocial,:telefono,:correo,:nom_per_contacto,:tel_contacto,:correo_contacto)");
        $sql->bindParam(":nit", $datos['nit']);
        $sql->bindParam(":nombre_razonsocial", $datos['nombre_razonsocial']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":correo", $datos['correo']);
        $sql->bindParam(":nom_per_contacto", $datos['nom_per_contacto']);
        $sql->bindParam(":tel_contacto", $datos['tel_contacto']);
        $sql->bindParam(":correo_contacto", $datos['correo_contacto']);
        $sql->execute();
        return $sql;
    }

    protected static function agregar_proveedor_usuario_modelo($datos_usuario)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario(usuario,contrasena,cod_tipo_usuario,nit_proveedor)       
                VALUES(:Usuario,:Contra,:tipo_usuario,:nit_proveedor)");
        $sql->bindParam(":Usuario", $datos_usuario['Usuario']);
        $sql->bindParam(":Contra", $datos_usuario['Contra']);
        $sql->bindParam(":tipo_usuario", $datos_usuario['tipo_usuario']);
        $sql->bindParam(":nit_proveedor", $datos_usuario['nit_proveedor']);
        $sql->execute();
        return $sql;
    }

    protected static function agregar_prov_prod_modelo($datos_prov_prod){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_prov_prod(nit_proveedor,cod_producto)
            VALUES(:nit_proveedor,:cod_producto)");
        $sql->bindParam(":nit_proveedor", $datos_prov_prod['nit_proveedor']);
        $sql->bindParam(":cod_producto", $datos_prov_prod['cod_producto']);
        $sql->execute();
        return $sql;
    }


    public function listar_tipo_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_tipo_usuario WHERE tipo_usuario = 'proveedor'");
        $sql->execute();
        return $sql;
    }

    public function listar_producto()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_producto");
        $sql->execute();
        return $sql;
    }

    /*------------- MODELO ELIMINAR PROVEEDOR -----------------------*/
    protected static function eliminar_proveedor_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_proveedor WHERE nit = :nit");
        $sql->bindParam(":nit", $id);
        $sql->execute();
        return $sql;
    }


    /*------------- MODELO ACTUALIZAR PROVEEDOR -----------------------*/
    protected static function datos_proveedor_modelo($nit){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_proveedor WHERE nit =:nit");

        $sql->bindParam(":nit",$nit);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_proveedor_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_proveedor SET
        nit=:nit,nombre_razonsocial=:nombre_razonsocial,telefono=:telefono,correo=:correo,
        nom_per_contacto=:nom_per_contacto,tel_contacto=:tel_contacto,correo_contacto=:correo_contacto
        WHERE nit=:nit");

        $sql->bindParam(":nit", $datos['nit']);
        $sql->bindParam(":nombre_razonsocial", $datos['nombre_razonsocial']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":correo", $datos['correo']);
        $sql->bindParam(":nom_per_contacto", $datos['nom_per_contacto']);
        $sql->bindParam(":tel_contacto", $datos['tel_contacto']);
        $sql->bindParam(":correo_contacto", $datos['correo_contacto']);
        $sql->execute();
        return $sql;
    }

    // protected static function actualizar_prov_prod($datos_prov_prod)
    // {
    //     $sql = mainModel::conectar()->prepare("UPDATE tbl_prov_prod SET nit_proveedor=:nit_proveedor,cod_producto=:cod_producto 
    //     WHERE nit=:nit");
    //     $sql->bindParam(":nit_proveedor",$datos_prov_prod['nit_proveedor']);
    //     $sql->bindParam(":cod_producto",$datos_prov_prod['cod_producto']);
    //     $sql->execute();
    //     return $sql;
    // }
    
    
}