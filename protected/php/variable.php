<?php 

session_start();
$min = "";
$mini = $_POST['autoMunicipio'];
$_SESSION['mini'] = $_POST['autoMunicipio'];

$catLocal = $_POST['autoMunicipio'];


if (isset($catLocal) && !empty($catLocal)) {

	$db = new SQLite3("../data/catMuniColCod.db");


	$cs = $db -> query("SELECT distritoSecc, COUNT(distritoSecc) as Cuantos FROM catSecc WHERE municipioSecc = '$catLocal' ;");
	while ($resul = $cs -> fetchArray()){
		if ($resul['Cuantos'] == 0) {
			echo "<input type='text' maxlength='2' pattern='[0-9]{2}' name='txtLocal' placeholder='Local...' autocomplete='on' class='form-control'/>";
		}else{
			echo "<input type='text' maxlength='2' pattern='[0-9]{2}' value='".$resul['distritoSecc']."' name='txtLocal' placeholder='Local...' autocomplete='on' class='form-control'/>";
		}
	}
	$db -> close();


}else{
	echo "<input type='text' maxlength='2' pattern='[0-9]{2}' name='txtLocal' placeholder='Local...' autocomplete='on' class='form-control'/>";
}

 ?>