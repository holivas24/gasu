<button class="btn btn-lg btn-success" id="cilindros" onClick="info()"><span class="glyphicon glyphicon-record"></span> Ir a Estacionarios</button>
<br><br><br>
<table class="table" width="50%">
    <tr>
        <th>Alias</th>
        <th>Capacidad</th>
        <td>Pedir</td>
    </tr>
<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}

    require('config.php');
    // Create connection
    $userid = $_SESSION['id'];
    $conn = new mysqli($host, $user, $passwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cilindros where usuario = '$userid'";
    $result = $conn->query($sql);

        // output data of each row
        while($row = $result->fetch_assoc()) 
        {

echo '    <tr>
            <td>Cilindro '.$row['alias'].'</td>
            <td>'.$row['capacidad'].'Kg</td>
            <td>
            <button class="btn btn-sm btn-success" id="pedido'.$row['id'].'"><span class="glyphicon glyphicon-shopping-cart"></span> Realizar pedido</button>
            </td>
        </tr>
';
}
?>
</table>