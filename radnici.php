<?php 

include 'dbconnect.php' 

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Korisnici</title>
		<?php include 'navbar.php' ?>
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
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
				color: #000;
			}
			tbody {
				color: #000;
			}
			.edit {
				color: #fff;
			}
			
			.card {
				width: 60%;
				margin-left: auto;
				margin-right: auto;
				
			}
			.card-header {
				color: #fff;				
			}
		
		</style>
	</head>
	<body>
		<h2 class="display-3" style="display: none;">Korisnici</h2>	
		<div class="card" style="display: none;">
			<h5 class="card-header text-center bg-info">
				Korisnici
			</h5>
			<div class="card-body" style="margin-top: 10px;">			
				<div class="form-horizontal justify-content-center">	
					<div class="form-group row">								
						<div class="col-md-4">
							<input type='text' name='search_bar' class='form-control'  placeholder='Ime, prezime ili ID'>
						</div>													
						<div class="col-md-4">
							<select type='text' name='filterSearch' class='form-control'>
								<option value="2">Svi</option>							
								<option value="1">Administratori</option>							
								<option value="0">Korisnici</option>							
							</select>
						</div>						
						<div class="col-md-4">
							<button class="btn btn-primary search" type='button' name='submit_search' id='search' style="min-width: 105px;"><i class="fas fa-search"></i> Pretraži</button>		
							<button class="btn btn-outline-primary" type='button' name='Insert' id='insert' data-toggle="modal" data-target="#exampleModalCenter" style="min-width: 105px;"><i class="fas fa-plus"></i> Insert</button>						
						</div>	
					</div>					
				</div>
			</div>
		</div>
			<div class="card" style="margin-top: 50px; display: none;">
				<h5 class="card-header bg-info text-center">Lista korisnika</h5>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" style="text-align: center;">
							<thead class="table-primary">
								<tr>
									<th>Ime</th>
									<th>Prezime</th>
									<th>Korisničko ime</th>
									<th>Datum registracije</th>
									<th style="width: 130px;">Akcija</th>											
								</tr>
							</thead>
							<tbody id="tbody" class="table-hover">							
							<?php 
							$sql = "SELECT * FROM radnici";
							$results = $conn->query($sql);
							while ($row=$results->fetch_assoc()) {
							?>
								<tr class="table-success">
									<td style="vertical-align: middle;"><?=$row['ime']?></td>
									<td style="vertical-align: middle;"><?=$row['prezime']?></td>
									<td style="vertical-align: middle;"><?=$row['username']?></td>
									<td style="vertical-align: middle;"><?=$row['e_mail']?></td>
									<td style="vertical-align: middle; min-width: 130px;">
									<button class="btn btn-warning edit" style="margin-right: 10px; color: #fff;" data-toggle="modal" data-target="#exampleModalCenter"	data-id = <?=$row['radnik_id']?>
									data-ime = "<?=$row['ime']?>"
									data-prezime = "<?=$row['prezime']?>"
									data-kor = "<?=$row['username']?>"
									data-mail = "<?=$row['e_mail']?>"
									data-pass = "<?=$row['password']?>"
									data-status = "<?=$row['admin']?>"><i class="fas fa-edit"></i></button>
									<button class="btn btn-danger delete" data-id = <?=$row['radnik_id']?>><i class="fas fa-trash"></i></button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</table>
				</div>
			</div>
		</div>
			
			<!-- MODAL ZA UNOS NOVOG KORISNIKA -->
			
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="margin-left: 3%; margin-right: 3%;">
						<div id='naslov_modala' class="modal-title w-100 text-center" style="margin-left: 8%">
							<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle"></h5>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<div align="center">
						<form class="form-horizontal" style="margin-top: -5px;">	
							<div class="col-md-8">	
								<label>Ime:</label>
								<input type="text" name="ime" class="form-control">
							</div>
							<div class="col-md-8">	
								<label>Prezime:</label>
								<input type="text" name="prezime" class="form-control">
							</div>
							<div class="col-md-8">	
								<label>Korisničko ime:</label>
								<input type="text" name="korIme" class="form-control">
							</div>
							<div class="col-md-8">	
								<label>Šifra:</label>
								<input type="password" name="sifra" class="form-control">
							</div>
							<div class="col-md-8">	
								<label>E-mail:</label>
								<input type="email" name="mail" class="form-control">
							</div>
							<div class="col-md-8">	
								<label>Status:</label>
								<select name="status" class="form-control">
									<option value="0">Korisnik</option>
									<option value="1">Administrator</option>								
								</select>
							</div>
							<input type="hidden" name="akcija">
							<input type="hidden" name="radnik_id">
						</form>
					</div>
					</div>
					<div class="modal-footer" style="margin-left: 3%; margin-right: 3%;">
					<button type="button" class="btn btn-success unosKorisnika" data-dismiss="modal"><i class="fas fa-check" style="min-width: 70px;"></i></button>
					<button type="button" class="btn btn-danger"><i class="fas fa-times" style="min-width: 70px;" data-dismiss="modal"></i></button>
					</div>
				</div>
			</div>
		</div>
			
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
	<?php include 'scripts.php'; ?></script>
	<script>
	$('document').ready(function(){
		$('.display-3').fadeIn(1500);
		$('.display-search').fadeIn(1500);
		$('.card').fadeIn(1500);
	});
	
	/* AJAX ZA PRETRAGU RADNIKA */
	
	$('body').on('click', '.search', function(e){
		e.preventDefault();
		var pretraga = $('input[name=search_bar]').val();
		var akcija = 'pretragaKorisnika';
		var filter = $('select[name=filterSearch]').val();
		$.ajax ({
			url: 'ajax/ajax_radnici.php',
			type: 'post',
			data: {
				pretraga:pretraga,
				akcija:akcija,
				filter:filter,
			},
			success: function(data){
				$('#tbody').html(data);				
			}			
		})
	})
	
	/* AJAX ZA UNOS RADNIKA */
	
	$('body').on('click', '.unosKorisnika', function(e){
		e.preventDefault();		
		var ime = $('input[name=ime]').val();
		var prezime = $('input[name=prezime]').val();
		var korIme = $('input[name=korIme]').val();
		var sifra = $('input[name=sifra]').val();
		var mail = $('input[name=mail]').val();
		var status = $('select[name=status]').val();
		var akcija = $('input[name=akcija]').val();
		var radnik_id = $('input[name=radnik_id]').val();
		$.ajax({
			url: 'ajax/ajax_radnici.php',
			type: 'post',
			data: {
				akcija:akcija,
				ime:ime,
				prezime:prezime,
				korIme:korIme,
				sifra:sifra,
				mail:mail,
				status:status,
				radnik_id:radnik_id,
			}, 
			success: function(data) {				
				$('#search').trigger('click');				
			}
		})		
	})
	/* AJAX ZA IZMENU RADNIKA */
	$('body').on('click', '.edit', function(e){
		e.preventDefault();
		$('#naslov_modala').html('<h5>Izmena korisnika</h5>');		
		var radnik_id = $(this).data('id');
		var ime = $(this).data('ime');
		var prezime = $(this).data('prezime');
		var korIme = $(this).data('kor');
		var sifra = $(this).data('pass');
		var mail = $(this).data('mail');
		var status = $(this).data('status');			
		
		$('input[name=radnik_id]').val(radnik_id);
		$('input[name=ime]').val(ime);
		$('input[name=prezime]').val(prezime);
		$('input[name=korIme]').val(korIme);
		$('input[name=sifra]').val(sifra);
		$('input[name=mail]').val(mail);
		$('select[name=status]').val(status);
		$('input[name=akcija').val('edit');		
	})
	
	$('body').on('click', '#insert', function(){
		$('#naslov_modala').html('<h5>Novi korisnik</h5>');		
		$('input[name=akcija]').val('unosKor');
	})
	
	$('#exampleModalCenter').on('hidden.bs.modal', function () {
		$(this).find('input').each(function(){
			$(this).val("");
			$('select[name=status]').val("0");
		})		
	})
	/* AJAX ZA BRISANJE RADNIKA */
	
	$('body').on('click', '.delete', function(e){
		
		e.preventDefault();
		var id = $(this).data('id');
		akcija = 'brisanje';
		if(confirm("Da li sigurno želite da obrišete ovog radnika?")) {
			$.ajax ({
				url: 'ajax/ajax_radnici.php',
				type: 'post',
				data: {
					id:id,
					akcija:akcija,
				}, 
				success: function(data) {					
					$('#search').trigger('click');					
				}
			})
		}
	})
	
	
	</script>
	</body>
</html>


