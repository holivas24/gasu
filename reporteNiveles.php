<?php
session_start();
  if(!isset($_SESSION['username']) && $_SESSION['nivel'] !=2){
    header("Location:login.php");
    die();
  }

  $date = date('Y-m-d');
?>
<!--<button class="btn btn-primary" onClick="reportes()"><span class="glyphicon glyphicon-stats"></span> Pedidos</button>-->
<div class="col-sm-12" style="width:100%">
  <h1 class="title">Reportes</h1>
      <form class="form-inline" role="form" id="buscarCont" action="javascript:buscarContenedor();">        
        <div class="form-group">
          <label for="estado"> Tipo: </label>
          <select class="form-control" id="tipo" name="tipo">
            <option value="*">Todos</option>
            <option value="1">Estacion</option>
            <option value="2">Salchicha</option>
            <option value="3">Pipa</option>
          </select>
        </div>
        <div class="form-group">
              <label for="operador"> Contenedor: </label>
              <select class="form-control seleccionar" id="contenedor" name="contenedor">
                <option value="*">Todos</option>
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
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Consultar</button>
      </form>
      <br>
      <div id="tablaEstado"></div>
</div>
<script>
$(document).ready(function(){

    $('.seleccionar').select2();
});

function buscarContenedor()
{
  var link = 'buscarContenedor.php?'+$( "#buscarCont" ).serialize();
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
</script>