<?php
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
include_once RUTA_SISTEMA.'clases/usuario.php';
include_once RUTA_SISTEMA.'clases/paciente.php';
include_once RUTA_SISTEMA.'clases/antecedente.php';
include_once RUTA_SISTEMA.'clases/consulta.php';
$xajax->registerFunction("mostrarConsulta");
$xajax->registerFunction("mostrarFechasConsulta");
$xajax->registerFunction("agregarConsulta");
$xajax->registerFunction("agregarAntecedente");
$xajax->registerFunction("buscarAntecedente");
$xajax->registerFunction("consultarAntecedentes");
$xajax->registerFunction("mostrarPaciente");
$xajax->registerFunction("buscarPaciente");
$xajax->registerFunction("addPatient");
$xajax->registerFunction("validarUsuario");
$xajax->registerFunction("agregarNuevoUsuario");

function mostrarConsulta($usuId,$cedula,$fechaLast){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$arrPaciente = buscarPaciente($cedula,$usuarioId);
	if(count($arrPaciente)==1){
		$pacienteId=$arrPaciente[0]->getAtributo("paciente_id");
		$arrConsulta=getConsultas($usuId,$pacienteId,$fechaLast);
		if(count($arrConsulta)==1){
			
		$sintomas=$arrConsulta[0]->getAtributo("consulta_sintomas");
		$dig=$arrConsulta[0]->getAtributo("consulta_diagnostico");
		$medica=$arrConsulta[0]->getAtributo("consulta_motivo");
		$trata=$arrConsulta[0]->getAtributo("consulta_tratamiento");
		$fecha=formatoFecha($arrConsulta[0]->getAtributo("consulta_fecha"),'d,m,Y');
		$objResponse->addScript("document.getElementById('fechaCons').value = '$fecha'");
		$objResponse->addScript("document.getElementById('sintomasTxt').value = '$sintomas'");
		$objResponse->addScript("document.getElementById('diagTxt').value = '$dig'");
		$objResponse->addScript("document.getElementById('medicaTxt').value = '$medica'");
		$objResponse->addScript("document.getElementById('trataTxt').value = '$trata'");
		}	
		else $objResponse->addAlert("No contien consulta registrada");
	}
	else {$objResponse->addAlert("Este paciente no se encuentra registrado");}
	return $objResponse;
}
function mostrarFechasConsulta($cedula,$usuarioId){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$arrPaciente = buscarPaciente($cedula,$usuarioId);
	if(count($arrPaciente)==1){
		$pacienteId=$arrPaciente[0]->getAtributo("paciente_id");
		$nombre=$arrPaciente[0]->getAtributo("paciente_nombre");
		$arrConsulta=getConsultas($usuId,$pacienteId,null);
		if(count($arrConsulta)<1){$objResponse->addAlert("Este paciente no tiene consultas registradas");}
		
		else {
			$objResponse->addScript("window.open('../controladores/paciente_consulta.php?pacienteId=$pacienteId&cedula=$cedula&nombre=$nombre','_self');");;}
	}
	else {$objResponse->addAlert("Este paciente no se encuentra registrado");}
	return $objResponse;
}



