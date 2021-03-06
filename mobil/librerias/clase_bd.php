<?php
if (!defined("RUTA_SISTEMA")) {
	include '../conf.inc.php';
}
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';

class ClaseBd {
	private $tabla;
	private $atributos;
	private $objetos;
	private $strOrderBy;
	private $listaAtribObj;
	private $miConexionBd;
	private $estaMaterializado;

	function __construct($miConexionBd,$valorListaPk) {
		$this->declararTabla();
		$this->miConexionBd = isset($miConexionBd) ? $miConexionBd : new ConexionBd();
		$this->setId($valorListaPk);
		$this->crearListaAtribObj();
	}

	/**
	private function declararTabla() {
		$tabla = "tabla";
		$atributos['tabla_id1']['esPk'] = true;
		$atributos['tabla_id2']['esPk'] = true;
		$atributos['tabla_campo1']['esPk'] = false;
		$atributos['tabla_campo2']['esPk'] = false;
		$objetos['OtraClaseBd']['id'] = "otra_tabla_id";
		$strOrderBy = tabla_id1;
		$this->registrarTabla($tabla,$atributos,$objetos,$strOrderBy);
	}
	*/

	function registrarTabla($tabla,$atributos,$objetos,$strOrderBy) {
		$this->tabla = $tabla;
		$this->atributos = $atributos;
		$this->objetos = $objetos;
		$this->strOrderBy = $strOrderBy;
	}

	private function getId(&$atributoPk) {
		$atributoLista = array();
		foreach ($this->atributos as $atributo=>$registro) {
			if ($registro['esPk']) {
				$atributoPk = $atributo;
				$atributoLista[$atributo] = $registro['valor'];
			}
		}
		// Devuelve el valor
		if (count($atributoLista) == 0) {
			return null;
		} else if (count($atributoLista) == 1) {
			return current($atributoLista);
		} else {
			return $atributoLista;
		}
	}
	function getAtributo($atributo) {
		return $this->getVar($atributo);
	}
	function getObjeto($clase) {
		return $this->getObj($clase);
	}

	private function setId($valorListaPk) {
		$this->estaMaterializado = false;
		// Se verifica si el parametro $valorListaPk es arreglo o un solo valor
		if ($valorListaPk != NULL) {
			if (is_array($valorListaPk)) {
				// Se recorren todos los valores de la lista
				foreach ($valorListaPk as $atributo=>$valor) {
					if ($this->atributos[$atributo]['esPk']) {
						$this->atributos[$atributo]['valor'] = ($valor != NULL) ? $valor : null;
					}
				}
			} else {
				// Se busca el unico pk de la clase
				$atributoTemp = null;
				$nroPk = 0;
				foreach ($this->atributos as $atributo=>$registro) {
					if ($registro['esPk']) {
						$atributoTemp = $atributo;
						$nroPk++;
					}
				}
				if ($nroPk == 1 and isset($atributoTemp)) {
					$this->atributos[$atributoTemp]['valor'] = $valorListaPk;
				}
			}
		}
	}
	function setAtributo($atributo,$valor) {
		if (array_key_exists($atributo,$this->atributos)) {
			$this->atributos[$atributo]['valor'] = ($valor != NULL) ? $valor : null;
			if ($this->atributos[$atributo]['esPk']) {
				$valorListaPk = $this->getId();
				$this->setId($valorListaPk);
			}
		}
	}
	function setObjeto($objeto,$valor) {
		if (isset($this->objetos[$objeto]['objeto'])) {
			$this->objetos[$objeto]['objeto']->setId($valor);
		} else {
			$this->objetos[$objeto]['objeto'] = new $objeto($this->miConexionBd,$valor);
		}
	}

