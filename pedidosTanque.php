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
	require('config.php');
?>
<!--  MODAL -->
<div class="modal fade" id="asignarPedidoDialog" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	 		<div class="modal-header">
	    		<button class="close" data-dismiss="modal">×</button>
	   			<h4 class="modal-title">Asignar recarga</h4>
	  		</div>
	    	<div class="modal-body">
		        <h5>Datos de asignacion</h5>
		        <form role="form" action="asignarRecarga.php" method="POST"> 
		        <div class="form-group">
			        <label>ID de la recarga</label>
			        <input type="number" name="pedidoId" id="pedidoId" value="" class="form-control" readonly>
		        </div>
		        <div class="form-group">
			        <label>Operador</label><br>
			        <select name="asOperador" id="asOperador" class="form-control">
			        	<?php
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
				<button class="btn btn-primary">Asignar</button>
				</form>	
		    </div>
		 	<div class="modal-footer">
		      	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		 	</div>
		</div>
	</div>
</div>
<!-- END MODAL -->
<button class="btn btn-primary" id="cilindros" onClick="admin(2)"><span class="glyphicon glyphicon-record"></span> Ir a Cilindros</button>
<section class="wrapper">
  <ul class="tabs">
    <li><a href="#tab1">Recargas pedidas</a></li>
    <li><a href="#tab2">Recargas asignadas</a></li>
    <li><a href="#tab3">Recargas realizadas</a></li>
  </ul>
  <div class="clr" style="margin:20px;"></div>

  <div class="panel panel-default">
  <div class="panel-heading"><h3>Pedidos de recargas</h3></div>
  <div class="panel-body">
  <section class="block" class="contenido">
    <article id="tab1">
	<?php
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT pedidosTanque.id as id, 
        pedidosTanque.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        tanques.alias as tanque, 
        tanques.direccion,
        pedidosTanque.fecha,
        pedidosTanque.cantidad,
        pedidosTanque.costo
    FROM  pedidosTanque 
    INNER JOIN operador 
        ON operador.id = pedidosTanque.operador
    INNER JOIN tanques 
        ON tanques.id=pedidosTanque.tanque
    INNER JOIN usuarios  
        ON usuarios.id = tanques.usuario
	 WHERE estado=1";
	$result = $conn->query($sql);
	$conn->close();
	?>
	<table id="example" class="display tabla" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        	 while($row = $result->fetch_assoc()) 
        {
        ?>
        <tr>
                <td><?php echo $row['id'];?></td>
                <td class="estado"><?php echo $row['estado'];?></td>
                <td><?php echo $row['direccion'];?></td>
                <td><?php echo $row['nombreUsuario']." ".$row['paternoUsuario']." ".$row['maternoUsuario'];?></td>
                <td><?php echo $row['nombreOp']." ".$row['paternoOp']." ".$row['maternoOp'];?></td>
                <td><?php echo $row['cantidad'];?></td>
                <td><?php echo $row['costo'];?></td>
                <td><?php echo $row['tanque'];?></td>
                <td><?php echo $row['fecha'];?></td>
                <td><a data-toggle="modal" data-id="<?php echo $row['id'];?>" title="Add this item" class="openAsignacion btn btn-primary" href="#asignarPedidoDialog">Asignar Pedido</a></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    </article>
    <article id="tab2" class="tabs">
      <?php

    $conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT pedidosTanque.id as id, 
        pedidosTanque.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        tanques.alias as tanque, 
        tanques.direccion,
        pedidosTanque.fecha,
        pedidosTanque.cantidad,
        pedidosTanque.costo
    FROM  pedidosTanque 
    INNER JOIN operador 
        ON operador.id = pedidosTanque.operador
    INNER JOIN tanques 
        ON tanques.id=pedidosTanque.tanque
    INNER JOIN usuarios  
        ON usuarios.id = tanques.usuario
	WHERE estado=2";
	$result = $conn->query($sql);
	$conn->close();
	?>
	<table id="example" class="display tabla" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        	 while($row = $result->fetch_assoc()) 
        {
        ?>
        <tr>
                <td><?php echo $row['id'];?></td>
                <td class="estado"><?php echo $row['estado'];?></td>
                <td><?php echo $row['direccion'];?></td>
                <td><?php echo $row['nombreUsuario']." ".$row['paternoUsuario']." ".$row['maternoUsuario'];?></td>
                <td><?php echo $row['nombreOp']." ".$row['paternoOp']." ".$row['maternoOp'];?></td>
                <td><?php echo $row['cantidad'];?></td>
                <td><?php echo $row['costo'];?></td>
                <td><?php echo $row['tanque'];?></td>
                <td><?php echo $row['fecha'];?></td>
                <td><a href="entregarRecarga.php?idPedido=<?php echo $row['id'];?>" class="btn btn-primary">Entregar</a></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    </article>
    <article id="tab3" class="tabs">
      <?php
    $conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT pedidosTanque.id as id, 
        pedidosTanque.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        tanques.alias as tanque, 
        tanques.direccion,
        pedidosTanque.fecha,
        pedidosTanque.cantidad,
        pedidosTanque.costo
    FROM  pedidosTanque 
    INNER JOIN operador 
        ON operador.id = pedidosTanque.operador
    INNER JOIN tanques 
        ON tanques.id=pedidosTanque.tanque
    INNER JOIN usuarios  
        ON usuarios.id = tanques.usuario
	WHERE estado=3";
	$result = $conn->query($sql);
	$conn->close();
	?>
	<table id="example" class="display tabla" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Dirección</th>
                <th>Cliente</th>
                <th>Operador</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Cilindro</th>
                <th>Fecha</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        	 while($row = $result->fetch_assoc()) 
        {
        ?>
        <tr>
                <td><?php echo $row['id'];?></td>
                <td class="estado"><?php echo $row['estado'];?></td>
                <td><?php echo $row['direccion'];?></td>
                <td><?php echo $row['nombreUsuario']." ".$row['paternoUsuario']." ".$row['maternoUsuario'];?></td>
                <td><?php echo $row['nombreOp']." ".$row['paternoOp']." ".$row['maternoOp'];?></td>
                <td><?php echo $row['cantidad'];?></td>
                <td><?php echo $row['costo'];?></td>
                <td><?php echo $row['tanque'];?></td>
                <td><?php echo $row['fecha'];?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    </article>
  </section>
  </div>
</div>
</section>

<script>
$(document).ready(function() {
	estado();
	$(document).on("click", ".openAsignacion", function () {
     var myBookId = $(this).data('id');
     console.log("Executed");
     $(".modal-body #pedidoId").val( myBookId );
	});

    $('.tabla').DataTable();
});




function estado()
{
	$('.estado').each(function()
	{
		if($(this).text()==1)
			$(this).text("Pedido");
		else if($(this).text()==2)
			$(this).text("Asignado");
		if($(this).text()==3)
			$(this).text("Entregado");
	});
}

	$(function(){
	  $('ul.tabs li:first').addClass('active');
	  $('.block article').hide();
	  $('.block article:first').show();
	  $('ul.tabs li').on('click',function(){
	    $('ul.tabs li').removeClass('active');
	    $(this).addClass('active')
	    $('.block article').hide();
	    var activeTab = $(this).find('a').attr('href');
	    $(activeTab).show();
	    return false;
	  });
	})
</script>

<style>
	body {
  background: white;
  font-family: sans-serif;
}
.wrapper {
  background: white;
  margin: auto;
  padding: 1em;
  width: 90%;
}
h1 {
  text-align: center;
}
ul.tabs {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
ul.tabs li {
  border: gray solid 1px;
  border-bottom: none;
  float: left;
  margin: 0 .25em 0 0;
  padding: .25em .5em;
}
ul.tabs li a {
  color: #333;
  font-weight: bold;
  text-decoration: none;
}
ul.tabs li.active {
  background: #337ab7;
}
ul.tabs li.active a {
  color: white;
}
.clr {
  clear: both;
}
article {
  border-top: gray solid 1px;
  padding: 0 1em;
}
</style>