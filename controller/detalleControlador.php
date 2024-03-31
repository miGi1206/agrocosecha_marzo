<?php
class detalleControlador extends mainModel
{
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_detalle_controlador($pagina, $registros, $id, $url, $busqueda)
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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS tbl_detalle.codigo_detalle, tbl_detalle.precio_unitario, tbl_detalle.cantidad, tbl_detalle.subtotal, tbl_detalle.cod_producto, tbl_detalle.cod_venta, tbl_producto.nombre AS nombre_producto FROM tbl_detalle INNER JOIN tbl_producto ON tbl_detalle.cod_producto = tbl_producto.codigo_producto WHERE tbl_detalle.cod_producto LIKE '%$busqueda%' ORDER BY tbl_detalle.codigo_detalle ASC LIMIT $inicio, $registros";
            } else {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS tbl_detalle.codigo_detalle, tbl_detalle.precio_unitario, tbl_detalle.cantidad, tbl_detalle.subtotal, tbl_detalle.cod_producto, tbl_detalle.cod_venta, tbl_producto.nombre AS nombre_producto FROM tbl_detalle INNER JOIN tbl_producto ON tbl_detalle.cod_producto = tbl_producto.codigo_producto ORDER BY tbl_detalle.codigo_detalle ASC LIMIT $inicio, $registros";
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
            <th class="text-center">Codigo de detalle</th>
            <th class="text-center">Precio unitario</th>
            <th class="text-center">catidad</th>
            <th class="text-center">subtotal</th>
            <th class="text-center">producto</th>
            <th class="text-center">codigo de venta</th>
            </tr>
            ';
        if ($total >= 1 &&  $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                    $tabla .=
                        '<tr class="p">
                        <td class="min-width">' . $contador . '</td>
                        <td class="min-width">' . $rows['codigo_detalle'] . '</td>
                        <td class="min-width">' . $rows['precio_unitario'] .'</td>
                        <td class="min-width">' . $rows['cantidad'] .' </td>
                        <td class="min-width">' . $rows['subtotal'] . '</td> 
                        <td class="min-width">' . $rows['nombre_producto'] . '</td>
                        <td class="min-width">' . $rows['cod_venta'] . '</td>   
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
}