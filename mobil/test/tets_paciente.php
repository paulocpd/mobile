<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/paciente.php';

$miPaciente = new Paciente();
$arrPaciente= $miPaciente->consultar();
echo count($arrPaciente);


echo "<table border='1'>";
foreach ($arrPaciente as $i=>$unPaciente){
	echo "</tr>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_id")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_nombre")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_mail")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_ci")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_telf")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_telf_cell")."</td>";
	echo "<td>".$arrPaciente[$i]->getAtributo("paciente_dir")."</td>";
	echo "<td>".$arrPaciente[$i]->getObjeto("Usuario")->getAtributo("usua_id")."</td>";

	echo "</tr>";
	
}

echo "</table>";

?>