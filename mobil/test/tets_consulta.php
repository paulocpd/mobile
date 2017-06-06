<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/paciente.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/consulta.php';
$miConsulta= new Consulta();

$arrConsulta = $miConsulta->consultar();
echo count($arrConsulta);


echo "<table border='1'>";
foreach ($arrConsulta as $i=>$unConsulta){
	echo "</tr>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_id")."</td>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_motivo")."</td>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_sintomas")."</td>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_diagnostico")."</td>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_tratamiento")."</td>";
	echo "<td>".$arrConsulta[$i]->getAtributo("consulta_fecha")."</td>";
	echo "<td>".$arrConsulta[$i]->getObjeto("Paciente")->getAtributo("paciente_nombre")."</td>";
	echo "<td>".$arrConsulta[$i]->getObjeto("Usuario")->getAtributo("usua_id")."</td>";
	echo "</tr>";


}

echo "</table>";

?>
