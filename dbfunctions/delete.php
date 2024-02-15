<?php
header("Content-Type:application/json");
if (isset($_GET['username']) && $_GET['username']!="") {

	if (isset($_GET['song']) && $_GET['song']!="")
	{
		include('db.php');

		$song = $_GET['song'];
		$username = $_GET['username'];

		$find = mysqli_query($con,"DELETE FROM playlists WHERE username='$username' AND songkey='$song'");

		if($find == true){
			$status = "Record Deleted Successfully";
			response($status);
			mysqli_close($con);
			
		}
		else
		{
			response("Could not delete");
		}
	}
	else
	{
		response("Invalid Request");
	}	
}
else
{
	response("Invalid Request 2");
}

function response($status)
{
	$response['status'] = $status;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
