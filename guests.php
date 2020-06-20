<?php

include 'dbconnect.php';


?>

<head>
  <meta charset="utf-8">
  <title>Gosti</title>
  <?php include 'navbar.php'; ?> <!-- DA BI RADIO TITLE -->
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
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1);	
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
		th {
			width: 200px;
		}
	
	</style>
</head>
<body>
	
	<h2 class="display-3" style='display: none;'>Gosti</h2>	
	<div class="display-search" style="display: none;">	
		<div class="container row d-flex justify-content-center" style="margin-left: auto; margin-right: auto; margin-bottom: 5%;">		
			<div class="col-md-4" style="margin-right: 10px;">
				<input type='text' name='search_bar' class='form-control'  placeholder='Pretraži'>
			</div>		
			<div class="form-group row">		
				<button class="btn btn-light" type='button' name='submit_search' id='search' style="margin-right: 10px;"><i class="fas fa-search"></i> Pretraži</button>		
				<button class="btn btn-light" type='button' name='Insert' id='insert' data-toggle="modal" data-target="#exampleModalCenter" style="min-width: 100px;"><i class="fas fa-plus"></i> Insert</button>
			</div>		
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-striped" id='tabela_zaposleni' style='display: none;'> 
			<thead class="bg-info">
				<tr>		
					<th style="width: 120px;">Redni broj</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>E-mail</th>				
					<th>Br. lične karte</th>	
					<th style="width: 130px;">Akcija</th>
				</tr>
			</thead>		
			<tbody id='tbody' class="bg-light"> 
		
<?php

	$sql = "SELECT * FROM guests";

	$results = $conn->query($sql);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
	
?>
			<tr>			
				<td style="vertical-align: middle;"><?=$i++?></td>			
				<td style="vertical-align: middle;"><?=$red['ime']?></td>			
				<td style="vertical-align: middle;"><?=$red['prezime']?></td>
				<td style="vertical-align: middle;"><?=$red['e_mail']?></td>
				<td style="vertical-align: middle;"><?=$red['lk_broj']?></td>		
				<td style='min-width: 180px; vertical-align: middle;'>			
					<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width: 45px; color: #fff;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['guests_id']?>"
					data-a="<?=$red['ime']?>"
					data-b="<?=$red['prezime']?>"
					data-c="<?=$red['e_mail']?>"
					data-d="<?=$red['lk_broj']?>"><i class="fas fa-edit"></i>			
					</button>
					<button class="btn btn-danger delete" name='delete' id='delete' style="margin-right: 5px; width: 45px;" data-id="<?=$red['guests_id']?>"><i class="fas fa-trash"></i></button>
					<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['guests_id']?>"><i class="fas fa-id-card"></i></button>
				</td>	
			</tr>

<?php		
}

?>
			</tbody>
		</table>
	</div>

	<!-- MODAL ZA INSERT/EDIT -->

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
					<div id='naslov_modala' class="modal-title w-100 text-center" style="margin-left: 8%">
						<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle" ></h5>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div align="center">
						<form class='form-horizontal' enctype='multipart/form-data' style="margin-top: -10px;">			
							<div class="col-md-8">
								<label>Ime:</label>
								<input type='text' name='ime' class="form-control" placeholder='Unesite ime' id='ime' >
							</div>
							<div class="col-md-8">
								<label>Prezime:</label>
								<input type='text' name='prezime' class="form-control" placeholder='Unesite prezime' id='prezime'>
							</div>
							<div class="col-md-8">
								<label>E-mail:</label>
								<input type='text' name='e_mail' class="form-control" placeholder='Unesite e-mail' id='e_mail'>
							</div>
							<div class="col-md-8">
								<label>Broj lične karte:</label>   
								<input type='text' name='lk_broj' class="form-control" placeholder='Unesite broj lične karte...' id='lk_broj'>
							</div>											
							<input type='hidden' name='akcija' id='akcija'>
							<input type='hidden' name='guests_id' id='guests_id'>				
						</form>
					</div>
					<div class="modal-footer" style="margin-top: 5%;">
						<button type="button" class="btn btn-success" data-dismiss="modal" id='button_save' style="min-width: 100px;"><i class="fas fa-plus"></i> Sačuvaj</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-times"></i> Odustani</button>        
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODAL ZA PRIKAZ REZERVACIJA -->
	
	
	<div  class="modal fade bd-example-modal-lg" id="modalRez"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 1.5%; margin-left: 1.5%">
					<h5 class="modal-title w-100 text-center"  style="margin-left: 8%" id="exampleModalLongTitle">Rezervacije gosta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-sm table-bordered table-striped table-hover text-center" style="margin-bottom: 0px;">
							<thead class="bg-info">
								<tr>
									<td style="vertical-align: middle;"><b>ID rezervacije</b></td>
									<td style="vertical-align: middle;"><b>Datum početka rezervacije</b></td>
									<td style="vertical-align: middle;"><b>Datum isteka rezervacije</b></td>
									<td style="vertical-align: middle;"><b>Broj sobe</b></td>
									<td style="vertical-align: middle;"><b>Akcija</b></td>									
								</tr>
							</thead>
							<tbody id="tbody1" class="bg-light">
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer" style="margin-right: 1.5%; margin-left: 1.5%">
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-times"></i> Zatvori</button>					
				</div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
