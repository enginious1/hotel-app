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
 <head>
  <meta charset="utf-8">
  <title>Kalkulacije</title>
  <?php include 'navbar.php' ?>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
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
			background: #0264d6;
			background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); 
			background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); 
			background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); 
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1); 
			
		}
		
		.card { 		
			
			margin-left: auto;
			margin-right: auto;
			vertical-align: middle;
			text-align: left;
			width: 50%;			
		}
		.card .card-header {	
			text-align: left;
			font-size: 20px;
			color: #fff;
		}				
		.label {
			text-align: left;
			font-size: 18px;
		}
		.card-header {
			font-size: 20px;
		}
		
		th {
			font-size: 15px;
		}
		td {
			font-size: 15px;
		}
		.modal {
			overflow: scroll;
		}
	
				
	</style>
</head>
<body>
	
	<div class="card border-light" style='display:none;  margin-top: 50px;'>
		<h4 class="card-header text-center bg-info">
			 Kalkulacije
		</h4>
		<div class="card-body" style='margin: 10px 0px'>		
			<form class="form-horizontal">
				<div class="form-group row">
					<div class="col-md-4">	
						<label class='label'>Od:</label>
						<div class="input-group date" data-target-input="nearest">		
						<input type='text' name='od' id='datetimepicker' data-toggle="datetimepicker" data-target="#datetimepicker" class='datetimepicker-input form-control'>
							<div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
						</div>
						</div>
					</div>
					<div class="col-md-4">
						<label class="label-control">Do:</label>	
						<div class="input-group date" data-target-input="nearest">
							<input type='text' name='do' id='datetimepicker1' data-toggle="datetimepicker" data-target="#datetimepicker1" class='datetimepicker-input form-control datum'>		
							<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<label class='label-control'>Dobavljač:</label> 				
						<select type='text' name='dobavljac' class='form-control' id='dobavljac_search' style='margin-right: 50px'>
							<option value="">Izaberi...</option>
							<?php $sql = "SELECT * FROM dobavljaci";
							$res = $conn->query($sql);
							while ($row=$res->fetch_assoc()) {?>
							<option value="<?=$row['dobavljaci_id']?>"><?=$row['ime'];?></option>
							<?php }?>
						</select>		
					</div>
				</div>
			</form>
			<div class="form-inline" style="margin-top: 30px;">	
				<div class='mx-auto'>	
					<label class="label-control"></label>
					<button class="btn btn-info btn-lg" style="min-width: 140px;" type='button' name='pretrazi' value='Pretrazi' id='pretrazi' style="margin-right: 5px"><i class="fas fa-search"></i>  Pretraži</button>		
					<button class="btn btn-outline-info btn-lg" style="min-width: 140px;" type='button' name='pretrazi' value='Nova' id='nova' data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i></i>  Nova</button>
				</div>
			</div>	
		</div>
	</div>
	<div class="card border-light" style='display:none; margin-top: 50px !important;'>
		<h4 class="card-header text-center bg-info" style="color: #fff;">
			<span style="margin-left: 140px; !important">Lista </span> 
			<span style='float: right;'>
			<a href='generate.php' class="btn btn-outline-light" style="border-radius: 10px;" type='button'><i class="far fa-file-pdf"></i> PDF format</a>
			</span>	
		</h4>  
		<div class="card-body" style="margin-top: 20px 0;">
			<div class="table-responsive">   
				<table class="table" style='text-align: center; margin-bottom: 0;'>
					<thead>
						<tr class="table-primary">
							<th scope="col">Kalkulacija</th>
							<th scope="col">Dobavljač</th>
							<th scope="col">Datum prijema</th>
							<th scope="col">Ukupna cena</th>
							<th scope="col">Napomena</th>
							<th style="width: 220px;">Akcija</th>	
						</tr>
					</thead>
					<tbody id='tbody' class="table-hover">
		
