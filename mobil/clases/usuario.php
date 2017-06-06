<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/clase_bd.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
class Usuario extends ClaseBd {
	function declararTabla(){
		$tabla = "usuario";
		$atributos['usua_id']['esPk'] = true;
		$atributos['usua_login']['esPk'] = false;
		$atributos['usua_clave']['esPk'] = false;
		$atributos['usua_nombre']['esPk'] = false;
		$atributos['usua_apellido']['esPk'] = false;
		$atributos['usua_mail']['esPk'] = false;
		$atributos['usua_ci']['esPk'] = false;
		$atributos['usua_telf']['esPk'] = false;
		$atributos['usua_telf_cell']['esPk'] = false;
		$strOrderBy = 'usua_id';
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);
	}
	}
?>