function agregarConsulta($usuId,$cedula,$fechaCons,$sintomas,$diag,$trata,$medi){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$miConsulta = new Consulta($miConexionBd);
	$arrPaciente = buscarPaciente($cedula,$usuarioId);
	$fechaCons= formatoFechaBd($fechaCons);
	if(count($arrPaciente)==1){
		$pacienteId=$arrPaciente[0]->getAtributo("paciente_id");
		
		
		$arrConsulta=getConsultas($usuId,$pacienteId,null,$fechaCons);
		$medi = preg_replace('/[\r?\n]+/','',$medi);
		$sintomas=preg_replace('/[\r?\n]+/','',$sintomas);
		$diag=preg_replace('/[\r?\n]+/','',$diag);
		$trata=preg_replace('/[\r?\n]+/','',$trata);	
		if(count($arrConsulta)<1){
			$miConsulta->setAtributo("consulta_sintomas", $sintomas);
			$miConsulta->setAtributo("consulta_diagnostico", $diag);
			$miConsulta->setAtributo("consulta_motivo", $medi);
			$miConsulta->setAtributo("consulta_tratamiento", $trata);
			$miConsulta->setAtributo("consulta_fecha", $fechaCons);
			$miConsulta->setObjeto("Paciente", $pacienteId);
			$miConsulta->setObjeto("Usuario", $usuId);
			if($miConsulta->registrar())$objResponse->addAlert("Se ha sido registrada la consulta");
			else $objResponse->addAlert("Falla de registro");
	
		}
		else{ 
			if (count($arrConsulta)==1){
			$arrConsulta[0]->setAtributo("consulta_sintomas", $sintomas);
			$arrConsulta[0]->setAtributo("consulta_diagnostico", $diag);
			$arrConsulta[0]->setAtributo("consulta_motivo", $medi);
			$arrConsulta[0]->setAtributo("consulta_tratamiento", $trata);
			$arrConsulta[0]->setAtributo("consulta_fecha", $fechaCons);
			$arrConsulta[0]->setObjeto("Paciente", $pacienteId);
			$arrConsulta[0]->setObjeto("Usuario", $usuId);
			($arrConsulta[0]->modificar()==true)?$objResponse->addAlert("Consulta modificada"):$objResponse->addAlert("Falla de modificación");
			}
			else $objResponse->addAlert("El paciente no tiene consultas registradas");}
	}
	else {$objResponse->addAlert("Este paciente no se encuentra registrado");}
	return $objResponse;
}
function getConsultas($usuId,$pacienteId,$consultaId,$fechaCosul){
		$miConexionBd= new ConexionBd();
		$miConsulta = new Consulta($miConexionBd);
		$miConsulta->setAtributo("consulta_fecha",$fechaCosul);
		$miConsulta->setAtributo("consulta_id",$consultaId);
		$miConsulta->setObjeto("Paciente",$pacienteId);
		$miConsulta->setObjeto("Usuario",$usuId);
		return $miConsulta->consultar();
		
}


function agregarAntecedente($tabaquismo,$alcohol,$heredidarias,$patologica,$noPatologica,$sexo,$fecha,$sangreId,$cedula,$usuarioId){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$miAntecedente = new Antecedente($miConexionBd);
	$arrPaciente = buscarPaciente($cedula,$usuarioId);
	$fecha=formatoFechaBd($fecha);	
	if(count($arrPaciente)==1){
		$pacienteId=$arrPaciente[0]->getAtributo("paciente_id");
		$arrAntencedente=consultarAntecedentes($cedula,$usuarioId);	
			if(count($arrAntencedente)<1){
						
				$miAntecedente->setAtributo("antecedente_tabaquismo", $tabaquismo);
				$miAntecedente->setAtributo("antecedente_alcohol", $alcohol);
				$miAntecedente->setAtributo("antecedente_heredidarias", $heredidarias);
				$miAntecedente->setAtributo("antecedente_patologica", $patologica);
				$miAntecedente->setAtributo("antecedente_no_patologica", $noPatologica);
				$miAntecedente->setAtributo("antecedente_sexo", $sexo);
				$miAntecedente->setAtributo("antecedente_fecha_nac",$fecha);
				$miAntecedente->setObjeto("Sangre",$sangreId);
				$miAntecedente->setObjeto("Paciente",$pacienteId);
					if($miAntecedente->registrar()==true)$objResponse->addAlert("Los antecedentes han sido registrados");	
					else $objResponse->addAlert("Falla de datos");	
			}
			else {
		
				$arrAntencedente[0]->setAtributo("antecedente_tabaquismo", $tabaquismo);
				$arrAntencedente[0]->setAtributo("antecedente_alcohol", $alcohol);
				$arrAntencedente[0]->setAtributo("antecedente_heredidarias", $heredidarias);
				$arrAntencedente[0]->setAtributo("antecedente_patologica", $patologica);
				$arrAntencedente[0]->setAtributo("antecedente_no_patologica", $noPatologica);
				$arrAntencedente[0]->setAtributo("antecedente_sexo", $sexo);
				$arrAntencedente[0]->setAtributo("antecedente_fecha_nac",$fecha);
				$arrAntencedente[0]->setObjeto("Sangre",$sangreId);
				$arrAntencedente[0]->setObjeto("Paciente",$pacienteId);
					if($arrAntencedente[0]->modificar()==true)$objResponse->addAlert("Modificación realizada");	
					else $objResponse->addAlert("Falla de datos");
				}
			}
	else {$objResponse->addAlert("Este paciente no se encuentra registrado");	}
	
	return $objResponse;
}
function consultarAntecedentes($cedula,$usuarioId){
	$miConexionBd = new ConexionBd();
	$arrPaciente=buscarPaciente($cedula,$usuarioId);
	if((count($arrPaciente))==1){
		$miAntecedente= new Antecedente($miConexionBd);
		$miAntecedente->setObjeto("Paciente",$arrPaciente[0]->getAtributo("paciente_id"));
		$arrAntecedente =$miAntecedente->consultar();
		return $arrAntecedente;
	}
 }
