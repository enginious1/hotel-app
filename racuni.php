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
  <title>Računi</title>  
  <?php include 'navbar.php'; ?>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css">	
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
			
		.card { 	
			margin-top: 5%;
			margin-left: auto;
			margin-right: auto;
			vertical-align: middle;
			text-align: left;
			width: 60%;		
		}
		
		.card .card-header {	

			text-align: left;
			font-size: 18px;
			color: #fff;
			}
			
		.table {			
			margin-left: auto;
			margin-right: auto;	
			text-align: center;
			vertical-align: middle:
		}
		
		.modal-content {
			border-color: #ffffff !important;
			background-image: url("blue-gradient-background.png");
			background: #0264d6;
			background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); 
			background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); 
			background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); 
			background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); 
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1);				
			}
		.modal {
			overflow: scroll;
		}
	</style>	
</head>
<body>	
	<div class="card border border-white" style="width: 50%; display:none;">
		<h4 class="card-header text-center bg-info">
			Računi
		</h4>
		<div class="card-body">
			<div class="form-group row">
				<div class="col-md-4">
					<label>Od:</label>
					<div class="input-group date" data-target-input="nearest">		
						<input type='text' name='datumOd' id='datetimepicker1' data-toggle="datetimepicker" data-target="#datetimepicker1" class='datetimepicker-input form-control'>  
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
						<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
						</div>
					</div>	
				</div>
				<div class="col-md-4">
					<label>Do:</label>
					<div class="input-group date" data-target-input="nearest">		
						<input type='text' name='datumDo' id='datetimepicker2' data-toggle="datetimepicker" data-target="#datetimepicker2" class='datetimepicker-input form-control'>  
						<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
						<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
						</div>
					</div>	
				</div>	
				<div class="col-sm-8 col-md-4">
					<label>Gost:</label>
					<select name="gosti" class="form-control">
						<option value="">Izaberi gosta...</option>
						<?php $sql= "SELECT * FROM guests";
						$results = $conn->query($sql);
						while ($row = $results->fetch_assoc()) { ?>
						<option value=<?= $row['guests_id']?>><?=$row['ime'] . " " . $row['prezime']?></option>
						<?php
						}?>
					</select>
				</div>		
			</div>	
			<div class="form-inline">
				<div class="mx-auto">
					<button class="btn btn-info btn-lg pretrazi" id="pretrazi" style="min-width: 90px; margin-right: 5px"><i class="fas fa-search"></i> Pretraži</button>
					<button class="btn btn-outline-info btn-lg insertRacun" style="min-width: 120px;" data-toggle="modal" data-target="#racunModal"><i class="fas fa-plus"></i> Unesi</button>
				</div>
			</div>					
		</div>
	</div>	
	<div class="card border-white" style="width: 55%; display: none">
		<h5 class="card-header text-center bg-info">
			<span style="margin-left: 140px; !important;">Lista</span> 
			<span style='float: right;'>
				<a href='generate2.php' class="btn btn-outline-light" style="border-radius: 10px;" type='button'><i class="far fa-file-pdf"></i> PDF format</a></span>	
		</h5>
	
		<div class="card-body"> 
			<div class="table-responsive">
				<table class="table table-stripped" style="margin-bottom: 0;">
					<thead class="table-info bordered">
						<th scope="col">Račun</th>
						<th scope="col">Ukupan račun</th>
						<th scope="col">Gost</th>
						<th scope="col">Datum prijema</th>
						<th style="width: 130px; text-center;">Akcija</th>
					</thead>
					<tbody id="tabelaRMAIN" class="table-hover">
					<?php $sql = "SELECT guests.guests_id, guests.ime, guests.prezime, racunimain.racun_id, racunimain.broj_racuna, racunimain.broj_godine, racunimain.gost_id, racunimain.datum_izdavanja, SUM(racunidetailed.ukupan_racun) AS ukupanRacun FROM racunimain LEFT JOIN guests ON racunimain.gost_id = guests.guests_id LEFT JOIN racunidetailed ON racunimain.racun_id = racunidetailed.d_racun_id WHERE racun_id > 0 GROUP BY racunimain.racun_id ORDER BY broj_racuna ASC, broj_godine ASC";
					$results = $conn->query($sql);
					while ($row = $results->fetch_assoc()) {?>
						<tr <?=$row['racun_id']?> class="table-success">						
							<td style="vertical-align: middle;"><?=$row['broj_racuna'] . "/" . $row['broj_godine']?></td>
							<td style="vertical-align: middle;"><?php if (!$row['ukupanRacun']) { echo "0€";} else {echo number_format ($row['ukupanRacun'], 2) . "€";}?></td>
							<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime']?></td>
							<td style="vertical-align: middle;"><?=date("d.m.Y H:i:s", strtotime($row['datum_izdavanja']));?></td>
							<td style="min-width: 130px;"><button class="btn btn-warning racunEdit" style="color: #fff;"data-toggle="modal" data-target="#racunModal" data-idrm= <?=$row['racun_id']?>
							data-gost = <?=$row['gost_id']?>
							data-broj = <?=$row['broj_racuna'] . "/" . $row['broj_godine']?> 
							data-datum = "<?=date('d.m.Y H:i:s', strtotime($row['datum_izdavanja']));?>"><i class="fas fa-edit"></i></button><button class="btn btn-danger deleteRM" data-rmain=<?=$row['racun_id']?> style="margin-left: 10px;"><i class="fas fa-trash"></i>
							</td>	
						</tr>
					<?php } ?>				
					</tbody>
				</table>
			</div>
		</div>
	</div>	
	<!-- MODAL ZA UNOS RACUNA -->
	
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg racunModal" id="racunModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content" style="width: 90%; margin-left:auto; margin-right:auto;">	 <div class="modal-header" style="margin-right: 2%; margin-left: 2%;">
			<div class="modal-title w-100 text-center" style="font-size: 24px; color: #fff"> Račun</div>
					</div>
				<div class="modal-body">
					<div class="card" style="width: 100%; margin-left: auto; margin-right: auto; margin-top: auto; margin-bottom: auto;">
						<div class="card-header text-center bg-info" id='card_naslov'>
							<h5></h5>
						</div>
						<div class="card-body">    
							<form action="" class="form-horizontal">
								<div class="form-group row">
									<div class="col-md-4">
										<label>Broj računa:</label>
										<input type="text" class="form-control" name="brRacuna" disabled>
									</div>
									<div class="col-md-4">
										<label>Datum:</label>
										<div class="input-group date" data-target-input="nearest">		
											<input type='text' name='datumRacuna1' id='datetimepicker3' data-toggle="datetimepicker" data-target="#datetimepicker3" class='datetimepicker-input form-control'>  
											<div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
											</div>
										</div>	
									</div>	
									<div class="col-md-4">
										<label>Gost:</label>
										<select name="gosti_1" class="form-control">
											<option value="">Izaberi gosta...</option>
											<?php $sql="SELECT * FROM guests";
											$results = $conn->query($sql);
											while ($row = $results->fetch_assoc()) { ?>
											<option value = <?=$row['guests_id']?>><?=$row['ime'] . " " . $row['prezime']?></option>									
											<?php } ?>									
										</select>									
									</div>									
									<div class="col-md-4" style="margin-top: 4%; min-width: 100px">
										<button class="btn btn-success racunMainUnos" style="min-width: 100px;"><i class="fas fa-check"></i> Unesi</button>
										<button class="btn btn-danger closeModal" style= "min-width: 100px"data-dismiss="modal"><i class="fas fa-times"></i> Odustani</button>
									</div>		
									<span class="col-md-6 sm-12 rm-success" style="margin-top: 4%">
									</span>
								</div>
								<input type="hidden" name="racunMainId">
								<input type="hidden" name="radio_id">
								<input type="hidden" name="akcijaM">
							</form>
						</div>
					</div>					
					<div class="card hiddenRD" style="width: 100%; margin-bottom: auto; margin-top: 2%; ">
						<div class="card-header text-center bg-info" id='dCard_naslov'>
							<h5></h5>
						</div>
						<div class="card-body">
							<form class="form-horizontal">
								<div class="form-group row">
									<div class="col-md-6 radioButtons">
										<label class="btn btn-info" class="btn btn-info" style="margin-right: 5%"><i class="fas fa-address-book"></i>  Rezervacije<input type="radio" class="radioButton" name="zaRacun" value="1" id="rRacun" style="visibility: hidden; min-width: 23px;">
										</label>
										<label class="btn btn-info" style="margin-right: 5%"><i class="fas fa-address-book"></i>  Suveniri<input type="radio" name="zaRacun" value="2" class="radioButton" id="suveniri" style="visibility: hidden; min-width: 25px;">										
										</label>
										<label class="btn btn-info"><i class="fab fa-servicestack"></i>  Usluga <input type="radio" name="zaRacun" class="radioButton" value="3" style="visibility: hidden; min-width: 25px;">
										</label>
									</div>
									<div class="col-md-6">
										<select name="sve" class="form-control select">
											<option value="">Izaberi...</option>
										</select>									
									</div>
								</div>	
								<div class="form-group row">
									<div class="col-md-3">
										<label>Cena:</label>
										<div class="input-group mb-4">					
											<input type="text" class="form-control" id='cena' name='cena'>
											<div class="input-group-append">
												<span class="input-group-text">&euro;</span>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<label>Datum:</label>
										<div class="input-group date" data-target-input="nearest">		
											<input type='text' name='datumRacuna' id='datetimepicker4' data-toggle="datetimepicker" data-target="#datetimepicker4" class='datetimepicker-input form-control datatimepicker4'>  
											<div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
											</div>
										</div>	
									</div>
									<div class="col-md-3">
										<label>Količina:</label>
										<div class="input-group mb-4">	
											<div class="input-group-prepend">
												<span class="input-group-text">Količina:</span>
											</div>
											<input type="text" class="form-control" id='kolicina' name='kolicina'>										
										</div>									
									</div>					
									<div class="col-md-3">
										<label>Ukupno:</label>
										<div class="input-group mb-3">						
											<input type="text" class="form-control" id='ukupno' name='ukupno'>
											<div class="input-group-append">
												<span class="input-group-text">&euro;</span>
											</div>
										</div>									
									</div>							
									</div>
									<div class="form-group row">
									<div class="col-md-5">
									<button class="btn btn-success unosRD" style="min-width: 100px;"><i class="fas fa-check"></i> Unesi</button>
									<button class="btn btn-danger closeModal" data-dismiss="modal"><i class="fas fa-times"></i> Odustani</button>										
									</div>
								<div class="col-md-5 rd-success">
								</div>
								</div>								
								<input type="hidden" name="idRD">
								<input type="hidden" name="akcija" value="unosDetailed">
								<input type="hidden" name="staraKol">
								<input type="hidden" name="skrivenaKol">
							</form>
						</div>
					</div>
					<div class="card hiddenLISTA" style="width: 100%; margin-bottom: auto; margin-top: 2%; ">
						<h4 class="card-header text-center bg-info">Lista računa
						</h4>
						
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-sm">
									<thead>
										<tr class="table-primary">
											<th scope="col">Datum</th>
											<th scope="col">Količina</th>								
											<th scope="col">Usluga</th>
											<th scope="col">Naziv</th> 
											<th scope="col">Cena/dan/komad</th>
											<th scope="col">Ukupno</th>
											<th scope="col" style="width: 100px;">Akcija</th>
										</tr>
									</thead>
									<tbody id="tbodyDetailed" class="table-bordered table-hover">
									</tbody>
								</table>
							</div>
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
<script type="text/javascript">
$('document').ready(function(){
	   $(function () {
			$('#datetimepicker1').datetimepicker({format:'DD.MM.YYYY HH:mm:ss'});
		});
		$(function () {
			$('#datetimepicker2').datetimepicker({format:'DD.MM.YYYY HH:mm:ss'});
		});
		$(function () {
			$('#datetimepicker3').datetimepicker({format:'DD.MM.YYYY HH:mm:ss'});
		});
		$(function () {
			$('#datetimepicker4').datetimepicker({format:'DD.MM.YYYY HH:mm:ss'});
		});
	
		
		$('.card').fadeIn(1000);
		
		$('body').on('click', '.insertRacun', function(){
			$('input[name=akcijaM]').val('racunMainUnos');
			$('#card_naslov').html('<h5>Račun Main Insert</h5>');
			$('#dCard_naslov').html('<h5>Račun Detailed Insert</h5>');
			
			$('.hiddenRD').hide();
			$('.hiddenLISTA').hide(); 
		});
			/*
			$('input[name=brRacuna]').val('');`
			$('select[name=gosti_1]').val('');
			$('input[name=racunMainId]').val('');
			$('input[radio_id]').val('');
			$('select[name=sve]').html('<option>Izaberi...</option>');
			$('input[name=cena]').val('');
			$('input[name=datumRacuna]').val('');
			$('input[name=kolicina]').val('');
			$('input[name=ukupno]').val('');
		}) */
	  $('#racunModal').on('hidden.bs.modal', function(){
        $(this).find('input:text, input[type=hidden], select').each(function(){
			$(this).val("");
			$('#tbodyDetailed').html('');
        });
    });  

	/* UNOS RAČUNA MAIN */
	
	$('body').on('click', '.racunMainUnos', function(e){
		e.preventDefault();
		var brRacuna = $('input[name=brRacuna]').val();
		var datumRacuna = $('input[name=datumRacuna1]').val();
		var akcija = $('input[name=akcijaM]').val();
		var gost = $('select[name=gosti_1]').val();
		var idRM = $('input[name=racunMainId]').val();
		$('input[name=radio_id]').val(gost);
		if (datumRacuna!="" && gost!="") {
			$.ajax ({
				url: 'ajax/ajax_racuni.php',
				type: 'post',
				data: {
					idRM:idRM,
					brRacuna:brRacuna,
					datumRacuna:datumRacuna,
					akcija:akcija,
					gost:gost,
				},
				success: function(data) {
					$('input[name=racunMainId]').val(data);
					$('.hiddenRD').fadeIn(2000);
					$('.hiddenLISTA').fadeIn(3000);
					$('#pretrazi').trigger('click');
					$('.rm-success').html("<p class='alert alert-success' role='alert' style=margin-top: 5%;>	Uspešno je unet račun main!</p>").fadeIn('slow');
					setTimeout(function(){
					$('.rm-success').fadeOut('slow');
					}, 2500);
				}
			})
		}
	});
	/* POPUNJAVANJE INPUTA ZA EDIT RAČUNA MAIN */
	
	$('body').on('click', '.racunEdit', function(e){
		e.preventDefault();
		$('.hiddenRD').show();
		$('.hiddenLISTA').show(); 		
		$('#card_naslov').html('<h5>Račun Main Edit</h5>');
		$('#dCard_naslov').html('<h5>Račun Detailed Edit</h5>');
		var brRacuna = $(this).data('broj');
		var gost = $(this).data('gost');
		var datumRacuna = $(this).data('datum');
		var idRM = $(this).data('idrm');
		var akcija = $('input[name=akcijaM]').val('editRacunMain');				
	})
	
	/* ON BLUR DATUM RAČUNA */
	$('input[name=datumRacuna1]').blur(function(e){
		e.preventDefault();
		
		var godina = $(this).val();
		var akcija = 'blurDatum';
		$.ajax({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				godina:godina,
				akcija:akcija,
			},
			success: function(data) {
				$('input[name=brRacuna').val(data);
			}
		})
	})
	/* RADIO DUGMAD */
	$('body').on('click', '.radioButtons', function(){
	var vrsta = $('input[name=zaRacun]:checked').val();
	var akcija = "lista";
	var gost = $('input[name=radio_id]').val();
		$.ajax ({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				vrsta:vrsta,
				akcija:akcija,
				gost:gost,
			},
			success: function(data) {
				$('select[name=sve]').html(data);				
			}
		})
	})
	
	$('select[name=sve]').change(function(e){
		e.preventDefault();
		var cena = $(this).find(':selected').data('cena');
		var dani = $(this).find(':selected').data('dani');
		console.log(dani);
		$('input[name=cena]').val(cena);
		$('input[name=kolicina]').val(dani);
	});
	
	$('input[name=kolicina]').blur(function(){
		var cena = $('input[name=cena]').val();
		var kolicina = $('input[name=kolicina]').val();
		var ukupno = cena * kolicina;
		$('input[name=ukupno]').val(ukupno);
	})
	$('input[name=cena]').blur(function(){
		var cena = $('input[name=cena]').val();
		var kolicina = $('input[name=kolicina]').val();
		var ukupno = cena * kolicina;
		$('input[name=ukupno]').val(ukupno);
	})
	
	/* UNOS RAČUNA DETAILED */
	
	$('body').on('click', '.unosRD', function(e){
		e.preventDefault();
		var vrsta = $('input[name=zaRacun]:checked').val();
		var stavkaID = $('select[name=sve]').val();
		var cena = $('input[name=cena]').val();
		var ukupno = $('input[name=ukupno]').val();
		var datum = $('.datatimepicker4').val();
		var racunMainID = $('input[name=racunMainId]').val();
		var kolicina = $('input[name=kolicina]').val();
		var racunDetID = $('input[name=idRD]').val();
		var akcija = 'unosDetailed';
		var dkol = $('input[name=skrivenaKol]').val();
		var staraKol = $('input[name=staraKol]').val();
		if (!vrsta == 0 && !kolicina == 0) {
		$.ajax ({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {				
					vrsta:vrsta,
					stavkaID:stavkaID,
					cena:cena,
					ukupno:ukupno,
					datum:datum,
					racunMainID:racunMainID,
					kolicina:kolicina,
					racunDetID:racunDetID,
					staraKol:staraKol,
					dkol:dkol,
					akcija:akcija,
			},
			success: function(data) {
				$('#tbodyDetailed').html(data);
				$('input[name=idRD]').val('');
				$('.rd-success').html("<p class='alert alert-success' role='alert'>	Uspešno je unet račun detailed!</p>").fadeIn('slow');
				setTimeout(function(){
				$('.rd-success').fadeOut('slow');
				}, 2500);
			}
		})
		}
	})	
	/* EDIT RAČUNA DETAILED */

	
	/* AJAX ZA PRETRAGU RAČUNA */
	$('body').on('click', '#pretrazi', function(e){
		e.preventDefault();
		var datumOd = $('input[name=datumOd]').val();
		var datumDo = $('input[name=datumDo]').val();
		var gost = $('select[name=gosti]').val();
		var akcija = "pretragaRacuna";
		$.ajax ({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				datumOd:datumOd,
				datumDo:datumDo,
				gost:gost,
				akcija:akcija,
			},
			success: function(data) {
				$('#tabelaRMAIN').html(data);
			}
		})
	})	
	/* AJAX ZA DELETE */
	$('body').on('click', '.deleteRM', function(e){

		e.preventDefault();
		var racun_id = $(this).data('rmain');
		console.log(racun_id);
		var akcija = 'deleteRM';
		if (confirm('Da li stvarno želite da obrišete ovaj račun?')) {
			$.ajax ({
				url: 'ajax/ajax_racuni.php',
				type: 'post',
				data: {
					racun_id:racun_id,
					akcija:akcija,
					},
					success: function(data) {						
						if (data == 'obrisana') {
						$('#pretrazi').trigger('click');
						}
					}				
				})
			} 
		})
	
	/* POPUNJAVANJE TABELE RACUNA DETAILED */
	
	$('body').on('click', '.racunEdit', function (e){
		e.preventDefault();
		
		var idRM = $(this).data('idrm');
		var gost = $(this).data('gost');
		var datum = $(this).data('datum');
		var broj = $(this).data('broj');
		var vrsta = $('input[name=zaRacun]:checked').val();
		var akcija = 'tabelaPop';
		
		$('input[name=brRacuna]').val(broj);
		$('input[name=datumRacuna1]').val(datum);
		$('select[name=gosti_1]').val(gost);
		$('input[name=racunMainId]').val(idRM);
		$('input[name=radio_id]').val(gost);
		$.ajax({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				idRM:idRM,
				gost:gost,
				datum:datum,
				broj:broj,
				vrsta:vrsta,
				akcija:akcija, 
			},
			success: function(data) {
				$('#tbodyDetailed').html(data);
			}
		});
	});
	
	/* POPUNJAVANJE DETAILED INPUT EDITA RACUNA MAIN */
	
	$('body').on('click', '.EditDetPrikaz', function(e){
		e.preventDefault();
		
		var vrsta = $(this).data('vrsta');
		var cena = $(this).data('cena');
		var ukupno = $(this).data('ukupno');
		var kolicina = $(this).data('kolicina');
		var datum = $(this).data('datum');
		var stavka = $(this).data('stavka');
		var idRD = $(this).data('id');
		var dkol = $(this).data('dkol');
		var gostID = $('input[name=radio_id]').val();
		var akcija = 'popunjavanjeSelecta';		
		
		$('input[name=skrivenaKol]').val(dkol);
		$('input[name=staraKol]').val(kolicina);
		$('input[name=cena]').val(cena);
		$('input[name=kolicina]').val(kolicina);
		$('input[name=datumRacuna]').val(datum);
		$('input[name=ukupno]').val(ukupno);
		$('input[name=zaRacun][value="' + vrsta + '"]').attr('checked', 'checked');
		$('input[name=idRD]').val(idRD);		
		$.ajax ({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				vrsta:vrsta,
				gostID:gostID,
				akcija:akcija
			},
			success: function(data) {
				$('select[name=sve]').html(data);
				$('select[name=sve]').val(stavka);
			}
		})
	});	
	
	/* AJAX ZA BRISANJE RAČUNA DETAILED */
	$('body').on('click', '.rdDelete', function(e){
		e.preventDefault();
		var kolicina = $(this).data('kol');
		var id = $(this).data('id');
		var mid = $(this).data('mid');
		var akcija = 'brisanjeRD';
		if (confirm('Da li želite da obrišete ovaj račun detailed?')) {
			$.ajax ({
			url: 'ajax/ajax_racuni.php',
			type: 'post',
			data: {
				kolicina:kolicina,
				mid:mid,
				id:id,
				akcija:akcija
			}, 
			success: function(data) {
				$('#tbodyDetailed').html(data);
			}
		})
		}
	})	
});


</script>
</body>
</html>