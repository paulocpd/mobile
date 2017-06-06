<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/clase_bd.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
class Paciente extends ClaseBd {
	function declararTabla(){
		$tabla = "paciente";
		$atributos['paciente_id']['esPk'] = true;
		$atributos['paciente_nombre']['esPk'] = false;
		$atributos['paciente_mail']['esPk'] = false;
		$atributos['paciente_ci']['esPk'] = false;
		$atributos['paciente_telf']['esPk'] = false;
		$atributos['paciente_telf_cell']['esPk'] = false;
		$atributos['paciente_dir']['esPk'] = false;
		$objetos['Usuario']['id'] = "usuario_id";
		$strOrderBy = 'paciente_id';
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);
	}
	}
?>