function buscarAntecedente($cedula,$usuarioId){
		$miConexionBd = new ConexionBd();
		$arrAntecedente =consultarAntecedentes($cedula,$usuarioId);
		$objResponse = new xajaxResponse();
		if(count($arrAntecedente)==1){
			//$objResponse->addAlert("Tiene antecedentes");
		
			$tabaquismo=$arrAntecedente[0]->getAtributo("antecedente_tabaquismo");
			$alcohol=$arrAntecedente[0]->getAtributo("antecedente_alcohol");
			$heredidarias=$arrAntecedente[0]->getAtributo("antecedente_heredidarias");
			$patologica=$arrAntecedente[0]->getAtributo("antecedente_patologica");
			$no_patologica=$arrAntecedente[0]->getAtributo("antecedente_no_patologica");
			$sexo=$arrAntecedente[0]->getAtributo("antecedente_sexo");
			$sangre=$arrAntecedente[0]->getObjeto("Sangre")->getAtributo("sangre_id");
			$paciente=$arrAntecedente[0]->getObjeto("Paciente")->getAtributo("paciente_nombre");
			$fecha_nac=formatoFecha($arrAntecedente[0]->getAtributo("antecedente_fecha_nac"));
			$cadena=$tabaquismo."-".$alcohol."-".$heredidarias."-".$patologica."-".$no_patologica."-".$sexo."-".$sangre."-".$fecha_nac."-".$paciente."-".$cedula;
			$objResponse->addScript("window.open('../controladores/paciente_datos_2.php?cadena=$cadena','_self');");
			
		}
		else {
		$objResponse->addAlert("No tiene antecedentes medicos registrados ");
		}
		return $objResponse;
}




function mostrarPaciente($cedula,$usuarioId){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$arrPaciente=buscarPaciente($cedula,$usuarioId);
	if(count($arrPaciente)==1){
	$nombre=$arrPaciente[0]->getAtributo("paciente_nombre");
	$mail=$arrPaciente[0]->getAtributo("paciente_mail");
	$ci=$arrPaciente[0]->getAtributo("paciente_ci");
	$telf=$arrPaciente[0]->getAtributo("paciente_telf");
	$telfCell=$arrPaciente[0]->getAtributo("paciente_telf_cell");
	$dir=$arrPaciente[0]->getAtributo("paciente_dir");
	$objResponse->addScript("document.getElementById('cedula').value = '$ci'");
	$objResponse->addScript("document.getElementById('nombre').value = '$nombre'");
	$objResponse->addScript("document.getElementById('email').value = '$mail'");
	$objResponse->addScript("document.getElementById('telefono').value = '$telf'");
	$objResponse->addScript("document.getElementById('telefonoCell').value = '$telfCell'");
	$objResponse->addScript("document.getElementById('direc').value = '$dir'");
	}
	else {
	$objResponse->addScript("document.getElementById('cedula').value = ''");
	$objResponse->addScript("document.getElementById('nombre').value = ''");
	$objResponse->addScript("document.getElementById('email').value = ''");
	$objResponse->addScript("document.getElementById('telefono').value = ''");
	$objResponse->addScript("document.getElementById('telefonoCell').value = ''");
	$objResponse->addScript("document.getElementById('direc').value = ''");
	}	
	return $objResponse;
}

function buscarPaciente($cedula,$usuarioId){
	$miConexionBd = new ConexionBd();
	$miPaciente= new Paciente($miConexionBd);
	$miPaciente->setObjeto("Usuario",$usuarioId);
	$miPaciente->setAtributo("paciente_ci",$cedula);
	$arrPaciente=$miPaciente->consultar();
	return $arrPaciente;
}

