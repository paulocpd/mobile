<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/clase_bd.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/sangre.php';
include_once RUTA_SISTEMA.'clases/paciente.php';
class Antecedente extends ClaseBd {
	function declararTabla(){
		$tabla = "antecedente";
		$atributos['antecedente_id']['esPk'] = true;
		$atributos['antecedente_tabaquismo']['esPk'] = false;
		$atributos['antecedente_alcohol']['esPk'] = false;
		$atributos['antecedente_heredidarias']['esPk'] = false;
		$atributos['antecedente_patologica']['esPk'] = false;
		$atributos['antecedente_no_patologica']['esPk'] = false;
		$atributos['antecedente_sexo']['esPk'] = false;
		$atributos['antecedente_fecha_nac']['esPk'] = false;
		$objetos['Paciente']['id'] = "paciente_id";
		$objetos['Sangre']['id'] = "sangre_id";
		$strOrderBy = 'antecedente_id';
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);

	}
	}
?>