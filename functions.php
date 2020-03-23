<?php


function validateUserName($username)
{
	if ($username == '') {
		
		return "username empty";
	}
	elseif (strlen($username) < 5 || strlen($username) >12) {
		
		return "username must not exceed 12 and not be less than 5";
	}

	return true;
}

function validateEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
			return true;
	}
	else{
		return "invalid email";
	}
}

function validatePassword($password)
{
	if (strlen($password) < 5) {
		
		return "invalid pasword";
	}
	else{
		return true;
	}
}


function validateNationality($nationality)
{
	$allowed = ['nigerian','canadian'];

	if (in_array($nationality,$allowed)) {
		
		return true;
	}
	else{
		return false;
	}
}

function collect($value)
{

	return stripslashes(strip_tags(htmlspecialchars(trim($value))));
}


function  createUserData($username,$email,$password)
{
	$user_array = ["username"=>$username,"password"=>$password,"email"=>$email];

	$user_json = json_encode($user_array);

	$handle = fopen('database.json','w');

	fwrite($handle,$user_json);

	fclose($handle);
}


function connectDB ()
{
	$db_username = "root";
	$db_password = "fruitfulbough";
	$db_host = "localhost";
	$db_name = "ebio";

	$conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);


	if ($conn == false) {
		
		echo "Database connection failed!";

		exit();
	}
	else{

		return $conn;
	}

}

?>