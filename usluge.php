<?php 

include 'dbconnect.php';

include 'scripts.php';

$upit = "SELECT * FROM usluge";
$results = $conn->query($upit);


?>
<!DOCTYPE>
<head>
	<meta charset="utf-8">
	<title>Usluge</title>
	<?php include 'navbar.php'; ?> <!-- DA BI RADIO TITLE -->
	<meta name="Enginious" content="">
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
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1 ); 
			
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

<h2  class="display-3" style='display: none;'>Usluge</h2>
	<div class="display-search" style="display:none;">	
		<div class="container row d-flex justify-content-center" style="margin-left: auto; margin-right: auto; margin-bottom: 5%;">		
			<div class="col-md-4" style="margin-right: 5px;">
				<input type='text' name='usluge_search' class='form-control'  placeholder='Pretraži'>
			</div>		
			<div class="form-group">		
				<button class="btn btn-light" type='button' name='submit_search' id='search' style="min-width: 100px; margin-left: -15px;"><i class="fas fa-search"></i> Pretraži</button>		
				<button class="btn btn-light" type='button' name='Insert' data-toggle="modal" data-target="#exampleModalCenter" style="min-width: 100px;"><i class="fas fa-plus"></i> Insert</button>
			</div>		
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered" id='tabela_usluge' style='display: none;'>
			<thead class="bg-info">
				<tr>
					<th>Redni broj</th>
					<th>Naziv usluge</th>
					<th>Cena usluge</th>
					<th style="width: 130px;">Akcija</th>	
				</tr>
			</thead>
			<tbody id='tbody' class="bg-light">
<?php
$i = 1;
while($red = $results->fetch_array()) {
?>

				<tr class='table-bordered'>	
					<td style='vertical-align: middle;'><?=$i++;?></td>
					<td style='vertical-align: middle;'><?=$red['naziv_usluge'];?></td>
					<td style='vertical-align: middle;'><?=$red['cena_usluge'] . "€"?></td>	
					<td style='vertical-align: middle; min-width: 130px;'>
						<button class="btn btn-warning edit" type='button' name='Edit' style="color: #fff; margin-right: 10px;" data-id="<?=$red['usluge_id'];?>" data-i="<?=$red['naziv_usluge']?>" data-c="<?=$red['cena_usluge']?>" style='max-width:100px; margin-right: 10px;' data-toggle="modal" data-target="#edit_modal"><i class="fas fa-edit"></i></button>					
						<button class="btn btn-danger Delete" name='Delete' data-id="<?=$red['usluge_id'];?>"value='Delete'><i class="fas fa-trash"></i></button>	
					</td>
				</tr>		
<?php
}

?>
			</tbody>
		</table>
	</div>
<!-- Modal za insert -->

			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
							<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle" style="margin-left: 8%">Dodajte novu uslugu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					  <div class="modal-body">
							<form id='modal_forma'>
								<div align="center">
									<div class="col-md-8 text-center">
										<label>Naziv usluge:</label>
										<input type='text' name='ime_modal' class="form-control">
									</div>
									<div class="col-md-8 text-center">
										<label>Cena usluge (€):</label>
										<input type='text' name='cena_modal' class="form-control">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer" style="margin-right: 3%; margin-left: 3%">
							<button type="button" class="btn btn-success" id='modal_insert' data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-plus"></i> Sačuvaj</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id='modal_close' style="min-width: 100px;"><i class="fas fa-times"></i> Odustani</button>			
						</div>
					</div>
				</div>
			</div>

		<!-- Modal za EDIT -->

			<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header" style="margin-right: 3%; margin-left: 3%">
							<h5 class="modal-title w-100 text-center" id="exampleModalLongTitle" style="margin-left: 8%">Izmenite uslugu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff !important">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					  
						<div class="modal-body">
							<div align="center">
								<form class="form-horizontal">			
									<div class="col-md-8">
										<label>Naziv usluge:</label>
										<input id='usluge_ime' type='text' class="form-control" name='ime_edit' placeholder='Naziv usluge'>	
									</div>
									<div class="col-md-8">	
										<label>Cena usluge (€):</label>
										<input type='text' placeholder='Cena usluge' class="form-control" id='usluge_cena' name='cena_edit'>
									</div>
										<input type='hidden' name='usluga_id' id='usluga_id'>			
								</form>
							</div>		  
						</div>
						<div class="modal-footer" style="margin-right: 3%; margin-left: 3%">        
							<button type="button" class="btn btn-success" id='edit_save' data-dismiss="modal" style="min-width: 100px;"><i class="fas fa-plus"></i> Sačuvaj</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id='modal_close' style="min-width: 100px;"><i class="fas fa-times"></i> Odustani</button>
						</div>
					</div>
				</div>
			</div>
	