	private function materializar() {
		$this->estaMaterializado = true;
		$valorListaPk = $this->getId($atributoPk);
		$seguir = true;
		$strWhere = "";
		if ($valorListaPk == NULL) {
			$seguir = false;
		} else { 
			if (is_array($valorListaPk)) {
				foreach ($valorListaPk as $atributo=>$valor) {
					if ($valor == NULL) {
						$seguir = false;
						break 1;
					} else {
						$strWhere .= "$atributo = '".$valor."' AND ";
					}
				}
				$strWhere = substr($strWhere,0,-4);
			} else {
				$strWhere = "$atributoPk = '".$valorListaPk."'";
			}
		}
		if ($seguir) {
			$strSelect = "*";
			$strFrom = $this->tabla;
			$resultado = $this->miConexionBd->hacerSelect($strSelect,$strFrom,$strWhere);
			if (count($resultado) == 1) {
				$valores = $resultado[0];
				foreach ($valores as $atributo=>$valor) {
					if (array_key_exists($atributo,$this->atributos)) {
						$this->atributos[$atributo]['valor'] = ($valor != NULL) ? $valor : null;						
					} else if (array_key_exists($atributo,$this->listaAtribObj)) {
						$clase = $this->listaAtribObj[$atributo];
						$this->objetos[$clase]['objeto'] = new $clase($this->miConexionBd,$valor);
					}
				}
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	private function crearListaAtribObj() {
		$this->listaAtribObj = array();
		foreach ($this->objetos as $clase=>$registro) {
			$this->listaAtribObj[$registro['id']] = $clase;
		}
	}
	private function getVar($atributo) {
		if ($this->atributos[$atributo]['valor'] != NULL) {
			return $this->atributos[$atributo]['valor'];
		} else if (!($this->estaMaterializado)) {
			if ($this->materializar()) {
				return $this->atributos[$atributo]['valor'];
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
	private function getObj($clase) {
		if (isset($this->objetos[$clase]['objeto'])) {
			return $this->objetos[$clase]['objeto'];
		} else if (!($this->estaMaterializado)) {
			if ($this->materializar()) {
				return $this->objetos[$clase]['objeto'];
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
	function getDatos($noMaterializar) {
		if (!$noMaterializar) {
			$this->materializar();
		}
		$datos = array();
		foreach ($this->atributos as $atributo=>$registro) {
			$datos[$atributo] = $registro['valor'];
		}
		foreach ($this->objetos as $registro) {
			$datos[$registro['id']] = isset($registro['objeto']) ? $registro['objeto']->getId() : null;
		}
		return $datos;
	}

	function consultar($soloCantidad) {
		$datos = $this->getDatos(true);
		$strOrderBy = null;
		if ($soloCantidad === true) {
			$strSelect = "COUNT(*) as cantidad";
		} else {
			$strSelect = "";
			$valorListaPk = $this->getId($atributoPk);
			if (is_array($valorListaPk)) {
				foreach ($valorListaPk as $atributo=>$valor) {
					$strSelect .= "$atributo,";
				}
				$strSelect = substr($strSelect,0,-1);
			} else {
				$strSelect = "$atributoPk";
			}
			$strOrderBy = $this->strOrderBy != NULL ? $this->strOrderBy : null;
		}
		$strFrom = $this->tabla;
		$strWhere = "1=1";
		foreach ($datos as $campo=>$valor) {
			if ($valor != NULL) {
				$strWhere .= " AND $campo = '".$valor."'";
			}
		}
		$resultado = $this->miConexionBd->hacerSelect($strSelect,
		$strFrom,$strWhere,null,$strOrderBy);
		if ($soloCantidad === true) {
			if (count($resultado) == 1 and isset($resultado[0]['cantidad'])) {
				return intval($resultado[0]['cantidad']);
			} else {
				return null;
			}
		} else {
			$arrClase = array();
			$clase = get_class($this);
			foreach ($resultado as $valores) {
				$valorListaPk = array();
				foreach ($valores as $atributo=>$valor) {
					$valorListaPk[$atributo] = $valor;
				}
				$valorListaPk = count($valorListaPk) == 1 ? current($valorListaPk) : $valorListaPk;
				// Se cargan las propiedades a la Conexion Actual
				$miClase = new $clase($this->miConexionBd,$valorListaPk);
				$arrClase[] = $miClase;
			}
			return $arrClase;
		}
	}
	function modificar() {
		$datos = $this->getDatos(true);
		$strUpdate = $this->tabla;
		$strSet = "";
		foreach ($datos as $campo=>$valor) {
			if ($valor != NULL) {
				$strSet .= "$campo = '".$valor."',";
			}
		}
		$strSet = substr($strSet,0,strlen($strSet)-1);
		$strWhere = "";
		$valorListaPk = $this->getId($atributoPk);
		if (is_array($valorListaPk)) {
			foreach ($valorListaPk as $atributo=>$valor) {
				$strWhere = "$atributo = '".$valor."' AND ";
			}
			$strWhere = substr($strWhere,0,-4);
		} else {
			$strWhere = "$atributoPk = '".$valorListaPk."'";
		}
		$strWhere = $strWhere == NULL ? "1=2" : $strWhere;
		return $this->miConexionBd->hacerUpdate($strUpdate,$strSet,$strWhere);
	}
	function registrar() {
		$datos = $this->getDatos(true);
		$strInsertInto = $this->tabla."(";
		$strValues = "";
		foreach ($datos as $campo=>$valor) {
			if ($valor != NULL) {
				$strInsertInto .= "$campo,";
				$strValues .= "'".trim($valor)."',";
			}
		}
		$strInsertInto = substr($strInsertInto,0,strlen($strInsertInto)-1).")";
		$strValues = substr($strValues,0,strlen($strValues)-1);
		$resultado = $this->miConexionBd->hacerInsert($strInsertInto,$strValues);
		if ($resultado) {
			$valorListaPk = $this->getId($atributoPk);
			if (!is_array($valorListaPk) and $valorListaPk == NULL) {
				$strSelect = "MAX($atributoPk) AS maximo";
				$strFrom = $this->tabla;
				$resultado = $this->miConexionBd->hacerSelect($strSelect,$strFrom);
				$this->atributos[$atributoPk]['valor'] = $resultado[0]['maximo'];
				$this->estaMaterializado = false;
				return true;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
}
?>