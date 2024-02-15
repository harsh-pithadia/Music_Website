<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "../shazamapi/playlist.php";
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
	    												echo "contact.php";
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
	<div>
		<div class="modal-dialog">
			<div class="main-section">
				<div class="modal-content">
					<div class="user-img">
						<img src="../assets/logo.jpg" class="rounded-circle" style="height: 120px; width: 120px;">
					</div>
					<div class="form-input" align="center">
						<h3 style="color: black">CONTACT US</h3>
						<form action="" method="POST">
							<input type='hidden' id="username" value="<?php echo $_SESSION["username"];?>"/>
							<input type='hidden' id="email" value="<?php echo $_SESSION["email"];?>"/>
							<div class="form-group">
								<input id="subject" name="subject" class="form-control" placeholder="Subject" required>
							</div>
							<div class="form-group">
								<textarea id="message" name="message" class="form-control" placeholder="Message..." required></textarea>
							</div>
							<br><button type="submit" name="submit" onclick="sendEmail()" class="btn btn-success btn-lg">Submit<i class="bi bi-box-arrow-in-right"></i></button>
						</form>
						<?php
						
							if(isset($_POST["submit"]))
							{
								if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
								{
									include('../dbfunctions/db.php');

									$subject = $_POST['subject'];
									$message = $_POST['message'];
									$username = $_SESSION["username"];
									$email = $_SESSION["email"];

									$contact = mysqli_query($con,"INSERT INTO contacts(username, email, subject, message) VALUES('$username', '$email', '$subject','$message')");

									if($contact=='1')
									{
										echo "<script>alert('Feedback Submitted!');</script>";
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
	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            function sendEmail() {
                var name = $("#username");
                var email = $("#email");
                var subject = $("#subject");
                var body = $("#message");

                if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                    $.ajax({
                        url: 'sendEmail.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            name: name.val(),
                            email: email.val(),
                            subject: subject.val(),
                            body: body.val(),
                        },
                        success: function(response) {
                            $('#myForm')[0].reset();
                            $('.sent-notification').text("Message Sent Successfully.");

                        }
                    });
                }
            }
            function isNotEmpty(caller) {
                if (caller.val() == "") {
                    caller.css('border', '1px solid red');
                    return false;
                } else
                    caller.css('border', '');

                return true;
            }
        </script>
</html>
