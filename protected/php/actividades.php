<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Reporte de Actividades</title>
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/bootstrap-theme.css">
	<link rel="stylesheet" href="../../css/fileinput.css">
	<link rel="stylesheet" href="../../css/jquery-ui.css">
	<script type="text/javascript" src="../../js/bootstrap.js"></script>
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../../js/fileinput.js"></script>
	<script type="text/javascript" src="../../js/fileinput_locale_es.js"></script>

<!-- 	Ajax de Auto Completado para Colonia -->
	<script type="text/javascript">
	function ejecutarAjax(){
		var conexion;
		var ctMinicipio = document.getElementById("autoMunicipio").value;
		var valor = "autoMunicipio="+ctMinicipio;


		if (window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}else{
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}

		conexion.onreadystatechange=function(){
			if (conexion.readyState==4 && conexion.status==200) {
				document.getElementById("localX").innerHTML = conexion.responseText;
			}
		}

		conexion.open("POST","variable.php",true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		conexion.send(valor);

	}
	</script>
<!-- 	Ajax de Auto Completado para Colonia -->


<!-- Todas en mayusculas -->
	<style>
		input[type=text],[type=number]{
			text-transform: uppercase;
		}
		textarea{
			text-transform: uppercase;
		}
	</style>
<!-- Todas en mayusculas -->

</head>
<body>
	<div class="container">
	<br>
		<div class="row">
		  <div class="col-md-6 col-md-offset-3 panel panel-success">
		  	<h1>Reporte Diario de Actividades</h1>
		  	<br>


				<form action="insertar.php" method="post" enctype="multipart/form-data">
					<div class="form-group">

					    <label>Municipio:</label>

					    <input type="text" name="txtMuni" placeholder="Municipio" id="autoMunicipio" autocomplete="on" onfocusout="ejecutarAjax()" class="form-control"/>
					</div>

					<div class="form-group">

					    <label>Localidad / Colonia:</label>

						
					    	<input type="text" name="txtLocColonia" placeholder="Localidad / Colonia..." id="autoLocColonia" autocomplete="on" class="form-control"/>
					    
					</div>

					<div class="form-group">

					    <label>Sección:</label>

					    <input type="number" name="txtSecc" maxlength="4" pattern="[0-9]{4}" placeholder="Sección..." id="autoSeccion" autocomplete="on" class="form-control"/>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading"><b>Distrito Electoral</b></div>
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">

								    <label>Local:</label>
									<div id="localX">
								    <input type="number" name="txtLocal" maxlength="2" pattern="[0-9]{2}" placeholder="Local..."  autocomplete="on" class="form-control"/>
								    </div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">

								    <label>Federal:</label>

								    <input type="number" name="txtFederal" maxlength="2" pattern="[0-9]{2}" placeholder="Federal..." id="autoFederal" autocomplete="on" class="form-control"/>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">

					    <label>No. de Asistentes o Visitados:</label>

					    <input type="number" name="txtVisitados" maxlength="3" pattern="[0-9]{3}" placeholder="No. de Asistentes o Visitados..." autocomplete="on" class="form-control"/>
					</div>

					<div class="form-group">

					    <label>Resultados Obtenidos (Comentarios)</label>

					    <textarea name="txtComentarios" cols="30" rows="10" class="form-control" placeholder="Comentarios..."></textarea>
					</div>
					<div class="jumbotron">
					<div class="form-group">

					    <label><h3>Evidencia Fotográfica</h3></label>
					</div>

					<div class="form-group">

					    <label>Foto Uno:</label>

					    <!-- <input id="archivos" name="fotoUno" type="file" multiple=true accept=".jpg"  class="file-loading"> -->
					    <input id="archivos" name="fotoUno" type="file" multiple=true accept=".jpg"  onChange="validateAUno(this.value)" class="file-loading">
					</div>

					<div class="form-group">

					    <label>Foto Dos:</label>

					    <input id="archivos2" name="fotoDos" type="file" multiple=true accept=".jpg" onChange="validateADos(this.value)"class="file-loading">
					</div>

					</div>

					<div class="form-group">

					    <input type="submit" value="Guardar" class="btn btn-success btn-lg btn-block"/>
					</div>

					
				</form>




		  </div>
		</div>
	</div>


<!-- Esta es la parte de Auto Completados -->
<script>
$( "#autoMunicipio" ).autocomplete({
  source: "municipios.php"
});

$( "#autoLocColonia" ).autocomplete({
  source: "locColonia.php"
});

$( "#autoSeccion" ).autocomplete({
  source: "seccion.php"
});


</script>
<!-- Esta es la parte de Auto Completados -->



</body>




<script>
	$("#archivos").fileinput({
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 2,
        showUpload: false, 
        showRemove: false
	});
	$("#archivos2").fileinput({
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 2,
        showUpload: false, 
        showRemove: false
	});
</script>

<script>
	
	function validateAUno(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg"];

	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Solo Archivos '.jpg'.");
	        $("#archivos").val("");
	    }
	}

	function validateADos(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg"];

	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Solo Archivos '.jpg'.");
	        $("#archivos2").val("");
	    }
	}
</script>

</html>