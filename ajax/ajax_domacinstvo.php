<?php


include 'dbconnect.php';

/* AJAX ZA INSERT */

if ($_POST['akcija'] == 'insert') {
	$ime = $_POST['ime'];
	$kolicina = $_POST['kolicina'];
	
	$datum_unosa = date('Y-m-d');
	
	$insert = "INSERT INTO `domacinstvo`(`domacinstvo_id`, `ime`, `kolicina`, `datum_unosa`) VALUES ('', '$ime', '$kolicina', '$datum_unosa')";

	$conn->query($insert);
	
	$prikaz = "SELECT * FROM domacinstvo";
	
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
		
?>
	<tr>	
		<td style="min-width: 110px;"><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td><?=$red['kolicina']?></td>			
		<td><?=$red['datum_unosa']?></td>			
		<td><?=$red['datum_promene']?></td>			
		<td style='vertical-align: middle; min-width: 130px;'>	
		
		<button class="btn btn-warning edit"  name='edit' id='edit' style='color: #fff; margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['domacinstvo_id']?>" data-a="<?=$red['ime']?>" data-b="<?=$red['kolicina']?>"><i class="fas fa-edit"></i>			
		</button>
		<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['domacinstvo_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>	

<?php
		
	}
}

/* AJAX ZA DELETE */
if ($_POST['akcija'] == 'brisanje') {
	$dom_id = $_POST['dom_id'];
	
	$delete = "DELETE FROM domacinstvo WHERE domacinstvo_id = $dom_id";
	
	$conn->query($delete);
	
	$prikaz = "SELECT * FROM domacinstvo";
	
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
?>

	<tr>	
		<td style="min-width: 110px;"><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td><?=$red['kolicina']?></td>			
		<td><?=$red['datum_unosa']?></td>			
		<td><?=$red['datum_promene']?></td>			
		<td style='vertical-align: middle; min-width: 130px;'>	
		
		<button class="btn btn-warning edit"  name='edit' id='edit' style='color: #fff; margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['domacinstvo_id']?>" data-a="<?=$red['ime']?>" data-b="<?=$red['kolicina']?>"><i class="fas fa-edit"></i>			
		</button>
		<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['domacinstvo_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>	


<?php	
	}	
}
/* AJAX ZA EDIT */
if ($_POST['akcija'] == 'edit') {
	$dom_id = $_POST['dom_id'];
	$ime = $_POST['ime'];
	$kolicina = $_POST['kolicina'];
	$datum_promene = date('Y-m-d H:i:s'); 
	
	$sql = "UPDATE `domacinstvo` SET `ime` = '$ime', `kolicina` = '$kolicina', `datum_promene` = '$datum_promene' WHERE domacinstvo_id = $dom_id";
	
	$conn->query($sql);
	
	$prikaz = "SELECT * FROM domacinstvo";
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
?>

	<tr>	
		<td style="min-width: 110px;"><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td><?=$red['kolicina']?></td>			
		<td><?=$red['datum_unosa']?></td>			
		<td><?=$red['datum_promene']?></td>			
		<td style='vertical-align: middle; min-width: 130px;'>	
		
		<button class="btn btn-warning edit"  name='edit' id='edit' style='color: #fff; margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['domacinstvo_id']?>" data-a="<?=$red['ime']?>" data-b="<?=$red['kolicina']?>"><i class="fas fa-edit"></i>			
		</button>
		<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['domacinstvo_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>	

<?php		
	}
	
}
	
/* AJAX ZA SEARCH */

if ($_POST['akcija'] == 'search') {
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	if ($search == '') {
		$sql_search = "SELECT * FROM domacinstvo";
	} else {
		$sql_search = "SELECT * FROM domacinstvo WHERE ime LIKE '%$search%' OR kolicina LIKE '%$search%'";
	}


$results = $conn->query($sql_search);
$i = 1;
while ($red = $results->fetch_assoc()) {
?>

	<tr>	
		<td style="min-width: 110px;"><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td><?=$red['kolicina']?></td>			
		<td><?=$red['datum_unosa']?></td>			
		<td><?=$red['datum_promene']?></td>			
		<td style='vertical-align: middle; min-width: 130px;'>	
		
		<button class="btn btn-warning edit"  name='edit' id='edit' style='color: #ffff; margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['domacinstvo_id']?>" data-a="<?=$red['ime']?>" data-b="<?=$red['kolicina']?>"><i class="fas fa-edit"></i>			
		</button>
		<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['domacinstvo_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>	


<?php	
	}
}
?>