<?php
include_once '../conf.inc.php';
include_once '../librerias/tbs_class/tbs_class.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
// SE VERIFICA LA SESIÓN Y ACCESO DEL USUARIO

$miConexionBd = new ConexionBd();
$miUsuario = new Usuario($miConexionBd);
validarAcceso($miUsuario);





// AJAX
$xajax = new xajax("../inc/ajax.inc.php");
$xajax->registerFunction("mostrarPaciente");
$xajax->registerFunction("buscarPaciente");
$xajax->registerFunction("addPatient");

// Carga de la plantilla
$miUsuario->setAtributo("usua_login", $_SESSION['YY']);
$arrUsuario=$miUsuario->consultar();
$usaId=$arrUsuario[0]->getAtributo("usua_id");
$nombre=$arrUsuario[0]->getAtributo("usua_nombre")." ".$arrUsuario[0]->getAtributo("usua_apellido");
$js = $xajax->getJavascript('../librerias/');

// Carga de la plantilla
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../paginas/main.tpl');
$TBS->Show();
?>