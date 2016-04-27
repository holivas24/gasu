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
<h2>Cuenta <small><?php echo $row['username'];?></small></h2>
<table class="table" width="50%">
		<tr>
			<td rowspan="6"><h4> Datos</h4></td>			
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
		<tr>
			<td></td>
			<td><button class="btn btn-sm btn-primary" id="guardarusuario"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar datos</button></td>
			
		</tr>
	</table>

	
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
			<td rowspan="<?php echo ($result->num_rows)*4+1; ?>"><h4> Tanques</h4></td>
		</tr>
<?php
		 while($row = $result->fetch_assoc()) 
		{		
?>
		<tr>
			<td>Nombre: </td>
			<td><a href="#" id="nombreTanque<?php echo $row['id'];?>" data-type="text" data-title="Escribir nombre" class="editable"><?php echo $row['alias'];?></a></td>
		
		</tr>
		<tr>
			<td>Dirección: </td>
			<td><a href="#" id="direccion<?php echo $row['id'];?>" data-type="text" data-title="Escribir dirección" class="editable"><?php echo $row['direccion'];?></a></td>
			
		</tr>
		<tr>
			<td>Capacidad: </td>
			<td><a href="#" id="capacidad<?php echo $row['id'];?>" data-type="text" data-title="Escribir capacidad" class="editable"><?php echo $row['capacidad'];?></a></td>
		
		</tr>

		<tr>
			<td></td>
			<td><button class="btn btn-sm btn-primary" id="guardartanques" onClick="guardarTanque(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar tanque</button></td>
		</tr>
<?php
}
$conn->close();
?>
</table>

	
<hr>

<table class="table" width="50%">
<?php
		$conn = new mysqli($host, $user, $passwd, $db);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		$sql = "SELECT * FROM cilindros WHERE usuario='$userid'";
		$result = $conn->query($sql);

?>
		<tr>
			<td rowspan="<?php echo ($result->num_rows)*4+1; ?>"><h4> Cilindros</h4></td>
		</tr>
<?php
		 while($row = $result->fetch_assoc()) 
		{		
?>
		<tr>
			<td>Nombre: </td>
			<td><a href="#" id="nombreCilindro<?php echo $row['id'];?>" data-type="text" data-title="Escribir nombre" class="editable"><?php echo $row['alias'];?></a></td>
		
		</tr>
		<tr>
			<td>Dirección: </td>
			<td><a href="#" id="direccionCilindro<?php echo $row['id'];?>" data-type="text" data-title="Escribir dirección" class="editable"><?php echo $row['direccion'];?></a></td>
			
		</tr>
		<tr>
			<td>Capacidad: </td>
			<td><a href="#" id="capacidadCilindro<?php echo $row['id'];?>" data-type="text" data-title="Escribir capacidad" class="editable"><?php echo $row['capacidad'];?></a></td>
		
		</tr>

		<tr>
			<td></td>
			<td><button class="btn btn-sm btn-primary" id="guardarcilindros" onClick="guardarCilindro(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar tanque</button></td>
		</tr>
<?php
}
$conn->close();
?>
</table>

	
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

function guardarTanque(idtanque)
{
	var direccion = $('#direccion'+idtanque).text()
		capacidad = $('#capacidad'+idtanque).text(),
		nombreTanque = $('#nombreTanque'+idtanque).text();

		$.get('modtanque.php?tanque='+idtanque+'&direccion='+
			direccion+'&capacidad='+capacidad+'&nombreTanque='+nombreTanque,
			function(){
				alert("Modificado exitosamente");
				configuracion();
			});
}

function guardarCilindro(idtanque)
{
	var direccion = $('#direccionCilindro'+idtanque).text()
		capacidad = $('#capacidadCilindro'+idtanque).text(),
		nombreTanque = $('#nombreCilindro'+idtanque).text();

		$.get('modcil.php?tanque='+idtanque+'&direccion='+
			direccion+'&capacidad='+capacidad+'&nombreTanque='+nombreTanque,
			function(){
				alert("Modificado exitosamente");
				configuracion();
			});
}
</script>