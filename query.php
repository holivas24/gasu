<?php
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location:login.php");
	}
	require('config.php');

	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if (isset($_GET['zip'])){
		$zip = prepare($_GET['zip']);
		$query = "SELECT id, store_name, store_address, store_city, store_state, store_zip FROM stores where UPPER(store_zip) like UPPER('%$zip%')";
	}
	elseif(isset($_GET['city'])){
		$city = prepare($_GET['city']);
		$query = "SELECT id, store_name, store_address, store_city, store_state, store_zip FROM stores where UPPER(store_city) like UPPER('%$city%')";
	}
	elseif(isset($_GET['store'])){
		$store = prepare($_GET['store']);
		$query = "SELECT id, store_name, store_address, store_city, store_state, store_zip FROM stores where UPPER(store_name) like UPPER('%$store%')";
	}
	else
		$query = "SELECT id, store_name, store_address, store_city, store_state, store_zip FROM stores";

	$connection = mysql_connect($host,$user,$passwd);
	mysql_select_db($db,$connection) or die();
        

        $result = mysql_query($query);

        mysql_close();

	
echo <<<END
			<h2>Stores <small>Results</small></h2>
			<table id="rtable" class="display" cellspacing="0" width="100%">
				<thead>
           	    	<tr>
						<th>Store</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>ZIP Code</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tfoot>
           	    	<tr>
						<th>Store</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>ZIP Code</th>
						<th>Edit</th>
					</tr>
				</tfoot>
				<tbody>
END;

while($row = mysql_fetch_array($result)) 
	{
		
	echo"<tr>";
	echo"	<td>".$row['store_name']."</td>";
	echo"	<td>".$row['store_address']."</td>";
	echo"	<td>".$row['store_city']."</td>";
	echo"	<td>".$row['store_state']."</td>";
	echo"	<td>".$row['store_zip']."</td>";
	echo'	<td><button value="'.$row['id'].'" class="btn btn-sm btn-primary button" onClick="edit(this.value)"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>';

	}
	echo "</tbody>";
	echo "</table>";
?>
<script>
	$(document).ready(function()
	{
		$('#rtable').DataTable();
		
	});
</script>





