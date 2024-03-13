<?php

if ($peticionAjax) {
    require_once "../model/personasModelo.php";
} else {
    require_once "./model/personasModelo.php";
}

class personasControlador extends personasModelo
{
    /*------------- CONTROLADOR AGREGAR APRENDIZ -----------------------*/
    public function agregar_personas_controlador()
    {
        try{
        
        $codigo_persona = mt_rand(1, 999999999);
        $identificacion = mainModel::limpiar_cadena($_POST['txtDni_ins']);
        $nombre1 = mainModel::limpiar_cadena($_POST['txtNombre1_ins']);
        $nombre2 = mainModel::limpiar_cadena($_POST['txtNombre2_ins']);
        $apellido1 = mainModel::limpiar_cadena($_POST['txtApellido1_ins']);
        $apellido2 = mainModel::limpiar_cadena($_POST['txtApellido2_ins']);
        $telefono = mainModel::limpiar_cadena($_POST['txtTelefono_ins']);
        $email = mainModel::limpiar_cadena($_POST['txtEmail_ins']);
        $sexo = mainModel::limpiar_cadena($_POST['txtSexo_ins']);
        $fecha_nacimiento = mainModel::limpiar_cadena($_POST['txtFecha_nacimiento_ins']);
        $direccion = mainModel::limpiar_cadena($_POST['txtDireccion_ins']);
        $tipo_usuario = mainModel::limpiar_cadena($_POST['txtTipo_usuario_ins']);
        $usuario = mainModel::limpiar_cadena($_POST['txtUsuario_ins']);
        $contra = mainModel::limpiar_cadena($_POST['txtContra_ins']);
        $confir_contra = mainModel::limpiar_cadena($_POST['txtConfir_contra_ins']);

        /* Verificando integridad de los datos */
        if ($identificacion == "" || $nombre1 == "" || $apellido1 == "" || $telefono == ""  
            || $email == "" || $sexo == "" || $fecha_nacimiento == "" || $direccion == ""
            || $tipo_usuario == "" || $usuario == "" || $contra == "" || $confir_contra == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{7,11}", $identificacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}", $nombre1)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}", $apellido1)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9]{7,15}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El numero de celular no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($contra != $confir_contra) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "La contraseñas no coinciden",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
        }

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT correo FROM tbl_persona WHERE correo='$email'");
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
        $comprobarIdentificacion = mainModel::ejecutar_consulta_simple("SELECT identificacion FROM tbl_persona WHERE identificacion='$identificacion'");
        if ($comprobarIdentificacion->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La identificacion ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $fecha_nacimiento_timestamp = strtotime($fecha_nacimiento);
        $edad_minima = 18; // Cambia esto si necesitas una edad mínima diferente.

        // Obtener el timestamp actual.
        $fecha_actual_timestamp = time();

        // Calcular la diferencia de tiempo en segundos.
        $diferencia_tiempo = $fecha_actual_timestamp - $fecha_nacimiento_timestamp;

        // Calcular la edad en años.
        $edad = floor($diferencia_tiempo / (365 * 24 * 60 * 60));

        if ($edad < $edad_minima) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "Debes ser mayor de 18 años para registrarte.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_personas_add  = [
            "cod_persona" => $codigo_persona,
            "Identi"     => $identificacion,
            "Nombre1"     => $nombre1,
            "Nombre2"     => $nombre2,
            "Apellido1"   => $apellido1,
            "Apellido2"   => $apellido2,
            "Telefono"   => $telefono,
            "Correo"     => $email,
            "Sexo"      => $sexo,
            "Fecha_nacimiento"   => $fecha_nacimiento,
            "Direccion"    => $direccion,
        ];

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
        
            $datos_usuario_add  = [
                "Usuario"     => $usuario,
                "Contra"     => $contra,
                "tipo_usuario"   => $tipo_usuario,
                "cod_persona"   => $codigo_persona,
            ];

