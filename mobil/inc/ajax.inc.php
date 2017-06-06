<?php
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
$xajax = new xajax("ajax.inc.php");
include_once 'ajax_funciones_pp.php';
$xajax->processRequests();
?>