$('#buscar').on("click",search);


function pagos()
{
	var link = "pagos.php";

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

	$('title').text('GasU | Pago');

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

}

function search()
{
	
	var zip = $('#zip').val(),
		city = $('#city').val(),
		store = $('#store').val();
	var link = "query.php?";
	
	if(store.length>0)
		link = link+"store="+store;
	else if(zip.length>0)
		link = link+"zip="+zip;
	else if(city.length>0)
		link = link+"city="+city;
	

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

	$('#zip').val("");
	$('#city').val("");
	$('#store').val("");

}

function edit(value)
{
	var id = value;

    link = "edit.php?id="+id;

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});
}

function newStore()
{
	$('#search').hide();
    link = "create.html";

	$.ajax({
		url: link,
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html'

	}).success(function(result)
		{
			$('#results').html(result);
		}
	).error(function(xhr,status)
	{
		alert(status);
	});
}

function undo()
{
	var valor = $('#idedit').val();

	edit(valor);
}