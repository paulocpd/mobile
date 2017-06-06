var medicaList =  new Array();
var mediGlobal;
var a;

function validar(){
    //window.location.assign("../controladores/main.php");
	var login = document.getElementById('usuarioTx').value;
	var clave = document.getElementById('clavetx').value;
	xajax_validarUsuario(login,clave);
};
function addNewUser(){
		//alert("hello");
		var login = document.getElementById('usuarioTx').value;
		var clave = document.getElementById('claveTx').value;
		var nombre = document.getElementById('nombreTx').value;
		var mail = document.getElementById('mailTx').value;
		var teleCellTx=document.getElementById('teleCellTx').value;
		var teleFijoTx=document.getElementById('teleFijoTx').value;
		var atpos=mail.indexOf("@");
		var dotpos=mail.lastIndexOf(".");
		
		if((login==""||clave==""||nombre==""||mail=="")){
			alert("los campos * son obligatorios");
		}
		else{
			xajax_agregarNuevoUsuario(login,clave,nombre,null,mail,null,teleFijoTx,teleCellTx);}
		
		}
		
		
	
function getPdf(){
	window.open("../test/pdf.php");
}
function addPatient(){
	var name =document.getElementById('nombre').value;
	var mail=document.getElementById('email').value;
	var ci=document.getElementById('cedula').value;
	var telf=document.getElementById('telefono').value;
	var telCell=document.getElementById('telefonoCell').value;
	var direc=document.getElementById('direc').value;
	var usuId=document.getElementById('usaId').value;
	//alert(name+mail+ci+telf+telCell+direc+usuId);
	
	if(name==""||ci==""){
		alert("La cedula y el nombre son obligatorios");
	}
	else xajax_addPatient(name,mail,ci,telf,telCell,direc,usuId);
}
function mostrarPaciente(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	if(cedula=="")alert("Debe ingrezar un número de cedula");
	else{
	xajax_mostrarPaciente(cedula,usuId);}
}

function mostraAntecedente(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	if(cedula=="")alert("Debe ingrezar un número de cedula");
	else{ xajax_buscarAntecedente(cedula,usuId);}
	
}
function guardarAntecedente(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	var tabaquismo;
	var alcohol=document.getElementById('alcoTxt').value;
	var here=document.getElementById('hereTxt').value;
	var patolo=document.getElementById('patoloTxt').value;
	var noPato=document.getElementById('noPatoloTxt').value;
	var sexo;
	var fechaNac=document.getElementById('fechaNac').value;
	var sangre=document.getElementById('sangreTxt').value;
	var i,j;

	
	for (i=0;i<document.datos.fumadorTxt.length;i++){
	    		if (document.datos.fumadorTxt[i].checked)
	          break;
	}
	for (j=0;j<document.datos.sexoTxt.length;j++){
	       if (document.datos.sexoTxt[j].checked)
	          break;
	}
	
	//alert(document.datos.fumadorTxt[i].checked+""+document.datos.sexoTxt[j].checked)
	tabaquismo=document.datos.fumadorTxt[i].value;
	sexo=document.datos.fumadorTxt[i].value;
	//alert(tabaquismo+sexo+usuId+cedula+alcohol+here+patolo+noPato+fechaNac+sangre);

	if(cedula==""||sangre=="") alert("Debe ingresar el número de cedula y tipo de sangre");
	else xajax_agregarAntecedente(tabaquismo,alcohol,here,patolo,noPato,sexo,fechaNac,sangre,cedula,usuId);

	
}

function buscarConsulta() {
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	var fechaLast=document.getElementById('fechaLast').value;
	//alert(document.getElementById('cedula').value+usuId);
	if(cedula=="")alert("Debe ingrezar un número de cedula");
	else{
		xajax_mostrarFechasConsulta(cedula,usuId);
		
		}
	
	}		
function agregarConsulta(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	var fechaCons=document.getElementById('fechaCons').value;
	var sintomas=document.getElementById('sintomasTxt').value;
	var diag=document.getElementById('diagTxt').value;
	var trata=document.getElementById('trataTxt').value;
	var medi=document.getElementById('medicaTxt').value;
	if(cedula==""||fechaCons=="")alert("Debe ingrezar un número de cédula y la fecha de la consulta");
	else{	
	xajax_agregarConsulta(usuId,cedula,fechaCons,sintomas,diag,trata,medi);}
}
function consutaFecha(){
	var fechaLast=document.getElementById('fechaLast').value;
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	if(cedula=="") alert("Debe ingrezar un número de cedula");
	else xajax_mostrarConsulta(usuId,cedula,fechaLast);
}

function getInforme(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	var fechaCons=document.getElementById('fechaCons').value;
	var sintomas=document.getElementById('sintomasTxt').value;
	var diag=document.getElementById('diagTxt').value;
	var trata=document.getElementById('trataTxt').value;
	var nombre=document.getElementById('paciNombreTxt').value;
	//window.open("../controladores/pdf.php?matrizId="+document.getElementById('matrizId').value+"&fechaIn="+fechaIn+"&fechaFin="+fechaFin);
	//window.open("../controladores/pdf.php");

	window.open("../controladores/pdf.php?usuId="+usuId+"&fecha="+fechaCons+"&sintomas="+sintomas+"&dig="+diag+"&trata="+trata+"&cedula="+cedula+"&nombre="+nombre);
}
function getRecipe(){
	var usuId=document.getElementById('usaId').value;
	var cedula=document.getElementById('cedula').value;
	var fechaCons=document.getElementById('fechaCons').value;
	var sintomas=document.getElementById('sintomasTxt').value;
	var diag=document.getElementById('diagTxt').value;
	var trata=document.getElementById('trataTxt').value;
	var nombre=document.getElementById('paciNombreTxt').value;
	var medica = document.getElementById('medicaTxt').value;
	//var medica=document.getElementById('medicaTxt').value;
	//window.open("../controladores/pdf.php?matrizId="+document.getElementById('matrizId').value+"&fechaIn="+fechaIn+"&fechaFin="+fechaFin);
	//window.open("../controladores/pdf.php");
	window.open("../controladores/recipe.php?usuId="+usuId+"&fecha="+fechaCons+"&medica="+medica+"&cedula="+cedula+"&nombre="+nombre);
}
