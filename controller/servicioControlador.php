<?php

if ($peticionAjax) {
    require_once "../model/servicioModelo.php";
} else {
    require_once "./model/servicioModelo.php";
}

class servicioControlador extends servicioModelo
{
    /*------------- CONTROLADOR AGREGAR producto -----------------------*/
    public function agregar_servicio_controlador()
    {
        $codigo = mainModel::limpiar_cadena($_POST['txtcodigo_reg']);
        $nombres = mainModel::limpiar_cadena($_POST['txtNombre_reg']);
        $descricpcion = mainModel::limpiar_cadena($_POST['txtdescripcion_reg']);
        $precio = mainModel::limpiar_cadena($_POST['txtprecio_reg']);
        $duracion = mainModel::limpiar_cadena($_POST['txtsduracion_ins']);
        $tipo_servicio = mainModel::limpiar_cadena($_POST['txtTipo_servicio_ins']);
    
        // Validación adicional en el servidor
        if (!preg_match("/^[0-9]+$/", $codigo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El codigo del producto no cumple con el formato requerido. Debe contener solo números.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
    
        /* Verificando integridad de los datos */
        if ($nombres == "" || $descricpcion=="" || $precio=="" || $codigo=="" || $duracion=="" || $tipo_servicio=="") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        $datos_servicio = [
            "Nombre" => $nombres,
            "codigo_servicio" => $codigo,
            "descripcion" => $descricpcion,
            "precio"=> $precio,
            "duracion" => $duracion,
            "cod_tipo_servicio" => $tipo_servicio,
        ];
    
        $agregar_servicio = servicioModelo::agregar_servicio_modelo($datos_servicio);
        if ($agregar_servicio->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Mesas registradas",
                "Texto" => " el servicio se ha registrado",
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
    

//     /*--------------------- TABLA PAGINADOR ---------------------------*/
//     public function paginador_producto_controlador($pagina, $registros, $id, $url, $busqueda)
//     {
//         $pagina = mainModel::limpiar_cadena($pagina);
//         $registros = mainModel::limpiar_cadena($registros);
//         $id = mainModel::limpiar_cadena($id);
//         $url = mainModel::limpiar_cadena($url);
//         $url = SERVERURL . $url . "/";
//         $busqueda = mainModel::limpiar_cadena($busqueda);
//         $tabla = "";
        
//         $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
//         $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
        
//         if (isset($busqueda) && $busqueda != "") {
//             $consulta = "SELECT SQL_CALC_FOUND_ROWS codigo_producto, nombre, descripcion, precio, stock, video, fecha_registro FROM tbl_producto WHERE nombre LIKE '%$busqueda%' ORDER BY nombre ASC LIMIT $inicio, $registros";
//         } else {
//             $consulta = "SELECT SQL_CALC_FOUND_ROWS codigo_producto, nombre, descripcion, precio, stock, video, fecha_registro FROM tbl_producto ORDER BY nombre ASC LIMIT $inicio, $registros";
//         }
        
//         $conexion = mainModel::conectar();
//         $datos = $conexion->query($consulta);
//         $datos = $datos->fetchAll();

//         $total = $conexion->query("SELECT FOUND_ROWS()");
//         $total = (int) $total->fetchColumn();
        
//         $Npaginas = ceil($total / $registros);

//         $tabla .= '<div class="">
//             <table class="table table-hover table-sm">
//             <tr>
//             <th class="text-center">N°</th>
//             <th class="text-center">Codigo</th>
//             <th class="text-center">Nombre</th>
//             <th class="text-center">Descripcion</th>
//             <th class="text-center">Precio</th>
//             <th class="text-center">Stock</th>
//             <th class="text-center">Video</th>
//             <th class="text-center">Fecha</th>
//             <th class="text-center" colspan="2">Acciones</th>
//             </tr>
//             ';
//         if ($total >= 1 &&  $pagina <= $Npaginas) {
//             $contador = $inicio + 1;
//             $reg_inicio = $inicio + 1;
//             foreach ($datos as $rows) {
//                     $tabla .=
//                         '<tr class="p">
//                         <td class="min-width">' . $contador . '</td>
//                         <td class="min-width">' . $rows['codigo_producto'] . '</td>
//                         <td class="min-width">' . $rows['nombre'] . '</td>  
//                         <td class="min-width">' . $rows['descripcion'] . '</td>  
//                         <td class="min-width">' . $rows['precio'] . '</td>  
//                         <td class="min-width">' . $rows['stock'] . '</td>  
//                         <td class="min-width">' . $rows['video'] . '</td>  
//                         <td class="min-width">' . $rows['fecha_registro'] . '</td>

//                         <td class="stat"><a href="' . SERVERURL . 'producto-update/' . mainModel::encryption($rows['codigo_producto']) . '/"</input>
//                             <button type="submit" class="btn warnign-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
//                                 <i class="bi bi-pencil-square lead"></i>
//                             </button>
//                         </td>  
//                         <td>
//                             <form class="FormularioAjax" action="' . SERVERURL . 'ajax/productoAjax.php" 
//                                 method="post" data-form="delete" autocomplete="off"> 		
//                                 <input type="hidden" name="idcodigo_del" value="' . mainModel::encryption($rows['codigo_producto']) . '"></input>
//                                 <button type="submit" class="btn danger-btn">
//                                     <i class="bi bi-trash3 lead"></i>
//                                 </button>
//                             </form>
//                         </td>
//                     </tr>';
                
//                 $contador++;
//             }
//             $reg_final = $contador - 1;
//         } else {
//             if ($total >= 1) {
//                 $tabla .= '<tr style="border-bottom: 1px solid white;">
//                     <td colspan="9"><a href="' . $url . '" class="btn btn-raised btn-info btn-sm">
//                     Haga click aqui para cargar nuevamnete la lista <i class="icon ion-md-refresh lead"></i></a></td></tr>';
//             } else {
//                 $tabla .= '<tr style="border-bottom: 1px solid white;">
//                     <td colspan="9">No hay registros en el Sistema</td></tr>';
//             }
//         }

//         $tabla .= '</table> </div>';
//         if ($total >= 1 && $pagina <= $Npaginas) {
//             $tabla .= '<p class="text-end text-muted mt-5">Lista de Personas ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
//             $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
//         }

//         return $tabla;
//     }/*------------------- FIN TABLA ---------------------------------*/

//     /*------------- CONTROLADOR ACTUALIZAR mesa -----------------------*/
//     public function datos_producto_controlador($id){
//         $id=mainModel::decryption($id);
//         return productoModelo::datos_producto_modelo($id);
//     }
    
//     public function actualizar_producto_controlador()
//     {
//         $id = mainModel::decryption($_POST['updateproducto']);
//         $id= mainModel::limpiar_cadena($id);

//         $check_ins = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_producto WHERE codigo_producto ='$id'");
//         if ($check_ins->rowCount() <= 0) {
//             $alerta = [
//                 "Alerta" => "simple",
//                 "Titulo" => "Ocurrió un error inesperado.",
//                 "Texto" => "No hemos encontrado la persona en el sistema",
//                 "Tipo" => "error"
//             ];
//             echo json_encode($alerta);
//             exit();
//         } else {
//             $campos = $check_ins->fetch();
//         }
//         $nombres = mainModel::limpiar_cadena($_POST['updateNombre']);
//         $descricpcion = mainModel::limpiar_cadena($_POST['updatedescripcion']);
//         $precio = mainModel::limpiar_cadena($_POST['updateprecio']);
//         $stock = mainModel::limpiar_cadena($_POST['updatetstock']);
//         $video = mainModel::limpiar_cadena($_POST['updatetvideo']);
       

//         /* Verificando integridad de los datos */ 
//         /* Verificando integridad de los datos */
//         if ($nombres == "" || $descricpcion=="" || $precio=="" || $stock=="" || $video=="") {
//             $alerta = [
//                 "Alerta" => "simple",
//                 "Titulo" => "Ocurrio un error inesperado",
//                 "Texto" => "No has llenado todos los campos que son obligatorios",
//                 "Tipo" => "error"
//             ];
//             echo json_encode($alerta);
//             exit();
//         }
     
//         // Validación adicional en el servidor
//         // if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\s*#\s*[0-9]+$/", $nombres)) {
//         //     $alerta = [
//         //         "Alerta" => "simple",
//         //         "Titulo" => "Ocurrió un error inesperado",
//         //         "Texto" => "El nombre no cumple con el formato requerido Ej:(mesa #21).",
//         //         "Tipo" => "error"
//         //     ];
//         //     echo json_encode($alerta);
//         //     exit();
//         // }
        

//         $datos_ins_up = [
//             "Nombre" => $nombres,
//             "descripcion" => $descricpcion,
//             "precio"=> $precio,
//             "stock" => $stock,
//             "video" => $video,
//             "id" => $id,
       
//         ];
//         if (productoModelo::actualizar_producto_modelo($datos_ins_up)) {
//             $alerta = [
//                 "Alerta" => "recargar",
//                 "Titulo" => "Datos actualizados",
//                 "Texto" => "Los datos han sido actualizados exitosamente",
//                 "Tipo" => "success"
//             ];
//         } else {
//             $alerta = [
//                 "Alerta" => "simple",
//                 "Titulo" => "Ocurrió un error inesperado",
//                 "Texto" => "No hemos podido actualizar tus datos ;(",
//                 "Tipo" => "error"
//             ];
//         }
//         echo json_encode($alerta);
//         exit();
//     }/*------------------ FIN ACTUALIZAR APRENDIZ -----------------------*/

//     /*------------- CONTROLADOR ELIMINAR mesa --------------------*/
//     public function eliminar_producto_controlador()
//     {
//         $id = mainModel::decryption($_POST['idcodigo_del']);
//         $id = mainModel::limpiar_cadena($id);

//         $check_producto = mainModel::ejecutar_consulta_simple("SELECT codigo_producto  FROM tbl_producto WHERE codigo_producto='$id'");
//         if ($check_producto->rowCount() <= 0) {
//             $alerta = [
//                 "Alerta" => "simple",
//                 "Titulo" => "Ocurrio un error inesperado",
//                 "Texto" => "la mesa que intenta eliminar no es existe en el sistema",
//                 "Tipo" => "error"
//             ];
//             echo json_encode($alerta);
//             exit();
//         }
//         $eliminar_producto = productoModelo::eliminar_producto_modelo($id);

//         if ($eliminar_producto->rowCount() == 1) {
//             $alerta = [
//                 "Alerta" => "limpiarTime",
//                 "Titulo" => "Eliminado",
//                 "Texto" => "Se ha eliminado la mesa exitosamente.",
//                 "Tipo" => "success"
//             ];
//         } else {
//             $alerta = [
//                 "Alerta" => "simple",
//                 "Titulo" => "Ocurrió un error inesperado.",
//                 "Texto" => "No hemos podido eliminar la mesa.",
//                 "Tipo" => "error"
//             ];
//         }
//         echo json_encode($alerta);
// }
}
