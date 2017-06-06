<?php
include("../librerias/mpdf53/mpdf.php");
include_once '../conf.inc.php';
include_once RUTA_SISTEMA.'librerias/conexion_bd.php';
include_once RUTA_SISTEMA.'inc/funciones.php';
include_once RUTA_SISTEMA.'librerias/xajax_0.2.4/xajax.inc.php';
include_once RUTA_SISTEMA.'clases/consulta.php';




// SE VERIFICA LA SESIÓN Y ACCESO DEL USUARIO
$miConexionBd = new ConexionBd();
$miUsuario = new Usuario($miConexionBd);
validarAcceso($miUsuario);
$celdasTemp=array();
//// AJAX
//$xajax = new xajax("../inc/ajax.inc.php");
//$js = $xajax->getJavascript('../librerias/');

/**
 * 
 * Paciente.
 * @var unknown_type
 */
$nombre=$_GET['nombre'];
$cedula=$_GET['cedula'];
$medica=$_GET['medica'];
$fecha=$_GET['fecha'];

$celdasTemp = explode(".",$medica);
count($celdasTemp);
if (count($celdasTemp)==1){
	 $celdasTemp[0]=$medica;
}
/**
 * Usuario
 */
$usuId=$_GET['usuId'];
$logo=$usuId.".png";
$tele1;
$tele2;
$mail;

$miUsuario->setAtributo('usua_id', $usuId);
$arrUsu=$miUsuario->consultar();
if(count($arrUsu)==1);{
	$tele1=$arrUsu[0]->getAtributo('usua_telf');
	$tele2=$arrUsu[0]->getAtributo('usua_telf_cell');
	$mail=$arrUsu[0]->getAtributo('usua_mail');
}

$cabecera = '
<table align="left" border="0" >
	<tr>
		<td align="left">
		<table>
			<tr>
				<td width="300px" align="left">
					<img src="../imagenes/'.$logo.'" width="120px"/>
				</td>
				<td  align="left">
				<span style="font-size:10px;font-weight:bold;"></span><br>
				<span style="font-size:10px;font-weight:bold;"></span>
				</td>
			
			</tr>
		</table>	
		</td>
			<td width="350" align="right" > Fecha: <strong>'.$fecha.' </strong>
			</td>
	</tr>
</table>';

$html = '<table align=center  border="0" width="600">
					<tr>
						<td align=center colspan=2>
							<h3>Rp./ INDICACIONES MEDICAS</h3>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=left nowrap>
						Sr(a).<strong>'.$nombre.'</strong>  de n&uacute;mero de c&eacute;dula de  
						 <strong>'.$cedula.'.</strong>
						 
						</td>
					</tr>';
for($i=0;$i<=count($celdasTemp)-1;$i++){
	$html.=	'<tr>
						<td colspan=2 nowrap>
							<strong>-</strong>
							<label>'.$celdasTemp[$i].'</label>
						</td>
					</tr>';
} 
$html.='</table>';
$header = array('L' => array(),'C' => array(),'R' => array(
'content' => '{PAGENO}28',
'font-family' => 'sans',
'font-style' => '',
'font-size' => '9', ),'line' => 1,);

$fecha = date("d/m/y");
$pagina = '{PAGENO}/{nb}';
$piePagina = '<div align="center" style="font-size:9px;color:#666666;">Telfs: '.$tele1.'/'.$tele2.'- e-mail:'.$mail.'</div>
			  <div align="center" style="font-size:9px;color:#666666;"></div>
			  <div align="center" style="font-size:9px;color:#666666;"></div>';
$piePagina .= '<table width=100% style="font-size:9px;color:#666666;"><tr><td align="left">'.$x.'</td>
			  <td align="right">'.$pagina.'</td></tr></table>';
//==============================================================
//==============================================================
//==============================================================
//mode,format,default_font_size,default_font,margin_left 15,margin_right 15,margin_top 16,
//margin_bottom 16,margin_header 9,margin_footer 9,orientation P o L,
$mpdf=new mPDF('c','Letter',10,null,10,10,60,18,9,5);
$mpdf->SetHTMLHeader($cabecera);
$mpdf->AddPage('P');
//zoom 'fullpage,fullwidth,real,default o un entero representando el porcentaje',
//layout 'single,continuous,two,twoleft,tworight,default'
$mpdf->SetDisplayMode('fullpage','single');

$paginas = '{PAGENO}';
$mpdf->SetHTMLFooter($piePagina);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>


