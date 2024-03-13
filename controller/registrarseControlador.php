<?php

if ($peticionAjax) {
    require_once "../model/registrarseModelo.php";
} else {
    require_once "./model/registrarseModelo.php";
}

class registrarseControlador extends registrarseModelo
{
    /*------------- CONTROLADOR AGREGAR PERSONA REGISTRARSE -----------------------*/
    public function agregar_registro_controlador()
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
        $tipo_usuario = 2;
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

        $agregar_personas = registrarseModelo::agregar_registro_modelo($datos_personas_add);
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
        $agregar_usuario = registrarseModelo::agregar_registro_usuario_modelo($datos_usuario_add);
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
    }/*------------- FIN AGREGAR PERSONAS REGISTRARSE -----------------------------*/

}