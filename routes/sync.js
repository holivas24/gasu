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

function admin()
{
	var link = "admin.php";

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

	$('title').text('GasU | Operador');

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


