<?php
	$username = $_POST["username"];
	$password = $_POST["password"];


	$connection = new mysqli("localhost","root","root","house_server");

	if($connection->connect_error){
		echo "Couldn't connect to database: Contact Admin";
		die();
	}
	else{
		$result = $connection->query("SELECT * FROM users");
		while($user = $result->fetch_assoc()){
			if( ($user['username'] == $username) and ($user['password'] == $password )){
				session_start();
				$_SESSION['name'] = $user['name'];
				#echo $_SESSION['name'];
				header('Location: ../html/home.html');
				#echo 'Welcome '.$user['first'].' '.$user['last'].'!';
				die();
			}
		}
	}
	header('Location: ../html/login_fail.html');

?>
