 <h1 class="title">Nuevo contenedor</h1>
 <div class="col-sm-4"></div>
 <div class="col-sm-4">
 <form class="form-horizontal" role="form" id="guardarCon" action="javascript:guardarCont();">        
        <div class="form-group">
          <label for="estado"> Alias del contenedor: </label>
          <input type="text" name="alias" id="alias" class="form-control">
        </div>
        <div class="form-group">
              <label for="tipo"> Tipo de contenedor: </label>
              <select class="form-control seleccionar" id="tipo" name="tipo">
                <option value="1">Estacion</option>
                <option value="2">Salchicha</option>
                <option value="3">Pipa</option>                
          </select>
        </div>
        <div class="form-group">
          <label for="direccion"> Dirección del contenedor: </label>
          <input type="text" name="direccion" id="direccion" class="form-control">
        </div>
        <div class="form-group">
          <label for="estado"> Capacidad del contenedor: </label>
          <input type="number" name="capacidad" id="capacidad" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
</form>
</div>
<script>
function guardarCont()
{
  var link = 'agregarContenedor.php?'+$( "#guardarCon" ).serialize();
      console.log(link);
  $.get(link, function(resultado){
        alert("Guardado exitosamente");
  newStation();
  });
}
</script>