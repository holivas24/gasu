<div class="row">
	<h1 class="title">Nuevo dispositivo monitor</h1>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
			<label>Clave</label>
			<input type="text" class="form-control" id="clave"><br>
			<button onClick="enviarNuevo()" class="btn btn-primary">Agregar</button>
	</div>
</div>
<script>
	function enviarNuevo()
	{	
		var clave = $('#clave').val(),
			url = 'registrarModulo.php?opcion=nuevo&clave='+clave;

		$.get(url,function(respuesta){
			alert(respuesta);
			nuevoModulo();
		});
	}
</script>