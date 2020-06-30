<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	echo $username.' '.$password;
	$connection = new mysqli("localhost","root","root","house_server");

	if($connection->connect_error){
		echo "Couldn't connect to database: Contact Admin";
		die();
	}
	else{
		$result = $connection->query("SELECT * FROM users");
		while($user = $result->fetch_assoc()){
			if( ($user['username'] == $username) and ($user['password'] == $password )){
				#header('Location: ../device/device_list.php');
				echo 'Welcome '.$user['first'].' '.$user['last'].'!';
				die();
			}
		}
	}
	echo "Nope";
	#header('Location: fail_to_login.html');

?>
