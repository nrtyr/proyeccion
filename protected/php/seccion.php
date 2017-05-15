<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
header('Content-Type: text/html; Charset=UTF-8');

session_start();

if (isset($_SESSION['mini']) && !empty($_SESSION['mini'])) {
	$ok = $_SESSION['mini'];
}else{
	$ok = "nada";
}


$db = new SQLite3("../data/catMuniColCod.db");

$cs = $db -> query("SELECT * FROM catSecc WHERE seccionSecc LIKE '%$_GET[term]%' AND municipioSecc LIKE '%$ok%' ;");
	    
while($resul = $cs->fetchArray()) {
  $return_arr[] =  $resul['seccionSecc'];
}
echo json_encode($return_arr);

$db -> close();



 ?>