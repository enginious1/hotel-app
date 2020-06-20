<?php 

include 'dbconnect.php';
include 'navbar.php';
include 'scripts.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
	<link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  	<style>
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
		.display-3 {
			color: white;
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
		thead {
			color: #fff;
		}
		tbody {
			color: #000;
		}
		.edit {
			color: #fff;
		}
		h2 {
			font-family: 'Coiny', cursive;
			color: #fff;	
			margin-top: 10%;
		}
		.border {
			margin-top: 10%;
			border-radius: 15px;
			border: 3px solid white;	
			margin-left: auto;
			margin-right: auto;
			width: 30%;
			height: 45%;
		}
		.inputs {
			margin-right: auto;
			margin-left: auto;
		}	
	</style>
</head>
<body>
	<div class="text-center border" style="display: none;"><h2>Abba Hotel & Spa</h2>
		<div class="form-group row">
			<div class="col-md-10 inputs" style="margin-top: 0.5%;">				
				<label style="color: white; text-align: left;">Unesite novu šifru:</label>
				<input type="password" class="form-control novaSifra" style="margin-top: 0.8%" autofocus>
				<div style="margin-top: 2.5%">
					<label style="color: white">Unesite novu šifru još jednom:</label>
					<input type="password" class="form-control novaSifraRpt" style="margin-top: 2%;" autofocus>
				</div>
				<button class="btn btn-success sifraPromena" type="button" name="button" style="margin-top: 8%;"><i class="fas fa-check"></i> Promeni</button>
			</div>
		</div>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript">

$('document').ready(function(){	
	
	
	$('.border').fadeIn(500);	
	
	/* AJAX ZA MENJANJE ŠIFRE */
	
	$('.sifraPromena').on('click', function(e){
		e.preventDefault();
		var novaSifra = $('.novaSifra').val();
		var novaSifraRpt = $('.novaSifraRpt').val();
		var akcija = 'menjanjeSifre';
		$.ajax ({
			url: 'ajax/ajax_radnici.php',
			type: 'post',
			data: {
				novaSifra:novaSifra,
				novaSifraRpt:novaSifraRpt,
				akcija:akcija
			}, 
			success: function(data) {
			
					console.log(data);
				if (data=="promenauspesna") {
					console.log('asdasd');
					window.location.replace('https://www.google.com');
				}
			}
		})		
	})
})
</script>

</body>
</html>