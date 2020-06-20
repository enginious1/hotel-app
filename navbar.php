<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="Enginious" content="">
  <meta name="" content="">
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link href="style.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Acme&family=Kaushan+Script&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Antic&family=Eczar:wght@400;500&display=swap" rel="stylesheet">
  <style>
  
  #hotel {    
		font-family: 'Coiny', cursive;
		color: #0264d6;
		font-size: 19px;
		margin-bottom: 10px;		
	}
	a {
		font-family: 'Antic', sans-serif;
		font-family: 'Eczar', serif;
		font-size: 16px;
			
	}
	
	.navbar {
		height: 6%;
	}

  </style>

<body>
	<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">	  
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="dashboard.php" id="hotel">Abba hotel & Spa</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<li class="nav-item">
					<a class="nav-link" href="sobe.php"><i class="fas fa-bed"></i>  Sobe<span class="sr-only">(current)</span></a>
				</li>   
				<li class="nav-item">
					<a class="nav-link" href="guests.php"><i class="fas fa-user"></i>  Gosti<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rezervacije.php"><i class="fas fa-address-book"></i>  Rezervacije<span class="sr-only">(current)</span></a>
				</li>  
				<li class="nav-item">
					<a class="nav-link" href="usluge.php"><i class="fab fa-servicestack"></i>  Usluge<span class="sr-only">(current)</span></a>
				</li>   
				<li class="nav-item">
					<a class="nav-link" href="zaposleni.php"><i class="fas fa-briefcase"></i>  Zaposleni<span class="sr-only">(current)</span></a>
				</li>
				<?php if ($_SESSION['admin'] == 1) { ?>
				<li class="nav-item">
					<a class="nav-link" href="radnici.php"><i class="fas fa-user-shield"></i>  Korisnici<span class="sr-only">(current)</span></a>
				</li> 
				<?php } ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id='navbar_dropdown' role='button' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i>  Dokumentacija<span class="sr-only">(current)</span></a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
					<a class="dropdown-item" href="kalkulacije.php"><i class="fas fa-calculator"></i>  Kalkulacije</a>
					<a class="dropdown-item" href="domacinstvo.php"><i class="fas fa-home"></i>  Domaćinstvo</a>
					<a class="dropdown-item" href="dobavljaci.php"><i class="fas fa-truck"></i>  Dobavljači</a>
					<a class="dropdown-item" href="racuni.php"><i class="fas fa-receipt"></i>  Računi</a>
				</div>			
				</li>  
			</ul>
			<ul class= "navbar-nav">
				<li class="nav-item" style="padding-bottom: 10px" href="logout.php">         
					<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>  Izloguj se<span class="sr-only">(current)</span></a>
				</li>  
			</ul>    
		</div>
	</nav>
</body>

</html>