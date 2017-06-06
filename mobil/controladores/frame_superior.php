<?php
include_once '../conf.inc.php';
include_once '../librerias/tbs_class/tbs_class.php';

// Carga de la plantilla
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../paginas/frame_superior.tpl');
$TBS->Show();
?>