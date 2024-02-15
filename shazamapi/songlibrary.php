<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Song Library</title>
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
			<div class="col-lg-6">
				<form action="" method="POST">
					<div class="row">
						<div class="col-lg-1">
						</div>
						<div class="col-lg-9">
							<div class="form-group">
								<input type="Text" name="search" class="form-control" value="<?php 
																								if(isset($_POST["submit"]))
																								{
																									echo '';
																								}
																								else
																								{
																									if(isset($_COOKIE['searchvalue']))
																									{
																										echo $_COOKIE['searchvalue'];
																									}
																								}
																							 ?>" placeholder="Search a song..." required>
							</div>
						</div>
						<div class="col-lg-2">
							<button type="submit" name="submit" class="btn btn-success">Search <i class="bi bi-search"></i></button>
						</div>
					</div>
				</form>
				<?php
					if(isset($_POST["submit"]))
					{
						$curl = curl_init();

						$search = $_POST['search'];

						$cookie_value = $_POST["search"];
						setcookie("searchvalue", $cookie_value, time() + (60 * 3), "/");

						$query = str_replace(' ', '%20', $search);

						curl_setopt_array($curl, [
							CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term=".$query."&locale=en-US&offset=0&limit=10",
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

						$searchresponse = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
							echo "cURL Error #:" . $err;
						} else {
							// echo $searchresponse;
							$searchResult = json_decode($searchresponse, true);
							foreach ($searchResult['tracks']['hits'] as $key => $value) {
								// code...
								if(isset($value['track']['hub']['actions'][1]['uri']))
								{
									echo "<div class='row'>
										<div class='col-lg-2'>
											<img src=".$value['track']['images']['coverart']." class='rounded mx-auto d-block' style='height: 100px;width: 100px;'>
										</div>
										<div class='col-lg-4'>
											<h6>".($key+1).". ".$value['track']['title']."</h6>
											<p>Singers: ".$value['track']['subtitle']."</p>
										</div>
										<div class='col-lg-5'>
											<audio controls>
											<source src='".$value['track']['hub']['actions'][1]['uri']."' type='audio/ogg'>
											<source src='".$value['track']['hub']['actions'][1]['uri']."' type='audio/mpeg'>
											Your browser does not support the audio element.
											</audio>
										</div>
										<div class='col-lg-1'>
											<form action='' method='POST'>
												<input type='hidden' value='".$value['track']['key']."' name='key'/>
												<button type='submit' name='playlist' class='btn btn-primary btn-lg'><i class='bi bi-plus'></i></button>
											</form>
										</div>
									</div><br>";
								}
							}
						}
					}
					else
					{
						if(isset($_COOKIE["searchvalue"])){
							$query = str_replace(' ', '%20', $_COOKIE['searchvalue']);

							$curl = curl_init();

							curl_setopt_array($curl, [
								CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term=".$query."&locale=en-US&offset=0&limit=10",
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

							$searchresponse = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							if ($err) {
								echo "cURL Error #:" . $err;
							} else {
								// echo $searchresponse;
								$searchResult = json_decode($searchresponse, true);
								foreach ($searchResult['tracks']['hits'] as $key => $value) {
									// code...
									if(isset($value['track']['hub']['actions'][1]['uri']))
									{
										echo "<div class='row'>
											<div class='col-lg-2'>
												<img src=".$value['track']['images']['coverart']." class='rounded mx-auto d-block' style='height: 100px;width: 100px;'>
											</div>
											<div class='col-lg-4'>
												<h6>".($key+1).". ".$value['track']['title']."</h6>
												<p>Singers: ".$value['track']['subtitle']."</p>
											</div>
											<div class='col-lg-5'>
												<audio controls>
												<source src='".$value['track']['hub']['actions'][1]['uri']."' type='audio/ogg'>
												<source src='".$value['track']['hub']['actions'][1]['uri']."' type='audio/mpeg'>
												Your browser does not support the audio element.
												</audio>
											</div>
											<div class='col-lg-1'>
												<form action='' method='POST'>
													<input type='hidden' value='".$value['track']['key']."' name='key'/>
													<button type='submit' name='playlist' class='btn btn-primary btn-lg'><i class='bi bi-plus'></i></button>
												</form>
											</div>
										</div><br>";
									}
								}
							}
						}
					}
				?>
			</div>
			<div class="col-lg-6">
				<h3 style="text-align:center;"><b><em>SONG LIBRARY</em></b></h3>
				<?php
					$curl = curl_init();

					curl_setopt_array($curl, [
						CURLOPT_URL => "https://shazam.p.rapidapi.com/songs/list-recommendations?key=102763094&locale=en-US",
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
						foreach ($result['tracks'] as $key => $value) {
							// code...$value['hub']['images']['coverart']
							if(isset($value['hub']['actions'][1]['uri'])){
								echo "<div class='row'>
									<div class='col-lg-2'>
										<img src=".$value['images']['coverart']." class='rounded mx-auto d-block' style='height: 100px;width: 100px;'>
									</div>
									<div class='col-lg-4'>
										<h6>".($key+1).". ".$value['title']."</h6>
										<p>Singers: ".$value['subtitle']."</p>
									</div>
									<div class='col-lg-5'>
										<audio controls>
										<source src='".$value['hub']['actions'][1]['uri']."' type='audio/ogg'>
										<source src='".$value['hub']['actions'][1]['uri']."' type='audio/mpeg'>
										Your browser does not support the audio element.
										</audio>
									</div>
									<div class='col-lg-1'>
										<form action='' method='POST'>
												<input type='hidden' value='".$value['key']."' name='key'/>
												<button type='submit' name='playlist' class='btn btn-primary btn-md'><i class='bi bi-plus'></i></button>
											</form>
									</div>
								</div><br>";
							}
						}
					}
				?>
				<?php
					if(isset($_POST["playlist"]))
					{
						if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
						{
							include('../dbfunctions/db.php');

							$song = $_POST['key'];

							$find = mysqli_query($con,"SELECT * FROM playlists WHERE username='".$_SESSION['username']."' AND songkey='$song'");

							if(mysqli_num_rows($find)=='0')
							{
								$add = mysqli_query($con, "INSERT INTO playlists (username, songkey) VALUES ('".$_SESSION['username']."', '$song')");

								if($add == '1'){
									echo "<script>alert('Song Added to playlist!');</script>";
								}
								else{
									echo "<script>alert('Some Error occurred!');</script>";
								}
							}
							else{
								echo "<script>alert('Song already in playlist!');</script>";
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