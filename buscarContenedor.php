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

	$type = prepare($_REQUEST['tipo']);
	$contenedor = prepare($_REQUEST['contenedor']);

    if($type == 1)
        $tipo = 'Estacion';
    elseif($type == 2)
        $tipo = 'Salchicha';
    elseif($type == 3)
        $tipo = 'Pipa';
    else
        $tipo = '*';




	require('config.php');
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
//Estado todos, operador todos
if($tipo == '*' && $contenedor == '*'){
	$sql = "SELECT * FROM contenedores";
}
//Estado uno, operador todos
elseif($tipo != '*' && $contenedor == '*'){
	$sql = "SELECT * FROM contenedores WHERE tipo LIKE '$tipo'";
}
//Estado todos, operador uno
elseif($tipo == '*' && $contenedor != '*'){
	$sql = "SELECT * FROM contenedores WHERE id = '$contenedor'";
}
//Estado uno, operador uno
elseif($tipo != '*' && $contenedor != '*'){
	$sql = "SELECT * FROM contenedores WHERE tipo LIKE '$tipo' and id = '$contenedor'";
}
	$result = $conn->query($sql);
	$conn->close();
?>
<div class="table-responsive">
<table id="example" class="display tabla" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Alias</th>
                <th>Dirección</th>
                <th>Capacidad</th>
                <th>(%)</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Alias</th>
                <th>Dirección</th>
                <th>Capacidad</th>
                <th>(%)</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        	 while($row = $result->fetch_assoc()) 
        {
            $porcentaje = $row['porcentaje'] * 100;
        ?>
        <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['tipo'];?></td>
                <td><?php echo $row['alias'];?></td>
                <td><?php echo $row['direccion'];?></td>
                <td><?php echo $row['capacidad'];?></td>
                <td><?php echo $porcentaje.'%';?></td>
                <td><a data-toggle="modal" data-id="<?php echo $row['id'];?>" title="Ver Detalle" class="verDetalle btn btn-primary" href="#detalleContenedor">Ver detalle</a></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--  MODAL -->
<div class="modal fade" id="detalleContenedor" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detalles</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-inline" action="javascript:detalles()" method="POST"> 
                <div class="form-group">
                    <label>Contenedor</label>
                    <input type="number" name="idContenedor" id="idContenedor" value="" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <input type="date" id="fechaDatos" class="form-control">
                </div>
                <button class="btn btn-primary">Consultar</button>
                </form> 

                <div class="row grafica" id="graficaDetalle"></div>
                <br><br>
                <div class="row map" id="mapaDetalle"></div>
                <br>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->



<script>
	$(document).ready(function(){ 
		$('.tabla').DataTable();
        $('#fechaDatos').val(obtenerFecha());
	});

    $(document).on("click", ".verDetalle", function () {
     var idContenedor = $(this).data('id');
     $(".modal-body #idContenedor").val(idContenedor);
    });

    function detalles()
    {
        var contenedor = $('#idContenedor').val(),
            fecha = $('#fechaDatos').val();

        $.getJSON('jsonNiveles.php?contenedor='+contenedor+'&fecha='+fecha,
            function(datos){
                grafica(datos[1],datos[2],fecha);
                mapa(datos[0]);
            });
    }

    function mapa(puntos)
    {
        console.log(puntos[0].latitud,puntos[0].longitud);
       var map = new google.maps.Map(document.getElementById('mapaDetalle'), {
          zoom: 10,
          center: new google.maps.LatLng(puntos[0].latitud,puntos[0].longitud),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < puntos.length; i++) 
        {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(puntos[i].latitud, puntos[i].longitud),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent('Hora: '+puntos[i].hora+'<br> Porcentaje: '+puntos[i].porcentaje+'%<br>Parada: '+puntos[i].posiscion);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
    }

    function grafica(horas,datos,fecha)
    {
        $('#graficaDetalle').highcharts({
        title: {
            text: 'Nivel del contenedor',
            x: -20 //center
        },
        subtitle: {
            text: 'Fecha: '+fecha,
            x: -20
        },
        xAxis: {
            categories: horas
        },
        yAxis: {
            title: {
                text: 'Porcentaje (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        credits: {
            text: 'GasU',
            href: 'http://gasu.esy.es'
        },
        series: [{
            name: 'Nivel',
            data: datos,
            color:'#0000FF'
        }]
    });
    }
</script>
<style>
      .map {
        position: center;
        height: 400px;
        width: 80%
        margin: 0 auto;
      }

      .grafica{ 
        position: center;
        height: 400px;
        width: 80%
        margin: 0 auto;
      }
</style>