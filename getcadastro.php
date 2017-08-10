<?php

require_once('/Library/WebServer/Documents/mysqli_connect.php');

$query = "SELECT * FROM empresa";

$response = @mysqli_query($db_connection, $query);

if($response){
	while($row = mysqli_fetch_array($response)){
		echo '<tr><td align="left">' .
		$row['id']. '</td><td align="left">'.
		$row['missao']. '</td><td align="left">'.
		$row['visao']. '</td><td align="left">'.
		$row['nome']. '</td><td align="left">';
	}
}
else{
	echo "Couldn't issue database query";
	echo mysqli_error($db_connection);
}
mysqli_close($db_connection);

?>