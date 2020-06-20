<?php


include 'dbconnect.php';


if(!$_SESSION['admin']){ 
	echo "<h1>Izvinite, samo admin ima pristup.</h1>";	
	die();
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Zaposleni</title>
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
		#profileDisplay {			
			 display: block; 
			 height: 210px; 
			 width: 80%; 
			 margin: 0px auto; 
			 border-radius: 50%;
			 
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
		
	</style>
</head>

<body>
	
	<h2  class="display-3" style='display: none;'>Zaposleni</h2>

	<div class="display-search" style="display: none;">	
		<div class="container row d-flex justify-content-center" style="margin-left: auto; margin-right: auto; margin-bottom: 5%;">		
			<div class="col-md-4" style="margin-right: 10px;">
				<input type='text' name='search_bar' class='form-control'  placeholder='Pretraži'>
			</div>		
			<div class="form-group row">		
				<button class="btn btn-light" type='button' name='submit_search' id='search' style="margin-right: 10px; min-width: 100px;"><i class="fas fa-search"></i> Pretraži</button>		
				<button class="btn btn-light" type='button' name='Insert' id='insert' data-toggle="modal" data-target="#insert_modal" style="min-width: 100px;"><i class="fas fa-plus"></i> Insert</button>
			</div>		
		</div>
	</div>	
	
		<table class="table table-striped table-bordered" id='tabela_zaposleni'  style='display: none;'>
			<thead class="bg-info">
				<tr>
					<th>#</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>E-mail</th>
					<th>Slika</th>
					<th>Broj telefona</th>
					<th>Pozicija</th>		
					<th style="width: 130px">Akcija</th>		
				</tr>
			</thead>	
			<tbody id='tbody' class="bg-light"> 

<?php 

$prikaz = "SELECT * FROM zaposleni";

$results = $conn->query($prikaz);
$i = 1;
while ($red = $results->fetch_assoc()) {
	$ime = $red['ime'];
	$prezime = $red['prezime'];
	$e_mail = $red['e_mail'];
	$slika = $red['slika'];
	$telefon = $red['broj_telefona'];
	$pozicija = $red['pozicija'];	
	
?>
				<tr>	
					<td style='vertical-align: middle;'><?=$i++;?></td>
					<td style='vertical-align: middle;'><?=$red['ime'];?></td>
					<td style='vertical-align: middle;'><?=$red['prezime'];?></td>
					<td style='vertical-align: middle;'><?=$red['e_mail'];?></td>
					<td><img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='50' width='50' data-html="true" data-toggle='tooltip' title="<img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='150' width='150'>'"></td>
					<td style='vertical-align: middle;'><?=$red['broj_telefona'];?></td>
					<td style='vertical-align: middle;'><?=$red['pozicija'];?></td>
					<td style=' vertical-align: middle; min-width: 130px'>		
						<button class="btn btn-warning edit" type='button' name='edit' id='edit' style='max-width:100px; margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['radnik_id']?>"		
						data-id="<?=$red['radnik_id'];?>"
						data-a="<?=$red['ime'];?>"
						data-b="<?=$red['prezime'];?>"
						data-c="<?=$red['e_mail'];?>"
						data-d="<?=$red['slika'];?>"
						data-e="<?=$red['broj_telefona'];?>"		
						data-f="<?=$red['pozicija'];?>">		
						<i class="fas fa-edit"></i>		
						</button>
						<button class="btn btn-danger delete" name='delete' data-id="<?=$red['radnik_id']?>" id='delete'><i class="fas fa-trash"></i></button>
					</td>	
				</tr>
<?php
}
?>
			</tbody>
		</table>	
	
<!-- MODAL ZA INSERT -->

	<div class="modal fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
					<div id='naslov_modala' class="modal-title w-100 text-center" style="margin-left: 8%">
						<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle"></h5>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id='modal_forma' enctype='multipart/form-data' style="margin-bottom: 5px !important;">
						<div align="center">				
							<div class="col-md-8 text-center">
								<label>Ime</label>
								<input type='text' name='ime' placeholder='' class='form-control' id='ime'>
							</div>				
							<div class="col-md-8 text-center">
								<label>Prezime</label>
								<input type='text' name='prezime' placeholder='' class='form-control' id='prezime'>				
							</div>
							<div class="col-md-8 text-center">
								<label>E-mail:</label>
								<input type='text' name='e-mail' placeholder='' class='form-control' id='e_mail'>
							</div>
							<div class="col-md-8 text-center">
								<label>Broj telefona</label>
								<input type='text' name='broj_telefona' placeholder='' class='form-control' id='telefon'>
							</div>
							<div align="center">
								<div class="col-md-8 text-center">
									<label>Pozicija</label>
									<select class='form-control input_margin' id='pozicija' name='pozicija'>	
										<option>Izaberi...</option>					
										<option value='Direktor'>Direktor</option>					
										<option value='Sef kuhinje'>Sef kuhinje</option>
										<option value='Komercijalni direktor'>Komercijalni direktor</option>
										<option value='Komercijalista'>Komercijalista</option>
										<option value='Sekretarica'>Sekretarica</option>
										<option value='HR'>HR</option>
										<option value='Recepcioner'>Recepcioner/ka</option>
										<option value='Blagajnik'>Blagajnik</option>
										<option value='Spremačica'>Spremacica</option>
									</select>	
								</div>
							</div>							
							<div align="center">	
								<label>Slika</label>
								<div class="col-md-8 text-center slicica" style="margin-bottom: 5%;">						
									<img src="ajax/uploads/placeholder.png" id="profileDisplay">
									<input type='file' name='filetoupload' id='slika' class='form-control' onchange="displayImage(this)" style='display: none;'>
								</div>										
								<input type='hidden' name='akcija' id='akcija'>
								<input type='hidden' name='radnik_id' id='radnik_id'>		
							</div>
						</div>
					</form>						
					<div class="modal-footer">
						<button type="button" class="btn btn-success" id='modal_insert' data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-plus"></i> Sačuvaj</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-times"></i> Izmeni</button>        
					</div>					
				</div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script <?php include 'scripts.php'; ?></script>
<script type='text/javascript'>

	function displayImage(e) {
		if(e.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){
				document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
				}
				reader.readAsDataURL(e.files[0]);
			}
	}	
	
