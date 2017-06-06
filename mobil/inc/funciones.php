<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'clases/usuario.php';

function devolverLoginSesion() {
	session_start();
	return isset($_SESSION['YY']) ? $_SESSION['YY'] : null;
}


function validarAcceso($miUsuario) {
	// Se instancia la sesiÃ³n actual del usuario
	session_start();
	$resultado = true;
	// Chequea el tiempo de expiraciÃ³n de la sesiÃ³n
	if ((!isset($_SESSION['exp'])) or (strcmp(trim($_SESSION['exp']),"") == 0) or
	(time() >= $_SESSION['exp'])) {
		$resultado = false;		
	}
	
	// Chequea el login y clave del usuario
	if ($resultado and isset($miUsuario)) {
		$miUsuario->setAtributo("usua_login",$_SESSION['YY']);
		$miUsuario->setAtributo("usua_clave",sha1($_SESSION['XX']));
		if (($miUsuario->consultar(true)) != 1) {
			$resultado = false;			
		}
	}
	
	if (!$resultado) {
		header("Location:cerrar_sesion.php");
		exit;
	} else {
		// Renueva el tiempo de expiraciÃ³n de la sesiÃ³n
		$_SESSION['exp'] = time()+EXP;
	}
}


function sinAcentos($cadena) {
	$cadena = str_replace("Ã¡","a",$cadena);
	$cadena = str_replace("Ã©","e",$cadena);
	$cadena = str_replace("Ã­","i",$cadena);
	$cadena = str_replace("Ã³","o",$cadena);
	$cadena = str_replace("Ãº","u",$cadena);
	$cadena = str_replace("Ã�","A",$cadena);
	$cadena = str_replace("Ã‰","E",$cadena);
	$cadena = str_replace("Ã�","I",$cadena);
	$cadena = str_replace("Ã“","O",$cadena);
	$cadena = str_replace("Ãš","U",$cadena);
	return $cadena;
}

function strMinus($cadena) {
	$cadena = aceptarComilla($cadena);
	return utf8_encode(strtolower((utf8_decode($cadena))));
}

function strMayus($cadena) {
	$cadena = aceptarComilla($cadena);
	return utf8_encode(strtoupper((utf8_decode($cadena))));
}

function comprobarVar($variable) {
	if (isset($variable) and strcmp(trim($variable),"") != 0)
	return true;
	else
	return false;
}

function aceptarComilla($cadena) {
	return str_replace("'","\'",$cadena);
}

function limpiarPalabra($palabra) {
	$resultado = trim($palabra);
	$valor = stripos($resultado," ");
	if ($valor)
	return "";
	else
	return $resultado;
}

function formatoFechaHoraBd() {
	ini_set('date.timezone','UTC');
	$tiempoMod = time() - 16200;
	return date("Y-m-d H:i:s",$tiempoMod);
}

function fechaPasada($anos) {
	$fechaActual = formatoFecha();
	$dia = substr($fechaActual,0,2);
	$mes = substr($fechaActual,3,2);
	$ano = substr($fechaActual,6,4);
	$tiempo = mktime(0,0,0,$mes,$dia,($ano - $anos));
	return date("d/m/Y",$tiempo);
}

function restarFechas($fecha1,$fecha2,$anos) {
	$dia1 = substr($fecha1,0,2);
	$mes1 = substr($fecha1,3,2);
	$ano1 = substr($fecha1,6,4);
	$dia2 = substr($fecha2,0,2);
	$mes2 = substr($fecha2,3,2);
	$ano2 = substr($fecha2,6,4);
	$tiempo1 = mktime(0,0,0,$mes1,$dia1,$ano1);
	$tiempo2 = mktime(0,0,0,$mes2,$dia2,$ano2);
	$tiempoDif = $tiempo1 - $tiempo2;
	if ($tiempoDif < 0) {
		return false;
	} else {
		if ($anos === true) {
			return date("Y",$tiempoDif) - 1970;
		} else {
			$diasDif = $tiempoDif / (60 * 60 * 24);
			return $diasDif;
		}
	}
}

function formatoFecha($fecha,$mesDia) {
	if (isset($fecha) and strcmp($fecha,"") != 0) {
		if ($mesDia === true) {
			$fechaNueva = substr($fecha,3,2)."/";
			$fechaNueva .= substr($fecha,0,2)."/";
			$fechaNueva .= substr($fecha,6,4);
		} else {
			$fechaNueva = substr($fecha,8,2)."/";
			$fechaNueva .= substr($fecha,5,2)."/";
			$fechaNueva .= substr($fecha,0,4);
		}
		return $fechaNueva;
	} else {
		ini_set('date.timezone','UTC');
		$tiempoMod = time() - 16200;
		return date("d/m/Y",$tiempoMod);
	}
}

