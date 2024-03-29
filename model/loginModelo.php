<?php 
require_once "mainModel.php";

class loginModelo extends mainModel{   

    /*----------- modelo para iniciar sesion ------------------*/
        // $correo = $datos['Correo'];
        // $contra = SHA1($datos['Contra']);
        protected static function iniciar_sesion_modelo($datos) {
            $correo = $datos['Correo'];
            $contrasena = SHA1($datos['Contra']); // No es necesario limpiar la contraseña ya que se usa para autenticar
            
            $sql = mainModel::conectar()->prepare("
                SELECT u.*, p.*, tu.*,pr.nombre_razonsocial,pr.nit,pp.*,pd.*
                FROM tbl_usuario AS u
                LEFT JOIN tbl_persona AS p ON u.cod_persona = p.codigo_persona
                LEFT JOIN tbl_tipo_usuario AS tu ON u.cod_tipo_usuario = tu.codigo_tipo_usuario
                LEFT JOIN tbl_proveedor AS pr ON u.nit_proveedor = pr.nit
                LEFT JOIN tbl_prov_prod AS pp ON pr.nit = pp.nit_proveedor
                LEFT JOIN tbl_producto AS pd ON pp.cod_producto = pd.codigo_producto
                WHERE u.usuario = :Correo AND u.contrasena = :Contrasena
            ");
            
            $sql->bindParam(":Correo", $correo);
            $sql->bindParam(":Contrasena", $contrasena);
            
            $sql->execute();
            
            return $sql;
        }
        
        
                
}