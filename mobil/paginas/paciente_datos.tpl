<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	[var.js;htmlconv=no;noerr]
	<script type="text/javascript" src="../js/validation.js"></script>
	
	<link rel="stylesheet" href="../librerias/jquery/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
	<script type="text/javascript"	src="../librerias/jquery/jquery.mobile-1.2.0/demos/js/jquery.js"></script>
	<script type="text/javascript"	src="../librerias/jquery/jquery.mobile-1.2.0/jquery.mobile-1.2.0.js"></script>
<title>Insert title here</title>
</head>
<body OnLoad="document.myform.cedula.focus();">
<div  class="classname" data-role="content" data-theme="b" style="width:820px;border-radius:10px" >
<form action="javascript:addPatient();" name="myform" >
<table align="center" height="300px" width="400px"  border="0" >

<tr>
		
	<td>
	<font color="#990000">*</font><label for="search-mini">C&eacute;dula</label>
	</td>
	<td>
	<input   data-mini="true" name="cedula" id="cedula" value=""  /></td>
	<td><input type="button" data-icon="search"  data-mini="true" value="Buscar" onclick="javascript:mostrarPaciente();">
	</td></tr>
	<tr>
		<td ><font color="#990000">*</font><label>Nombre y Apellido </label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="nombre" id="nombre" ></td>
	</tr>
	<tr>
		<td><label>Email</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="email" id="email" ></td>
	</tr>
	<tr>
		<td><label>Tel&eacute;fono</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="telefono" id="telefono"></td>
	</tr>
	<tr>
		<td><label>Tel&eacute;fono Celular</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="telefonoCell" id="telefonoCell" ></td>
		
	</tr>
		<tr>
		<td><label>Direcci&oacute;n </label></td>
		<td><textarea rows="3" cols="3" maxlength="40"  data-mini="true" name="direc" id="direc"></textarea></td>
		
	</tr>
	<tr>
		<td colspan="2" style="text-align: center">
		<input type="submit" data-mini="true"	value="Guardar"> </td>
	
</table>

<input type="hidden" value="[var.usaId;htmlconv=no;noerr]" name="usaId" id="usaId" > 

</form>
</div>
<!--<input type="button" value="PDF" onclick="javascript:getPdf();">-->
</body>
</html>