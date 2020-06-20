<?php 
include 'scripts.php';
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
  <title>Tip sobe</title>
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


	</style>
</head>

<body>
	<h2 class="display-3" style='display: none;'>Tipovi sobe</h2>
	<form class='usluge_search' style='display:none;'> 	
		<p style='color: white; margin-bottom: 60px'><b>Unesi novi tip:</b></p>	
		<button style='min-width: 70px; color: #fff;' type='button' class="btn btn-success btn-lg" name='Insert' value='Insert' id='insert' data-toggle="modal" data-target="#insert_modal"><i class="fas fa-folder-plus"></i>
		</button>
	</form>
	<div class="table-responsive">
		<table class="table table-bordered table-striped" id='tabela_zaposleni' style='display:none;'>
			<thead class="bg-info">
				<tr>
					<th style="max-width: 60px">Redni broj</th>
					<th style="vertical-align: middle;">Naziv sobe</th>
					<th style="vertical-align: middle;">Kapacitet</th>
					<th style="vertical-align: middle;">Broj soba</th>
					<th style="vertical-align: middle;">Cena sobe</th>
					<th style="vertical-align: middle;">Broj dostupnih soba</th>
					<th style="vertical-align: middle;">Povrsina</th>				
					<th style="width: 130px; vertical-align: middle;">Akcija</th>		
				</tr>
			</thead>	
			 <tbody id='tbody' class="bg-light"> 	 
<?php

$prikaz = "SELECT * FROM sobatip";

$results = $conn->query($prikaz);
$i = 1;
while ($red = $results->fetch_assoc()) {

?>
		
				<tr>			
					<td style='vertical-align: middle;'><?=$i++?></td>
					<td style='vertical-align: middle;'><?=$red['naziv_sobe']?></td>
					<td style='vertical-align: middle;'><?=$red['broj_gostiju']?></td>
					<td style='vertical-align: middle;'><?=$red['broj_soba']?></td>
					<td style='vertical-align: middle;'><?=$red['cena_sobe'] . "€"?></td>
					<td style='vertical-align: middle;'><?=$red['broj_slobodnih']?></td>
					<td style='vertical-align: middle;'><?=$red['povrsina'] . "m²"?></td>		
					<td style='vertical-align: middle; min-width: 130px;'> 
					
					<button class="btn btn-warning edit" type='button' name='edit' style='max-width:100px; margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['tipsobe_id']?>"
					data-a="<?=$red['naziv_sobe']?>"
					data-b="<?=$red['broj_gostiju']?>"
					data-c="<?=$red['broj_soba']?>"
					data-d="<?=$red['cena_sobe']?>"
					data-e="<?=$red['broj_slobodnih']?>"
					data-f="<?=$red['povrsina']?>">
					<i class="fas fa-edit"></i>	
					</button>	
					<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['tipsobe_id']?>"><i class="fas fa-trash"></i></button>	
					</td>	
				</tr>		

<?php
}

$rez = $conn->query("SELECT * FROM sobatip");

?>
			</tbody>
		</table>
	</div>
<!-- MODAL ZA INSERT -->

	<div class="modal fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
					<div id='naslov_modala' class="modal-title w-100 text-center" style="margin-left: 8%">
						<h5 class="modal-title w-100 text-center"></h5>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div align="center">
						<form class='form-horizontal' enctype='multipart/form-data'>
							<div class="col-md-8">
								<label>Naziv sobe:</label>			
								<input type='text' name='naziv_sobe' class= "form-control" placeholder='' id='naziv_sobe'>
							</div>							
							<!-- 
							<select id='tip_sobe'> 
							<?php while ($red = $rez->fetch_array()) { ?>
							<option value="<?=$red['tipsobe_id']?>"><?=$red['naziv_sobe']?></option>
							<?php } ?>
							</select>
							</label> -->			
							<div class="col-md-8">
								<label>Kapacitet:</label>
								<input type='text' name='kapacitet' placeholder='' class= "form-control" id='kapacitet'>
							</div>		
							<div class="col-md-8">
								<label>Broj soba:</label>
								<input type='text' name='broj_soba' placeholder='' class= "form-control" id='broj_soba'>
							</div>		
							<div class="col-md-8">
								<label>Cena sobe:</label>
								<input type='text' name='cena_sobe' placeholder='' class= "form-control" id='cena_sobe'>
							</div>		
							<div class="col-md-8">
								<label>Broj dostupnih soba:</label>
								<input type='text' name='dostupne_sobe' placeholder='' class= "form-control" id='dostupne_sobe'>
							</div>
							<div class="col-md-8">
								<label>Povrsina:</label> 
								<input type='text' name='povrsina' placeholder='' class= "form-control" id='povrsina'>		
							</div>
							<input type='hidden' name='akcija' id='akcija'>
							<input type='hidden' name='sobe_id' id='sobe_id'>			
						</form>
					</div>
				</div>
				<div class="modal-footer" style="margin-right: 3%; margin-left: 3%">
					<button type="button" class="btn btn-success" data-dismiss="modal" style='min-width: 70px;' id='button_save'><i class="fas fa-check"></i></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style='min-width: 70px;'><i class="fas fa-times"></i></button>			   
				</div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- AJAX ZA INSERT -->
