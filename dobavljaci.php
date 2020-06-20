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
  <title>Dobavljači</title>
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
			color: #fff;
		}
		tbody {
			color: #000;
		}
		.edit {
			color: #fff;
		}
	</style>

</head>

<body>
	
	<h2 class="display-3" style="display: none;">Dobavljači</h2>
	
	<div class="display-search" style="display: none;">	
		<div class="container row d-flex justify-content-center" style="margin-left: auto; margin-right: auto; margin-bottom: 5%; width: 50%;">		
			<div class="col-md-4" style="margin-right: 10px;">
				<input type='text' name='search_bar' class='form-control'  placeholder='Pretraži'>
			</div>		
			<div class="form-group row">		
				<button class="btn btn-light" type='button' name='submit_search' id='search' style="margin-right: 10px; min-width: 100px;"><i class="fas fa-search"></i> Pretraži</button>		
				<button class="btn btn-light" type='button' name='Insert' id='insert' data-toggle="modal" data-target="#exampleModalCenter" style="min-width: 100px;"><i class="fas fa-plus"></i> Insert</button>
			</div>		
		</div>
	</div>	
	<div class="table-responsive"> 
		<table class="table table-striped table-bordered" id='tabela_dobavljaci' style="display: none;"> 
			<thead class="bg-info">
				<tr>		
					<th style="width: 130px;">Redni broj</th>
					<th>Ime dobavljača</th>					
					<th style="width: 130px;">Akcija</th>					
				</tr>
			</thead>		
			<tbody id='tbody' class="bg-light"> 
<?php

$sql = "SELECT * FROM dobavljaci";

$results = $conn->query($sql);
$i = 1;
while ($red = $results->fetch_assoc()) {
?>	
	
				<tr>	
					<td><?=$i++?></td>			
					<td><?=$red['ime']?></td>			
					<td style='min-width: 130px; vertical-align: middle;'>			
					<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['dobavljaci_id']?>"
					data-a="<?=$red['ime']?>"><i class="fas fa-edit"></i>			
					</button>
					<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['dobavljaci_id']?>"><i class="fas fa-trash"></i></button>
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
					<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle"></h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<div align="center">
						<form class='form-horizontal' enctype='multipart/form-data'>				
							<div class="col-md-6">
								<label>Ime:</label>
								<input type='text' name='ime' class="form-control" placeholder='' id='ime'>
							</div>					
							<input type='hidden' name='akcija' id='akcija'>
							<input type='hidden' name='dobavljaci_id' id='dobavljaci_id'>			
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
<?php include 'scripts.php'; ?></script>
<script>
$('document').ready(function() {	

	$('body').on('click', '#insert', function(){
		$('#akcija').val('insert');
		$('#naslov_modala').html('<h5>Insert</h5>');
		$('#dobavljaci_id').val('');
		$('#ime').val('');
	});
	
	$('.display-3').fadeIn(1500);
	$('.table').fadeIn(1500);
	$('.display-search').fadeIn(1500);
	
	<!-- AJAX ZA INSERT -->
	
	$('body').on('click', '#button_save', function(){
		var ime = $('#ime').val();
		var dobavljaci_id = $('#dobavljaci_id').val();
		var akcija = $('#akcija').val();
		$.ajax ({
			url: 'ajax/ajax_dobavljaci.php',
			type: 'post',
			data: {
				ime:ime,
				dobavljaci_id:dobavljaci_id,
				akcija:akcija, 
			},
			success: function(data) {
				$('#tbody').html(data);
			}
		})
	}); 
	
	$('body').on('click', '.delete', function(e){
		e.preventDefault();
		
		var dobavljaci_id = $(this).data('id');
		var akcija = 'brisanje';
		
		if (confirm('Da li sigurno zelite da obrisete ovog dobavljača?')) {
			$.ajax ({
				url: 'ajax/ajax_dobavljaci.php',
				type: 'post',
				data: {
					dobavljaci_id:dobavljaci_id,
					akcija:akcija, 
				},
				success: function(data) {
					$('#tbody').html(data);
				}
			})
		}
	});
	
	<!-- POPUNJAVANJE INPUTA ZA EDIT -->
	
	$('body').on('click', '#edit', function() {
		$('#akcija').val('edit');
		
		var dobavljaci_id = $(this).data('id');
		var ime = $(this).data('a');
		
		$('#dobavljaci_id').val(dobavljaci_id);
		$('#ime').val(ime);
	});
	
	$('body').on('click', '#edit', function() {
		$('#naslov_modala').html('<h5>Edit</h5>');	
		});
});

<!-- AJAX ZA SEARCH -->

	$('#search').on('click', function(e) {
		e.preventDefault();
		var search = $('input[name=search_bar]').val();
		var akcija = 'search';
		$.ajax ({
			url: 'ajax/ajax_dobavljaci.php',
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

</script>
</body>
</html>



