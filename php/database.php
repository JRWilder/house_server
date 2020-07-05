<?php
$connection  = new mysqli("localhost","pi","Skate911!","mydb");
$ip          = $_GET['ip'];
$device_name = $_GET['device_name'];
$data        = $_GET['data'];
$online      = $_GET['online'];


date_default_timezone_set('US/Eastern');
$online =  date("Y-m-d h:i:sa");	

if($connection->connect_error){
	die('Could not connect: '.$connection->connect_error);
}else{
	$query_msg = "SELECT * FROM Devices";
	$result = $connection->query($query_msg);

	while($devices = $result->fetch_assoc()){
		if( ($devices['device_name'] == $device_name) ){
			$query_msg = "UPDATE `Devices` SET online = '$online' WHERE device_name = '$device_name'";
			$result = $connection->query($query_msg);

			if($result === TRUE){
				echo 'Success: Database updated';
				mysql_close($connection);
				die();
			}
			else{
				echo 'Fail: Database not updated';
				mysql_close($connection);
				die();
			}
		}
	}

	$query_msg = "INSERT INTO `Devices` (`ip`,`device_name`,`data`,`online`) VALUES ('$ip', '$device_name', '$data', '$online');";
	$result = $connection->query($query_msg);

	if($result === TRUE){
		echo 'Success: Entry added';
	}
	else{
		echo 'Fail: Entry not added';
	}
	mysql_close($connection);
}


?>
