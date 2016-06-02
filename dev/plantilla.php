<?php
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			$i=0;
		    // output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		    	
		    }
		} 
		else 
		{
		  	
		}
		$conn->close();
?>
