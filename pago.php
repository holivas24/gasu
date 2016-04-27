<?php
	$tipo=$_REQUEST['tipo'];
	$idtanqcil = $_REQUEST['idtanqcil'];
?>
<div class="col-sm-8">
<form action="" method="POST" id="card-form">
  <span class="card-errors"></span>
  <div class="form-row">
    <label>
      <span>Nombre del tarjetahabiente</span>
      <input type="text" size="20" data-conekta="card[name]" class="form-control"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Número de tarjeta de crédito</span>
      <input type="text" size="20" data-conekta="card[number]" class="form-control"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>CVC</span>
      <input type="text" size="4" data-conekta="card[cvc]" class="form-control"/>
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Fecha de expiración (MM/AAAA)</span>
      <input type="text" size="2" data-conekta="card[exp_month]" class="form-control col-xs-2"/>
    </label>
    <span>/</span>
    <input type="text" size="4" data-conekta="card[exp_year]" class="form-control col-xs-3"/>
  </div>
  <button type="submit" class="btn btn-success">Pagar</button>
</form>
</div>