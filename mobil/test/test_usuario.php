<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/usuario.php';

$miUsuario= new Usuario();

$arrUsuario= $miUsuario->consultar();
echo count($arrUsuario);


echo "<table border='1'>";
foreach ($arrUsuario as $i=>$unaUsuario){
	echo "</tr>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_id")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_login")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_clave")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_nombre")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_apellido")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_mail")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_ci")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_telf")."</td>";
	echo "<td>".$arrUsuario[$i]->getAtributo("usua_telf_cell")."</td>";

	
	
	
	echo "</tr>";
	/*
	 * $atributos['usua_clave']['esPk'] = false;
		$atributos['usua_nombre']['esPk'] = false;
		$atributos['usua_apellido']['esPk'] = false;
		$atributos['usua_mail']['esPk'] = false;
		$atributos['usua_ci']['esPk'] = false;
		$atributos['usua_telf ']['esPk'] = false;
		$atributos['usua_telf_cell']['esPk'] = false;
	 */
}

echo "</table>";

?>