<?php 
	require('config.php');
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}

	$idSession = $_SESSION['id'];
	$contenedor = 0;
    $conn = new mysqli($host, $user, $passwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT contenedor FROM movilContenedor where movil = '$idSession' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $contenedor = $row['contenedor'];
        }
    }
    else{
        $contenedor = 0;
    }
?>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		  <div class="form-group">
		    <label for="inputdefault">Porcentaje</label>
		    <input class="form-control" id="valor" type="number" max="99" min="0" required>
		  </div>
		  <button class="btn btn-primary btn-lg" onClick="enviar()">Enviar homie</button>
	</div>

<script>
	function enviar()
    {   
        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(pos);
        }                       
    }
    function pos(geo)
    {
       var porcentaje = $('#valor').val(),
       	   location = 'recibirNivelGeo.php?latitud='+geo.coords.latitude+
       	'&longitud='+geo.coords.longitude+
       	'&contenedor='+<?php echo $contenedor;?>+
       	'&porcentaje=0.'+porcentaje;
       	console.log(location);

       $.get(location,function(respuesta){
       		alert(respuesta);
       		send();
       	});
    }
</script>