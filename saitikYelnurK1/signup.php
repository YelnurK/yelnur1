<?php 
	if (isset($_POST['signup'])) {
		include('connection.php');
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];

		$mysqli = new mysqli("localhost", "root", "", "bd");

		$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$pass', '$email')";

		if ($mysqli-> query($query) === true ) {
			header ("Location: homepage.html");
		} else {
			echo ("Failed");
		}

	}

?>