<?php 
						$sql_1 = "SELECT kalkulacijemain.dobavljaci_id, kalkulacijemain.racun_id, kalkulacijemain.datum_prijema, kalkulacijemain.broj_fakture, kalkulacijemain.broj_godine, kalkulacijemain.napomena, dobavljaci.dobavljaci_id, dobavljaci.ime, SUM(kalkulacijedetailed.prodajnacena) as pdc FROM kalkulacijemain LEFT JOIN dobavljaci ON kalkulacijemain.dobavljaci_id = dobavljaci.dobavljaci_id LEFT JOIN kalkulacijedetailed ON kalkulacijemain.racun_id = kalkulacijedetailed.racun_id	GROUP BY kalkulacijemain.racun_id";
						
					
							
						$results1 = $conn->query($sql_1);
						
						while ($red = $results1->fetch_assoc()) {
						?>	
						<tr class="table-success">
							<td style="vertical-align: middle;"><?=$red['broj_fakture'] . "/" . $red['broj_godine']?></td>
							<td style="vertical-align: middle;"><?=$red['ime']?></td>						
							<td style="vertical-align: middle;"><?=$red['datum_prijema']?></td>
							<td style="vertical-align: middle;"><?php if (!$red['pdc']) { 
							echo "0€"; } else {	echo number_format($red['pdc'], 2) . "€";} ?></td>
							<td style="vertical-align: middle;"><?=$red['napomena']?></td>
							<td style="min-width: 220px; vertical-align: middle;">
							<button class="btn btn-warning edit" type='button' name='edit' value='edit' id='edit' style='margin-right: 10px; color: #fff;' data-toggle="modal" data-target=".bd-example-modal-lg"
							data-id="<?=$red['racun_id']?>"
							data-a="<?=$red['dobavljaci_id']?>"
							data-b="<?=date('d.m.Y', strtotime($red['datum_prijema']))?>"
							data-c="<?=$red['napomena']?>"
							data-d="<?=$red['broj_fakture'] . "/" . $red['broj_godine']?>">	
							<i class="fas fa-edit"></i>  Prikaz</button>		
							<button class="btn btn-danger delete" type='button' name='delete' value='delete' id='delete' data-id="<?=$red['racun_id']?>"><i class="fas fa-trash"></i>  Obriši</button>		
							</td>
						</tr>	
<?php
	}
?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php	

$sql_2 = "SELECT * FROM dobavljaci";
$results2 = $conn->query($sql_2);

?>

