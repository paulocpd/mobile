<?php
include_once '../conf.inc.php';
include_once '../librerias/tbs_class/tbs_class.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/consulta.php';
// SE VERIFICA LA SESIÓN Y ACCESO DEL USUARIO

$miConexionBd = new ConexionBd();
$miUsuario = new Usuario($miConexionBd);
validarAcceso($miUsuario);
$paciendeId=$_GET['pacienteId'];

$datos=array();

// AJAX
$xajax = new xajax("../inc/ajax.inc.php");
$xajax->registerFunction("agregarConsulta");
$xajax->registerFunction("mostrarFechasConsulta");
$xajax->registerFunction("mostrarConsulta");
$js = $xajax->getJavascript('../librerias/');
// Carga de la plantilla
$miUsuario->setAtributo("usua_login", $_SESSION['YY']);
$arrUsuario=$miUsuario->consultar();
$usaId=$arrUsuario[0]->getAtributo("usua_id");
//$nombre=$arrUsuario[0]->getAtributo("usua_nombre")." ".$arrUsuario[0]->getAtributo("usua_apellido");


if($paciendeId!=null){
	$datos=null;			
	$miConsulta= new Consulta($miConexionBd);
	$miConsulta->setObjeto("Paciente",$paciendeId);
 	$miConsulta->setObjeto("Usuario",$usaId);
	$arrConsulta=$miConsulta->consultar();
	$nombre=$_GET['nombre'];
 	$cedula=$_GET['cedula'];
	if((count($arrConsulta))>=1){
		foreach ($arrConsulta as $i=>$unaConsulta){
			$datos[$i]['consulta_id'] = $arrConsulta[$i]->getAtributo("consulta_id");
			$datos[$i]['consulta_fecha'] = formatoFecha($arrConsulta[$i]->getAtributo("consulta_fecha"),'d,m,Y');
		}
	}
}
else $datos;


$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../paginas/paciente_consulta.tpl');
$TBS->MergeBlock('datos',$datos);
$TBS->Show();


?>