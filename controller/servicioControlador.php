<?php

if ($peticionAjax) {
    require_once "../model/servicioModelo.php";
} else {
    require_once "./model/servicioModelo.php";
}

class servicioControlador extends servicioModelo
{
    /*------------- CONTROLADOR AGREGAR servicio -----------------------*/
    public function agregar_servicio_controlador()
    {
        $codigo = mainModel::limpiar_cadena($_POST['txtcodigo_reg']);
        $nombres = mainModel::limpiar_cadena($_POST['txtNombre_reg']);
        $descricpcion = mainModel::limpiar_cadena($_POST['txtdescripcion_reg']);
        $precio = mainModel::limpiar_cadena($_POST['txtprecio_reg']);
        $duracion = mainModel::limpiar_cadena($_POST['txtduracion_reg']);
        $tipi_servicio = mainModel::limpiar_cadena($_POST['txtservicio_reg']);

        $fotos = $_FILES['txtfotos_reg'];
        
        /* Verificando integridad de los datos */
        if ($nombres == "" || $descricpcion=="" || $precio=="" || $codigo=="" || $duracion=="" || $tipi_servicio=="") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // Validación adicional en el servidor
        if (!preg_match("/^[0-9]+$/", $codigo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El codigo del servicio no cumple con el formato requerido. Debe contener solo números.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $comprobarCodigo = mainModel::ejecutar_consulta_simple("SELECT codigo_servicio  FROM tbl_servicio WHERE codigo_servicio='$codigo'");
        if ($comprobarCodigo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La codigo del servicio ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_servicio_add = [
            "Nombre" => $nombres,
            "codigo_servicio" => $codigo,
            "descripcion" => $descricpcion,
            "precio"=> $precio,
            "duracion" => $duracion,
            "cod_tipo_servicio" => $tipi_servicio,
        ];
    
        $agregar_servicio = servicioModelo::agregar_servicio_modelo($datos_servicio_add);
        if ($agregar_servicio->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Servicio registrado",
                "Texto" => "El servicio se ha registrado",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el servicio.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_servicio_controlador($pagina, $registros, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS s.*, t.tipo_servicio 
            FROM tbl_servicio s 
            INNER JOIN tbl_tipo_servicio t ON s.cod_tipo_servicio = t.codigo_tipo_servicio 
            WHERE s.codigo_servicio != '$id' 
            AND (
                s.nombre LIKE '%$busqueda%' 
                OR s.descripcion LIKE '%$busqueda%'
                OR s.precio LIKE '%$busqueda%'
                OR s.duracion LIKE '%$busqueda%'
                OR t.tipo_servicio LIKE '%$busqueda%'
            )
            ORDER BY s.codigo_servicio ASC 
            LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS s.*, t.tipo_servicio 
                            FROM tbl_servicio s 
                            INNER JOIN tbl_tipo_servicio t ON s.cod_tipo_servicio = t.codigo_tipo_servicio 
                            WHERE s.codigo_servicio != '$id' 
                            ORDER BY s.codigo_servicio ASC 
                            LIMIT $inicio, $registros";
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
                <th class="text-center">Codigo</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Precio</th>
                <th class="text-center">duracion</th>
                <th class="text-center">fecha</th>
                <th class="text-center">Fotos</th>
                <th class="text-center">tipo_servicio</th>
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
                            <td class="min-width">' . $rows['codigo_servicio'] . '</td>
                            <td class="min-width">' . $rows['nombre'] . '</td>  
                            <td class="min-width">' . $rows['descripcion'] . '</td>  
                            <td class="min-width">'. MONEDA . number_format($rows['precio'],0,',','.') . '</td>  
                            <td class="min-width">' . $rows['duracion'] . 'h</td> 
                            <td class="min-width">' . $rows['fecha_registro'] . '</td>  
                            <td class="min-width"><a href="' . SERVERURL . 'imagenes-servicios?id=' . $rows['codigo_servicio'] . '">Ver fotos</a></td>
                            <td class="min-width">' . $rows['tipo_servicio'] . '</td>

                            <td class="stat"><a href="' . SERVERURL . 'servicio-update/' . mainModel::encryption($rows['codigo_servicio']) . '/"</input>
                                <button type="submit" class="btn warnign-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-pencil-square lead"></i>
                                </button>
                            </td>  
                            <td>
                                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/servicioAjax.php" 
                                    method="post" data-form="delete" autocomplete="off"> 		
                                    <input type="hidden" name="idcodigo_del" value="' . mainModel::encryption($rows['codigo_servicio']) . '"></input>
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
    public function eliminar_servicio_controlador()
    {
        try {
            $id = mainModel::decryption($_POST['idcodigo_del']);
            $id = mainModel::limpiar_cadena($id);

            $check_personas = mainModel::ejecutar_consulta_simple("SELECT codigo_servicio FROM tbl_servicio WHERE codigo_servicio  ='$id'");
            if ($check_personas->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "el servicio que intenta eliminar no es existe en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $eliminar_servicio = servicioModelo::eliminar_servicio_modelo($id);

            if ($eliminar_servicio->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "limpiarTime",
                    "Titulo" => "Eliminado",
                    "Texto" => "Se ha eliminado el servicio exitosamente.",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado.",
                    "Texto" => "No hemos podido eliminar el servicio.",
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
                    "Texto" => "No se puede eliminar esta servicio porque tiene registros relacionados.",
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
    }/*-------------- FIN ELIMINAR servicio--------------------------*/

    /*------------- CONTROLADOR ACTUALIZAR SERVICIO -----------------------*/
    public function datos_servicio_controlador($id){
        $id=mainModel::decryption($id);
        return servicioModelo::datos_servicio_modelo($id);
    }
    public function actualizar_servicio_controlador()
    {
        $id = mainModel::decryption($_POST['updateservicios']);
        $id= mainModel::limpiar_cadena($id);

        $check_ins = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_servicio WHERE codigo_servicio ='$id'");
        if ($check_ins->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos encontrado el servicio en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_ins->fetch();
        }
        $nombres = mainModel::limpiar_cadena($_POST['updateNombre']);
        $descricpcion = mainModel::limpiar_cadena($_POST['updatedescripcion']);
        $precio = mainModel::limpiar_cadena($_POST['updateprecio']);
        $duracion = mainModel::limpiar_cadena($_POST['updateduracion']);
        $tipi_servicio = mainModel::limpiar_cadena($_POST['updateservicio']);
    

        /* Verificando integridad de los datos */ 
        /* Verificando integridad de los datos */
        if ($nombres == "" || $descricpcion=="" || $precio=="" || $duracion=="" || $tipi_servicio=="" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        
        $datos_ins_up = [
            "Nombre" => $nombres,
            "descripcion" => $descricpcion,
            "precio"=> $precio,
            "duracion" => $duracion,
            "cod_tipo_servicio" => $tipi_servicio,
            "id" => $id,
    
        ];
        if (servicioModelo::actualizar_servicio_modelo($datos_ins_up)) {
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