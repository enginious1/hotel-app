<?php

include 'scripts.php';
include 'dbconnect.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';	

$text_message = '';
	 
 if (isset($_POST['submit'])) {
	 
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 
	 $query1 = "SELECT * FROM radnici WHERE username = '$username'";
	 $results = $conn->query($query1);
	 
	 if ($results->num_rows == 0) {
		$text_message = 'Netačno korisničko ime!';
	 } else {
		$query2 = $conn->query("SELECT * FROM radnici WHERE username = '$username' AND password = '$password'");
		
		if ($query2->num_rows == 1) {
			
			while($red = $query2->fetch_array()) {
				$admin = $red['admin'];
				$username = $red['username'];
				
				include 'phpMailer.php';					
				
				$mail->setFrom('mr.enginious@gmail.com', 'Mailer');
				$mail->addAddress('enginious1@gmail.com', 'Joe User');			
				
				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Login';
				$mail->Body    = "$ime $prezime <b>has logged in.</b>";
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				$mail->send();				
			}				
			
			$_SESSION['admin'] = $admin;
			$_SESSION['username'] = $username;		
			unset($_SESSION['hash']);					
			header('Location: dashboard.php');		
			
		} else {
			$text_message = 'Netačna šifra!'; 
		}
	}
}
	 
?>
  <head>
	<title>Abba Hotel & Spa</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<style>
	h2, p{
		font-family: 'Coiny', cursive;
		color: #fff;		
	}
	.carousel-inner {
		border-top: 1px;
		border-left: 1px;
		border-right: 1px;
		border-bottom: 1px;
		border-color: #fff;
		border-style: solid;
		border-radius: 8px;
	}
	
	h2 {
		font-size: 50px;
	}
	
	.form-control  {
		border-radius: 15px !important;
	}
	.modal-content {
		border-color: #ffffff !important;
		color: #ffffff;
		background: #0264d6;
		background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); 
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); 
		background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
		background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
		background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
		background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); 
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1);		
		}
	.borderRad {
		border-radius: 10px !important;
		
	}
	

	
	</style>
  </head>
<body>
	<div class="sidenav">
		<div class="col-md-12 side-navi" style="display:none;">
			<div class="col-md-12 text-center" style="margin-top: 30%">			
				<h2>Abba Hotel & Spa</h2>
				<p>Ulogujte se ili registrujte za pristup.</p>						
			</div>	
			<div id="carouselExampleControls" class="carousel slide col-md-12" data-ride="carousel" style="width: 100%;">
				<div class="carousel-inner" style="width: 80%; margin-right: auto; margin-left: auto;">
					<div class="carousel-item active">
						<div class="d-block w-100"><img src='abba_hotel.jpg' width='100%' height='280'>
						</div>	
					</div>
					<div class="carousel-item">	
						<div class="d-block w-100"><img src='abbahotel2.jpg' width='100%' height='280'>
						</div>				
					</div>
					<div class="carousel-item">	
						<div class="d-block w-100"><img src='abbahotel3.jpg' width='100%' height='280'>
						</div>				
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>			
				</div>			
			</div>	
		</div>	
	</div>	
	<div class="main">
		<div class="col-md-6 col-sm-12">
			<div class="login-form" style="display: none;">
				<form method='post'>
					<?= $text_message ?>
					<br>
					<div class="form-group">
						<label>Korisničko ime:</label>
						<input type="text" class="form-control" name='username' placeholder="Korisničko ime">
					</div>
					<div class="form-group">
						<label>Šifra:</label>
						<input type="password" class="form-control" name='password' placeholder="Šifra">
					</div>	
					<div class="form-inline" style="width: 120%;">
						
							<button name="submit" value='Login' class="btn btn-info btn-sm borderRad" style="width: 140px; margin-right: 10px; margin-left: 10px;">Prijavi se</button>
							<button type="button" class="btn btn-info btn-sm borderRad" style=" color: #fff; width: 140px" data-toggle="modal" data-target="#exampleModalCenter">Zaboravljena šifra?</button>
						
					</div>
				</form>				
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
					<h5  class="modal-title w-100 text-center" style="margin-left: 8%" id="exampleModalLongTitle">Unesite e-mail:</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-8" style="margin-left: auto; margin-right: auto;">
						<input type="email" class="form-control sifra-input" autofocus>
						<div id="msg" style="display:none;"></div>
					</div>
				</div>
				<div class="modal-footer" style="margin-right: 3%; margin-left: 3%">
					<button type="button" class="btn btn-success sifra" style="width: 115px;" data-dismiss="modal"><i class="fas fa-check"></i> Pošalji</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 115px;"><i class="fas fa-times"></i> Odustani</button>					
				</div>
			</div>
		</div>
	</div>
	<?php include 'scripts.php'; ?>
	<script>
		$('document').ready(function(){
			$('.side-navi').fadeIn(1500);
			$('.login-form').fadeIn(1500);
			$('#exampleModalCenter').on('hidden.bs.modal', function(){
				$('.sifra-input').val('');
			})	
		
		$('body').on('click', '.sifra', function(e){
			e.preventDefault();
			var mail = $('.sifra-input').val();
			var akcija = 'menjanjeSifre';
			$.ajax({
				url: 'testmail.php',
				type: 'post',
				data: {
					mail:mail,
					akcija:akcija
				},
				success: function(data) {
					if (data == "Message has been sent") {
						if(data=="Message has been sent") {
							$('#msg').fadeIn('slow').html("<p class='alert alert-success'>Mail za promenu šifre poslat.</p>");
                    } else {
							$('#msg').fadeIn('slow').html("<p class='alert alert-danger'>Došlo je do greške.</p>");
							setTimeout(function(){
								$('#msg').fadeOut('slow').html("<p class='alert alert-danger'>Došlo je do greške.</p>");
							}, 1000);
						}
					}
				}
			})
		})
		})
		
		
	</script>
</body>

	  
