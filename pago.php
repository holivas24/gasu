<?php
	$tipo=$_REQUEST['tipo'];
	$idtanqcil = $_REQUEST['idtanqcil'];
?>
<script type="text/javascript"> 
 // Conekta Public Key
  Conekta.setPublishableKey('key_ERs5C8kkjbs3jkhy7JAriWg');

  $(function () {
  $("#card-form").submit(function(event) {
    var $form = $(this);

    // Previene hacer submit más de una vez
    $form.find("button").prop("disabled", true);
    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
   
    // Previene que la información de la forma sea enviada al servidor
    return false;
  });
});

  var conektaSuccessResponseHandler = function(token) {
  var $form = $("#card-form");

  /* Inserta el token_id en la forma para que se envíe al servidor */
  $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));
 
  /* and submit */
  $form.get(0).submit();
};

var conektaErrorResponseHandler = function(response) {
  var $form = $("#card-form");
  
  /* Muestra los errores en la forma */
  $form.find(".card-errors").text(response.message);
  $form.find("button").prop("disabled", false);
};
</script>
<div class="col-sm-4">
<h3>Forma de Pago</h3>
<p>
<?php
	if($tipo == 1)
		echo "Pedido de recarga";
	else if($tipo == 2)
		echo "Pedido de cilindro";
	echo "<br>Tanque: ".$idtanqcil
?>	
</p>
</div>
<div class="col-sm-4">
<center>
<form action="proceso_de_pago.php" method="POST" id="card-form" class="form-horizontal" style="width:90%">
  <span class="card-errors"></span>
  <div class="form-group">
    <label>
      Nombre del tarjetahabiente:
    </label>
      <input type="text" size="20" data-conekta="card[name]" class="form-control"/>
  </div>
  <div class="form-group">
    <label>
      Número de tarjeta de crédito:
    </label>
   	<input type="text" size="20" data-conekta="card[number]" class="form-control"/>    
  </div>
  <div class="form-group">
    <label>
      CVC
  	</label>
      <input type="text" size="4" data-conekta="card[cvc]" class="form-control"/>
  </div>
  <div class="form-group">
    <label>
      Fecha de expiración (MM/AAAA)
    </label><br>
    <div class="col-xs-3">
    	<input type="text" data-conekta="card[exp_month]" class="form-control" placeholder="MM"/>
   	</div>    
    <div class="col-xs-3">
    	<input type="text" data-conekta="card[exp_year]" class="form-control" placeholder="AAAA"/>
  	</div>
  </div>
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-usd"></span> Pagar pedido</button>
</form>
</center>
</div>