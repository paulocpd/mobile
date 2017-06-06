<?php
include_once 'conf.inc.php';
include_once 'librerias/tbs_class/tbs_class.php';
include_once 'librerias/xajax_0.2.4/xajax.inc.php';

// AJAX
$xajax = new xajax('inc/ajax_funciones.php');
// Carga de la plantilla principal
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('paginas/index.tpl');
$TBS->Show();
?>