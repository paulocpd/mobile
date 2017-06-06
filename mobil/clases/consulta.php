<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/clase_bd.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/paciente.php';
class Consulta extends ClaseBd {
	function declararTabla(){
		$tabla = "consulta";
		$atributos['consulta_id']['esPk'] = true;
		$atributos['consulta_motivo']['esPk'] = false;
		$atributos['consulta_sintomas']['esPk'] = false;
		$atributos['consulta_diagnostico']['esPk'] = false;
		$atributos['consulta_tratamiento']['esPk'] = false;
		$atributos['consulta_fecha']['esPk'] = false;
		$objetos['Paciente']['id'] = "paciente_id";
		$objetos['Usuario']['id'] = "usuario_id";
	   	$strOrderBy = 'consulta_fecha';
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);
	}
	}
?>
