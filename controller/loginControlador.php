<?php
    if ($peticionAjax) {
        require_once "../model/loginModelo.php";
    } else {
        require_once "./model/loginModelo.php";
    }
    class loginControlador extends loginModelo
    {
        /*---------CONTROLADOR INICIAR SECCION---------------*/
        public function iniciar_sesion_controlador()
        {

            $correo = mainModel::limpiar_cadena($_POST['usuario_log']);
            $clave = mainModel::limpiar_cadena($_POST['clave_log']);
            // $clave=mainModel::encryption($clave);

            $datos_login = [
                "Correo" => $correo,
                "Contra" => $clave
            ];

            $iniciar_sesion = loginModelo::iniciar_sesion_modelo($datos_login);

            if ($iniciar_sesion->rowCount() == 1) {
                $row = $iniciar_sesion->fetch();

                session_start(['name' => 'SPM']); 
                // TODO: datos de la persona cuando inicia sesion
                $_SESSION['cod_persona_spm'] = $row['codigo_persona'];
                $_SESSION['id_spm'] = $row['identificacion'];
                $_SESSION['primer_nombre_spm'] = $row['primer_nombre'];
                $_SESSION['segundo_nombre_spm'] = $row['segundo_nombre'];
                $_SESSION['primer_apellido_spm'] = $row['primer_apellido'];
                $_SESSION['segundo_apellido_spm'] = $row['segundo_apellido'];
                $_SESSION['telefono_spm'] = $row['telefono'];
                $_SESSION['correo_spm'] = $row['correo'];
                $_SESSION['sexo_spm'] = $row['cod_sexo'];
                $_SESSION['fecha_nacimiento_spm'] = $row['fecha_nacimiento'];
                $_SESSION['direccion_spm'] = $row['direccion'];
                $_SESSION['fecha_creacion_spm'] = $row['fecha_creacion'];

                // TODO: datos del usuario cuando inicia sesion
                $_SESSION['tipo_usuario_spm'] = $row['cod_tipo_usuario'];
                $_SESSION['codigo_usuario_spm'] = $row['codigo_usuario'];
                $_SESSION['usuario_spm'] = $row['usuario'];
                
                $_SESSION['cod_tipo_usuario_spm'] = $row['tipo_usuario'];
                
                // TODO: datos del proveedor cuando inicia sesion
                $_SESSION['nit_spm'] = $row['nit'];
                $_SESSION['nombre_razonsocial_spm'] = $row['nombre_razonsocial'];
                $_SESSION['telefono_spm'] = $row['telefono'];
                $_SESSION['correo_spm'] = $row['correo'];
                $_SESSION['nombre_contacto_spm'] = $row['nom_per_contacto'];
                $_SESSION['telefono_contacto_spm'] = $row['tel_contacto'];
                $_SESSION['correo_contacto_spm'] = $row['correo_contacto'];

                // TODO: datos del producto cuando se inicia secion
                $_SESSION['nom_producto_spm'] = $row['nombre'];
                $_SESSION['stock_producto_spm'] = $row['stock'];
                $_SESSION['cod_prod_prov_spm'] = $row['codigo_producto'];

                $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));

                
                if ($_SESSION['tipo_usuario_spm'] == 1) { // Si es administrador
                    header("Location: " . SERVERURL . "personas-list/");
                    exit();
                } elseif ($_SESSION['tipo_usuario_spm'] == 2 || $_SESSION['tipo_usuario_spm'] == 3) { // Si es cliente o proveedor
                    header("Location: " . SERVERURL . "home-agro/");
                    exit();
                }                              

            } elseif ($correo == ""  || $clave == "") {
                echo '
                            <script>
                                Swal.fire({
                                        title: "ERROR",
                                        text: "Debes llenar todos los campos que son obligatorios",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                });
                            </script>
                        ';
            } else {
                echo '
                            <script>
                                Swal.fire({
                                        title: "Usuario y contraseña",
                                        text: "Usuario y contraseña son incorrectos",
                                        icon: "error",
                                        confirmButtonText: "Aceptar"
                                });
                            </script>
                        ';
            }
        } //FIN INICIAR

        /*---------FORZAR CIERRE DE SECCION---------------*/
        public function forzar_cierre_sesion_controlador()
        {
            session_unset();
            session_destroy();
            if (headers_sent()) {
                return "<script> window.location.href='" . SERVERURL . "home-agro/'; </script>";
            } else {
                return header("Location: " . SERVERURL . "home-agro/");
            }
        } //fin cierre

        /*---------CONTROLADOR CIERRE DE SECCION---------------*/
        public function cerrar_sesion_controlador()
        {
            session_start(['name' => 'SPM']); 
            $token = mainModel::limpiar_cadena($_POST['token']);
            $nombre = mainModel::limpiar_cadena($_POST['nombre']);

            if ($token == $_SESSION['token_spm'] && $nombre == $_SESSION['id_spm']) {
                session_unset();
                session_destroy();
                $alerta = [
                    "Alerta" => "redireccionar",
                    "URL" => SERVERURL . "home-agro/",
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha podido cerrar sesion",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            exit();
        }
    }//fin controlador