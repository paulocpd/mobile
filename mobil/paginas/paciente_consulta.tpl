<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Insert title here</title>
	<script type="text/javascript" src="../js/validation.js"></script>
	<link rel="stylesheet" href="../librerias/jquery/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.css" />
	<link rel="stylesheet" href="../librerias/jquery/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
	<script type="text/javascript"	src="../librerias/jquery/jquery.mobile-1.2.0/demos/js/jquery.js"></script>
	<script type="text/javascript"	src="../librerias/jquery/jquery.mobile-1.2.0/jquery.mobile-1.2.0.js"></script>
	<script src="../librerias/jquery/jquery-ui-1.9.2.custom/js/jquery-1.8.3.js"></script>
    <script src="../librerias/jquery/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js"></script>
    <script src="../librerias/jquery/jquery-ui-1.9.2.custom/development-bundle/ui/i18n/jquery.ui.datepicker-es.js"></script>
	[var.js;htmlconv=no;noerr]
		 <script>
    $(function() {
        $( "#fechaCons" ).datepicker
        ({  dateFormat: 'dd-mm-yy', 
            changeMonth: true, 
            changeYear: true, 
            yearRange: '-100:+0'
       
        });
    });
    </script>
</head>
<body>
<div  data-role="content" data-theme="b" style="width:820px;border-radius:10px" >

<form name="datos" action="javascript:agregarConsulta();" >
<table align="center" border="0" >
<tr>		
	<td colspan="1" width="300"></td>
	<td ><label>Fecha</label><input data-mini="true" name="fechaCons" id="fechaCons" value="[var.fecha_nac;htmlconv=no;noerr]" /></td>
	<td width="150"><label>Registro de Consulta </label>
	<select data-mini="true" name="fechaLast" id="fechaLast">
		 <option value="[datos.consulta_id;noerr]" onclick="javascript:consutaFecha();" >[datos.consulta_fecha;block=option;noerr] </option>
	</select></td>
	<td  ><label for="search-mini">Cedula</label>	<input maxlength="40"  data-mini="true" name="cedula" id="cedula" value="[var.cedula;htmlconv=no;noerr]" /></td>
	<td  valign="bottom"><input type="button" data-icon="search"  data-mini="true" value="Buscar" onclick="javascript:buscarConsulta();"></td>
</tr>
<tr>
<td colspan="6"><b>[var.nombre;htmlconv=no;noerr]</b></td>
</tr>

<tr>
	<td valign=top colspan="6" >
	<label>Sintomas</label>
	<textarea maxlength="2000"   style="height:60px;width:100%" name="sintomasTxt" id="sintomasTxt" ></textarea>
	</td>
</tr>
<tr>
	<td valign=top colspan="6" >
	<label>Diagnostico</label>
	<textarea maxlength="2000"  style="height:60px;width:100%" name="diagTxt" id="diagTxt" ></textarea>
	</td>
</tr>	
<tr>
	<td valign=top width="100">
	<label>Medicamentos</label>
	<textarea  maxlength="2000"  style="height:83px;width:100%" name="mediTxt" id="medicaTxt"></textarea>
	</td>
	<td valign=top colspan="5" >
	<label>Tratamiento</label>
	<textarea maxlength="2000"  style="height:83px;width:100%" name="trataTxt" id="trataTxt" ></textarea>
	</td>
	
	
</tr>
<tr>
	<td ><input type="button" data-mini="true" onclick="javascript:consutaFecha();"	value="Mostrar Consulta"></td>
	<td ><input type="button" data-mini="true" onclick="javascript:getInforme();"	value="Imprimir informe"></td>
	<td ><input type="button" data-mini="true" onclick="javascript:getRecipe();"	value="Imprimir recipe"></td>
	<td colspan="3"><input type="submit" data-mini="true"	value="Guardar"></td>
</tr>
	
</table>
<input type="hidden" value="[var.nombre;htmlconv=no;noerr]" name="paciNombreTxt" id="paciNombreTxt" > 
<input type="hidden" value="[var.usaId;htmlconv=no;noerr]" name="usaId" id="usaId" > 

</form>
</div>
</body>
</html>

 
