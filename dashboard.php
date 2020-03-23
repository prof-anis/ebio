<?php

include 'functions.php';
session_start();

if (isset($_SESSION['loggedin'])) {
	
	$email = $_SESSION['user_logged_in'];

	$sql = "SELECT * FROM users WHERE email = '$email' ";

	$connection = connectDB();

	$query_result = mysqli_query($connection,$sql);


	$affected_records = mysqli_num_rows($query_result);

	$actual_data = mysqli_fetch_assoc($query_result);

 


}
else{
	header("location:index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<p>Hello <?php  echo $actual_data['username'] ?>
	how are you today ? Dont forget that your email is <?php  echo $actual_data['email'] ?> </p>
<p>click <a href="logout.php">here</a> to logout</p>
</body>
</html>