<!-- MODAL ZA NOVU FAKTURU -->

	<div class="modal fade bd-example-modal-lg hide-modal" tabindex="-1" role="dialog" id="modalKalk" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" style="width: 80%; margin-left:auto; margin-right: auto;">
				<div class="card" style="width: 95%; margin-bottom: 20px; margin-top: 20px;">
					<div class="card-header text-center bg-info" id='card_naslov'>
						<h5></h5>
					</div>
					<div class="card-body">
						<form action="" class="form-horizontal" id="klm">
						<div class="form-group row">   
							<div class="col-md-4">
								<label class="control-label">Broj fakture:</label>
								<input type="text" class="form-control" name="br_racuna" id='br_racuna' disabled>
							</div>					
							<div class="col-sm-12 col-md-4">		
								<label class="control-label">Datum:</label>
								<div class="input-group date" data-target-input="nearest">
								<input type='text' class="form-control" name="datum1" id='datetimepicker2' data-toggle="datetimepicker" data-target="#datetimepicker2" class='datetimepicker-input form-control datum'>
								<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
								</div>
							</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<label class="control-label">Dobavljač:</label>
									<select name="dobavljac" class="form-control dobavljac_instant" id='dobavljac_instant'>
										<option value=0>Izaberi...</option>
										<option class="dobShow" type="button" value='novi_dob'>Novi dobavljač: </option>
										<?php 
											$sql = "SELECT * FROM dobavljaci";
											$res = $conn->query($sql);
											while($row=$res->fetch_assoc()){?>
										<option value="<?=$row['dobavljaci_id'];?>"><?=$row['ime'];?>
										</option>
											<?php } ?>    
									</select>
							</div><br>
						</div>		
							<div class="modal fade" id="miniM_dob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header" style="margin-right: 3%; margin-left: 3%;">
											<h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 8px; color: #fff;">Unos novog dobavljača</h5>
											<button type="button" class="close" data-dismiss-modal="modal2" aria-label="Close" style="color: #fff;";
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div align="center">
												<div class="form-group" style="margin-top: -15px;"> 
													<div class="col-md-8">
														<label class="label-control" style="color: #fff;">Ime:</label>
														<input class='form-control' type='text' name='ime_dob' id='ime_dob' placeholder="Naziv dobavljača">
														<input type='hidden' name='akcija2' id='akcija2'>
													</div>
												</div>
												</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-success"  id='dob_select' data-dismiss-modal="modal2" style="min-width: 100px;"><i class="fas fa-check"></i></button>
												<button type="button" class="btn btn-danger" id='dob_close' data-dismiss-modal="modal2" style="min-width: 100px;"><i class="fas fa-times"></i></button>		
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label class="control-label">Napomena:</label>
									<input type="text" class="form-control" name="napomena" id='napomena'>
								</div>													
								<div class="col-md-4" style="margin-top:33px;">								
									<button class="btn btn-success" style='min-width:100px;' id='unesi_button'>
										<i class="fas fa-plus"></i>
									</button>
									<button class="btn btn-danger" type='button' style='min-width:100px;' data-dismiss="modal" id='modalClose'>
										<i class="fas fa-times"></i>  Zatvori
									</button>
								</div>	
									<div class="col-md-4" id="mainSuccess" style='margin-top: 30px;'> 
									<p></p>
								</div>
								<input type="hidden" name="idKalkulacije" id='racun_id'>
								<input type="hidden" name="akcija" id='akcija'>
							</div>
						</form>							
					</div>
				</div>
				
				<!-- BODY ZA KALKULACIJE DETAILED -->
			
				<div class="card" style="width: 95%; margin-bottom: 20px;">
					<div class="card-header text-center bg-info" id='detailed_naslov'>
						<h5></h5>
					</div>
					<div class="card-body">
						<form class="form-horizontal">
							<div class="form-group row">	
								<div class="col-md-6">
									<label class="control-label"> Domaćinstvo:</label>
									<select type='text' name='domacinstvo' class="form-control">
											<option value=0 id="izab">Izaberi...</option>
										<?php $sql = "SELECT * FROM domacinstvo";
										$res = $conn->query($sql);
										while ($red = $res->fetch_assoc()) {
										?>											
										<option value="<?=$red['domacinstvo_id']?>"><?=$red['ime']?></option>
										<?php 
										} ?>								
									</select>
								</div>	
								<div class="col-md-5">
									<label class="control-label"> Količina:</label>
									<input type='text' class="form-control" id='kolicina'>									
								</div>												
							</div>
							<div class="form-group row up">
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Nabavna</span>
										</div>
										<input type="text" class="form-control" id='nabavna' name='nabavnaCena'>
										<div class="input-group-append">
											<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Prodajna</span>
										</div>
										<input type="text" class="form-control" id='prodajna' name='prodajnaCena'>
										<div class="input-group-append">
											<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>							
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">PDV</span>
										</div>
										<input type="text" class="form-control" id='pdv' name='pdv'>
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Marža</span>
										</div>
										<input type="text" class="form-control" id='marza' name='marza'>
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Rabat</span>
										</div>
										<input type="text" class="form-control" id='rabat' name='rabat'>
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<button type='button' class="btn btn-success kdet_insert showhide" style='min-width:100px;' id='kdet_insert' disabled></button> 
								</div>							
								<div class="col-md-6 sm-12 kd-success">			 							
								</div>
								<input type='hidden' name='akcija_det' id='akcija_det'>
								<input type="hidden" name="idKalkDet" id='idKalkDet'>
								<input type='hidden' name="skrivenaKolicina" id='hiddenKol'>
								<input type='hidden' name="skrivenaKD">
								<input type="hidden" name="hiddenPCI">
								<input type="hidden" name="hiddenPC">
							</div>	
						</form>												
					</div>	
				</div>
				<div class="card" style="width: 95%; margin-bottom: 20px;">
					<div class="card-header text-center bg-info">
						Lista
					</div>
					<div class="card-body">
						<div class="table-responsive">   
							<table class="table table-sm" style='vertical-align: middle; text-align: center;'>
								<thead>
									<tr class="table-primary">
										<th scope="col">Količina</th>
										<th scope="col">Nabavna cena</th>
										<th scope="col">Prodajna cena</th>
										<th scope="col">Domaćinstvo</th>
										<th scope="col">Marža</th>
										<th scope="col">PDV</th>
										<th scope="col">Rabat</th>
										<th style="width: 100px;">Akcija</th>
									</tr>
								</thead>
								<tbody id='tableBody' class="table-hover">
								</tbody>	
							</table>
						</div>
					</div>							
				</div>	
			</div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<?php include 'scripts.php'; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>


