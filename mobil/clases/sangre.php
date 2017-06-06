<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/clase_bd.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';

class Sangre extends ClaseBd {
	function declararTabla(){
		$tabla = "sangre";
		$atributos['sangre_id']['esPk'] = true;
		$atributos['sangre_tipo']['esPk'] = false;
		$strOrderBy = 'sangre_id';
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);
	}
	}
?>