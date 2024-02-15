<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="../index.css">
	</head>
	<style type="text/css">
		a:hover, a:active {
		  background-color: #00000000;
		  color: white;
		}

		.main-section 
		{
		  margin:0 auto;
		  margin-top: 50px;
		  padding:0;
		}

		.modal-dialog
		{
		  text-align: center;
		}

		.modal-content
		{
		  background-image: linear-gradient(violet, lightblue);
		  padding:0 18px;
		  border-radius: 20px;
		}
		.user-img
		{
		  margin-top: -40px;
		  margin-bottom: 20px;
		}

		.form-group1 input
		{
		  margin-bottom: 10px;
		}

		.form-input button
		{
		  width: 30%;
		  margin: 5px 0 25px;
		}
	</style>
	<body>
		<br>
		<div class="container-fluid">
		<ul class="nav nav-pills nav-justified">
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="../index.php"><img class="rounded-circle" src="../assets/logo.jpg" alt="Logo" style="width: 20px;"> Music Website</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="../shazamapi/songlibrary.php">SONG LIBRARY</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "../shazamapi/playlist.php";
	    											}
	    											else
	    											{
	    												echo "login.php";
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
	    												echo "login.php";
	    											}
	    											?>">CONTACT US</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="login.php">LOGIN</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="signup.php">REGISTER</a>
	    	</li>
	 	</ul>
	</div>
	<div>
		<div class="modal-dialog">
			<div class="main-section">
				<div class="modal-content">
					<div class="user-img">
						<img src="../assets/logo.jpg" class="rounded-circle" style="height: 120px; width: 120px;">
					</div>
					<div class="form-input" align="center">
						<h3 style="color: black">LOG IN</h3>
						<form action="" method="POST">
							<div class="form-group">
								<input type="Username" name="username" class="form-control" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input type="Password" name="password" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-group">
								<a style="color: blue" href="#">Forgot Password ?</a>
							</div>
							<br><button type="submit" name="submit" class="btn btn-success btn-lg">Log In <i class="bi bi-box-arrow-in-right"></i></button>
							<div class="form-group">
								<p>Don't Have An Account ? <a style="color: blue" href="signup.php">Register Here</a></p>
							</div>
						</form>
						<?php
							if(isset($_POST["submit"]))
							{
								include('../dbfunctions/db.php');

								$username = $_POST['username'];
								$password = $_POST['password'];

								$check = mysqli_query($con,"SELECT * FROM users where username='$username'");

								if(mysqli_num_rows($check)=='1')
								{
									$result = mysqli_fetch_array($check);
									
									if($username == $result['username'] && $password == $result['password'])
									{
										session_start();
										$_SESSION["username"] = $username;
										$_SESSION["email"] = $result['email'];
										header("Location: ../index.php");
									}
									else
									{
										echo "<h4 style='color: red;'>Login Failed! Invalid Credentials</h4>";
									}
								}
								else
								{
									echo "<h4 style='color: red;'>Username not found</h4>";
								}
								
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
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
		<section>We are a team of 2 members who are trying to provide users with their favourite songs available online.</section>
		<p>Users can listen to any song they like as well create playlists of their favourite songs.</p>
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