<script type='text/javascript'>


$('document').ready(function(){
	$('.card').fadeIn(1500);
	
	$("button[data-dismiss-modal=modal2]").click(function(){
		$('#miniM_dob').modal('hide');
		$('#akcija').val('unosKalk');
		
	});

	$('body').on('click', '#dob_select', function(){
		$('#akcija').val('unosKalk');
	})
	
	$('#datetimepicker2').datetimepicker({format: 'DD.MM.YYYY'});
	
	<!-- AJAX ZA PRETRAGU -->
	
	$('body').on('click', '#pretrazi', function(e){
		
		e.preventDefault();
		var datumOd = $('#datetimepicker').val();
		var datumDo = $('#datetimepicker1').val();
		var dobavljac = $('#dobavljac_search').val();
		var akcija = 'pretragaK';
		$.ajax ({
			url: 'ajax/ajax_kalkulacije.php',
			type: 'post',
			data: {
				datumOd:datumOd,
				datumDo:datumDo,
				dobavljac:dobavljac,
				akcija:akcija,
			},
			success: function(data) {
				$('#tbody').html(data);
				
			}
		})
	});	
	
		
 /*	$('#modalKalk').on('hidden.bs.modal', function(){
		$('#akcija').val('');
		$('#racun_id').val('');
	}); */
	
	$('body').on('click', '#nova', function()	{
		
		$('#idKalkDet').val('');
		$('#kdet_insert').attr('disabled', 'disabled');
		$('#unesi_button').html('<i class="fas fa-plus"></i> Unesi');
		$('#kdet_insert').html('<i class="fas fa-plus"></i> Unesi');		
		$('#tableBody').html('');
		$('select[name=domacinstvo]').val(0);		
		
		$('#kolicina').val('');
		$('#prodajna').val('');		
		$('#nabavna').val('');
		$('#rabat').val('');
		$('#marza').val('');
		$('#pdv').val('');
		$('#card_naslov').html('<h5>Kalkulacije main INSERT</h5>');
		$('#detailed_naslov').html('<h5>Kalkulacije detailed INSERT</h5>');
		$('#akcija').val('unosKalk');
		$('#br_racuna').val('');
		$('#datetimepicker2').val('');
		$('#dobavljac_instant').val(0);
		$('#napomena').val('');		
		$('#racun_id').val('');
		var akcija = $('#akcija').val('unosKalk');
	})
	$('body').on('click', '#dob_select', function(){
		$('#miniM_dob').fadeOut(400);
	})	
	
	$('body').on('click', '#dob_close', function(){
		$('#miniM_dob').fadeOut(400);
	})
	
	$('.dobavljac_instant').change(function() {
		
		var opval = $(this).val();
		if (opval == "novi_dob") {
			$('#miniM_dob').modal('show');
		} 
	}); 


	$('#datetimepicker2').blur(function() {
		var datum = $('input[name=datum1]').val();
		var akcija = 'test';
		$.ajax ({
			url: 'ajax/ajax_kalkulacije.php',
			type: 'post',
			data: {
				datum:datum, 
				akcija:akcija,
			},
			success: function(data) {
				$('#br_racuna').val(data);
			}
		})
	});		
	
<!-- modal za insert -->

	$('body').on('click', '#unesi_button', function(e) {
		e.preventDefault();
		var akcija = $('#akcija').val();
		var datum = $('input[name=datum1]').val();
		var napomena = $('input[name=napomena]').val();
		var akcija = $('#akcija').val();
		var dobavljac = $('#dobavljac_instant').val();
		var racun_id = $('#racun_id').val();
		if (dobavljac != 0) {
		$.ajax ({
				url: 'ajax/ajax_kalkulacije.php',
				type: 'post',
				data: {
					akcija:akcija, 
					datum:datum,
					napomena:napomena, 
					akcija:akcija, 
					dobavljac:dobavljac,
					racun_id: racun_id, 
				},
				success: function(data) {
					if(data.includes('/')) {
						$('#br_racuna').val(data);
					} else {
						$('#racun_id').val(data);
					}
					$('#mainSuccess').html("<p class='alert alert-success' role='alert'>	Uspešno je uneta kalkulacija!</p>").fadeIn('slow');
					setTimeout(function(){
						$('#mainSuccess').fadeOut('slow');
					}, 2500);
					
					$('#kdet_insert').removeAttr('disabled');
					$('#pretrazi').trigger('click');
				}
			});	
		}
	}); 
<!-- dugme za delete -->
	$('body').on('click', '.delete', function(e) {
		e.preventDefault();		
		var kalkulacije_id = $(this).data('id');
		var akcija = 'brisanje';
		
		if (confirm('Da li želite da obrisete ovu kalkulaciju?')) {
			$.ajax ({
				url: 'ajax/ajax_kalkulacije.php',
				type: 'post',
				data: {
					kalkulacije_id:kalkulacije_id,
					akcija:akcija,
				},
				success: function(data) {
					data=data.trim();
					console.log(data);
					if(data=="obrisana") {						
						$('#pretrazi').trigger('click');
					}
				}
			})
		}
	});
	
	<!-- popunjavanje inputa za edit -->
	
	$('body').on('click', '.edit', function(){
		$('#kdet_insert').removeAttr('disabled');	
		$('select[name=domacinstvo]').val(0);		
		$('#kolicina').val('');
		$('#prodajna').val('');		
		$('#nabavna').val('');
		$('#rabat').val('');
		$('#marza').val('');
		$('#pdv').val('');		
		
		var akcija = $('#akcija').val('edit');		
		var racun_id = $(this).data('id');
		var dobavljaci_id = $(this).data('a');
		var datum_prijema = $(this).data('b');
		var napomena = $(this).data('c');
		var broj_fakture = $(this).data('d');	
		
		$('#racun_id').val(racun_id);
		$('.dobavljac_instant').val(dobavljaci_id);
		$('#datetimepicker2').val(datum_prijema);
		$('#napomena').val(napomena);
		$('#br_racuna').val(broj_fakture);		
	});
	
	$('body').on('click', '.edit', function(){	
		
		$('#akcija_det').val('editKalkDet');
		$('#card_naslov').html('<h5>Kalkulacije main EDIT</h5>');
		$('#detailed_naslov').html('<h5>Kalkulacije detailed EDIT</h5>');
		
		$('#unesi_button').html('<i class="fas fa-plus"></i> Izmeni');
		$('#kdet_insert').html('<i class="fas fa-plus"></i>  Izmeni');
		
	});
	
	/*$('body').on('click', '.showhide', function(){
		$(this).removeClass('.kdet_insert');
		$(this).addClass('.editDet');
	});*/
	
/*	$('#kdet_insert').click(function() {
	
    $(this).removeClass('btn btn-outline-primary kdet_insert showhide');
    $(this).addClass('btn btn-outline-primary editDet showhide');
});

*/

	<!-- AJAX INSERT ZA DOBAVLJACE (SELECT) -->
	$('body').on('click', '#dob_select', function(e) {
		e.preventDefault();
		var ime = $('#ime_dob').val();
		var akcija = 'insert_dob';
		$.ajax ({
			url: 'ajax/ajax_kalkulacije.php',
			type: 'post',
			data: {
				ime:ime,
				akcija:akcija,
			},
			success: function(data) {
				$('.dobavljac_instant').html(data);
				
			}
		})
	});
	
	<!-- AJAX INSERT KALKULACIJE DETAILED -->
	
	$('body').on('click', '.kdet_insert', function(e) {
		$('.kdet_insert').removeAttr('disabled');
		e.preventDefault();
		var akcija = 'kdet_insert';		
		var domacinstvo = $('select[name=domacinstvo]').val();
		var kolicina = $('#kolicina').val();
		var nabavna = $('#nabavna').val();
		var rabat = $('#rabat').val();
		var pdv = $('#pdv').val();
		var marza = $('#marza').val();
		var prodajna = $('#prodajna').val();
		var racun_id = $('#racun_id').val();
		var kalk_det_id = $('#idKalkDet').val();
		var dkol = $('#hiddenKol').val();
		var staraKol = $('input[name=skrivenaKD]').val();
		if (domacinstvo != 0) {
			$.ajax ({
				url: 'ajax/ajax_kalkulacije.php',
				type: 'post',
				data: {
					akcija:akcija,
					domacinstvo:domacinstvo,
					kolicina:kolicina,
					nabavna:nabavna,
					rabat:rabat,
					pdv:pdv,
					marza:marza,
					prodajna:prodajna,
					racun_id:racun_id,
					kalk_det_id:kalk_det_id,
					dkol:dkol,
					staraKol:staraKol,
				},
				success: function(data) {
					
					$('#tableBody').html(data);
					$('.kd-success').html("<p class='alert alert-success' role='alert'>	Uspešno je uneta kalkulacija detailed!</p>").fadeIn('slow');
					setTimeout(function(){
						$('.kd-success').fadeOut('slow');
					}, 2500);
					$('#akcija_det').val('kdet_insert');
					$('#idKalkDet').val('');
				}
			}); 
		}
	});

<!-- KALKULACIJA DETAILED EDIT INPUTI -->

	$('body').on('click', '.editDet', function(e){
		e.preventDefault();
		$('#kdet_insert').removeAttr('disabled');
		var akcija = 'editKalkDet';	
		var racun_id = $('#racun_id').val();	
		var kalk_det_id = $(this).data('id');
		var kolicina = $(this).data('kolicina');	
		var nabavna = $(this).data('nabavna');
		var prodajna = $(this).data('prodajna');
		var domacinstvo_id = $(this).data('domacinstvo_id');
		var marza = $(this).data('marza');
		var pdv = $(this).data('pdv');
		var rabat = $(this).data('marza');
		var dkol = $(this).data('dkol');	
		
		$('#racun_id').val(racun_id);
		$('select[name=domacinstvo]').val(domacinstvo_id);
		$('#kalk_det_id').val(kalk_det_id);
		$('#kolicina').val(kolicina);
		$('#nabavna').val(nabavna);
		$('#prodajna').val(prodajna);
		$('#pdv').val(pdv);
		$('#marza').val(marza);
		$('#rabat').val(rabat);
		$('#idKalkDet').val(kalk_det_id);
		$('input[name=skrivenaKolicina]').val(dkol);
		$('input[name=skrivenaKD]').val(kolicina);		
	});

<!-- POPUNJAVANJE TABELE DETAILED PRILIKOM IZMENE (AJAX) -->

	$('body').on('click', '.edit', function(e){
		e.preventDefault();
		var akcija = 'popTab';
		var racun_id = $(this).data('id');
		$.ajax ({
			url: 'ajax/ajax_kalkulacije.php',
			type: 'post',
			data: {
				akcija:akcija,
				racun_id:racun_id,
			},
			success: function(data){
				$('#tableBody').html(data);			
			}
		})	
	})	

/* brisanje kalkulacije detailed iz insert-a */

	$('body').on('click', '.kalkDetDel', function(e){
		e.preventDefault();
		akcija = 'brisanjeKDET';
		var kalkId = $(this).data('id');
		var kolicina = $(this).data('kol');
		var dom = $(this).data('dom');
		var kalkMain = $('input[name=idKalkulacije]').val();
		if (confirm('Da li želite da obrišete ovo iz trenutne kalkulacije?')) {
			$.ajax ({
				url: 'ajax/ajax_kalkulacije.php',
				type: 'post',
				data: {
					dom:dom,
					akcija:akcija,
					kalkId:kalkId,
					kalkMain:kalkMain,
					kolicina:kolicina,
				},
				success: function(data) {
					$('#tableBody').html(data);
				}
			})		
		}
	});

/* AJAX ZA BRISANJE KALK DETAILED IZ BAZE */

/*******************/

	$('input[name=nabavnaCena]').change(function(e){
		e.preventDefault();
		var nc = parseFloat($(this).val() || 0);
		$('input[name=prodajnaCena]').val(nc);
		
	});

	$('input[name=pdv]').change(function(e){
		e.preventDefault();
		var pdv = parseFloat($(this).val() || 0);
		var nc = parseFloat($('input[name=nabavnaCena]').val() || 0);
		var nc = nc + (nc * (pdv/100));
		$('input[name=hiddenPC]').val(nc);
		$('input[name=prodajnaCena]').val(nc);	
	});

    $('input[name=marza]').change(function(e){
        e.preventDefault();
        var marza = parseFloat($(this).val()|| 0);
        var prodC = parseFloat($('input[name=hiddenPC]').val());
        var prodC = prodC + (prodC * (marza/100));
        $('input[name=prodajnaCena]').val(prodC);
    });


	$('modalKalk').modal('hide', function(){ 
		$(this).find('input, select').each(function(){
			$(this).val('');
		});
	})

	$('input[name=nabavnaCena]').blur(function(e){
		e.preventDefault();
		var nc = parseFloat($(this).val() || 0);
		$('input[name=prodajnaCena]').val(nc);	
	});
	
	$('input[name=pdv]').blur(function(e){
		e.preventDefault();
		var pdv = parseFloat($(this).val() || 0);
		var nc = parseFloat($('input[name=nabavnaCena]').val() || 0);
		var nc = nc + (nc * (pdv/100));
		$('input[name=prodajnaCena]').val(nc);
		$('input[name=hiddenPCI]').val(nc);
	});
	
	/* $('input[name=rabat]').change(function(e){
		e.preventDefault();
		var rabat = parseInt($(this).val() || 0);
		var nc = parseFloat($('input[nabavnaCena]').val() || 0);
		var novaC = nc - (nc * (rabat/100));
		$('input[name=nabavnaCena]').val(novaC);
		$('input[name=prodajnaCena]').val(novaC);		
	}) */

	$('input[name=marza]').blur(function(e){
		e.preventDefault();
		var marza = parseFloat($(this).val() || 0);
		var prodC = parseFloat($('input[name=prodajnaCena]').val());
		var prodC = prodC + (prodC * (marza/100));
		$('input[name=prodajnaCena]').val(prodC);
	});
});
</script>
</body> 
</html>