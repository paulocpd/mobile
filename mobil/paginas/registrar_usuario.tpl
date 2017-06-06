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
<body>

<div data-role="content" data-theme="b" style="width:820px;border-radius:10px"; >
<form action="javascript:addNewUser();"  >
<table align="center" height="300px" width="400px"  border="0" >
	<tr>
		<td width="200"><font color="#990000">*</font><label>Mi nombre y apellido</label></td>
		<td><input type="text" maxlength="40" size="40"  data-mini="true" name="nombreTx" id="nombreTx" ></td>
	</tr>
	<tr>
		<td><font color="#990000">*</font><label>email</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true"name="mailTx" id="mailTx"></td>

	</tr>
		<tr>
		<td><font color="#990000">*</font><label >Nombre de usuario </label></td>
		<td><input type="text" maxlength="16" size="40" data-mini="true" name="usuarioTx" id="usuarioTx"></td>
	</tr>
	<tr>
		<td><font color="#990000">*</font><label >Clave </label></td>
		<td><input type="password" maxlength="2000" size="40" data-mini="true" name="claveTx" id="claveTx" ></td>
	</tr>
	<tr>
		<td><label >Tel&eacute;fono Celuar</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="teleCellTx" id="teleCellTx" ></td>
	</tr>
		<tr>
		<td><label >Tel&eacute;fono Fijo</label></td>
		<td><input type="text" maxlength="40" size="40" data-mini="true" name="teleFijoTx" id="teleFijoTx" ></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center">
		<input type="submit" data-mini="true"	value="Guardar"> </td>
	</tr>
</table>
<h6 align="center"><font color="#990000">* Estos campos son obligatorios</font> </h6>
</form>


</body>
</html>

