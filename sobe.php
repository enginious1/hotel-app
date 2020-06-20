<?php 
include 'dbconnect.php';

?>


<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<title>Sobe</title>
	<?php include 'navbar.php'; ?> <!-- DA BI RADIO TITLE -->
	<meta name="Enginious" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
	</head>
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
		tbody {
			color: #000;
		}
		thead {
			color: #fff;			
		}
		.table-sm {
			font-size: 14px;
		}	
		
	</style>


<body>
	
	<h2 class="display-3" style='display: none;'>Sobe</h2>

	
	<form class='usluge_search' style='display: none;'> 
		
		<input type='text' name='search_bar' class='form-control' style='width: 20%; display: inline;' placeholder='Pretraži'>
		<button class="btn btn-light" type='button' name='submit_search' id='search' style='margin-bottom: 3px; min-width: 100px;'><i class="fas fa-search"></i> Pretraži</button>		
		<button class="btn btn-light" type='button' name='Insert' id='insert' style='margin-bottom: 3px; min-width: 100px;' data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i> Insert</button>
		<div id='css_round' style='display: inline; margin-left: 40px;'>
			<a href='tipovi_sobe.php' class="btn btn-light btn-lg" style='margin-bottom: 3px; margin-left: auto; margin-right: auto;'><i class="fas fa-hotel"></i> Vrste soba</a>
		</div>
	</form>


	<div class="table-responsive">
		<table class="table table-bordered table-striped" id='tabela_zaposleni' style='display: none;'> 
			<thead class="bg-info">
				<tr>		
					<th scope="col">Broj sobe</th>
					<th scope="col">Naziv sobe</th>
					<th scope="col">Sprat sobe</th>
					<th scope="col">Kapacitet</th>
					<th scope="col">Broj slobodnih soba</th>
					<th scope="col">Cena</th>
					<th scope="col">Povrsina</th>	
					<th scope="col" style="width: 130px">Akcija</th>
				</tr>
			</thead>	
			<tbody id='tbody' class="bg-light"> 

<?php 

			$sql2 = "SELECT * FROM sobe";

			$results2 = $conn->query($sql2);

			$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id";

			$results = $conn->query($sobe_upit);

			while ($red = $results->fetch_assoc()) {

?>
				<tr id="redbr<?=$red['sobe_id'];?>">				
					<td style="vertical-align: middle;"><?=$red['broj_sobe']?></td>			
					<td style="vertical-align: middle;"><?=$red['naziv_sobe']?></td>
					<td style="vertical-align: middle;"><?=$red['sprat_sobe']?></td>
					<td style="vertical-align: middle;"><?=$red['broj_gostiju']?></td>
					<td style="vertical-align: middle;"><?=$red['broj_slobodnih']?></td>
					<td style="vertical-align: middle;"><?=$red['cena_sobe'] . "€"?></td>
					<td style="vertical-align: middle;"><?=$red['povrsina'] . "m²"?></td>
					<td style='vertical-align: middle; min-width: 180px;'>	
						<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width:45px; color: #fff' data-toggle="modal" data-target="#exampleModalCenter" 	
						data-0="<?=$red['sobe_id']?>"		
						data-a="<?=$red['broj_sobe'];?>"
						data-b="<?=$red['sprat_sobe'];?>"
						data-c="<?=$red['tipsobe_id']?>">
						<i class="fas fa-edit"></i>			
						</button>
						<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['sobe_id']?>" style="margin-right: 5px; width: 45px;"><i class="fas fa-trash"></i></button>
						<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['sobe_id']?>" data-naziv="<?=$red['naziv_sobe']?>"><i class="fas fa-id-card"></i></button>
					</td>	
				</tr>
		
<?php
			}

$sql = "SELECT * FROM sobatip";
$rez = $conn->query($sql);

?>

			</tbody>
		</table>
	</div>
	
