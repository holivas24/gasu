<?php
session_start();
  if(!isset($_SESSION['username']) && $_SESSION['nivel'] !=2){
    header("Location:login.php");
    die();
  }

  $date = date('Y-m-d');
?>
<div class="col-sm-12" style="width:100%">
  <h1 class="title">Reportes</h1>
      <form class="form-inline" role="form" id="buscarPorEstado" action="javascript:porEstado();">        
        <div class="form-group">
          <label for="estado"> Estado: </label>
          <select class="form-control" id="estado" name="estado">
            <option value="*">Todos</option>
            <option value="1">Pedido</option>
            <option value="2">Asignado</option>
            <option value="3">Entregado</option>
          </select>
        </div>
        <div class="form-group">
              <label for="operador"> Operador: </label>
              <select class="form-control seleccionar" id="operador" name="operador">
                <option value="*">Todos</option>
                <?php
              require('config.php');
              $conn = new mysqli($host, $user, $passwd, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
              $sql = "SELECT * FROM operador WHERE id>1";
              $result = $conn->query($sql);
              $conn->close();
               while($row = $result->fetch_assoc()) 
                 {
                  echo '<option value="'.$row['id'].'">'.$row['nombres'].' '.$row['apPaterno'].' '.$row['apMaterno'].'</option>';
                 }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="fecha1"> Desde:</label>
          <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>
        <div class="form-group">
          <label for="fecha2">Hasta:</label>
          <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>
        <label class="radio-inline"><input type="radio" name="opcion" value="1" checked>Tanques</label>
        <label class="radio-inline"><input type="radio" name="opcion" value="2">Cilindros</label>
        <br><br>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Consultar</button>
      </form>
      <br>
      <div id="tablaEstado"></div>
</div>
<script>
$(document).ready(function(){
    $('#fecha1').val(obtenerFecha());
    $('#fecha2').val(obtenerFecha());
  /*
  $('#fecha1').datepicker({ 
     currentText: "Now",
     dateFormat: 'yy/mm/dd',
     altFormat: 'yyyy-mm-dd'
     });
    $('#fecha2').datepicker({ 
     currentText: "Now",
     dateFormat: 'yy/mm/dd',
     altFormat: 'yyyy-mm-dd'
     });
*/
    $('.seleccionar').select2();
});

function porEstado()
{
  var link = 'buscarPorEstado.php?'+$( "#buscarPorEstado" ).serialize();
      console.log(link);

  $.ajax({
    url: link,
    contentType: 'application/html; charset=utf-8',
    type: 'GET',
    dataType: 'html'

  }).success(
  function(result)
    {
      $('#tablaEstado').html(result);
    }
  ).error(function(xhr,status)
  {
    alert(status);
  });

}

function addZero(i) 
{
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function obtenerFecha()
{
    var currentdate = new Date(); 
    var datetime = currentdate.getFullYear()+"-"+
                   addZero((currentdate.getMonth()+1))+"-"+
                   addZero(currentdate.getDate());
    return datetime;
}
</script>