function formatoFechaBd($fecha,$otroFormato) {
	if (isset($fecha)) {
		// Se chequea que la fecha este separada por "/" o "-" y que sean 3 valores
		$arregloFecha = split('[/]',$fecha);
		if ((!isset($arregloFecha)) or count($arregloFecha) != 3) {
			$arregloFecha = split('[-]',$fecha);
			if ((!isset($arregloFecha)) or count($arregloFecha) != 3) {
				return null;
			}
		}
		// Se chequea que sean valores enteros
		foreach ($arregloFecha as $i=>$valor) {
			if ((!is_numeric($valor)) or intval($valor) < 1) {
				return null;
			} else {
				if (intval($valor) < 10 and strlen(trim($valor)) == 1) {
					$arregloFecha[$i] = "0$valor";
				}
			}
		}
		// Se chequea que la fecha tenga formato correcto
		$fecha = $arregloFecha[0]."/".$arregloFecha[1]."/".$arregloFecha[2];
		if (!verificarFormatoFecha($fecha)) {
			return null;
		}
		if (strlen($arregloFecha[2]) == 4 and intval($arregloFecha[2]) > 2038 or intval($arregloFecha[2]) < 1970) {
			return $arregloFecha[2]."-".$arregloFecha[1]."-".$arregloFecha[0];
		} else {
			// Se toma la marca de tiempo UNIX de la fecha
			$marcaTiempo = mktime(0,0,0,$arregloFecha[1],$arregloFecha[0],$arregloFecha[2]);
			return date(((comprobarVar($otroFormato)) ? $otroFormato : "Y-m-d"),$marcaTiempo);
		}
	} else {
		ini_set('date.timezone','UTC');
		$tiempoMod = time() - 16200;
		return date(((comprobarVar($otroFormato)) ? $otroFormato : "Y-m-d"),$tiempoMod);
	}
}

function formatoHoraBd() {
	ini_set('date.timezone','UTC');
	$tiempoMod = time() - 16200;
	return date("H:i:s",$tiempoMod);
}

function verificarFormatoFecha($fecha,$ddmmyyyy) {
	$fecha = str_replace("-","/",trim($fecha));
	if (isset($fecha) and strcmp($fecha,"") != 0) {
		if (strlen($fecha) != 10 and ((!isset($ddmmyyyy)) or $ddmmyyyy === false))
		return false;
		$arregloFecha = split('[/]',$fecha);
		if (isset($arregloFecha) and count($arregloFecha) == 3) {
			$mesesDias[1] = 31;
			$mesesDias[3] = 31;
			$mesesDias[4] = 30;
			$mesesDias[5] = 31;
			$mesesDias[6] = 30;
			$mesesDias[7] = 31;
			$mesesDias[8] = 31;
			$mesesDias[9] = 30;
			$mesesDias[10] = 31;
			$mesesDias[11] = 30;
			$mesesDias[12] = 31;
			// Verifico el aÃ±o
			if (!is_numeric($arregloFecha[2]) or intval($arregloFecha[2]) > 9999
			or intval($arregloFecha[2]) < 1900)
			return false;
			// Verifico los meses
			if (!is_numeric($arregloFecha[1]) or intval($arregloFecha[1]) > 12
			or intval($arregloFecha[1]) < 1)
			return false;
			// Verifico los dias
			if (!is_numeric($arregloFecha[0]) or intval($arregloFecha[0]) > 31
			or intval($arregloFecha[0]) < 1)
			return false;
			// Verifico la cantidad de dias por meses (excepto febrero)
			if (intval($arregloFecha[1]) != 2) {
				if (intval($arregloFecha[0]) > $mesesDias[intval($arregloFecha[1])])
				return false;
			} else {
				// Verifico la cantidad de dï¿½as para febrero
				if (((intval($arregloFecha[2]) % 4) == 0) and (intval($arregloFecha[0]) > 29)) {
					return false;
				}
				if (((intval($arregloFecha[2]) % 4) != 0) and (intval($arregloFecha[0]) > 28)) {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

function formatoDouble($valor,$formatoBd) {
	$valor = "$valor";
	$tamano = strlen($valor);
	$separador1 = $formatoBd ? "." : ",";
	$separador2 = $formatoBd ? "," : ".";
	for ($i=0;$i < $tamano;$i++) {
		if (strcmp($valor[$i],$separador2) == 0) {
			$valor[$i] = $separador1;
			return $valor;
		}
	}
	return $valor;
}

?>