<!-- Prekida se listanje tabele -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js'>
</script>
<script>

<!-- AJAX ZA SEARCH -->

$('document').ready(function() {
	$('#search').on('click', function() {
		var search =$('input[name=usluge_search]').val();
		var akcija = 'search';
			$.ajax ({
				url: 'ajax/ajax_usluge.php',
				type: 'post',
				data: {
					search:search,
					akcija:akcija
				},
				success: function(data) {
					$('#tbody').html(data);
				}
			});
	});

<!-- AJAX ZA INSERT -->

	$('body').on('click', '#modal_insert',function() {
		var ime_modal = $('input[name=ime_modal]').val();
		var cena_modal = $('input[name=cena_modal]').val();
		var akcija = 'insert';
		$.ajax ({
			url: 'ajax/ajax_usluge.php',
			type: 'post', 
			data: {
				ime_modal:ime_modal,
				akcija:akcija, 
				cena_modal:cena_modal
			},
			success: function(data) {
				$('#tbody').html(data);
				$("#modal_forma")[0].reset();
			}	
		});		
	});

	<!-- AJAX ZA DELETE -->

	$('body').on('click', '.Delete', function(e){
		e.preventDefault();
		var usluge_id = $(this).data('id');
		var akcija = 'brisanje';
		
		if (confirm('Are you sure you want to delete this?')) {
			$.ajax({
				url: 'ajax/ajax_usluge.php',
				type: 'post',
				data: {
					usluge_id:usluge_id,
					akcija: akcija,
				},
				success: function(data) {
					$('#tbody').html(data);				
				}
			})
		}
	});

	<!-- AJAX ZA EDIT -->

	$('body').on('click', '#edit_save', function() {
		var usluge_id = $('#usluga_id').val();
		var ime_edit = $('input[name=ime_edit]').val();
		var cena_edit = $('input[name=cena_edit]').val();	
		var akcija = 'edit';
		$.ajax ({
			url: 'ajax/ajax_usluge.php',
			type: 'post',
			data: {
				usluge_id:usluge_id,
				ime_edit:ime_edit,
				cena_edit:cena_edit, 
				akcija:akcija
			},
			success: function(data) {
				$('#tbody').html(data);		
				$('#usluga_cena').val(0);
				$('#usluga_ime').val('');
				$('#usluga_id').val('');
			}
		})	
	})

<!-- Tabela fadein -->	

	$('#tabela_usluge').fadeIn(1000);
	$('.display-3').fadeIn(1000);
	$('.display-search').fadeIn(1000);
	$('#navbar').fadeIn(1000);
	
<!-- Popunjavanje edit inputa -->	

	$('body').on('click', '.edit', function(){
		
		var uid = $(this).data('id');
		var usluga_ime = $(this).data('i');
		var usluga_cena = $(this).data('c');
		
		$('#usluga_id').val(uid);
		$('#usluge_ime').val(usluga_ime);
		$('#usluge_cena').val(usluga_cena);
		
	});
});

</script>

</body>
</html>





