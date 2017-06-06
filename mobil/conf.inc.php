<?php

//SERVIDOR DE PRODUCCION HOYAPP18
/*define ("RUTA_SISTEMA","D:/Sistemas/sictra/");
define ("X","sictra");
define ("Y","sictra");
define ("Z","sictra");
define ("W","10.8.15.45");*/
//FIN SERVIDOR DE PRODUCCION

//SERVIDOR DE PRODUCCION HOYAPP071
/*define ("RUTA_SISTEMA","D:/www/sistemas/sictra/");
define ("X","sictra");
define ("Y","sictra");
define ("Z","sictra");
define ("W","10.8.15.45");*/
//FIN SERVIDOR DE PRODUCCION

//SERVIDOR DE PRUEBA HOYLNX003
/*define ("RUTA_SISTEMA","/srv/www/htdocs/sistemas/tdc_venezuela/");
define ("X","tdc_venezuela");
define ("Y","tdc_venezuela");
define ("Z","tdc_venezuela");
define ("W","10.8.15.102");*/
//FIN SERVIDOR DE PRUEBA

//SERVIDOR LOCAL WINDOWS
define("RUTA_SISTEMA","/opt/lampp/htdocs/sistemas/mobil/");
define ("X","metro123");
define ("Y","postgres");
define ("Z","record");
define ("W","localhost");
//FIN SERVIDOR LOCAL
//SERVIDOR CARHOSTING
//define ("RUTA_SISTEMA","/home/paciente/public_html/Mobil2/");
//define ("X","j6CI5uaI66");
//define ("Y","paciente");
//define ("Z","paciente_record");
//define ("W","localhost");
//FIN SERVIDOR LOCAL
//SERVIDOR LOCAL CANAIMA
/*define ("RUTA_SISTEMA","/var/www/sistemas/sigo/");
define ("X","metro123");
define ("Y","postgres");
define ("Z","sigo");
define ("W","localhost");*/
//FIN SERVIDOR LOCAL

define ("EXP",6000000);
setlocale(LC_CTYPE, 'es_ES'); 
ini_set("display_errors","0");
ini_set("memory_limit","-1");
session_start();
?>