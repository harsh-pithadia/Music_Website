<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="../index.css">
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  	
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
	    		<a class="nav-link btn-info" href="login.php">MY PLAYLIST</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="login.php">CONTACT US</a>
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
					<div class="form-input">
						<h3 style="color: black">REGISTER</h3>
						<form action="" method="POST">
							<div class="form-group">
								<input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
								<small></small>
							</div>
							<div class="form-group">
								<input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
								<small></small>
							</div>
							<div class="form-group">
								<input type="number" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone Number" required>
								<small></small>
							</div>
							<div class="form-group">
								<label for="date">Date Of Birth</label>
								<input type="date" name="date" id="date" class="form-control" value="2021-12-31" required>
							</div>
							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
								<small></small>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
								<small></small>
							</div>
							<div class="form-group">
								<input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
								<small></small>
							</div>	
							<br><button type="submit" name="submit" class="btn btn-success btn-lg">Sign Up <i class="bi bi-upload"></i></i></button>
							<div class="form-group">
								<p>Already Have An Account ? <a style="color: blue" href="login.php">Login Here</a></p>
							</div>
						</form>
						<?php
							if(isset($_POST["submit"]))
							{
								include('../dbfunctions/db.php');

								$username = $_POST['username'];
								$fullName = $_POST['name'];
								$email = $_POST['email'];
								$phoneNumber = $_POST['phonenumber'];
								$dob = $_POST['date'];
								$password = $_POST['password'];

								$check = mysqli_query($con,"SELECT * FROM users where username='$username'");
								
								if(mysqli_num_rows($check)=='0')
								{
									$result = mysqli_query($con,"INSERT INTO users (username, fullName, email, phoneNumber, dob, password) VALUES ('$username', '$fullName', '$email', '$phoneNumber', '$dob', '$password')");
									
									if($result == '1'){
										session_start();
										$_SESSION["username"] = $username;
										$_SESSION["email"] = $email;
										header("Location: ../index.php");
									}
									else{
										echo "<h4 style='color: red;'>Signup Failed!</h4>";
									}
								}
								else{
									echo "<h4 style='color: red;'>Username already in use</h4>";
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
