<?php
header("Content-Type:application/json");
if (isset($_GET['username']) && $_GET['username']!="") {
	include('db.php');
	$username = $_GET['username'];
	$fullName = $_GET['fullName'];
	$email = $_GET['email'];
	$phoneNumber = $_GET['phoneNumber'];
	$password = $_GET['password'];
	$dob = $_GET['dob'];

	$result = mysqli_query($con,"INSERT INTO users (username, fullName, email, phoneNumber, dob, password) VALUES ('$username', '$fullName', '$email', '$phoneNumber', '$dob', '$password')");

	if($result == true)
	{
		$status = "Success";
		$userid = $username;
		response($status, $userid);
		mysqli_close($con);
	}
	else
	{
		$status = "Failed";
		response($status, NULL);
	}
}
else
{
	response("Error 404", NULL);
}

function response($status,$userid)
{
	$response['status'] = $status;
	$response['userid'] = $userid;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
