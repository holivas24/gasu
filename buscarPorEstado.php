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

	$estado = prepare($_REQUEST['estado']);
	$operador = prepare($_REQUEST['operador']);
	$fecha1 = prepare($_REQUEST['fecha1'])." 00:00:01";
	$fecha2 = prepare($_REQUEST['fecha2'])." 23:59:59";
	$opcion = prepare($_REQUEST['opcion']);
	$tabla ="";
	$contenedor ="";
	$word ="";
    $unidad = "";
    $totalCant= 0.0;
    $totalVent= 0.0;
    $pedidos = 0;

	if($opcion == 1){
		$tabla = "pedidosTanque";
		$contenedor = "tanques";
		$word="tanque";
        $unidad = "Lts";
	}
	else{
		$tabla = "pedidosCilindro";
		$contenedor = "cilindros";
		$word="cilindro";
        $unidad = "Kg";
	}

	require('config.php');
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
//Estado todos, operador todos
if($estado == '*' && $operador == '*'){
	$sql = "SELECT $tabla.id as id, 
        $tabla.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        $contenedor.alias as tanque, 
        $contenedor.direccion,
        $tabla.fecha,
        $tabla.cantidad,
        $tabla.costo
    FROM  $tabla 
    INNER JOIN operador 
        ON operador.id = $tabla.operador
    INNER JOIN $contenedor 
        ON $contenedor.id=$tabla.$word
    INNER JOIN usuarios  
        ON usuarios.id = $contenedor.usuario
	 WHERE $tabla.fecha BETWEEN '$fecha1' AND '$fecha2'";
}
//Estado uno, operador todos
elseif($estado != '*' && $operador == '*'){
	$sql = "SELECT $tabla.id as id, 
        $tabla.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        $contenedor.alias as tanque, 
        $contenedor.direccion,
        $tabla.fecha,
        $tabla.cantidad,
        $tabla.costo
    FROM  $tabla 
    INNER JOIN operador 
        ON operador.id = $tabla.operador
    INNER JOIN $contenedor 
        ON $contenedor.id=$tabla.$word
    INNER JOIN usuarios  
        ON usuarios.id = $contenedor.usuario
	 WHERE estado=$estado 
	 AND $tabla.fecha BETWEEN '$fecha1' AND '$fecha2'";
}
//Estado todos, operador uno
elseif($estado == '*' && $operador != '*'){
	$sql = "SELECT $tabla.id as id, 
        $tabla.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        $contenedor.alias as tanque, 
        $contenedor.direccion,
        $tabla.fecha,
        $tabla.cantidad,
        $tabla.costo
    FROM  $tabla 
    INNER JOIN operador 
        ON operador.id = $tabla.operador
    INNER JOIN $contenedor 
        ON $contenedor.id=$tabla.$word
    INNER JOIN usuarios  
        ON usuarios.id = $contenedor.usuario
	 WHERE operador=$operador 
	 AND $tabla.fecha BETWEEN '$fecha1' AND '$fecha2'";
}
//Estado uno, operador uno
elseif($estado != '*' && $operador != '*'){
	$sql = "SELECT $tabla.id as id, 
        $tabla.estado,
        operador.nombres as nombreOp,
        operador.apPaterno as paternoOp,
        operador.apMaterno as maternoOp,
        usuarios.nombres as nombreUsuario, 
        usuarios.apPaterno as paternoUsuario,
        usuarios.apMaterno as maternoUsuario,
        $contenedor.alias as tanque, 
        $contenedor.direccion,
        $tabla.fecha,
        $tabla.cantidad,
        $tabla.costo
    FROM  $tabla 
    INNER JOIN operador 
        ON operador.id = $tabla.operador
    INNER JOIN $contenedor 
        ON $contenedor.id=$tabla.$word
    INNER JOIN usuarios  
        ON usuarios.id = $contenedor.usuario
	 WHERE operador=$operador AND estado=$estado
	 AND $tabla.fecha BETWEEN '$fecha1' AND '$fecha2'";
}
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
                <th>Cantidad(<?php echo $unidad;?>)</th>
                <th>Costo (<?php echo "$";?>)</th>
                <th>Contenedor</th>
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
                <th>Contenedor</th>
                <th>Fecha</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        	 while($row = $result->fetch_assoc()) 
        {
            $totalCant += $row['cantidad'];
            $totalVent += $row['costo'];
            $pedidos++;
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
<div class="col-sm-4"></div>
<div class="col-sm-4">
     <div class="panel panel-primary">                       
    <div class="panel-heading">
        Resultados de la consulta
    </div>    
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Dato</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="info">
                        <td>Numero de pedidos</td>
                        <td><?php echo $pedidos;?></td>
                    </tr>
                    <tr class="info">
                        <td>Cantidad vendida(<?php echo $unidad;?>)</td>
                        <td><?php echo $totalCant;?></td>
                    </tr>
                    <tr class="info">
                        <td>Total de ventas(<?php echo "$";?>)</td>
                        <td><?php echo $totalVent;?></td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
	$(document).ready(function(){ 
		estado();
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
</script>