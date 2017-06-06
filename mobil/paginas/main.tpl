<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Iframe Tutorial</title>
</head>
<meta name="viewport" content="width=device-width,user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/structure.css"/>
<body >
<div style="text-align:center;">
<ul id="menu-bar">
	<li><a href="../controladores/paciente_datos.php" target="iframe1">Agregar Paciente</a></li>
	<li><a href="../controladores/paciente_datos_2.php" target="iframe1" >Antecedentes</a></li>
	<li><a href="../controladores/paciente_consulta.php" target="iframe1">Consulta</a></li>
	<li><a href="#">Examenes</a></li>
	<li><a href="#"></a></li>
	<li><a href="#"></a></li>
	<li><a href="#"></a></li>
	<li><a href="#"></a></li>
	<li><a href="../controladores/cerrar_sesion.php" target="iframe1" >Cerrar Sesion</a></li>


<!--	<ul>-->
<!--		<li><a href="../controladores/paciente_datos_2.php" target="frame_data"">Datos2</a></li>-->
<!--		<li><a href="#">Services Sub Menu 2</a></li>-->
<!--		<li><a href="#">Services Sub Menu 3</a></li>-->
<!--		<li><a href="#">Services Sub Menu 4</a></li>-->
<!--	</ul>-->
<!--	</li>-->
</ul>
<div>
<p> <span style="color:darkolivegreen;font-weight:bold">Bienvenido Dr.(a)[var.nombre;htmlconv=no;noerr]</span> </p>
</div>

<iframe name="iframe1" width="850" height="500" src="../controladores/paciente_datos.php" frameborder="0" scrolling="auto" align="middle">
</iframe>

</div>

</body>
</html> 