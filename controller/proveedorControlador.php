<?php

if ($peticionAjax) {
    require_once "../model/proveedorModelo.php";
} else {
    require_once "./model/proveedorModelo.php";
}

class proveedorControlador extends proveedorModelo
{
    /*------------- CONTROLADOR AGREGAR PROVEEDOR-----------------------*/
    public function agregar_proveedor_controlador()
    {

        $nit = mainModel::limpiar_cadena($_POST['txtNit_ins']);
        $razonsocial = mainModel::limpiar_cadena($_POST['txtRazonSocial_ins']);
        $telefono = mainModel::limpiar_cadena($_POST['txtTelefono_ins']);
        $email = mainModel::limpiar_cadena($_POST['txtEmail_ins']);
        $personaContacto = mainModel::limpiar_cadena($_POST['txtPersonaContacto_ins']);
        $telefonoContacto = mainModel::limpiar_cadena($_POST['txtTelefonoContacto_ins']);
        $emailContacto = mainModel::limpiar_cadena($_POST['txtEmailContacto_ins']);
        $tipo_usuario = 3;
        $usuario = mainModel::limpiar_cadena($_POST['txtUsuario_ins']);
        $contra = mainModel::limpiar_cadena($_POST['txtContra_ins']);
        $confir_contra = mainModel::limpiar_cadena($_POST['txtConfir_contra_ins']);

        /* Verificando integridad de los datos */
        if ($nit == "" || $razonsocial == "" || $telefono == "" || $email == ""  || $personaContacto == "" || $telefonoContacto == "" || $emailContacto == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (!preg_match("/^\d+-\d+$/", $nit)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error de formato",
                "Texto" => "el nit no coincide con el formato solicitado. Debe seguir el formato 'número-número'.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,100}", $razonsocial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El nombre o razon social no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,15}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El telefono empresarial no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($telefonoContacto != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefonoContacto)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El telefono personal no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT correo FROM tbl_proveedor WHERE correo='$email'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "El EMAIL ingresado ya se encuentra registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($emailContacto != "") {
            if (filter_var($emailContacto, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT correo FROM tbl_proveedor WHERE correo='$email'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "El EMAIL ingresado ya se encuentra registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $comprobarNit = mainModel::ejecutar_consulta_simple("SELECT nit FROM tbl_proveedor WHERE nit='$nit'");
        if ($comprobarNit->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "El nit ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_proveedor_add  = [
            "nit"     => $nit,
            "nombre_razonsocial"     => $razonsocial,
            "telefono"   => $telefono,
            "correo"     => $email,
            "nom_per_contacto"      => $personaContacto,
            "tel_contacto"   => $telefonoContacto,
            "correo_contacto"     => $emailContacto,
        ];

        $checkUsuario = mainModel::ejecutar_consulta_simple("SELECT usuario FROM tbl_usuario WHERE usuario='$usuario'");
            if ($checkUsuario->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El nombre de usuario ingresado ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $contraincriptada = SHA1($contra);
            $datos_usuario_add  = [
                "Usuario"     => $usuario,
                "Contra"     => $contraincriptada,
                "tipo_usuario"   => $tipo_usuario,
                "nit_proveedor"   => $nit,
            ];

        $agregar_proveedor = proveedorModelo::agregar_proveedor_modelo($datos_proveedor_add);
        if ($agregar_proveedor->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Proveedor Registrado",
                "Texto" => "El proveedor ha sido registrado exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el proveedor.",
                "Tipo" => "error"
            ];
        }
        $agregar_usuario = proveedorModelo::agregar_proveedor_usuario_modelo($datos_usuario_add);
            if ($agregar_usuario->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "limpiarTime",
                    "Titulo" => "Persona Registrado",
                    "Texto" => "El proveedor ha sido registrado exitosamente.",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No hemos podido registrar al proveedor.",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            exit();
    }

    /*------------- FIN AGREGAR PROVEEDOR -----------------------------*//*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_proveedor_controlador($pagina, $registros, $id, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $id = mainModel::limpiar_cadena($id);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_proveedor WHERE nit != '$id' AND (nit LIKE '%$busqueda%' OR nombre_razonsocial LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR nom_per_contacto LIKE '%$busqueda%' OR tel_contacto LIKE '%$busqueda%' OR correo_contacto LIKE '%$busqueda%') ORDER BY nit ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_proveedor WHERE nit != '$id' ORDER BY nit ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= '<div class="">
            <table class="table table-hover table-sm">
            <tr>
                <th class="text-center"></th>
                <th class="text-center">nit</th>
                <th class="text-center">nombre_razonsocial</th>
                <th class="text-center">telefono</th>
                <th class="text-center">correo</th>
                <th class="text-center">nom_per_contacto</th>
                <th class="text-center">tel_contacto</th>
                <th class="text-center">correo_contacto</th>
                <th class="text-center" colspan="2">Acciones</th>
            </tr>
            ';
            if ($total >= 1 &&  $pagina <= $Npaginas) {
                $contador = $inicio + 1;
                $reg_inicio = $inicio + 1;
                foreach ($datos as $rows) {                  
                        $tabla .=
                            '<tr class="p">
                            <td class="min-width">' . $contador . '</td>
                            <td class="min-width">' . $rows['nit'] . '</td>
                            <td class="min-width">' . $rows['nombre_razonsocial'] . '</td>  
                            <td class="min-width">' . $rows['telefono'] . '</td>
                            <td class="min-width">' . $rows['correo'] . '</td>
                            <td class="min-width">' . $rows['nom_per_contacto'] . '</td>
                            <td class="min-width">' . $rows['tel_contacto'] . '</td>
                            <td class="min-width">' . $rows['correo_contacto'] . '</td>
                            <td class="stat"><a href="' . SERVERURL . 'proveedor-update/' . mainModel::encryption($rows['nit']) . '/"</input>
                                <button type="submit" class="btn warnign-btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-pencil-square lead"></i>
                                </button>
                            </td>  
                            <td>
                                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/proveedorAjax.php" 
                                    method="post" data-form="delete" autocomplete="off"> 		
                                    <input type="hidden" name="proveedor_eliminar" value="' . mainModel::encryption($rows['nit']) . '"></input>
                                    <button type="submit" class="btn danger-btn">
                                        <i class="bi bi-trash3 lead"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>';
                    $contador++;
                }
                $reg_final = $contador - 1;
            } else {
                if ($total >= 1) {
                    $tabla .= '<tr style="border-bottom: 1px solid white;">
                        <td colspan="9"><a href="' . $url . '" class="btn btn-raised btn-info btn-sm">
                        Haga click aqui para cargar nuevamnete la lista <i class="icon ion-md-refresh lead"></i></a></td></tr>';
                } else {
                    $tabla .= '<tr style="border-bottom: 1px solid white;">
                        <td colspan="9">No hay registros en el Sistema</td></tr>';
                }
            }
    
            $tabla .= '</table> </div>';
            if ($total >= 1 && $pagina <= $Npaginas) {
                $tabla .= '<p class="text-end text-muted mt-5">Lista de proveedores ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
                $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
            }
    
            return $tabla;
        

        $tabla .= '</table> </div>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-end text-muted mt-5">Lista de proveedores ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;
    }

    public function eliminar_proveedor_controlador()
    {
        $id = mainModel::decryption($_POST['proveedor_eliminar']);
        $id = mainModel::limpiar_cadena($id);

        $check_proveedor = mainModel::ejecutar_consulta_simple("SELECT nit FROM tbl_proveedor WHERE nit  ='$id'");
        if ($check_proveedor->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El proveedor que intenta eliminar no es existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_proveedor = proveedorModelo::eliminar_proveedor_modelo($id);

        if ($eliminar_proveedor->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el proveedor exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar al proveedor.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*-------------- FIN ELIMINAR PROVEEDOR --------------------------*/

    //actualizar proveedor 

    public function datos_proveedor_controlador($id){
        $id=mainModel::decryption($id);
        return proveedorModelo::datos_proveedor_modelo($id);
    }

    public function actualizar_proveedor_controlador()
    {
        $id = mainModel::decryption($_POST['proveedor_nit_up']);
        $nit_primary = mainModel::limpiar_cadena($id);

        $check_ins = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_proveedor WHERE nit='$nit_primary'");
        if ($check_ins->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos encontrado el proveedor en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_ins->fetch();
        }
        $nit = mainModel::limpiar_cadena($_POST['updateNit']);
        $razonsocial = mainModel::limpiar_cadena($_POST['updateNombrerazonsocial']);
        $telefono = mainModel::limpiar_cadena($_POST['updateTelefono']);
        $email = mainModel::limpiar_cadena($_POST['updateCorreo']);
        $personaContacto = mainModel::limpiar_cadena($_POST['updatePersonaContacto']);
        $telefonoContacto = mainModel::limpiar_cadena($_POST['updateTelefonoContacto']);
        $emailContacto = mainModel::limpiar_cadena($_POST['updateCorreoContacto']);

        /* Verificando integridad de los datos */
        if ($nit == "" || $razonsocial == "" || $telefono == "" || $email == ""  || $personaContacto == ""
            || $telefonoContacto == "" || $emailContacto == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (!preg_match("/^\d+-\d+$/", $nit)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error de formato",
                "Texto" => "el nit no coincide con el formato solicitado. Debe seguir el formato 'número-número'.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}", $razonsocial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El nombre o razon social no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($email != "") {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no válido en el correo empresarial",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($emailContacto != "") {
            if (!filter_var($emailContacto, FILTER_VALIDATE_EMAIL)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no válido en el correo personal",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        
        
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9]{8,15}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El telefono empresarial no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($nit != $campos['nit']) {
            $check_dni = mainModel::ejecutar_consulta_simple("SELECT nit FROM tbl_proveedor WHERE nit='$nit'");
            if ($check_dni->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error Inesperado",
                    "Texto" => "El nit ingresado ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_ins_up = [
            "nit"        => $nit,
            "nombre_razonsocial"        => $razonsocial,
            "telefono"        => $telefono,
            "correo"      => $email,
            "nom_per_contacto"      => $personaContacto,
            "tel_contacto"      => $telefonoContacto,
            "correo_contacto"        => $emailContacto,
            "ID"            => $nit_primary,
        ];
        if (proveedorModelo::actualizar_proveedor_modelo($datos_ins_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos actualizados",
                "Texto" => "Los datos han sido actualizados exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido actualizar tus datos",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }/*------------------ FIN ACTUALIZAR PROVEEDOR -----------------------*/

}
/*------------------- FIN TABLA ---------------------------------*/