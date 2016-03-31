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

	if(isset($_GET['id']))
		$id = prepare($_GET['id']);
	else
		die();
	$query = "SELECT * FROM stores where id = $id LIMIT 1";
	$connection = mysql_connect($host,$user,$passwd);
	mysql_select_db($db,$connection) or die();    
    $result = mysql_query($query);
	mysql_close();

	echo "<h2>Store <small>Edit</small></h2>";
	echo '<table class="table" width="50%">';

	while($row = mysql_fetch_array($result)) 
	{
		echo "<tr>";
		echo "<td>Store ID: </td>";
		echo '<td id="idedit">'.$row['id'].'</td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Store Identifier: </td>";
		echo '<td><a href="#" id="store_identifier" data-type="text" data-title="Enter Identifier" class="editable">'.$row['store_identifier'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Status: </td>";
		echo '<td><a href="#" id="store_status" data-type="select" data-title="Enter Status" class="editable"> '.$row['store_status'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Rank: </td>";
		echo '<td><a href="#" id="store_rank" data-type="select" data-title="Enter Rank" class="editable">'.$row['store_rank'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Type: </td>";
		echo '<td><a href="#" id="store_type" data-type="select" data-title="Enter Type" class="editable">'.$row['store_type'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Store Name: </td>";
		echo '<td><a href="#" id="store_name" data-type="text" data-title="Enter name" class="editable"> '.$row['store_name'].'</a></td>';
		echo "</tr>";
		    
		echo "<tr>";
		echo "<td>Address: </td>";
		echo '<td><a href="#" id="store_address" data-type="text" data-title="Enter Address" class="editable"> '.$row['store_address'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>City: </td>";
		echo '<td><a href="#" id="store_city" data-type="text" data-title="Enter City" class="editable"> '.$row['store_city'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>State: </td>";
		echo '<td><a href="#" id="store_state" data-type="select" data-title="Enter State" class="editable"> '.$row['store_state'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>ZIP Code: </td>";
		echo '<td><a href="#" id="store_zip" data-type="text" data-title="Enter ZIP" class="editable"> '.$row['store_zip'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Phone number: </td>";
		echo '<td><a href="#" id="store_phone" data-type="text" data-title="Enter Phone" class="editable"> '.$row['store_phone'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Territory Code: </td>";
		echo '<td><a href="#" id="territory_code" data-type="text" data-title="Enter Code" class="editable"> '.$row['territory_code'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Payment flag: </td>";
		echo '<td><a href="#" id="store_payment_flag" data-type="text" data-title="Enter Flag" class="editable"> '.$row['store_payment_flag'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Contact: </td>";
		echo '<td><a href="#" id="store_contact" data-type="text" data-title="Enter Contact" class="editable"> '.$row['store_contact'].'</a></td>';
		echo "</tr>";

		echo "<tr>";
		echo "<td>Creation date: </td>";
		echo '<td><a href="#" id="store_create_date" data-type="text" data-title="Enter Date" class="editable"> '.$row['store_create_date'].'</a></td>';
		echo "</tr>";
	}

	echo "</table>";
	echo '<button class="btn btn-sm btn-primary" value="'.$id.'"onClick="edit(this.value)"><span class="glyphicon glyphicon-repeat"></span> Undo</button>';
?>

<button class="btn btn-sm btn-primary" id="save"><span class="glyphicon glyphicon-floppy-disk"></span> Save Changes</button>

<script>
	$(document).ready(function(){
		$('#store_rank').editable({    
        source: [
              {value: 1, text: 'A'},
              {value: 2, text: 'B'},
              {value: 3, text: 'C'},
              {value: 4, text: 'CH'},
              {value: 5, text: 'CV'},
              {value: 6, text: 'M'}
           ]});

		$('#store_type').editable({    
        source: [
              {value: 1, text: 'I'},
              {value: 2, text: 'X'},
              {value: 3, text: 'D'}
           ]});

		$('#store_status').editable({    
        source: [
              {value: 1, text: 'A'},
              {value: 2, text: 'I'}
           ]});

		$('#store_state').editable({    
        source: [
              {value: 1, text: 'AL'},
              {value: 2, text: 'AK'},
              {value: 3, text: 'AZ'},
              {value: 4, text: 'AR'},
              {value: 5, text: 'CA'},
              {value: 6, text: 'CO'},
              {value: 7, text: 'CT'},
              {value: 8, text: 'DE'},
              {value: 9, text: 'DC'},
              {value: 10, text: 'FL'},
              {value: 11, text: 'GA'},
              {value: 12, text: 'HI'},
              {value: 13, text: 'ID'},
              {value: 14, text: 'IL'},
              {value: 15, text: 'IN'},
              {value: 16, text: 'IA'},
              {value: 17, text: 'KS'},
              {value: 18, text: 'KY'},
              {value: 19, text: 'LA'},
              {value: 20, text: 'ME'},
              {value: 21, text: 'MD'},
              {value: 22, text: 'MA'},
              {value: 23, text: 'MI'},
              {value: 24, text: 'MN'},
              {value: 25, text: 'MS'},
              {value: 26, text: 'MO'},
              {value: 27, text: 'MT'},
              {value: 28, text: 'NE'},
              {value: 29, text: 'NV'},
              {value: 30, text: 'NH'},
              {value: 31, text: 'NJ'},
              {value: 32, text: 'NM'},
              {value: 33, text: 'NY'},
              {value: 34, text: 'NC'},
              {value: 35, text: 'ND'},
              {value: 36, text: 'OH'},
              {value: 37, text: 'OR'},
              {value: 38, text: 'PA'},
              {value: 39, text: 'RI'},
              {value: 40, text: 'SC'},
              {value: 41, text: 'SD'},
              {value: 42, text: 'TN'},
              {value: 43, text: 'TX'},
              {value: 44, text: 'UT'},
              {value: 45, text: 'VT'},
              {value: 46, text: 'VA'},
              {value: 47, text: 'WA'},
              {value: 48, text: 'WV'},
              {value: 49, text: 'WI'},
              {value: 50, text: 'WY'}

           ]});

		$('.editable').editable();

	});

	$('#save').click(function()
	{
		var id = $('#idedit').text(),
		identifier = $('#store_identifier').text(),
		rank = $('#store_rank').text(),
		type = $('#store_type').text(),
		name = $('#store_name').text(),
		address = $('#store_address').text(),
		city = $('#store_city').text(),
		state = $('#store_state').text(),
		zip = $('#store_zip').text(),
		phone = $('#store_phone').text(),
		code = $('#territory_code').text(),
		flag = $('#store_payment_flag').text(),
		status = $('#store_status').text(),
		contact = $('#store_contact').text(),
		date = $('#store_create_date').text();

		var url = "save.php?id="+id+"&store_identifier="+identifier+"&store_rank="+rank+"&store_type="+type+
		"&store_name="+name+"&store_address="+address+"&store_city="+city+"&store_state="+state+"&store_zip="+zip+
		"&store_phone="+phone+"&territory_code="+code+"&store_payment_flag="+flag+"&store_status="+status+
		"&store_contact="+contact+"&store_create_date="+date;

		$.get(url, function(response)
			{
				alert(response);
			});

	});


</script>