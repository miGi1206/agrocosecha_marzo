<?php

if ($peticionAjax) {
	require_once "../config/SERVER.php";
} else {
	require_once "./config/SERVER.php";
}

class mainModel
{

	/*--------- Funcion conectar a BD ---------*/
	protected static function conectar()
	{
		$conexion = new PDO(SGBD, USER, PASS);
		$conexion->exec("SET CHARACTER SET utf8");
		return $conexion;
	}


	/*--------- Funcion ejecutar consultas simples ---------*/
	protected static function ejecutar_consulta_simple($consulta)
	{
		$sql = self::conectar()->prepare($consulta);
		$sql->execute();
		return $sql;
	}


	/*--------- Encriptar cadenas ---------*/
	public function encryption($string)
	{
		$output = FALSE;
		$key = hash('sha256', SECRET_KEY);
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
		$output = openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output = base64_encode($output);
		return $output;
	}


	/*--------- Desencriptar cadenas ---------*/
	protected static function decryption($string)
	{
		$key = hash('sha256', SECRET_KEY);
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
		$output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}


	/*--------- Funcion generar codigos aleatorios ---------*/
	protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
	{
		for ($i = 1; $i <= $longitud; $i++) {
			$aleatorio = rand(0, 9);
			$letra .= $aleatorio;
		}
		return $letra . "-" . $numero;
	}


	/*--------- Funcion limpiar cadenas ---------*/
	protected static function limpiar_cadena($cadena)
	{
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = str_ireplace("<script>", "", $cadena);
		$cadena = str_ireplace("</script>", "", $cadena);
		$cadena = str_ireplace("<script src", "", $cadena);
		$cadena = str_ireplace("<script type=", "", $cadena);
		$cadena = str_ireplace("SELECT * FROM", "", $cadena);
		$cadena = str_ireplace("DELETE FROM", "", $cadena);
		$cadena = str_ireplace("INSERT INTO", "", $cadena);
		$cadena = str_ireplace("DROP TABLE", "", $cadena);
		$cadena = str_ireplace("DROP DATABASE", "", $cadena);
		$cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena = str_ireplace("SHOW TABLES", "", $cadena);
		$cadena = str_ireplace("SHOW DATABASES", "", $cadena);
		$cadena = str_ireplace("<?php", "", $cadena);
		$cadena = str_ireplace("?>", "", $cadena);
		$cadena = str_ireplace("--", "", $cadena);
		$cadena = str_ireplace(">", "", $cadena);
		$cadena = str_ireplace("<", "", $cadena);
		$cadena = str_ireplace("[", "", $cadena);
		$cadena = str_ireplace("]", "", $cadena);
		$cadena = str_ireplace("^", "", $cadena);
		$cadena = str_ireplace("==", "", $cadena);
		$cadena = str_ireplace(";", "", $cadena);
		$cadena = str_ireplace("::", "", $cadena);
		$cadena = stripslashes($cadena);
		$cadena = trim($cadena);
		return $cadena;
	}


	/*--------- Funcion verificar datos ---------*/
	protected static function verificar_datos($filtro, $cadena)
	{
		if (preg_match("/^" . $filtro . "$/", $cadena)) {
			return false;
		} else {
			return true;
		}
	}


	/*--------- Funcion verificar fechas ---------*/
	protected static function verificar_fecha($fecha)
	{
		$valores = explode('-', $fecha);
		if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
			return false;
		} else {
			return true;
		}
	}


	/*--------- Funcion paginador de tablas ---------*/
	protected static function paginador_tablas($pagina, $Npaginas, $url, $botones)
	{
		$tabla = '<div class="d-flex justify-content-center" aria-label="Page navigation example"><ul class="pagination" >';

		if ($pagina == 1) {
			$tabla .= '<li class="page-item disabled"><a class="page-link text-success bg-light border-body-tertiary"><i class="bi bi-arrow-left"></i></a></li>';
		} else {
			$tabla .= '
				<li class="page-item"><a class="page-link text-success bg-light border-body-tertiary" href="' . $url . '1/"><i class="bi bi-arrow-left"></i></a></li>
				<li class="page-item"><a class="page-link text-success bg-light border-body-tertiary" href="' . $url . ($pagina - 1) . '/">Anterior</a></li>
				';
		}


		$ci = 0;
		for ($i = $pagina; $i <= $Npaginas; $i++) {
			if ($ci >= $botones) {
				break;
			}

			if ($pagina == $i) {
				$tabla .= '<li class="page-item"><a class="page-link text-light active bg-success border-success" href="' . $url . $i . '/">' . $i . '</a></li>';
			} else {
				$tabla .= '<li class="page-item"><a class="page-link text-success bg-light border-body-tertiary " href="' . $url . $i . '/">' . $i . '</a></li>';
			}

			$ci++;
		}


		if ($pagina == $Npaginas) {
			$tabla .= '<li class="page-item disabled"><a class="page-link bg-light border-body-tertiary text-success"><i class="bi bi-arrow-right"></i></a></li>';
		} else {
			$tabla .= '
				<li class="page-item"><a class="page-link text-success bg-light border-body-tertiary" href="' . $url . ($pagina + 1) . '/">Siguiente</a></li>
				<li class="page-item"><a class="page-link text-success bg-light border-body-tertiary" href="' . $url . $Npaginas . '/"><i class="bi bi-arrow-right"></i>
				</i></a></li>
				';
		}

		$tabla .= '</ul></div>';
		return $tabla;
	}
}