function addPatient($nombre,$mail,$cedula,$tel,$telfCell,$dirc,$usuario){
	$miConexionBd = new ConexionBd();
	$objResponse = new xajaxResponse();
	$miPaciente= new Paciente($miConexionBd);
	$arrPaciente= buscarPaciente($cedula,$usuario);
	if(count($arrPaciente)<1){
		$miPaciente->setAtributo("paciente_nombre",$nombre);
		$miPaciente->setAtributo("paciente_mail",$mail);
		$miPaciente->setAtributo("paciente_ci",$cedula);
		$miPaciente->setAtributo("paciente_telf",$tel);
		$miPaciente->setAtributo("paciente_telf_cell",$telfCell);
		$miPaciente->setAtributo("paciente_dir",$dirc);
		$miPaciente->setObjeto("Usuario", $usuario);
		if($miPaciente->registrar())$objResponse->addAlert("Nuevo paciente agregado");
		else $objResponse->addAlert("Falla en el registro");
		
	}
	if(count($arrPaciente)==1){
	$nombre=$arrPaciente[0]->getAtributo("paciente_nombre");
	$mail=$arrPaciente[0]->getAtributo("paciente_mail");
	$ci=$arrPaciente[0]->getAtributo("paciente_ci");
	$telf=$arrPaciente[0]->getAtributo("paciente_telf");
	$telfCell=$arrPaciente[0]->getAtributo("paciente_telf_cell");
	$dir=$arrPaciente[0]->getAtributo("paciente_dir");
	$objResponse->addScript("document.getElementById('cedula').value = '$ci'");
	$objResponse->addScript("document.getElementById('nombre').value = '$nombre'");
	$objResponse->addScript("document.getElementById('email').value = '$mail'");
	$objResponse->addScript("document.getElementById('telefono').value = '$telf'");
	$objResponse->addScript("document.getElementById('telefonoCell').value = '$telfCell'");
	$objResponse->addScript("document.getElementById('direc').value = '$dir'");

	}
	return $objResponse;
}

/**
 * 
 * Esta función permite validar el usuario
 * @param $login esta variable es de tipo string
 * @param $clave esta variable es de tipo string
 */
function validarUsuario($login,$clave){
	$miConexionBd = new ConexionBd();
	$miUsurio= new Usuario($miConexionBd);
	$objResponse = new xajaxResponse();
	$login = strMayus(limpiarPalabra($login));
	$miUsurio->setAtributo("usua_login",$login);
	$miUsurio->setAtributo("usua_clave",sha1(sha1($login.$clave)));
	$arrMiUsuario=$miUsurio->consultar();
	if(count($arrMiUsuario)==1){
		session_start();
		$_SESSION['YY'] = $login;
		$_SESSION['XX'] = sha1($login.$clave);
		$_SESSION['exp'] = time()+EXP;
		$objResponse->addScript("window.open('../controladores/main.php','_self');");
	}
	else {
		$objResponse->addAlert("Verifique su usuario o clave");
		session_unset();
		session_destroy();
	}
	
	return $objResponse;
}


/**
 * 
 * Esta funcion permite verificar y crear un nuevo.
 * @param $login string 
 * @param $clave string 
 * @param $nombre string 
 * @param $apellido string 
 * @param $mail string 
 * @param $ci string 
 * @param $telfOfic string 
 * @param $telCell string 
 */
function agregarNuevoUsuario($login,$clave,$nombre,$apellido,$mail,$ci,$telfOfic,$telCell){
	$miConexionBd = new ConexionBd();
	$miUsurio= new Usuario($miConexionBd);
	$objResponse = new xajaxResponse();
	$login=strMayus(limpiarPalabra($login));
	$miUsurio->setAtributo("usua_login",$login);
	$arrMiUsurio=$miUsurio->consultar();
	if(count($arrMiUsurio)<1){
		$miUsurio->setAtributo("usua_login",$login);
		$miUsurio->setAtributo("usua_clave",sha1(sha1($login.$clave)));
		$miUsurio->setAtributo("usua_nombre",$nombre);
		$miUsurio->setAtributo("usua_apellido",$apellido);
		$miUsurio->setAtributo("usua_mail",$mail);
		$miUsurio->setAtributo("usua_ci",$ci);
		$miUsurio->setAtributo("usua_telf",$telfOfic);
		$miUsurio->setAtributo("usua_telf_cell",$telCell);
		if($miUsurio->registrar()){
		$titulo = 'Login y clave pacientealdia.com';
		$mensaje = 'Bienvenida a  pacientealdia.com su Login:'.$login.'Clave:  '.$clave;
		$cabeceras = 'From: soporte@pacientealdia.com' . "\r\n" .
   		 'Reply-To: webmaster@example.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
		mail($mail, $titulo, $mensaje, $cabeceras);
	
		$objResponse->addScript("window.open('../controladores/frame_central.php','_self');");
		}
		else {
			$objResponse->addAlert("Falla de registro");
		}
	}
	else {
		$objResponse->addAlert("Cambie el mobre de usuario");
	}

	
	return $objResponse;
	
	
}



?>