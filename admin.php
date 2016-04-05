<?php
session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
if($_SESSION['nivel'] >=2)
echo '
			<div id="search" class="row">

				<h3>Buscar Usuario</h3>
				<form>
					<label>Nombre : </label><input type="text" id="nombre">
					<label>Apellido Paterno: </label><input type="text" id="apPaterno">
					<label>Apellido Materno: </label><input type="text" id="apMaterno">
					<button class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar</button>
				</form>
			</div>
		
		';
?>