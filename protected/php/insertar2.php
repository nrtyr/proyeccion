<?php 
 
header('Content-Type: text/html; Charset=UTF-8');
 
$carpeta = "imagenes_/";
 
opendir($carpeta);
$destino = $carpeta . $_FILES['fotoUno']['name'];
copy($_FILES['fotoUno']['tmp_name'], $destino);

$destino = $carpeta . $_FILES['fotoDos']['name'];
copy($_FILES['fotoDos']['tmp_name'], $destino);
 
echo "Foto Subida!<br>";
$nombre = $_FILES['fotoUno']['name'];
echo "<img src=\"imagenes_/$nombre\"><br>";
echo $_FILES['fotoUno']['name'] . "<br>";
echo $_FILES['fotoUno']['type'] . " Extención <br>";
echo $_FILES['fotoUno']['size'] . " Bytes <br>";
echo "<a href=upload.html>Regresar....</a>";
echo "<br><br>";

echo "Foto Subida!<br>";
$nombre = $_FILES['fotoDos']['name'];
echo "<img src=\"imagenes_/$nombre\"><br>";
echo $_FILES['fotoDos']['name'] . "<br>";
echo $_FILES['fotoDos']['type'] . " Extención <br>";
echo $_FILES['fotoDos']['size'] . " Bytes <br>";
echo "<a href=upload.html>Regresar....</a>";
 
 
 ?>