<?php
require_once('../init/init.php');


// debug($dbcon);
//debug($_POST);
$response = $user->User_Login($_POST);

if ($response === "success"){
	echo json_encode([
		'success' => 'success',
		'message' => '<div class="alert alert-success text-success text-center">You are loggedin successfully</div>',
		'url' => 'index.php',
	]);

}else if($response === "Required_Fields"){
	echo json_encode([
		"error" => "error",
		"message" => "<div class='alert alert-danger text-danger text-center'>All the fields are required </div>",
	]);

}else if($response === "Not_Exists"){
	echo json_encode([
		"error" => "error",
		"message" => "<div class='alert alert-danger text-danger text-center'>The user does not exist </div>",
	]);

}else if($response === "Invalid_Email"){
	echo json_encode([
		"error" => "error",
		"message" => "<div class='alert alert-danger text-danger text-center'>This is invalid email address </div>",
	]);

}else if($response === "Not_Matched"){
	echo json_encode([
		"error" => "error",
		"message" => "<div class='alert alert-danger text-danger text-center'>This email address or password does not match </div>",
	]);
}


