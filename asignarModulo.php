<div class="row">
	<h1 class="title">Asignar dispositivo monitor</h1>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
			<label>Modulo</label>
			 <select class="form-control seleccionar" id="modulo" name="modulo">
                <?php
              require('config.php');
              $conn = new mysqli($host, $user, $passwd, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
              $sql = "SELECT * FROM modulos";
              $result = $conn->query($sql);
              $conn->close();
               while($row = $result->fetch_assoc()) 
                 {
                  echo '<option value="'.$row['id'].'">'.$row['clave'].'</option>';
                 }
            ?>
          </select>
          <label>Contenedor</label>
			<select class="form-control seleccionar" id="contenedor" name="contenedor">
                <?php
              require('config.php');
              $conn = new mysqli($host, $user, $passwd, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
              $sql = "SELECT * FROM contenedores";
              $result = $conn->query($sql);
              $conn->close();
               while($row = $result->fetch_assoc()) 
                 {
                  echo '<option value="'.$row['id'].'">'.$row['alias'].'</option>';
                 }
            ?>
          </select>
          <br>
		<button onClick="asignar()" class="btn btn-primary">Agregar</button>
	</div>
</div>
<script>
$(document).ready(function()
{
		$('.seleccionar').select2();
});

function asignar()
{	
	var idContenedor = $('#contenedor').val(),
		idModulo = $('#modulo').val();
		url = 'registrarModulo.php?opcion=asignar&idModulo='+idModulo+
		'&idContenedor='+idContenedor;

	$.get(url,function(respuesta){
		alert(respuesta);
		asignarModulo();
	});
}
</script>