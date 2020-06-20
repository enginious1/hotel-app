<?php


include 'dbconnect.php';
include 'navbar.php';


?>

<!DOCTYPE>
<html>
	<head>  
		<title>Abba Hotel & Spa</title>
		
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Acme&family=Kaushan+Script&display=swap" rel="stylesheet">
		<style type='text/css'>
			body {
				background: #0264d6;
				background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); 
				background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); 
				background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
				background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
				background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
				background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); 
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1 ); 
				height:calc(100vh);
				width:100%;	
			}	
			a {
				border-radius: 14px !important;
				
			}

		
		</style>	
	</head>
<body>
	<div class="container text-center">
		<div class="col-md-12 col-sm-12 col-xs-12 dashboard" style="margin-top: 15%; display: none;">
			<div class='dashboard text-center'>
				<a href='sobe.php' class="btn btn-light"><i class="fas fa-bed"></i> Sobe</a>
				<a href='guests.php' class="btn btn-light"><i class="fas fa-user"></i> Gosti</a>
				<a href='rezervacije.php' class="btn btn-light" style=""><i class="fas fa-address-book"></i> Rezervacije</a>
			</div>
			</div>
			<div class="col-md-12 col-sm-12 dashboard" style="display: none;">
			<div class='dashboard text-center'>
				<a href='usluge.php' class="btn btn-light" style=""><i class="fab fa-servicestack" ></i> Usluge</a>
				<a href='zaposleni.php' class="btn btn-light" style=""><i class="fas fa-briefcase"></i> Zaposleni</a>
				<a href='racuni.php' class="btn btn-light"><i class="fas fa-layer-group"></i> Računi</a>
			</div>
			</div>
			<div class="col-md-12 col-sm-12 dashboard text-center" style="display: none;">
				<a href='logout.php' class="btn btn-light"><i class="fas fa-sign-out-alt"></i> Izloguj se</a>
			</div>			
			</div>
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
<?php include 'scripts.php'; ?></script>
<script>
$('document').ready(function(){
	$('.dashboard').fadeIn(1500);
});

</script>
</body>

</html>
