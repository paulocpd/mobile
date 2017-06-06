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
        $( "#fechaNac" ).datepicker
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

<form name="datos" action="javascript:guardarAntecedente();" >
<table align="left" border="0" >
<tr>		
	<td width="100" colspan="1"><b>[var.paciente;htmlconv=no;noerr]</b>
	</td>
	<td width="250">
	
	</td>
	<td width="100" >
	
	</td>
	<td valign=top >
		<label for="search-mini">Cedula</label>
		<input maxlength="40" data-mini="true" name="cedula" id="cedula" value="[var.cedula;htmlconv=no;noerr]" /></td>
	<td width="150" valign="bottom">
		<input type="button" data-icon="search"  data-mini="true" value="Buscar" onclick="javascript:mostraAntecedente();">
	</td>
</tr>
<tr>
	<td valign=top >
		<label>Fumador</label>
		<fieldset data-role="controlgroup">
		<input type="radio" name="fumadorTxt" id="radio-choice-1" value="s"  [var.tabaquismo;htmlconv=no;noerr] checked/>
	    <label for="radio-choice-1">Si</label>
	    <input type="radio" name="fumadorTxt" id="radio-choice-2" value="n"  [var.Notabaquismo;htmlconv=no;noerr]/>
	    <label for="radio-choice-2">No</label>
		</fieldset>
	</td>
	<td valign=top>
		<label>Heredidarias</label>
		<textarea maxlength="2000" style="height:83px;width:100%" name="hereTxt" id="hereTxt" >[var.heredidarias;htmlconv=no;noerr]</textarea>
	</td>
	<td  valign=top ><label>Sexo</label>
		<fieldset data-role="controlgroup">
		<input type="radio" name="sexoTxt" id="radio-choice-1" value="m" [var.m;htmlconv=no;noerr] checked />
	    <label for="radio-choice-1">M</label>
	    <input type="radio" name="sexoTxt" id="radio-choice-2" value="f" [var.f;htmlconv=no;noerr]/>
	    <label for="radio-choice-2">F</label>
		</fieldset>
	</td>
	<td   valign=top  colspan="2">
		<label>Patologica</label>
		<textarea maxlength="2000" style="height:83px;width:100%" name="patoloTxt" id="patoloTxt">[var.patologica;htmlconv=no;noerr]</textarea>
	
</tr>
<tr>
	<td valign="top" colspan="2">
		<label>No patologica</label>
		<textarea maxlength="2000" style="height:83px;width:100%" name="noPatoloTxt" id="noPatoloTxt">[var.no_patologica;htmlconv=no;noerr]</textarea>
	</td>
	<td valign="top" colspan="2">
	<label>Alcohol</label>
	<input data-mini="true" name="alcoTxt" id="alcoTxt" value="[var.alcohol;htmlconv=no;noerr]"  />
	<label>Fecha de Nacimento</label>
	<input data-mini="true" name="fechaNac" id="fechaNac" value="[var.fecha_nac;htmlconv=no;noerr]" />	
	
	</td>
	<td valign="top" width="100">
	<label>Tipo de Sangre</label>
	<select data-mini="true" name="sangreTxt" id="sangreTxt">
		  <option value="" >Seleccione...</option>
		  <option value="[datos.sangre_id;noerr]"[datos.seleccion;block=option;noerr] >[datos.sangre_tipo;block=option;noerr]</option>
	</select>
	</td>
</tr>	
<tr>
<td colspan="5">
<input type="submit" data-mini="true"	value="Guardar">
</td>
</tr>
	
</table>

<input type="hidden" value="[var.usaId;htmlconv=no;noerr]" name="usaId" id="usaId" > 

</form>
</div>
</body>
</html>



