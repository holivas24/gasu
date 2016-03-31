<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
	if($_SESSION['nivel'] < 2){
		header("Location:index.php");
	}
	require('config.php');

	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$store_identifier=prepare($_GET['store_identifier']);
	$store_rank=prepare($_GET['store_rank']);
	$store_type=prepare($_GET['store_type']);
	$store_name=prepare($_GET['store_name']);
	$store_address=prepare($_GET['store_address']);
	$store_city=prepare($_GET['store_city']);
	$store_state=prepare($_GET['store_state']);
	$store_zip=prepare($_GET['store_zip']);
	$store_phone=prepare($_GET['store_phone']);
	$territory_code=prepare($_GET['territory_code']);
	$store_payment_flag=prepare($_GET['store_payment_flag']);
	$store_status=prepare($_GET['store_status']);
	$store_contact=prepare($_GET['store_contact']);
	$store_create_date=prepare($_GET['store_create_date']);

	$key="AIzaSyA01Xw0_Qm-3xAh2SG_8JzIcPpWcSX95gY";
	$address = str_replace(" ", "+", $store_address);
	$city = str_replace(" ", "+", $store_city);
	$state = str_replace(" ", "+", $store_state);


	$url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address.",+".$city.",+".$state."&key=".$key;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);

	//echo $url;
	$location = json_decode($response);
		
	if($location->{'status'} == "OK")
	{
		echo "Successfully saved with geocode";
		
		$lat = $location->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$lng = $location->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	}

	else 
	{
		echo "Error saving data, fill all the address fields";
		die();
	}
	
	$query = "INSERT INTO stores (id,store_identifier,store_rank,store_type,store_name,
		store_address, store_city, store_state, store_zip, store_phone, territory_code,
		store_payment_flag, store_status,store_contact, store_create_date,latitude,longitude) VALUES
	(0,'$store_identifier', '$store_rank','$store_type','$store_name','$store_address',
	'$store_city','$store_state','$store_zip','$store_phone','$territory_code',
	'$store_payment_flag','$store_status','$store_contact','$store_create_date',$lat,$lng)";

	$connection = mysql_connect($host,$user,$passwd);
	mysql_select_db($db,$connection) or die();    
    $result = mysql_query($query);
	mysql_close();
?>