<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
	require('config.php');

		$userid = $_SESSION['id'];
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "SELECT * FROM usuarios WHERE id='$userid' LIMIT 1";

		$result = $conn->query($sql);
		 while($row = $result->fetch_assoc()) 
		{		
?>
<h2>Mi cuenta <small><?php echo $row['username'];?></small></h2>
<table class="table" width="50%">
		<tr>
			<td rowspan="5"><h4>Mis datos</h4></td>
		</tr>
		<tr>
			<td>Nombre(s): </td>
			<td><a href="#" id="nombres" data-type="text" data-title="Escribir nombres" class="editable"><?php echo $row['nombres'];?></a></td>
		</tr>

			<tr>
			<td>Apellido Paterno: </td>
			<td><a href="#" id="apPaterno" data-type="text" data-title="Escribir apellido" class="editable"><?php echo $row['apPaterno'];?></a></td>
		</tr>

		<tr>
			<td>Apellido Materno: </td>
			<td><a href="#" id="apMaterno" data-type="text" data-title="Escribir apellido" class="editable"><?php echo $row['apMaterno'];?></a></td>
		</tr>

		<tr>
			<td>Email: </td>
			<td><a href="#" id="email" data-type="text" data-title="Escribir email" class="editable"><?php echo $row['email'];?></a></td>
		</tr>		
	</table>

	<button class="btn btn-sm btn-primary" id="guardarusuario"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
<?php
}
$conn->close();
?>

<table class="table" width="50%">
<?php
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "SELECT * FROM tanques WHERE usuario='$userid'";
		$result = $conn->query($sql);

?>
		<tr>
			<td rowspan="<?php echo $result->num_rows +1; ?>"><h4>Mis Tanques</h4></td>
		</tr>
<?php
		 while($row = $result->fetch_assoc()) 
		{		
?>

		<tr>
			<td>Dirección: </td>
			<td><a href="#" id="nombres" data-type="text" data-title="Escribir nombres" class="editable"><?php echo $row['direccion'];?></a></td>
			<td>Capacidad: </td>
			<td><a href="#" id="nombres" data-type="text" data-title="Escribir nombres" class="editable"><?php echo $row['capacidad'];?></a></td>
		</tr>
<?php
}
$conn->close();
?>
</table>

	<button class="btn btn-sm btn-primary" id="guardartanques"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
<hr>

<script>
$(document).ready(function(){
	$('.editable').editable();
	$('#guardarusuario').on("click",modUsuario);
});

function modUsuario()
{
	var nombres = $('#nombres').text()
		apPaterno = $('#apPaterno').text(),
		apMaterno = $('#apMaterno').text()
		email = $('#email').text();

		$.get('modusuario.php?nombres='+nombres+'&apPaterno='+
			apPaterno+'&apMaterno='+apMaterno+'&email='+email,
			function(){
				alert("Modificado exitosamente");
				configuracion();
			});
}
</script>