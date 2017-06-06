<?php

include("../librerias/mpdf53/mpdf.php");

$cabecera = '
<table width="100%" id="table_header">
	<tr>
		<td align="left">
		<table>
			<tr>
				<td width="40px" align="left">
					<img src="../imagenes/logo_metro.png" width="120px"/>
				</td>
				<td  align="left">
				<span style="font-size:10px;font-weight:bold;">C.A METRO DE CARACAS</span><br>
				<span style="font-size:10px;font-weight:bold;">OFICINA DE APOYO Y CONTROL DE GRANDES OBRAS</span>
				</td>
			</tr>
		</table>	
		</td>
	</tr>
	<tr>
		<td align="left" colspan=2>
			<div><h4>REPORTE: AVANCE DE ACTIVIDADES</h4></div>
		</td>
	</tr>
</table>';

$html = '<table border="1" align="center">
		<thead> 
			<tr> 
				<th bgcolor="#333333" color="#FFFFFF"><strong>ACTIVIDAD</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>FECHA INICIO PROGRAMADA</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>FECHA FIN PROGRAMADA</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>AVANCE PROGRAMADO</strong></th>	
				<th bgcolor="#333333" color="#FFFFFF"><strong>AVANCE REAL</strong></th>			  
				<th bgcolor="#333333" color="#FFFFFF"><strong>OBSERVACIONES</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>FACTOR CRITICO</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>ACCIONES A TOMAR</strong></th>
				<th bgcolor="#333333" color="#FFFFFF"><strong>RESPONSABLE</strong></th>
			</tr> 
		</thead>';

$html .= '<tbody>';

$html .= '</tbody></table>';

$header = array('L' => array(),'C' => array(),'R' => array(
'content' => '{PAGENO}28',
'font-family' => 'sans',
'font-style' => '',
'font-size' => '9', ),'line' => 1,);

$fecha = date("d/m/y");
$pagina = '{PAGENO}/{nb}';
$piePagina = '<div align="center" style="font-size:9px;color:#666666;">Oficina de Apoyo y Control de Grandes Obras</div>
			  <div align="center" style="font-size:9px;color:#666666;">Gerencia General de Tecnología de la Información (GCT) - Gerencia de Sistemas de Información (GIN)</div>
			  <div align="center" style="font-size:9px;color:#666666;">C.A. Metro de Caracas</div>';
$piePagina .= '<table width=100% style="font-size:9px;color:#666666;"><tr><td align="left">'.$fecha.'</td>
			  <td align="right">'.$pagina.'</td></tr></table>';
//==============================================================
//==============================================================
//==============================================================
//mode,format,default_font_size,default_font,margin_left 15,margin_right 15,margin_top 16,
//margin_bottom 16,margin_header 9,margin_footer 9,orientation P o L,
/*Parametros: modo,formato,tamaño_letra,tipo_letra,margen_izquierdo,margen_derecho,
*margen_superior,margen_inferior,margen_cabecera,margen_pie*/

$mpdf=new mPDF('c','Letter',10,null,10,10,40,22,9,5);
$mpdf->SetHTMLHeader($cabecera);
$mpdf->AddPage('L');
//zoom 'fullpage,fullwidth,real,default o un entero representando el porcentaje',
//layout 'single,continuous,two,twoleft,tworight,default'
$mpdf->SetDisplayMode('fullpage','single');

$paginas = '{PAGENO}';
$mpdf->SetHTMLFooter($piePagina);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================
/*
$mpdf=new mPDF();
$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie);
$mpdf->WriteHTML($cuerpo);
$mpdf->Output();

$mpdf=new mPDF( 
'',    // mode - default ''
'',    // format - A4, for example, default ''
0,     // font size - default 0
'',    // default font family
15,    // margin_left
15,    // margin right
16,     // margin top
16,    // margin bottom
9,     // margin header
9,     // margin footer
'L'););
*/

?>