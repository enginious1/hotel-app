<?php
include 'dbconnect.php';
include 'scripts.php';

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Rezervacije</title>
  <?php include 'navbar.php'; ?> <!-- DA BI RADIO TITLE -->
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
		.card  {
			margin-left: auto;
			margin-right: auto;
			background-color: #ffffff;
			text-align: left;
			
			color: #000000;
			}
		.card-header {					
			text-align: left;
			font-size: 20px;			
			}
			
	</style>
</head>

<body>
	
	<div class="card" style="margin-bottom: 5%;margin-top: 5%; width: 60% !important; display: none;">
		<h4 class="card-header text-center bg-info" style="color: #fff;">
			Rezervacije
		</h4>
		<div class="card-body">	
			<form class="form-horizontal" style="margin-bottom: 5%"> 
				<div class="form-group row">		
					<div class="col-md-3">	
						<label class='label-control'>Datum od:</label>	
						<div class="input-group date" data-target-input="nearest">		
							<input type='text' name='odDatum' id='datetimepicker3' data-toggle="datetimepicker" data-target="#datetimepicker3" class='datetimepicker-input form-control'>  
							<div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
							</div>
						</div>				
					</div>
					<div class="col-md-3">	
						<label>Datum do:</label>		
						<div class="input-group date" data-target-input="nearest">		
							<input type='text' name='doDatum' id='datetimepicker4' data-toggle="datetimepicker" data-target="#datetimepicker4" class='datetimepicker-input form-control'>  
							<div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
							</div>
						</div>					
					</div>					
					<div class="col-md-3">
					<label>Ime gosta:</label>
						<select type='text' name='ime_gosta' class="form-control">
							<option value="">Izaberi gosta...</option>
							<?php $sql="SELECT * FROM guests";
							$res=$conn->query($sql);
							while ($row=$res->fetch_assoc()) { ?>
							<option value="<?=$row['guests_id']?>"><?=$row['ime']?> <?=$row['prezime']?></option>
							<?php }?>
						</select>
					</div>					
					<div class="col-md-3">
						<label>Broj sobe:</label>
						<select type='text' name='brsobe' class="form-control">
							<option value="">Izaberi broj sobe...</option>
							<?php $sql="SELECT * FROM sobe";
							$res=$conn->query($sql);
							while ($row=$res->fetch_assoc()) { ?>
							<option value="<?=$row['sobe_id']?>"><?=$row['broj_sobe']?></option>
							<?php }?>
						</select>			
					</div>	
				</div>
			</form>		
			<div class="form-inline">
				<div class='mx-auto'>			
					<button class="btn btn-info btn-lg" style="min-width: 150px" type='button' name='submit_search' id='pretrazi' value='Search' ><i class="fas fa-search"></i> Pretraži</button>					
					<button class="btn btn-outline-info btn-lg" style="min-width: 150px" type='button' name='Insert' value='Insert' id='insert' data-toggle="modal" data-target="#insert_modal"><i class="fas fa-plus"></i> Insert</button>				
				</div>
			</div>		
		</div>	
		<div class="modal fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
						<h4 id='naslov_modala' class="modal-title w-100 text-center" style="margin-left: 8%">
							<div class="modal-title w-100 text-center" id="exampleModalLongTitle" style="font-size: 22px;"></div>
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id='modal_forma'  enctype='multipart/form-data'>
							<div align="center">				
							<div class="col-md-8 text-center">
								<label>Ime gosta</label>
								<select type='text' name='ime' placeholder='' class='form-control' id='ime'>								
									<?php
									$sql= "SELECT * FROM guests";
									$res = $conn->query($sql);
									while($row=$res->fetch_assoc()) { ?>
									<option>Izaberi ime...</option>
									<option value="<?=$row['guests_id']?>"><?=$row['ime']?> <?=$row['prezime']?></option>
									<?php }?>
								</select>
							</div>				
							<div class="col-md-8 text-center">
								<label>Status</label>
									<select type='text' name='statusSobe' placeholder='' class='form-control' id='statusSobe'>
									<option>Izaberi status sobe...</option>
									<?php $sql="SELECT * FROM sobestatus";
									$res=$conn->query($sql);
									while ($row=$res->fetch_assoc()) { ?>
									<option value="<?=$row['sst_status_id']?>"><?=$row['status']?></option>
									<?php }?>
								</select>
							</div>
							<div class="col-md-8 text-center">
								<label>Broj sobe</label>
								<select type='text' name='brojSobe' placeholder='' class='form-control' id='brojSobe'>
									<option>Izaberi broj sobe...</option>
									<?php $sql="SELECT * FROM sobe";
									$res=$conn->query($sql);
									while ($row=$res->fetch_assoc()) { ?>
									<option value="<?=$row['sobe_id']?>"><?=$row['broj_sobe']?></option>
									<?php }?>
								</select>
								</div>
							<div class="col-md-8 text-center">
								<label>Od:</label>	
								<div class="form-group">
									<div class="input-group date" data-target-input="nearest">				
										<input type='text' name='odDatum' id='datetimepicker1' data-toggle="datetimepicker" data-target="#datetimepicker1" class='datetimepicker-input form-control datum'>
										<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-8 text-center">
								<label>Do:</label>
								<div class="form-group">
									<div class="input-group date" data-target-input="nearest">	
										<input type='text' name='doDatum' id='datetimepicker2' data-toggle="datetimepicker" data-target="#datetimepicker2" class='datetimepicker-input form-control'>  
										<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
										</div>
									</div>						
								</div>
							</div>				
							<div align="center">	
								<div class="col-md-8 text-center" style="margin-bottom: 20px">	
									<label class="label-control">Cena:</label>
									<div class="form-group">
										<div class="input-group date">
											<input type='text' name='cena' placeholder='' class='form-control' id='cena'>							
										<div class="input-group-append">
											<div class="input-group-text">€</div>
										</div>
										</div>
									</div>
								</div>						
							</div>
							<input type='hidden' name='akcija' id='akcija'>
							<input type='hidden' name='rezervacije_id' id='rezervacije_id'>
							</div>				
						</form>      
						<div class="modal-footer">
							<button type="button" class="btn btn-success" style= "min-width: 100px !important;" id='modal_insert' data-dismiss="modal"><i class="fas fa-check"></i> Sačuvaj</button>
							<button type="button" class="btn btn-danger" style= "min-width: 100px !important;" data-dismiss="modal"><i class="fas fa-times"></i> Odustani</button>     
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card" style="width: 70% !important; margin-bottom: 3%; display: none;">
		<h5 class="card-header text-center bg-info" style="color: #fff;">Lista</h5>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id='tabela_rezervacije' style="margin-bottom: 0px;">
					<thead>
						<tr class="table-primary">
							<th scope="col">Ime gosta</th>
							<th scope="col">Broj sobe</th>
							<th scope="col">Status: </th>
							<th scope="col">Cena:</th>
							<th scope="col">Od:</th>
							<th scope="col">Do:</th>				
							<th scope="col" style="width: 130px;">Akcija</th>		
						</tr>
					</thead>	
					<tbody id='tbody' class="table-hover"> 
					<?php $prikaz = "SELECT sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM `rezervacije` LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id;";
	
						$results = $conn->query($prikaz);
						while ($row = $results->fetch_assoc()){
?>
						<tr class="table-success">
							<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime'];?></td>
							<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>
							<td style="vertical-align: middle;"><?=$row['status'];?></td>
							<td style="vertical-align: middle;"><?=$row['cena'] . "€";?></td>
							<td style="min-width: 100px; vertical-align: middle;"><?=$row['datum_od'];?></td>			
							<td style="vertical-align: middle;"><?=$row['datum_do'];?></td>		
							<td style='min-width: 130px; vertical-align: middle;'><button type="button" data-toggle="modal" data-target="#insert_modal" class="btn btn-warning edit" style="color: #fff; margin-right: 10px"
								data-id="<?=$row['rezervacije_id']?>";
								data-ime="<?=$row['gost_id']?>";
								data-status="<?=$row['rez_status_id']?>";
								data-brojsobe="<?=$row['sobe_id']?>"
								data-datumOd="<?=$row['datum_od']?>"
								data-datumDo="<?=$row['datum_do']?>"
								data-cena="<?=$row['cena']?>"><i class="fas fa-edit"
								></i></button>
							<button type="button" class="btn btn-danger delete" data-id=<?=$row['rezervacije_id']?>><i class="fas fa-trash"></button></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
	
$('document').ready(function(){	

	$('.card').fadeIn(1500);


	/* $('#datetimepicker1').on('dp.change', function(){
		$(this).datetimepicker({format: 'DD-MM-YYYY'});
		});	*/

	$('body').on('click', '#insert', function(e){
		e.preventDefault();
		$('input[name=akcija]').val('insertRez');
		$('#naslov_modala').html('<h5>INSERT REZERVACIJE</h5>');
		$('select[name=ime]').val('Izaberi ime...');
		$('select[name=statusSobe]').val('Izaberi status sobe...');
		$('select[name=brojSobe]').val('Izaberi broj sobe...');
		$('input[name=odDatum]').val('');
		$('input[name=doDatum]').val('');
		$('input[name=cena]').val('');
		
	});
	/* $('#datetimepicker1').datetimepicker({format: 'DD.MM.YYYY'}); */
	
	/* AJAX ZA INSERT REZERVACIJE */
			
	$('body').on('click', '#modal_insert', function(e){
		
		e.preventDefault();		
		akcija = $('input[name=akcija]').val();
		var ime = $('select[name=ime]').val();
		var brojSobe = $('select[name=brojSobe]').val();
		var status = $('select[name=statusSobe]').val();
		var datumOd = $('#datetimepicker1').val();
		var datumDo = $('#datetimepicker2').val();			
		var cena = $('input[name=cena]').val();
		var rezId = $('input[name=rezervacije_id]').val();		
		$.ajax ({
			url: 'ajax/ajax_rezervacije.php',
			type: 'post',
			data: {
				akcija:akcija,
				brojSobe:brojSobe,
				ime:ime,
				status:status,
				datumOd:datumOd,
				datumDo:datumDo,
				cena:cena,	
				rezId:rezId,				
			},
			success: function(data) {
				$('#tbody').html(data);
				
			}
		})			
	});	
	
	/* popunjavanje inputa za edit */
	
	$('body').on('click', '.edit', function(){
		$('#naslov_modala').html('<h5>EDIT REZERVACIJE</h5>');
		var akcija = 'editRez';
		var rezId = $(this).data('id');
		var ime = $(this).data('ime');
		var status = $(this).data('status');
		var brojSobe = $(this).data('brojsobe');
		var datumOd = $(this).data('datumod');
		var datumDo = $(this).data('datumdo');
		var cena = $(this).data('cena');
		
		$('input[name=rezervacije_id]').val(rezId);
		$('select[name=ime]').val(ime);
		$('select[name=statusSobe]').val(status);
		$('select[name=brojSobe]').val(brojSobe);
		$('#datetimepicker1').val(datumOd);
		$('#datetimepicker2').val(datumDo);
		$('input[name=cena]').val(cena);
		$('input[name=akcija]').val(akcija);		
	});	
	
	/* AJAX ZA DELETE */
	
	$('body').on('click', '.delete', function(e){
	var id = $(this).data('id');
	var akcija = 'brisanjeREZ';
	
	if (confirm('Da li zelite da obrisete ovu rezervaciju?')) {
		$.ajax ({
		url: 'ajax/ajax_rezervacije.php',
		type: 'post',
		data: {
			id:id,
			akcija:akcija,
		},
			success: function(data) {
			$('#tbody').html(data);
				}
			})
		}
	}); 
	
	/* AJAX ZA SEARCH */
	
	$('body').on('click', '#pretrazi', function(e){
		e.preventDefault();
		var akcija = 'pretragaRez';
		var datumOd = $('#datetimepicker3').val();
		var datumDo = $('#datetimepicker4').val();
		var imeGosta = $('select[name=ime_gosta]').val();
		var brSobe = $('select[name=brsobe]').val();
		
		$.ajax ({
			url: 'ajax/ajax_rezervacije.php',
			type: 'post',
			data: {
				imeGosta:imeGosta,
				brSobe:brSobe,
				datumOd:datumOd,
				datumDo:datumDo,
				akcija:akcija,
			},
			success: function(data) {
				$('#tbody').html(data);				
			}
		})		
	});	
});
	
</script>
 </body>
 </html>