<!-- MODAL ZA INSERT I EDIT -->

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
					<div align="center">
						<form class="form-horizontal" enctype='multipart/form-data' style="margin-top: -12px">					 
							<div class="col-md-8 text-center">
								<label>Tip sobe:</label>
								<select id='tip_sobe' class="form-control selectTIP"> 
									<option>Izaberi tip sobe...</option>
									<?php while ($red = $rez->fetch_array()) { ?>
									<option value="<?=$red['tipsobe_id']?>"><?=$red['naziv_sobe']?></option>
									<?php } ?>
								</select>					
							</div>
							<div class="col-md-8 text-center">
								<label>Broj sobe:</label>	
								<input type='text' name='kapacitet' class="form-control" placeholder='' id='broj_sobe'>
							</div>						
							<div class="col-md-8 text-center">
								<label>Sprat sobe:</label>
								<input type='text' name='broj_soba' class="form-control" placeholder='' id='sprat_sobe'>								
							</div>			
							<input type='hidden' name='akcija' id='akcija'>
							<input type='hidden' name='sobe_id' id='sobe_id'>		
						</form>
					</div>				
				</div>	
				<div class="modal-footer" style="margin-right: 3%; margin-left: 3%">
					<button type="button" class="btn btn-success" data-dismiss="modal" id='button_save' style="min-width: 100px;"><i class="fas fa-plus"></i> Sačuvaj</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-times"></i> Odustani</button>        
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODAL ZA PRIKAZ REZERVACIJA PO SOBI -->
	
	<div  class="modal fade bd-example-modal-lg" id="modalRez"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-right: 1.5%; margin-left: 1.5%">
				<h5 class="modal-title w-100 text-center" id="modalNaslov" style="margin-left: 8%" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-sm table-bordered table-striped table-hover text-center" style="margin-bottom: 0px;">
						<thead class="bg-info">
							<tr>
								<td style="vertical-align: middle;"><b>Gost</b></td>
								<td style="vertical-align: middle;"><b>Datum početka rezervacije</b></td>
								<td style="vertical-align: middle;"><b>Datum isteka rezervacije</b></td>
								<td style="vertical-align: middle;"><b>Vrsta rezervacije</b></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<?php include 'scripts.php'; ?>

<script>

$('document').ready(function(){
	
	$('body').on('click', '#insert', function(){
		$('#sobe_id').val('');
		$('#akcija').val('insert');
		$('#naslov_modala').html('<h5>Insert</h5>');
		$('#broj_sobe').val('');
		$('#sprat_sobe').val('');
		$('#tip_sobe').val('Izaberi tip sobe...');
		//
	});

	<!-- AJAX ZA INSERT -->
	
	$('body').on('click', '#button_save', function(){		
		var tip_sobe = $('#tip_sobe').val();
		var broj_sobe = $('#broj_sobe').val();
		var sprat_sobe = $('#sprat_sobe').val();
		var akcija = $('#akcija').val();
		var sobe_id = $('#sobe_id').val();
		
		$.ajax ({
			url: 'ajax/ajax_sobe.php',
			type: 'post',
			data: {					
				broj_sobe:broj_sobe,
				sprat_sobe:sprat_sobe,
				akcija:akcija,
				tip_sobe:tip_sobe,
				sobe_id:sobe_id,
			},
			success: function(data) {
				$('#tbody').html(data);				
			}
		});	
	});
	
	<!-- AJAX ZA DELETE -->
	
	$('body').on('click', '.delete', function(){		
		var sobe_id = $(this).data('id');
		var akcija = 'brisanje';		
		if (confirm('Da li sigurno zelite da obrisete ovu sobu?')) {
			$.ajax ({
				url: 'ajax/ajax_sobe.php',
				type: 'post',
				data: {
					sobe_id:sobe_id,
					akcija:akcija,				
				},
				success: function(data) {
					$('#tbody').html(data);
				}
			});
		}			
	});

	<!-- Lista rezervacija određene sobe -->
	
	$('body').on('click', '.proveraREZ', function(e){
		e.preventDefault();
		var akcija = 'proveraREZ';
		var soba_id = $(this).data('id');
		var naziv = $(this).data('naziv');		
		$('#modalNaslov').html(naziv);
		$.ajax({
			url: 'ajax/ajax_sobe.php',
			type: 'post',
			data: {
				soba_id:soba_id,
				naziv:naziv,
				akcija:akcija,
			}, success: function(data) {
				$('#tbody1').html(data);
			}
		})
	})
	

	
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
	
	<!-- Popunjavanje edit inputa -->	
	
	$('body').on('click', '.edit', function(){
		
		$('#akcija').val('edit');
		
		var sobe_id = $(this).data('0');
		var broj_sobe = $(this).data('a');
		var sprat_sobe = $(this).data('b');
		var tip_sobe = $(this).data('c');
	
		$('#sobe_id').val(sobe_id);
		$('#broj_sobe').val(broj_sobe);
		$('#sprat_sobe').val(sprat_sobe);
		$('.selectTIP').val(tip_sobe);
	});
	$('body').on('click', '#edit', function(){
		$('#naslov_modala').html('<h5>Edit</h5');
	});
	
	$('#tabela_zaposleni').fadeIn(1000);
	$('.display-3').fadeIn(1000);
	$('.usluge_search').fadeIn(1000);
	
	
	$('body').on('click', '#search', function(e){
		e.preventDefault();
		var search = $('input[name=search_bar]').val();
		var akcija = 'search';
		$.ajax ({
			url: 'ajax/ajax_sobe.php',
			type: 'post',
			data: {
				search:search,
				akcija,akcija,
			},
			success: function(data) {
				$('#tbody').html(data);
			}
		})
	})	
});
</script>




</body>
</html>