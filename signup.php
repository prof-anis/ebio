<?php

session_start();


if ($_SESSION['loggedin'] === true) {
	
	header("location:dashboard.php");
	exit;
}


include 'functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	

		/** retrieving user data**/

	$email = collect($_POST['email']);
	$password = collect($_POST['password']);
	$username = collect($_POST['username']);

		/** retrieving user data ends**/


	/** validation**/

	if (validateUserName($username) !== true) {
		
		$errors[] = "invalid username";
	}

	if (validatePassword($password) !==  true ) {
		
		$errors[] = "invalid password";
	}

	if (validateEmail($email) !== true) {
		
		$errors[] = "invalid email";
	}

		/** validation ends**/

		/** confirming if there was no error**/

		if(count($errors) == 0)
		{
			/** save user data**/


		$connection  = connectDB();

		$select_query = "SELECT  email FROM users WHERE email = '$email'";

		$select_result = mysqli_query($connection,$select_query);

		$affected_records = mysqli_num_rows($select_result);

		if ($affected_records > 0) {
			

			$errors[] = "Email already exist. Kindly try another email";
		}
		else{
			$query = "INSERT INTO users ( id, email,username,password,date_registered ) VALUES (NULL,'$email','$username','$password',NULL)";

			$query_result = mysqli_query($connection,$query);
			if ($query_result === false) {
				
				$errors[] = "sorry, we were not able to sign you up at this moment. Please try again later";
			}
			else{

					/** redirect the user to the dahboard page**/

			$_SESSION['loggedin'] = true;
			$_SESSION['user_logged_in'] = $email;

			header("location:dashboard.php");

			}
		}

		


			


				
		}


}



include 'views/signup.php';
?>