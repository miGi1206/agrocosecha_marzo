<?php
class ventaControlador extends mainModel
{
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_venta_controlador($pagina, $registros, $id, $url, $busqueda)
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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS tbl_venta.ticket, tbl_venta.fecha_venta, tbl_venta.direccion, tbl_venta.sub_total, tbl_venta.total_venta, tbl_venta.iva, tbl_persona.identificacion, tbl_persona.primer_nombre 
                            FROM tbl_venta 
                            INNER JOIN tbl_persona ON tbl_venta.cod_persona = tbl_persona.identificacion 
                            WHERE tbl_persona.identificacion LIKE '%$busqueda%' 
                            ORDER BY tbl_venta.ticket ASC LIMIT $inicio, $registros";
            } else {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS tbl_venta.ticket, tbl_venta.fecha_venta, tbl_venta.direccion, tbl_venta.sub_total, tbl_venta.total_venta, tbl_venta.iva, tbl_persona.identificacion, tbl_persona.primer_nombre 
                FROM tbl_venta 
                INNER JOIN tbl_persona ON tbl_venta.cod_persona = tbl_persona.codigo_persona 
                ORDER BY tbl_venta.ticket;
                ASC LIMIT $inicio, $registros";
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
            <th class="text-center">Ticket de venta</th>
            <th class="text-center">Fecha de venta</th>
            <th class="text-center">Direccion</th>
            <th class="text-center">Sub total</th>
            <th class="text-center">Total de la venta</th>
            <th class="text-center">Iva</th>
            <th class="text-center">Identificaion de la persona </th>
            <th class="text-center">Nombre</th>
            </tr>
            ';
        if ($total >= 1 &&  $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                    $tabla .=
                        '<tr class="p">
                        <td class="min-width">' . $contador . '</td>
                        <td class="min-width">' . $rows['ticket'] . '</td>
                        <td class="min-width">' . $rows['fecha_venta'] .'</td>
                        <td class="min-width">' . $rows['direccion'] .' </td>
                        <td class="min-width">' . $rows['sub_total'] . '</td> 
                        <td class="min-width">' . $rows['total_venta'] . '</td>
                        <td class="min-width">' . $rows['iva'] . '</td>   
                        <td class="min-width">' . $rows['identificacion'] . '</td>   
                        <td class="min-width">' . $rows['primer_nombre'] . '</td>   
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