            $agregar_personas = personasModelo::agregar_personas_modelo($datos_personas_add);
        if ($agregar_personas->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Persona Registrado",
                "Texto" => "La persona se ha sido registrado exitosamente.",
                "Tipo" => "success"
            ];
        }else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar a la persona.",
                "Tipo" => "error"
            ];
        }
        $agregar_usuario = personasModelo::agregar_personas_usuario_modelo($datos_usuario_add);
            if ($agregar_usuario->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "limpiarTime",
                    "Titulo" => "Persona Registrado",
                    "Texto" => "La persona ha sido registrado exitosamente.",
                    "Tipo" => "success"
                ];
            }else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No hemos podido registrar a la persona.",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            exit();
        } catch (PDOException $e) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No pudimos registrarte intentalo mas tarde",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    }/*------------- FIN AGREGAR PERSONAS -----------------------------*/

    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_personas_controlador($pagina, $registros, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_persona, tbl_sexo 
            WHERE cod_sexo=codigo_sexo AND ((codigo_persona  !='$id') 
            AND (identificacion LIKE '%$busqueda%' OR primer_nombre  LIKE '%$busqueda%' OR segundo_nombre  LIKE '%$busqueda%'
            OR primer_apellido LIKE '%$busqueda%' OR segundo_apellido  LIKE '%$busqueda%' OR telefono  LIKE '%$busqueda%'
            OR correo  LIKE '%$busqueda%' OR sexo  LIKE '%$busqueda%' OR direccion  LIKE '%$busqueda%')) ORDER BY identificacion ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_persona, tbl_sexo WHERE cod_sexo=codigo_sexo AND codigo_persona  !='$id' ORDER BY codigo_persona  ASC LIMIT $inicio, $registros";
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
                <th class="text-center">Identificacion</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Sexo</th>
                <th class="text-center">Fecha de nacimiento</th>
                <th class="text-center">Direccion</th>
                <th class="text-center">Fecha de creacion</th>
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
                        <td class="min-width">' . $rows['identificacion'] . '</td>
                        <td class="min-width">' . $rows['primer_nombre'] .' '. $rows['segundo_nombre'] .'</td>
                        <td class="min-width">' . $rows['primer_apellido'] .' '. $rows['segundo_apellido'] . '</td>
                        <td class="min-width">' . $rows['telefono'] . '</td> 
                        <td class="min-width">' . $rows['correo'] . '</td>
                        <td class="min-width">' . $rows['sexo'] . '</td>
                        <td class="min-width">' . $rows['fecha_nacimiento'] . '</td>
                        <td class="min-width">' . $rows['direccion'] . '</td>
                        <td class="min-width">' . $rows['fecha_creacion'] . '</td>

                        <td class="stat"><a href="' . SERVERURL . 'personas-update/' . mainModel::encryption($rows['identificacion']) . '/"</input>
                            <button type="submit" class="btn warnign-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square lead"></i>
                            </button>
                        </td>  
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/personasAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="personas_eliminar" value="' . mainModel::encryption($rows['identificacion']) . '"></input>
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
            $tabla .= '<p class="text-end text-muted mt-5">Lista de Personas ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;
    }/*------------------- FIN TABLA ---------------------------------*/

    /*------------- CONTROLADOR ELIMINAR PERSONAS --------------------*/
    public function eliminar_personas_controlador()
    {
        try {
            $id = mainModel::decryption($_POST['personas_eliminar']);
            $id = mainModel::limpiar_cadena($id);

            $check_personas = mainModel::ejecutar_consulta_simple("SELECT identificacion FROM tbl_persona WHERE identificacion  ='$id'");
            if ($check_personas->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "La persona que intenta eliminar no existe en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $eliminar_personas = personasModelo::eliminar_personas_modelo($id);

            if ($eliminar_personas->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "limpiarTime",
                    "Titulo" => "Eliminado",
                    "Texto" => "Se ha eliminado la persona exitosamente.",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado.",
                    "Texto" => "No hemos podido eliminar la persona.",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
        } catch (PDOException $e) {
            $errorInfo = $e->errorInfo;

            if ($errorInfo[0] === '23000' && $errorInfo[1] === 1451) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error al eliminar",
                    "Texto" => "No se puede eliminar esta persona porque tiene registros relacionados.",
                    "Tipo" => "error"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error en la base de datos",
                    "Texto" => "Error: " . $e->getMessage(),
                    "Tipo" => "error"
                ];
            }

            echo json_encode($alerta);
        }
    }/*-------------- FIN ELIMINAR APRENDIZ --------------------------*/

    /*------------- CONTROLADOR ACTUALIZAR PERSONAS -----------------------*/
    public function datos_personas_controlador($id){
        $id=mainModel::decryption($id);
        return personasModelo::datos_personas_modelo($id);
    }
    
    public function actualizar_personas_controlador()
    {
        $id = mainModel::decryption($_POST['personas_id_up']);
        $id_primary = mainModel::limpiar_cadena($id);

        $check_ins = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_persona WHERE identificacion='$id_primary'");
        if ($check_ins->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos encontrado la persona en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_ins->fetch();
        }
        $identificacion = mainModel::limpiar_cadena($_POST['updateIdentificacion']);
        $nombre1 = mainModel::limpiar_cadena($_POST['updateNombre1']);
        $nombre2 = mainModel::limpiar_cadena($_POST['updateNombre2']);
        $apellido1 = mainModel::limpiar_cadena($_POST['updateApellido1']);
        $apellido2 = mainModel::limpiar_cadena($_POST['updateApellido2']);
        $telefono = mainModel::limpiar_cadena($_POST['updateTelefono']);
        $email = mainModel::limpiar_cadena($_POST['updateEmail']);
        $sexo = mainModel::limpiar_cadena($_POST['updateSexo']);
        $fecha_nacimiento = mainModel::limpiar_cadena($_POST['updateFecha_nacimiento']);
        $direccion = mainModel::limpiar_cadena($_POST['updateDireccion']);

        /* Verificando integridad de los datos */
        if ($identificacion == "" || $nombre1 == "" || $apellido1 == "" || $telefono == ""  || $email == ""
            || $sexo == "" || $fecha_nacimiento == "" || $direccion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{7,11}", $identificacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}", $nombre1)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}", $apellido1)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9]{8,15}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El numero de celular no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($identificacion != $campos['identificacion']) {
            $check_dni = mainModel::ejecutar_consulta_simple("SELECT identificacion FROM tbl_persona WHERE identificacion='$identificacion'");
            if ($check_dni->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error Inesperado",
                    "Texto" => "La Identificacion ingresada ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_ins_up = [
            "identi"        => $identificacion,
            "Nombre1"        => $nombre1,
            "Nombre2"        => $nombre2,
            "Apellido1"      => $apellido1,
            "Apellido2"      => $apellido2,
            "Telefono"      => $telefono,
            "Correo"        => $email,
            "Sexo"         => $sexo,
            "Fecha_nacimiento"  => $fecha_nacimiento,
            "Direccion"  => $direccion,
            "ID"            => $id_primary,
        ];
        if (personasModelo::actualizar_personas_modelo($datos_ins_up)) {
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
    }/*------------------ FIN ACTUALIZAR APRENDIZ -----------------------*/
}