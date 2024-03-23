<?php
class vistasModelos
{
    protected static function obtener_vistas_modelos($vistas)
    {
        $listaPermitida = [
            "votacion", "home",
            "personas", "personas-list", "personas-update","personas-search",
            "usuario","usuario-list","usuario-update","usuario-search",
            "producto","producto-list","producto-update","producto-search",
            "proveedor", "proveedor-list","proveedor-search","proveedor-update",
            "servicio","servicio-list","servicio-update","servicio-search","ver-fotos","imagenes-servicios","correos"];
        if (in_array($vistas, $listaPermitida)) {
            if (is_file("./view/contenidos/" . $vistas . "-view.php")) {
                $contenido = "./view/contenidos/" . $vistas . "-view.php";
            } else {
                $contenido = "404";
            }
        } elseif ($vistas == "home-agro" || $vistas == "index") {
            $contenido = "home-agro";
        } elseif ($vistas == "login") {
            $contenido = "login";
        } elseif ($vistas == "contactanos") {
            $contenido = "contactanos";
        }elseif ($vistas == "index") {
            $contenido = "home-agro";
        }elseif ($vistas == "quienes-somos") {
            $contenido = "quienes-somos";
        }elseif ($vistas == "productos-servicios") {
            $contenido = "productos-servicios";
        }elseif ($vistas == "registrarse") {
            $contenido = "registrarse";
        }elseif ($vistas == "checkout") {
            $contenido = "checkout";
        }else{
            $contenido = "404";
        }
        return $contenido;
    }
}