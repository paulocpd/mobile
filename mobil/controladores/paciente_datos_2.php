<?php
include_once '../conf.inc.php';
include_once '../librerias/tbs_class/tbs_class.php';
include_once '../librerias/tbs_class/tbs_plugin_html.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/sangre.php';

// SE VERIFICA LA SESIÓN Y ACCESO DEL USUARIO
$miConexionBd = new ConexionBd();
$miUsuario = new Usuario($miConexionBd);
validarAcceso($miUsuario);
$celdasTemp=array();
// AJAX
$xajax = new xajax("../inc/ajax.inc.php");
$xajax->registerFunction("buscarAntecedente");
$xajax->registerFunction("consultarAntecedentes");
$xajax->registerFunction("buscarPaciente");
$xajax->registerFunction("agregarAntecedente");
$js = $xajax->getJavascript('../librerias/');
$datos = array();
$miSangre= new Sangre($miConexionBd);
$arrSangre = $miSangre->consultar();


$cadena=$_GET['cadena'];
//$cadena=$tabaquismo."-".$alcohol."-".$heredidarias."-".$patologica."-".$no_patologica."-".$sexo."-".$sangre."-".$fecha_nac;
$miUsuario->setAtributo("usua_login", $_SESSION['YY']);
$arrUsuario=$miUsuario->consultar();
$usaId=$arrUsuario[0]->getAtributo("usua_id");
$celdasTemp = explode("-",$cadena);

;	
foreach ($arrSangre as $j=>$unTipoSangre){
	$datos[$j]['sangre_id']=$arrSangre[$j]->getAtributo("sangre_id");
	$datos[$j]['sangre_tipo']=$arrSangre[$j]->getAtributo("sangre_tipo");	
	if($datos[$j]['sangre_id']==$celdasTemp[6]){
		$datos[$j]['seleccion']="selected";
					}
		else $datos[$j]['seleccion']= "";
}
if($celdasTemp[0]==s) $tabaquismo="checked";
if($celdasTemp[0]==n) $Notabaquismo="checked";
if($celdasTemp[5]==f) $m="checked";
if($celdasTemp[5]==m) $f="checked";
$alcohol=$celdasTemp[1];
$heredidarias=$celdasTemp[2];
$patologica=$celdasTemp[3];
$no_patologica=$celdasTemp[4];
$fecha_nac=$celdasTemp[7];
$paciente=$celdasTemp[8];
$cedula=$celdasTemp[9];
//echo "<pre>";
//print_r($datos);
//echo "<pre>";





 // Carga de la plantilla
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../paginas/paciente_datos_2.tpl');
$TBS->MergeBlock('datos',$datos);
$TBS->Show();
?>