<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<div class="container-fluid">
		<ul class="nav nav-pills nav-justified">
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="#"><img class="rounded-circle" src="assets/logo.jpg" alt="Logo" style="width: 20px;"> Music Website</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="shazamapi/songlibrary.php">SONG LIBRARY</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "shazamapi/playlist.php";
	    											}
	    											else
	    											{
	    												echo "authentication/login.php";
	    											}
	    											?>">MY PLAYLIST</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link btn-info" href="<?php
	    											if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	    											{
	    												echo "contact/contact.php";
	    											}
	    											else
	    											{
	    												echo "authentication/login.php";
	    											}
	    											?>">CONTACT US</a>
	    	</li>
	    	<?php
	    	if(isset($_SESSION["username"]) && isset($_SESSION["email"])) 
			{
				echo "<li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>".$_SESSION['username']."</a>
						<ul class='dropdown-menu'>
							<a class='dropdown-item' href='authentication/logout.php'>Logout</a>
						</ul>
					</li>";
			}
			else
			{
				echo "<li class='nav-item'>
			    		<a class='nav-link btn-info' href='authentication/login.php'>LOGIN</a>
			    	</li>
			    	<li class='nav-ite'>
			    		<a class='nav-link btn-info' href='authentication/signup.php'>REGISTER</a>
			    	</li>";
			}
	    	?>
	 	</ul>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-3" style="text-align: center;">
			<h3><b><i>SONG OF THE DAY</i></b></h3>
			<img src="assets/songoftheday.jpg" class="img" style="height: 300px; width: 300px;">
			<p> </p>
			<audio controls>
			<source src="assets/songoftheday.ogg" type="audio/ogg">
			<source src="assets/songoftheday.mp3" type="audio/mpeg">
			Your browser does not support the audio element.
			</audio>
			<h2>Singer: Amit Trivedi</h2>
			<h4>Released: 2018</h4>
			<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">See Lyrics</button>
		</div>
			<div class="column">
				<div id="demo" class="collapse" style="text-align: center;">
					<p><em>LYRICS</em></p>
					Arre abhi abhi pyara sa chehra dikha hai<br> 
					Jaane kya kahun uspe kya likha hai<br> 
					Gehra samunder dil dooba jismein<br>
					Ghayal hua main uss pal se ismein<br>
					<br>
					Naina da kya kasoor, ve kasoor, ve kasoor<br>
					Naina da kya kasoor, ve kasoor, ve kasoor<br> 
					Naina da kya kasoor, ve kasoor, ve kasoor<br> 
					Ae dil tu bata re<br>
					<br>
					Naina da kya kasoor, ve kasoor, ve kasoor<br> 
					Naina da kya kasoor, ve kasoor, ve kasoor<br>
					Naina da kya kasoor, ve kasoor, ve kasoor<br> 
					Ae dil tu bata re<br> 
					<br> 
					Dil ko hazaron baandhe the dhaage<br> 
					Par paaji nikla yeh humse aage<br>  
					Hua kya hai, hua kya hai humko<br>   
				</div>
			</div>
			<div class="column">
				<div id="demo" class="collapse" style="text-align: center;"> 
					<br>
					<br>
					Ek pal yeh daude, ek pal yeh bhaage<br>  
					Bhor ho jaaye tab naina jaage <br> 
					Hua yeh hai, hua hai yeh samjho <br> 
					<br> 
					Dil dil ke milte sanche aur khanche <br> 
					Jo hai banata upar se jaake <br> 
					Batti hai na hai dhoop na kasoor, na kasoor <br> 
					<br> 
					Naina da kya kasoor, ve kasoor, ve kasoor <br> 
					Naina da kya kasoor, ve kasoor, ve kasoor <br> 
					Ae dil tu bata re<br> 
					<br> 
					Naina da kya kasoor, ve kasoor, ve kasoor<br>  
					Naina da kya kasoor, ve kasoor, ve kasoor <br> 
					Naina da kya kasoor, ve kasoor, ve kasoor <br> 
					Ae dil tu bata re<br> 
				</div>
			</div>
		<div class="col">
			<h3 style="text-align: center;"><b><i>UPCOMING RELEASES</i></b></h3>
			<div class="row">
				<div class="col-lg-6">
					<h6>1.Udi Udi Jaye</h6>
					<p>Singer: <em>Bhoomi Trivedi</em></p>
				</div>
				<div class="col-lg-6">
					<h6>2.Udi Udi Jaye</h6>
					<p>Singer: <em>Bhoomi Trivedi</em></p>
				</div>
				<div class="col-lg-6">
					<h6>3.Udi Udi Jaye</h6>
					<p>Singer: <em>Bhoomi Trivedi</em></p>
				</div>
				<div class="col-lg-6">
					<h6>4.Udi Udi Jaye</h6>
					<p>Singer: <em>Bhoomi Trivedi</em></p>
				</div>
				<div class="col-lg-6">
					<h6>5.Udi Udi Jaye</h6>
					<p>Singer: <em>Bhoomi Trivedi</em></p>
				</div>
			</div>
		</div>
		<div class="col">
			<h3 style="text-align: center;"><b><i>TRENDING SONGS</i></b></h3>
			<div class="row">
				<div class="col">
					<h6>1.Soch Na Sake</h6>
					<p>Singer: Arjit Singh</p>
				</div>
				<div class="col">
					<audio controls>
					<source src="trendingsongs/SochNaSake.ogg" type="audio/ogg">
					<source src="trendingsongs/SochNaSake.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h6>2.Sunn Raha Hai</h6>
					<p>Singer: Ankit Tiwari</p>
				</div>
				<div class="col">
					<audio controls>
					<source src="trendingsongs/SunnRahaHai.ogg" type="audio/ogg">
					<source src="trendingsongs/SunnRahaHai.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h6>3.Udi Udi Jaye</h6>
					<p>Singer: Bhoomi Trivedi</p>
				</div>
				<div class="col">
					<audio controls>
					<source src="trendingsongs/UdiUdiJaye.ogg" type="audio/ogg">
					<source src="trendingsongs/UdiUdiJaye.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h6>4.Tu Meri</h6>
					<p>Singer: Vishal Shekhar</p>
				</div>
				<div class="col">
					<audio controls>
					<source src="trendingsongs/TuMeri.ogg" type="audio/ogg">
					<source src="trendingsongs/TuMeri.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h6>5.Bezubaan Phir Se</h6>
					<p>Singer: Vishal Dadhlani</p>
				</div>
				<div class="col">
					<audio controls>
					<source src="trendingsongs/BezubaanPhirSe.ogg" type="audio/ogg">
					<source src="trendingsongs/BezubaanPhirSe.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				</div>
			</div>			
		</div>
	</div>
	<div><h3 style="text-align: center;"><b><i>TOP ARTISTS</i></b></h3></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/ARRahman.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>AR Rahman</mark></i></b></h6>	
				</div>		
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/SelenaGomez.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>Selena Gomez</mark></i></b></h6>	
				</div>		
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/ArijitSingh.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>Arijit Singh</mark></i></b></h6>	
				</div>		
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/ShreyaGhoshal.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>Shreya Ghoshal</mark></i></b></h6>	
				</div>		
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/VishalDadlani.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>Vishal Dadlani</mark></i></b></h6>	
				</div>		
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="container">
					<img src="topsingers/NehaKakkar.jpg" class="img-thumbnail" style="height: 200px; width: 300px;">
					<h6 class="text-block"><b><i><mark>Neha Kakkar</mark></i></b></h6>	
				</div>		
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<article>
			<h3 style="text-align: center;"><b><i>ABOUT US</i></b></h3></div>
		<aside>
			<div style="display:inline-block;vertical-align:top;">
			    <img src="assets/logo.jpg" class="rounded-circle" style="height: 50px;width: 50px;">
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