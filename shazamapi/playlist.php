<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Playlist</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<div class="container-fluid">
		<ul class="nav nav-pills nav-justified">
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="../index.php"><img class="rounded-circle" src="../assets/logo.jpg" alt="Logo" style="width: 20px;"> Music Website</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="songlibrary.php">SONG LIBRARY</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "playlist.php";
	    											}
	    											else
	    											{
	    												echo "../authentication/login.php";
	    											}
	    											?>">MY PLAYLIST</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "../contact/contact.php";
	    											}
	    											else
	    											{
	    												echo "../authentication/login.php";
	    											}
	    											?>">CONTACT US</a>
	    	</li>
	    	<?php
	    	if(isset($_SESSION["username"]) && isset($_SESSION["email"])) 
			{
				echo "<li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>".$_SESSION['username']."</a>
						<ul class='dropdown-menu'>
							<a class='dropdown-item' href='../authentication/logout.php'>Logout</a>
						</ul>
					</li>";
			}
			else
			{
				echo "<li class='nav-item'>
			    		<a class='nav-link btn-info' href='../authentication/login.php'>LOGIN</a>
			    	</li>
			    	<li class='nav-ite'>
			    		<a class='nav-link btn-info' href='../authentication/signup.php'>REGISTER</a>
			    	</li>";
			}
	    	?>
	 	</ul>
	</div>
	<br>
	<div class="container-fluid" style="text-align: center;">
		<div class="row">
			<div class="col">
				<h3 style="text-align:center;"><b><em>MY PLAYLIST</em></b></h3>
				<?php

					if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
					{
						include('../dbfunctions/db.php');

						$playlist = mysqli_query($con,"SELECT * FROM playlists where username='".$_SESSION["username"]."'");

						if(mysqli_num_rows($playlist)>0)
						{
							// $songslist = mysqli_fetch_assoc($playlist);

							// print_r($songslist);
							$keys = array();
						    $i = 0;
						    while($song = mysqli_fetch_assoc($playlist)){
						        $keys[$i] = $song['songkey'];

								$curl = curl_init();

								curl_setopt_array($curl, [
									CURLOPT_URL => "https://shazam.p.rapidapi.com/songs/get-details?key=".$keys[$i]."&locale=en-US",
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_ENCODING => "",
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 30,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => "GET",
									CURLOPT_HTTPHEADER => [
										"x-rapidapi-host: shazam.p.rapidapi.com",
										"x-rapidapi-key: 598f0bba14msh74028b7ea53164dp1b4d56jsne16124bd6ec3"//YOUR RAPIDAPI KEY HERE
									],
								]);

								$response = curl_exec($curl);
								$err = curl_error($curl);

								curl_close($curl);

								if ($err) {
									echo "cURL Error #:" . $err;
								} else {
									// echo $response;
									$result = json_decode($response, true);
									// print_r($result);
									echo "<div class='row'>
										<div class='col-lg-2'>
											<img src=".$result['images']['coverart']." class='rounded mx-auto d-block' style='height: 100px;width: 100px;'>
										</div>
										<div class='col-lg-4'>
											<h6>".($i+1).". ".$result['title']."</h6>
											<p>Singers: ".$result['subtitle']."</p>
										</div>
										<div class='col-lg-5'>
											<audio controls>
											<source src='".$result['hub']['actions'][1]['uri']."' type='audio/ogg'>
											<source src='".$result['hub']['actions'][1]['uri']."' type='audio/mpeg'>
											Your browser does not support the audio element.
											</audio>
										</div>
										<div class='col-lg-1'>
											<form action='' method='POST'>
													<input type='hidden' value='".$result['key']."' name='key'/>
													<button type='submit' name='delete' class='btn btn-danger btn-md'><i class='bi bi-trash'></i></button>
												</form>
										</div>
									</div><br>";
								}

						        $i++;
						    }
						}
						else
						{
							echo "<br><h3 style='text-align:center;'><b><em>YOUR PLAYLIST IS EMPTY</em></b></h3><br>
							<a class='btn btn-primary btn-lg' href='songlibrary.php'>ADD SONGS <i class='bi bi-plus'></i></a><br><br>";
						}
					}
				?>
				<?php
					if(isset($_POST["delete"]))
					{
						if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
						{
							include('../dbfunctions/db.php');

							$song = $_POST['key'];
							$username = $_SESSION['username'];

							$url = "http://localhost/WP-2-Project/dbfunctions/delete.php?username=".$username."&song=".$song;
							$client = curl_init($url);
							curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
							$response = curl_exec($client);

							$result = json_decode($response,true);
							
							if($result['status'] == 'Record Deleted Successfully'){
								header("Refresh: 1");
							}
							else
							{
								echo "<script>alert('Some Error occurred!');</script>";
							}
						}
						else
						{
							echo "<script>alert('Login First');</script>";
						}
					}
				?>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="text-align: center;">
		<article>
			<h3 style="text-align: center;"><b><i>ABOUT US</i></b></h3></div>
		<aside>
			<div style="display:inline-block;vertical-align:top;">
			    <img src="../assets/logo.jpg" class="rounded-circle" style="height: 50px;width: 50px;">
			</div>
			<div style="display:inline-block;">
			    <div>MUSIC WEBSITE</div>
			    <div>AUTHOR : <em>BHAVIK MEHTA, HEMIL MEHTA</em></div>
			</div>
		</aside>
		<section>We are a team of 2 members who are trying to provide users with their favourite songs available online.<br>Users can listen to any song they like as well create playlists of their favourite songs.</section>
		</article>
	</div>
	<div class="footer" align="center">
		<h4>Follow Us On </h4>
		<button type="button" class="btn btn-primary btn-lg"><i class="bi bi-facebook"></i></button>
		<button type="button" class="btn btn-primary btn-lg"><i class="bi bi-instagram"></i></button>
		<button type="button" class="btn btn-primary btn-lg"><i class="bi bi-twitter"></i></button>		
	</div>
</body>
</html>