<script>
$('document').ready(function() {
	$('body').on('click', '#button_save', function(){		
		var naziv_sobe = $('#naziv_sobe').val();
		var kapacitet = $('#kapacitet').val();
		var broj_soba = $('#broj_soba').val();
		var cena_sobe = $('#cena_sobe').val();
		var dostupne_sobe = $('#dostupne_sobe').val();
		var povrsina = $('#povrsina').val();
		var akcija = $('#akcija').val();
		var sobe_id = $('#sobe_id').val();
		
		$.ajax ({
			url: 'ajax/ajax_tipsobe.php',
			type: 'post',
			data: {
				naziv_sobe:naziv_sobe,
				kapacitet:kapacitet,
				broj_soba:broj_soba,
				cena_sobe:cena_sobe,
				dostupne_sobe:dostupne_sobe,
				povrsina:povrsina,
				akcija:akcija, 
				sobe_id:sobe_id,
			},
			success: function(data) {
				$('#tbody').html(data);			
			}	
	});	
});


	$('body').on('click', '#insert', function(){
		$('#naslov_modala').html('<h5>Insert</h5>');
		$('#akcija').val('insert');
		$('#sobe_id').val('');
		$('#naziv_sobe').val('');
		$('#kapacitet').val('');
		$('#broj_soba').val('');
		$('#cena_sobe').val('');
		$('#dostupne_sobe').val('');
		$('#povrsina').val('');		
	});



	<!-- AJAX ZA DELETE -->
	$('body').on('click', '#delete', function(e){		
		e.preventDefault();	
		var soba_id = $(this).data('id');
		var akcija = 'brisanje';	
		if (confirm('Da li ste sigurni da zelite da obrisete ovaj tip?')) {
			$.ajax ({
				url: 'ajax/ajax_tipsobe.php',
				type: 'post',
				data: {
					soba_id:soba_id,
					akcija:akcija,
				},
				success: function(data) {
					$('#tbody').html(data);
				}
			})
		}	
	});

	


	<!-- AJAX ZA EDIT -->
	$('body').on('click', '.edit', function(){		

		$('#akcija').val('edit');
		
		var sobe_id = $(this).val();
		var naziv_sobe = $(this).data('a');
		var kapacitet = $(this).data('b');
		var broj_soba = $(this).data('c');
		var cena_sobe = $(this).data('d');
		var dostupne_sobe = $(this).data('e');
		var povrsina = $(this).data('f');
		
		
		$('#sobe_id').val(sobe_id);
		$('#naziv_sobe').val(naziv_sobe);
		$('#kapacitet').val(kapacitet);
		$('#broj_soba').val(broj_soba);
		$('#cena_sobe').val(cena_sobe);
		$('#dostupne_sobe').val(dostupne_sobe);
		$('#povrsina').val(povrsina);			
	});
	$('body').on('click', '.edit', function(){
			$('#naslov_modala').html('<h5>Edit</h5>');
		});

		$('.display-3').fadeIn(1000);
		$('.usluge_search').fadeIn(1000);
		$('#tabela_zaposleni').fadeIn(1000);
});


</script>
</body>
</html>








