<?php
session_start();

if ($_SESSION['loggedin'] === true) {
	
	header("location:dashboard.php");
	exit;
}

include 'functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$email = collect($_POST['email']);

	$password = collect($_POST['password']);

	$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

	$connection = connectDB();

	$query_result = mysqli_query($connection,$query);

	$affected_records = mysqli_num_rows($query_result);
	if ($affected_records < 1) {
		
		$errors[] = "Invalid email or password";

	}
	else{

		$_SESSION['loggedin'] = true;
		$_SESSION['user_logged_in'] = $email; 



		header("location:dashboard.php");
	}

}
include 'views/login.php';


?>