<?php
session_start();
	if(!isset($_SESSION['username']) && $_SESSION['nivel'] !=2){
		header("Location:login.php");
		die();
	}
	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$latitud;
	$longitud;
	require('config.php');

	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT * FROM contenedores";
	$result = $conn->query($sql);
	$conn->close();
    ?>                  <div class="row">
    					<div class="col-sm-2"></div>
                        <div class="col-sm-8">
                        <div class="table-responsive">
                        <h2 class="title">Estado Actual de contenedores</h2>
                        <table id="rtable" class="table table-striped table-bordered table-hover">
	                        <thead>
				                <tr>
				                	<th>#</th>
				                    <th>Alias</th>
				                    <th>Tipo</th>
				                    <th>Dirección</th>
				                    <th>Capacidad</th>
				                    <th>(%)</th>
				                    <th>Mapa</th>
				                </tr>
				            </thead>
				            <tfoot>
				                <tr>
				                	<th>#</th>
				                    <th>Alias</th>
				                    <th>Tipo</th>
				                    <th>Dirección</th>
				                    <th>Capacidad</th>
				                    <th>(%)</th>
				                    <th>Mapa</th>
				                </tr>
				            </tfoot>
    <tbody>
    <?php
    while($row = $result->fetch_assoc()) 
        {
        	$porcentaje = $row['porcentaje'] * 100;
            echo"<tr>";
            echo"   <td>".$row['id']."</td>";
            echo"   <td>".$row['alias']."</td>";
            echo"   <td>".$row['tipo']."</td>";
            echo"   <td>".$row['direccion']."</td>";
            echo"   <td>".$row['capacidad']."</td>";
            echo"   <td>".$porcentaje."%</td>";
            echo'   <td><button value="'.$row['id'].'" class="btn btn-sm btn-primary button" onClick="initMap('.$row['latitud'].','.$row['longitud'].')"> Mapa</button></td>';

            }
            echo "</tbody>";
            echo "</table>";

    ?>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    	<div class="col-sm-2"></div>
        <div class="col-sm-8">
        	<div id="map"></div>
        </div>
    </div>
    <script>
        function initMap(latitude,longitude)
        {
            
          var myLatLng = {lat: latitude, lng: longitude};
          var suc = {lat: latitude, lng: longitude}
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: myLatLng
          });

          var marker = new google.maps.Marker({
            position: suc,
            map: map,
            title: "Ubicacion"
          });
        }

    </script>
<script>
	$(document).ready(function(){
		$('#rtable').DataTable();
		});
</script>
<style>
      #map {
        position: center;
        height: 500px;
        width: 80%;
      }
</style>