$('document').ready(function(){	

	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
	
 /*	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
		}) */

	$('#profileDisplay').on('click', function(e){
		e.preventDefault();
		$('#slika').trigger('click');		
	});	
	
<!-- AJAX ZA INSERT -->

	$('body').on('click', '#insert', function(){
		$('#naslov_modala').html('<h5>Insert</h5>');
		$('#ime').val('');
		$('#prezime').val('');
		$('#e_mail').val('');
		$('#telefon').val('');
		$('#slika').val('');
		$('select[name=pozicija]').val();
		$('#pozicija').val('Izaberi...');
		$('#radnik_id').val('');
		$('#akcija').val('insert');
		
	});
	
	
	$('body').on('click', '#modal_insert', function(e){
		e.preventDefault();
		var formdata = new FormData($('#modal_forma')[0]);
		var akcija = 'insert';
		$.ajax ({
			url: 'ajax/ajax_zaposleni.php',
			method: 'post',
			data: formdata,
			processData: false,
			contentType: false,
			success: function(data){
				$('#tbody').html(data);
			}
		})
	});
	/*
	$('body').on('click', '#modal_insert', function(e){
	e.preventDefault();
	var ime = $('#ime').val();
	var prezime = $('#prezime').val();
	var e_mail = $('#e_mail').val();
	var telefon = $('#telefon').val();
	var slika = $('#slika_form').serialize();
	var pozicija = $('#pozicija').val();	
	var akcija = $('#akcija').val();
	var radnik_id = $('#radnik_id').val();
	

	$.ajax ({
		url:'ajax/ajax_zaposleni.php',
		enctype: 'multipart/form-data',
		type: 'post',	
		data: {			
			ime:ime,
			prezime:prezime,
			e_mail:e_mail,
			telefon:telefon,
			pozicija:pozicija,
			slika:slika,
			radnik_id:radnik_id,
			akcija:akcija
		},
		success: function(data) {
			$('#tbody').html(data);
					
		}
	})
  }); 
*/
  
<!-- AJAX ZA SEARCH --> 

	$('#search').on('click', function(e){
		e.preventDefault();
		var search = $('input[name=search_bar]').val();
		var akcija = 'search';
		$.ajax ({
			url: 'ajax/ajax_zaposleni.php',
			type: 'post',
			
			data: {
				search:search,
				akcija:akcija,				
			},
			success: function(data) {
			$('#tbody').html(data);			
			}
		})
	});
	
<!-- AJAX ZA DELETE -->

	$('body').on('click', '.delete', function(e){
		e.preventDefault();
		var radnik_id = $(this).data('id');
		var akcija = 'brisanje';
		
		if (confirm('Da li sigurno želite da uklonite ovog radnika?')) {			
			$.ajax({
				url: 'ajax/ajax_zaposleni.php',
				type: 'post', 
				data: {
					radnik_id:radnik_id,
					akcija:akcija, 
				},
				success: function(data) {
					$('#tbody').html(data);
				}
			});			
		}
	});
	
	<!-- AJAX ZA EDIT -->		
	
	<!-- Popunjavanje edit inputa -->	
	
	$('body').on('click', '.edit', function() {				
				
		$('#akcija').val('edit');
		var z_id = $(this).data('id');
		var ime = $(this).data('a');
		var prezime = $(this).data('b');
		var e_mail = $(this).data('c');
		var slika = $(this).data('d');
		var broj_telefona = $(this).data('e');
		var pozicija = $(this).data('f');
		
		$('#radnik_id').val(z_id);
		$('#ime').val(ime);
		$('#prezime').val(prezime);
		$('#e_mail').val(e_mail);
		$('.slicica').val(slika);
		$('#telefon').val(broj_telefona);
		$('#pozicija').val(pozicija);		
		
	});	
	
	$('body').on('click', '.edit', function() {
		$('#naslov_modala').html('<h5>Edit</h5>');
	});
	
	$('.display-search').fadeIn(1000);
	$('#tabela_zaposleni').fadeIn(1000);
	$('.display-3').fadeIn(1000);	
});
</script>
</body>
</html>

