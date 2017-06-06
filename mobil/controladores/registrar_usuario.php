<?php
include_once '../conf.inc.php';
include_once '../librerias/tbs_class/tbs_class.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';


// AJAX
$xajax = new xajax("../inc/ajax.inc.php");
$xajax->registerFunction("agregarNuevoUsuario");
$js = $xajax->getJavascript('../librerias/');


// Carga de la plantilla
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../paginas/registrar_usuario.tpl');
$TBS->Show();
?>