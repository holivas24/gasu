function inicio()
{
	var link = "inicio.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Inicio');
}

function info()
{
	var link = "info.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Estacionarios');
}

function cilindros()
{
	var link = "cilindros.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Cilindros');
}

function configuracion()
{
	var link = "configuracion.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Configuración');
}

function admin(cilTan)
{
	var link = "pedidosTanque.php";
		if(cilTan == 1)
			link = "pedidosTanque.php";
		else if(cilTan == 2)
			link = "pedidosCil.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Pedidos');

}

function pedido(tipo,id)
{
	var link = "pago.php?tipo="+tipo+"&idtanqcil="+id;

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Pedido');

}

function reportes()
{
	var link = "reportes.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Reportes');

}

function niveles()
{
	var link = "niveles.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Niveles');

}

function newStation()
{
	var link = "newStation.php";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(
	function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});

	$('title').text('GasU | Nuevo Contenedor');

}


