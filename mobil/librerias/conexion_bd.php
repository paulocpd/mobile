<?php
if ((!defined("X")) or (!defined("Y")) or (!defined("Z")) or (!defined("W"))) {
	define ("X","");
	define ("Y","");
	define ("Z","");
	define ("W","");
}

// Clase para realizar la conexion con la BD PostgreSQL
class ConexionBd {
	private $enlace;
	private $ejecutar;
	private $consultaPendiente;
	private $esInformix;

	// Conecta con la Base de Datos
	function __construct($enlace,$ejecutar,$esInformix) {
		session_start();
		$this->consultaPendiente = "";
		$this->ejecutar = isset($ejecutar) ? $ejecutar : true;
		if (isset($enlace))
		$this->enlace = $enlace;
		else {
			if ($esInformix === true) {
				$this->enlace = ifx_connect("personal@hoyprod_shm","anonimo","anonimo");
				$this->esInformix = true;
			} else {
				$this->enlace = pg_connect("dbname=".Z." port=5432 host=".W." user=".Y." password=".X);
				$this->esInformix = false;
			}
		}
	}
	// Realiza las consultas a la Base de Datos
	function hacerSelect($strSelect,$strFrom,$strWhere,$strGroupBy,$strOrderBy) {
		$consulta = isset($strSelect) ? "SELECT $strSelect" : "";
		$consulta .= isset($strFrom) ? " FROM $strFrom" : "";
		$consulta .= (isset($strWhere) and (strcmp($strWhere,"") != 0)) ? " WHERE $strWhere" : "";
		$consulta .= isset($strGroupBy) ? " GROUP BY $strGroupBy" : "";
		$consulta .= isset($strOrderBy) ? " ORDER BY $strOrderBy" : "";
		$consulta .= ";";
		if(!($resultado=$this->hacerConsulta($consulta,true)))
		return null;
		$arreglo = null;
		if ($this->esInformix === true) {
			while ($linea = ifx_fetch_row($resultado)) {
				$arreglo[] = $linea;
			}
		} else {
			$i = 0;
			while ($linea = pg_fetch_array($resultado,$i,PGSQL_ASSOC)) {
				$arreglo[] = $linea;
				$i++;
			}
		}
		return $arreglo;
	}
	// Realiza los ingreso a la Base de Datos
	function hacerInsert($strInsertInto,$strValues,$strReturning) {
		$consulta = isset($strInsertInto) ? "INSERT INTO ".$strInsertInto : "";
		$consulta .= isset($strValues) ? " VALUES ($strValues)" : "";
		$consulta .= isset($strReturning) ? " RETURNING $strReturning" : "";
		$consulta .= ";";
		$resultado = $this->hacerConsulta($consulta,comprobarVar($strReturning));
		if (comprobarVar($strReturning)) {
			if ($resultado === false) {
				return false;
			} else {
				return pg_fetch_array($resultado,0,PGSQL_ASSOC);
			}
		} else {
			return $resultado;
		}
	}
	// Realiza la eliminacion en la Base de Datos
	function hacerDelete($strDeleteFrom,$strWhere) {
		$consulta = isset($strDeleteFrom) ? "DELETE FROM $strDeleteFrom" : "";
		$consulta .= isset($strWhere) ? " WHERE $strWhere" : "";
		$consulta .= ";";
		return $this->hacerConsulta($consulta);
		
	}

	// Realiza las actualizaciones en la Base de Datos
	function hacerUpdate($strUpdate,$strSet,$strWhere) {
		$consulta = isset($strUpdate) ? "UPDATE $strUpdate" : "";
		$consulta .= isset($strSet) ? " SET $strSet" : "";
		$consulta .= isset($strWhere) ? " WHERE $strWhere" : "";
		$consulta .= ";";
		return $this->hacerConsulta($consulta);
	}

	// Realiza la ejecuci�n de las consultas pendientes
	function hacerConsultasPendientes() {
		if (!($this->ejecutar)) {
			$this->ejecutar = true;
			$consulta = $this->consultaPendiente;
			$this->consultaPendiente = "";
			$resultado = $this->esInformix ? ifx_query($consulta,$this->enlace) :
			pg_query($this->enlace,$consulta);
			if ($resultado) {
				return true;
			} else {
				return false;
			}
		} else
		return false;
	}

	// Realiza la ejecuci�n de una consulta
	function hacerConsulta($consulta,$devolver) {
		if ($this->ejecutar) {
			$resultado = $this->esInformix ? ifx_query($consulta,$this->enlace) :
			pg_query($this->enlace,$consulta);
			if ($resultado) {
				if (isset($devolver) and $devolver) {
					return $resultado;
				} else {
					return true;
				}
			} else {
				if (defined("RUTA_SISTEMA")) {
					ini_set('date.timezone','UTC');
					$tiempoMod = time() - 16200;
					$archivo = date("Ymd-His",$tiempoMod);
					$error = $this->devolverError();
					$error .= chr(13).$consulta;
					file_put_contents(RUTA_SISTEMA."log/$archivo.txt",$error);
				}
				return false;
			}
		} else {
			$this->consultaPendiente .= $consulta;
			return true;
		}
	}

	// Devuelve el ultimo error en las consultas
	function devolverError() {
		return $this->esInformix ? ifx_errormsg() : pg_last_error($this->enlace);
	}

	function noEjecutar() {
		$this->ejecutar = false;
		$this->consultaPendiente = "";
	}

	function siEjecutar() {
		$this->ejecutar = true;
		$this->consultaPendiente = "";
	}

}
?>