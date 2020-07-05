<?php
$connection  = new mysqli("localhost","root","root","house_server");
$fname       = $_POST['fname'];
$lname       = $_POST['lname'];
$username    = $_POST['username'];
$password    = $_POST['password'];
$name        = $fname.' '.$lname;


if($connection->connect_error){
	die('Could not connect: '.$connection->connect_error);
}else{
	$query_msg = "SELECT * FROM users";
	$result = $connection->query($query_msg);

	while($user = $result->fetch_assoc()){
		if( ($user['username'] == $username) ){
				echo "User is already in database";
				die();
			}
		}

	$query_msg = "INSERT INTO `users` (`name`,`username`,`password`,`availability`) VALUES ('$name', '$username', '$password', 1);";
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