<?php include 'scripts.php'; ?></script>
<script>

<!-- AJAX ZA INSERT -->
$('document').ready(function(){
	
	$('body').on('click', '#insert', function(){		
		$('#akcija').val('insert');
		$('guests_id').val('');
		$('#ime').val('');
		$('#prezime').val('');
		$('#e_mail').val('');
		$('#lk_broj').val('');		
		$('#naslov_modala').html('<h5>Insert</h5>');
	});
	
	
	
	$('body').on('click', '#button_save', function(){
		var guests_id = $('#guests_id').val();
		var akcija = $('#akcija').val();
		var ime = $('#ime').val();
		var prezime = $('#prezime').val();
		var e_mail = $('#e_mail').val();
		var lk_broj = $('#lk_broj').val();
		$.ajax ({
			url: 'ajax/ajax_guests.php',
			type: 'post',
			data: {
				guests_id:guests_id,
				akcija:akcija,
				ime:ime,
				prezime:prezime,
				e_mail:e_mail,
				lk_broj:lk_broj,
			},
			success: function(data) {
				$('#tbody').html(data);
			}
		})		
	})	
	
	$('body').on('click', '#delete', function(e){
		e.preventDefault();
		var guests_id = $(this).data('id');
		var akcija = 'brisanje';
		
		if (confirm('Da li ste sigurni da zelite da obrisete ovog gosta?')) {
			$.ajax({
				url: 'ajax/ajax_guests.php',
				type: 'post',
				data: {
					guests_id:guests_id,
					akcija:akcija, 
				},
				success: function(data) {
					$('#tbody').html(data);
				}				
			})
		}
	})
	
/* AJAX ZA EDIT */
/* Popunjavanje edit inputa */

	$('body').on('click', '.edit', function(){
		$('#akcija').val('edit');
		
		var guests_id = $(this).data('id');
		var ime = $(this).data('a');
		var prezime = $(this).data('b');
		var e_mail = $(this).data('c');
		var lk_broj = $(this).data('d');
		
		$('#guests_id').val(guests_id);
		$('#ime').val(ime);
		$('#prezime').val(prezime);
		$('#e_mail').val(e_mail);
		$('#lk_broj').val(lk_broj);
	});
	
	$('body').on('click', '#edit', function() {
		$('#naslov_modala').html('<h5>Edit</h5>');
	});	

/* AJAX ZA SEARCH */

	$('#search').on('click', function(e){
		e.preventDefault();
		var search = $('input[name=search_bar]').val();
		var akcija = 'search';
		$.ajax ({
			url: 'ajax/ajax_guests.php',
			type: 'post',
			data: {
				search:search,
				akcija:akcija,
			}, 
			success: function(data) {
				$('#tbody').html(data);
			}
		})
	})
	<!-- AJAX ZA PROVERU SVIH REZERVACIJA -->
	
	$('body').on('click', '.proveraREZ', function(e){
		e.preventDefault();
		var akcija = 'proveraREZ';
		var id = $(this).data('id');
		$.ajax ({
			url: 'ajax/ajax_guests.php',
			type: 'post',
			data: {
				akcija:akcija,
				id:id
			},
			success: function(data) {
				$('#tbody1').html(data);
			}
		})
	});
	<!-- AJAX ZA BRISANJE REZERVACIJE IZ TABELE -->
	
	$('body').on('click', '.deleteREZ', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var akcija = 'brisanjeREZ';
		$('#redI' + id).css({"background-color":"#9c0909", "color":"white"});
		if (confirm('Da li želite da obrišete rezervaciju za datog gosta?')) {
			$.ajax ({
				url: 'ajax/ajax_guests.php',
				type: 'post',
				data: {
					akcija:akcija,
					id:id,						
					},
					success: function(data) {
						data=data.trim();
						if (data=="obrisana") {
						$('#redI' + id).fadeOut('slow');
						}
					}
				})
			}
		})
	
	
	$('.display-search').fadeIn(1000);
	$('#tabela_zaposleni').fadeIn(1000);
	$('.display-3').fadeIn(1000);
	

});
</script>







</body>
</html>



		