<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/sangre.php';
include_once RUTA_SISTEMA.'clases/paciente.php';
include_once RUTA_SISTEMA.'clases/antecedente.php';
$miAntecedente= new Antecedente();

$arrAntecedente= $miAntecedente->consultar();
echo count($arrAntecedente);


echo "<table border='1'>";
foreach ($arrAntecedente as $i=>$unAntecedente){
	echo "</tr>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_id")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_tabaquismo")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_alcohol")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_heredidarias")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_patologica")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_no_patologica")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_sexo")."</td>";
	echo "<td>".$arrAntecedente[$i]->getAtributo("antecedente_fecha_nac")."</td>";
	echo "<td>".$arrAntecedente[$i]->getObjeto("Paciente")->getAtributo("paciente_nombre")."</td>";
	echo "<td>".$arrAntecedente[$i]->getObjeto("Sangre")->getAtributo("sangre_tipo")."</td>";
	echo "</tr>";

}

echo "</table>";

?>
