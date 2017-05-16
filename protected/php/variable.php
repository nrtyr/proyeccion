<?php 

session_start();
$min = "";
$mini = $_POST['autoMunicipio'];
$_SESSION['mini'] = $_POST['autoMunicipio'];

$catLocal = $_POST['autoMunicipio'];


if (isset($catLocal) && !empty($catLocal)) {

	$db = new SQLite3("../data/catMuniColCod.db");


	$cs = $db -> query("SELECT Seccion, COUNT(Seccion) as Cuantos FROM distritosLocales WHERE municipio = '$catLocal' ;");
	while ($resul = $cs -> fetchArray()){
		if ($resul['Cuantos'] == 0) {
			echo '
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">

								    <label>Local:</label>
									
								    <input type="number" name="txtLocal" maxlength="2" pattern="[0-9]{2}" placeholder="Local..."  autocomplete="on" class="form-control"/>
								    
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">

								    <label>Federal:</label>

								    <input type="number" name="txtFederal" maxlength="2" pattern="[0-9]{2}" placeholder="Federal..." id="autoFederal" autocomplete="on" class="form-control"/>
								</div>
							</div>
						</div>

			';
		}else{

			echo '
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">

								    <label>Local:</label>
									
								    <input type="number" name="txtLocal" maxlength="2" value="'.$resul["Seccion"].'" pattern="[0-9]{2}" placeholder="Local..."  autocomplete="on" class="form-control"/>
								    
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">

								    <label>Federal:</label>

								    <input type="number" name="txtFederal" maxlength="2" value="88" pattern="[0-9]{2}" placeholder="Federal..." id="autoFederal" autocomplete="on" class="form-control"/>
								</div>
							</div>
						</div>

			';
		}
	}
	$db -> close();


}else{
	echo '
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">

								    <label>Local:</label>
									
								    <input type="number" name="txtLocal" maxlength="2" pattern="[0-9]{2}" placeholder="Local..."  autocomplete="on" class="form-control"/>
								    
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">

								    <label>Federal:</label>

								    <input type="number" name="txtFederal" maxlength="2" pattern="[0-9]{2}" placeholder="Federal..." id="autoFederal" autocomplete="on" class="form-control"/>
								</div>
							</div>
						</div>

			';
}

 ?>