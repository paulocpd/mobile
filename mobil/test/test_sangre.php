<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'clases/sangre.php';

$miSangre= new Sangre();

$arrSangre= $miSangre->consultar();
echo count($arrSangre);


echo "<table border='1'>";
foreach ($arrSangre as $i=>$unaSangre){
	echo "</tr>";
	echo "<td>".$arrSangre[$i]->getAtributo("sangre_id")."</td>";
	echo "<td>".$arrSangre[$i]->getAtributo("sangre_tipo")."</td>";
	echo "</tr>";

}

echo "</table>";

?>
