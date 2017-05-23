<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
session_start();

header('Content-Type: text/html; Charset=UTF-8');

date_default_timezone_set('America/Mexico_City');

include("info.php");
include("ipUsuario.php");


if (isset($_SESSION['pwUsuario']) && !empty($_SESSION['pwUsuario']) &&
	isset($_POST['txtMuni']) && !empty($_POST['txtMuni'])) {

$varMuni = "";
$varLocColonia = "";
$varCodPost = "";
$varSecc = "";
$varLocal = "";
$varFederal = "";
$varVisitados = "";
$varComentarios = "";
$fechaCap = date("d-m-Y");
$horaCap = date("g:i:s a");
$varUsuario = $_SESSION['usuario'];
$varNavega = $info["browser"];
$varSitemaO = $info["os"];
$varGeoRefAct = "";
$varVersio = $info["version"];
$geoLatitud = "";
$geoLongitud = "";

if (isset($_POST["txtLatitud"]) && !empty($_POST["txtLatitud"]) &&
	isset($_POST["txtLongitud"]) && !empty($_POST["txtLongitud"])) {

	$geoLatitud = $_POST["txtLatitud"];
	$geoLongitud = $_POST["txtLongitud"];
}


$carpeta = "imagenes_/";



$con = new SQLite3("../data/catMuniColCod.db");

$cs = $con -> query("SELECT * FROM CP_Estado WHERE D_mnpio = '$_POST[txtMuni]' ;");
	    
while($resul = $cs->fetchArray()) {
  $varCodPost =  $resul['d_codigo'];
}


$varMuni = mb_strtoupper($_POST['txtMuni'], 'UTF-8');
$varLocColonia = mb_strtoupper($_POST['txtLocColonia'], 'UTF-8');
$varSecc = mb_strtoupper($_POST['txtSecc'], 'UTF-8');
$varLocal = mb_strtoupper($_POST['txtLocal'], 'UTF-8');
$varFederal = mb_strtoupper($_POST['txtFederal'], 'UTF-8');
$varVisitados = mb_strtoupper($_POST['txtVisitados'], 'UTF-8');
$varComentarios = mb_strtoupper($_POST['txtComentarios'], 'UTF-8');

// Comprobación de fotoUno

if (isset($_FILES['fotoUno']) && !empty($_FILES['fotoUno'])) {
	

	// aquí sube la fotoUno
	opendir($carpeta);
	$nombreArchivo = $varSecc."_".date("dmYgisa")."_".$_FILES['fotoUno']['name'];
	$destino = $carpeta.$nombreArchivo;
	copy($_FILES['fotoUno']['tmp_name'], $destino);

	// aquí se crea la variable fotoUno
	$varfotoUno = $nombreArchivo;

}else{
	$varfotoUno = "";
}

// Comprobación de fotoUno

if (isset($_FILES['fotoDos']) && !empty($_FILES['fotoDos'])) {

	// aquí sube la fotoDos
	opendir($carpeta);
	$nombreArchivo2 = $varSecc."_".date("dmYgisa")."_2_".$_FILES['fotoDos']['name'];
	$destino2 = $carpeta.$nombreArchivo2;
	copy($_FILES['fotoDos']['tmp_name'], $destino2);

	// aquí se crea la variable fotoUno
	$varfotoDos = $nombreArchivo2;
}else{
	$varfotoDos = "";
}



$con = new SQLite3("../data/capturas.db");

$cs2 = $con -> query("INSERT INTO capActividades (muniAct,LocColoniaAct,codPostAct,seccAct,localAct,federalAct,visitadosAct,comentariosAct,fotoUnoAct,fotoDosAct,fechaCapAct,horaCapAct,usuarioAct,navegadorAct,sisOperaAct,ipUsuarioAct,geoRefLatitudAct,geoRefLongitudAct,versionAct) VALUES ('$varMuni','$varLocColonia','$varCodPost','$varSecc','$varLocal','$varFederal','$varVisitados','$varComentarios','$varfotoUno','$varfotoDos','$fechaCap','$horaCap','$varUsuario','$varNavega','$varSitemaO','$ipUsuario','$geoLatitud','$geoLongitud','$varVersio')");

$con -> close();
	
	echo "<script> alert('Datos Insertados!'); </script>";
	echo "<script> window.location='actividades.php'; </script>";


}else{
	echo "<script> alert('Faltan algunos campos!'); </script>";
	echo "<script> window.location='actividades.php'; </script>";
}
 
 
 
 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<title>Guardar Actividades</title>
 </head>
 <body>
 	
 </body>
 </html>