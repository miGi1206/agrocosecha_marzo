<?php

if ($peticionAjax) {
    require_once "../model/usuarioModelo.php";
} else {
    require_once "./model/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    /*------------- CONTROLADOR AGREGAR USUARIO -----------------------*/
    public function agregar_usuario_controlador()
    {
        $usuario = mainModel::limpiar_cadena($_POST['txtUsuario_ins']);
        $contraseña = mainModel::limpiar_cadena($_POST['txtContra_ins']);
        $confir_contra = mainModel::limpiar_cadena($_POST['txtConfir_contra_ins']);
        $persona = mainModel::limpiar_cadena($_POST['txtIDpersona_ins']);
        $tipo_usuario = mainModel::limpiar_cadena($_POST['txtTipo_usuario_ins']);

        if ($usuario == "" || $contraseña == "" || $persona == "" || $tipo_usuario == "" || $confir_contra == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $comprobarpersona = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_usuario WHERE cod_persona ='$persona' AND cod_tipo_usuario = '$tipo_usuario'");

        if ($comprobarpersona->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La identificación ingresada ya cuenta con un usuario con ese tipo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // Verificar si el usuario ya existe
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
        if ($contraseña != $confir_contra) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
    }
        else {
                $contraincriptada = SHA1($contraseña);
                $datos_users_add = [
                    "usuario" => $usuario,
                    "contrasena" => $contraincriptada,
                    "persona" => $persona,
                    "tipo_usuario" => $tipo_usuario,
                ];

                $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_users_add);

                if ($agregar_usuario->rowCount() == 1) {
                    $alerta = [
                        "Alerta" => "limpiarTime",
                        "Titulo" => "Usuario Registrado",
                        "Texto" => "El Usuario ha sido registrado exitosamente.",
                        "Tipo" => "success"
                    ];
                } else {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "No hemos podido registrar el usuario.",
                        "Tipo" => "error"
                    ];
                }
            echo json_encode($alerta);
            exit();
        }
    }
    /*------------- FIN AGREGAR USUARIO -----------------------------*/

    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_usuario_controlador($pagina, $registros, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * 
                        FROM tbl_usuario 
                        LEFT JOIN tbl_tipo_usuario ON tbl_tipo_usuario.codigo_tipo_usuario = tbl_usuario.cod_tipo_usuario
                        LEFT JOIN tbl_persona ON tbl_persona.codigo_persona = tbl_usuario.cod_persona
                        LEFT JOIN tbl_proveedor ON tbl_proveedor.nit = tbl_usuario.nit_proveedor
                        WHERE tbl_usuario.codigo_usuario != '$id' AND 
                            (usuario LIKE '%$busqueda%' OR 
                            identificacion LIKE '%$busqueda%' OR 
                            tipo_usuario LIKE '%$busqueda%' OR 
                            primer_nombre LIKE '%$busqueda%' OR 
                            primer_apellido LIKE '%$busqueda%' OR 
                            nit LIKE '%$busqueda%' OR 
                            nombre_razonsocial LIKE '%$busqueda%')
                        ORDER BY codigo_usuario ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * 
            FROM tbl_usuario 
            LEFT JOIN tbl_tipo_usuario ON tbl_tipo_usuario.codigo_tipo_usuario = tbl_usuario.cod_tipo_usuario
            LEFT JOIN tbl_persona ON tbl_persona.codigo_persona = tbl_usuario.cod_persona
            LEFT JOIN tbl_proveedor ON tbl_proveedor.nit = tbl_usuario.nit_proveedor
            ORDER BY codigo_usuario ASC LIMIT $inicio, $registros";
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
                <th class="text-center">N°</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">identificacion / NIT</th>
                <th class="text-center">persona o proveedor</th>
                <th class="text-center">Tipo de usuario</th>
                <th class="text-center">Acciones</th>
            </tr>
            ';
        if ($total >= 1 &&  $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="p">
                    <td class="min-width">' . $contador . '</td>
                    <td class="min-width">' . $rows['usuario'] . '</td>
                    <td class="min-width">' . (($rows['cod_tipo_usuario'] == 3) ? $rows['nit'] : $rows['identificacion']) . '</td>
                    <td class="min-width">' . (($rows['cod_tipo_usuario'] == 3) ? $rows['nombre_razonsocial'] : $rows['primer_nombre'] . ' - ' . $rows['primer_apellido']) . '</td>
                    <td class="min-width">' . $rows['tipo_usuario'] . '</td>
                    <td>
                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="post" data-form="delete" autocomplete="off">
                            <input type="hidden" name="usuarioId_eliminar" value="' . mainModel::encryption($rows['codigo_usuario']) . '"></input>
                            <button type="submit" class="btn danger-btn">
                                <i class="bi bi-trash3 lead"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
                $contador +=1;
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
            $tabla .= '<p class="text-end text-muted mt-5">Lista de Personas ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;
    }/*------------------- FIN TABLA ---------------------------------*/

    /*------------- CONTROLADOR ACTUALIZAR programa -----------------------*/
    // public function datos_usuario_controlador($id){
    //     $id=mainModel::decryption($id);
    //     return usuarioModelo::datos_usuario_modelo($id);
    // }

    // public function actualizar_usuario_controlador()
    // {
    //     $id = mainModel::decryption($_POST['usuarioId_up']);
    //     $id_primary = mainModel::limpiar_cadena($id);


    //     $check_ins = mainModel::ejecutar_consulta_simple("SELECT useUser,tbl_apren_ID FROM tbl_usuario WHERE usuarioId ='$id_primary'");
    //     if ($check_ins->rowCount() <= 0) {
    //         $alerta = [
    //             "Alerta" => "simple",
    //             "Titulo" => "Ocurrió un error inesperado.",
    //             "Texto" => "No hemos encontrado la persona en el sistema",
    //             "Tipo" => "error"
    //         ];
    //         echo json_encode($alerta);
    //         exit();
    //     }

    //     $usuario = mainModel::limpiar_cadena($_POST['updateusuario']);
    //     $idaprendiz = mainModel::limpiar_cadena($_POST['updateidAprendiz']);


    //     /* Verificando integridad de los datos */
    //     if ($usuario == "" || $idaprendiz == "") {
    //         $alerta = [
    //             "Alerta" => "simple",
    //             "Titulo" => "Ocurrio un error inesperado",
    //             "Texto" => "No has llenado todos los campos que son obligatorios",
    //             "Tipo" => "error"
    //         ];
    //         echo json_encode($alerta);
    //         exit();
    //     }

    //     // if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]", $usuario)) {
    //     //     $alerta = [
    //     //         "Alerta" => "simple",
    //     //         "Titulo" => "Ocurrió un error inesperado",
    //     //         "Texto" => "El Primer nombre no coincide con el formato solicitado",
    //     //         "Tipo" => "error"
    //     //     ];
    //     //     echo json_encode($alerta);
    //     //     exit();
    //     // }


    //     $datos_usuario_up = [
    //         "usuario" => $usuario,
    //         "idaprendiz" => $idaprendiz,
    //         "ID" => $id

    //     ];

    //     if (usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)) {
    //         $alerta = [
    //             "Alerta" => "recargar",
    //             "Titulo" => "Datos actualizados",
    //             "Texto" => "Los datos han sido actualizados exitosamente",
    //             "Tipo" => "success"
    //         ];
    //     } else {
    //         $alerta = [
    //             "Alerta" => "simple",
    //             "Titulo" => "Ocurrió un error inesperado",
    //             "Texto" => "No hemos podido actualizar tus datos ;(",
    //             "Tipo" => "error"
    //         ];
    //     }
    //     echo json_encode($alerta);
    //     exit();

    // }
    // /*------------------ FIN ACTUALIZAR USUARIO -----------------------*/

    /*------------- CONTROLADOR ELIMINAR USUARIO --------------------*/
    public function eliminar_usuario_controlador()
    {
        $id = mainModel::decryption($_POST['usuarioId_eliminar']);
        $id = mainModel::limpiar_cadena($id);

        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT codigo_usuario  FROM tbl_usuario WHERE codigo_usuario ='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El usuario que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);

        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el usuario exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar el usuario.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*-------------- FIN ELIMINAR APRENDIZ --------------------------*/
}