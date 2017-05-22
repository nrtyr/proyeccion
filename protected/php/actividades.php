<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

session_start();

if (isset($_SESSION['pwUsuario']) && !empty($_SESSION['pwUsuario'])) {
	$varCss = "";
}else{

	session_destroy();

	$varCss = '

	body{
			display: none;
		}


	';
	echo "<script> alert('No puedes ver esta Pagina!!'); </script>";
	echo "<script> window.location='../../index.php'; </script>";

}

 ?>

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

	<!-- este es el delay de la pagina -->
	<?php include("../../inc/displayDelay.inc"); ?>
	<!-- este es el delay de la pagina -->


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


<!-- Ajax para Geolocalización -->
	<script>
		
function geoLocaliza() {
  var output = document.getElementById("geoPosLatLong");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Tu navegador no soporta la Geo Localización!</p>";
    return;
  }

  function success(position) {
	    var latitude  = position.coords.latitude;
	    var longitude = position.coords.longitude;
	    var geoPos;

	      if (window.XMLHttpRequest) {
	        geoPos = new XMLHttpRequest();
	      }else{
	        geoPos = new ActiveXObject("Microsoft.XMLHTTP");
	      }
	      geoPos.onreadystatechange=function(){
	        if (geoPos.readyState==4 && geoPos.status==200) {
	          document.getElementById("geoPosLatLong").innerHTML=geoPos.responseText;
	        }
	      }
	      geoPos.open("GET", "geo.php?q="+latitude+"&q2="+longitude,true);
	      geoPos.send();
	  };

	  function error() {
	    output.innerHTML = "<span class='glyphicon glyphicon-map-marker' aria-hidden='true'></span> No se puede encontrar tu ubicación!";
	  };

	  output.innerHTML = "<p><span class='glyphicon glyphicon-map-marker' aria-hidden='true'></span> Localizando..</p>";

	  navigator.geolocation.getCurrentPosition(success, error);
	}

		  
	</script>
<!-- Ajax para Geolocalización -->

<!-- Todas en mayusculas -->
	<style>

		input[type=text],[type=number]{
			text-transform: uppercase;
		}
		textarea{
			text-transform: uppercase;
		}

		<?php echo $varCss; ?>

	</style>
<!-- Todas en mayusculas -->

</head>
<body onload="geoLocaliza()">

	<div class="container">
	<br>
		<div class="row">
		  <div class="col-md-6 col-md-offset-3 panel panel-success">
			
		  	<div class="ok"><h1>Reporte Diario de Actividades</h1></div>
		  	<br>
		  	


				<form action="insertar.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<h2>
							<small>

								<div id="geoPosLatLong">
									<span class='glyphicon glyphicon-map-marker' aria-hidden='true'></span>
								</div>
							</small>
						</h2>
						<br>

					    <label>Municipio:</label>

					    <input type="text" name="txtMuni" placeholder="Municipio" id="autoMunicipio" autocomplete="on" onfocusout="ejecutarAjax()" class="form-control" required/>
					</div>

					<div class="form-group">

					    <label>Localidad / Colonia:</label>

						
					    	<input type="text" name="txtLocColonia" placeholder="Localidad / Colonia..." id="autoLocColonia" autocomplete="on" class="form-control" required/>
					    
					</div>

					<div class="form-group">

					    <label>Sección:</label>

					    <input type="text" name="txtSecc" size="4" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Sección..." id="autoSeccion" autocomplete="on" class="form-control" required/>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading"><b>Distrito Electoral</b></div>
						<div id="localX">
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">

								    <label>Local:</label>
									
								    <input type="text" name="txtLocal" size="2" maxlength="2" pattern="[0-9]" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Local..."  autocomplete="on" class="form-control"/>
								    
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">

								    <label>Federal:</label>

								    <input type="text" name="txtFederal" size="2" maxlength="2" pattern="[0-9]" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Federal..." id="autoFederal" autocomplete="on" class="form-control"/>
								</div>
							</div>
						</div>
						</div>
					</div>

					<div class="form-group">

					    <label>No. de Asistentes o Visitados:</label>

					    <input type="text" name="txtVisitados" size="2" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Asistentes..." id="autoSeccion" autocomplete="on" class="form-control" required/>
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
					    <input id="archivos" name="fotoUno" type="file" multiple=true accept=".jpg"  onChange="validateAUno(this.value)" class="file-loading" required>
					</div>

					<div class="form-group">

					    <label>Foto Dos:</label>

					    <input id="archivos2" name="fotoDos" type="file" multiple=true accept=".jpg" onChange="validateADos(this.value)" class="file-loading" required>
					</div>

					</div>

					<div class="form-group">

					    <input type="submit" value="Guardar" class="btn btn-success btn-lg btn-block"/>
					</div>

					

					
				</form>

					<a href="destruir.php" ><button class="btn btn-danger btn-lg btn-block">Cerrar sesion <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button>
					</a>
					<br>


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