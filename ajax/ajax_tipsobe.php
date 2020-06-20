<?php 

include 'dbconnect.php';

if($_POST['akcija'] == 'insert') {
	$naziv_sobe = $_POST['naziv_sobe'];
	$kapacitet = $_POST['kapacitet'];
	$broj_soba = $_POST['broj_soba'];
	$cena_sobe = $_POST['cena_sobe'];
	$dostupne_sobe = $_POST['dostupne_sobe'];
	$povrsina = $_POST['povrsina'];	
	
	$insert = "INSERT INTO `sobatip` (`tipsobe_id`, `naziv_sobe`, `broj_gostiju`, `broj_soba`, `cena_sobe`, `broj_slobodnih`, `povrsina`, `opis_sobe`) VALUES (null, '$naziv_sobe', '$kapacitet', '$broj_soba', '$cena_sobe', '$dostupne_sobe', '$povrsina', '')";
	
	$conn->query($insert);

	$prikaz = "SELECT * FROM sobatip";
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results->fetch_assoc()) {	

?>

	<tr class='table-bordered'>		
		
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
	
}
if ($_POST['akcija'] == 'brisanje') {
	$soba_id = $_POST['soba_id'];
	$delete = "DELETE FROM sobatip where tipsobe_id = $soba_id";
	$conn->query($delete);
	$prikaz = "SELECT * FROM sobatip";
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results ->fetch_assoc()) {	
		
?>	
	
	<tr class='table-bordered'>		
		
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
}

/* AJAX ZA EDIT */

$i = 1;
if ($_POST['akcija'] == 'edit') {
	$sobe_id = $_POST['sobe_id'];
	$naziv_sobe = $_POST['naziv_sobe'];
	$kapacitet = $_POST['kapacitet'];
	$broj_soba = $_POST['broj_soba'];
	$cena_sobe = $_POST['cena_sobe'];
	$dostupne_sobe = $_POST['dostupne_sobe'];
	$povrsina = $_POST['povrsina'];
	
	$sql_update = "UPDATE `sobatip` SET `naziv_sobe` = '$naziv_sobe', `broj_gostiju` = '$kapacitet', `broj_soba` = '$broj_soba', `cena_sobe` = '$cena_sobe', `broj_slobodnih` = '$dostupne_sobe', `povrsina` = '$povrsina' WHERE tipsobe_id = $sobe_id";
	
	$results = $conn->query($sql_update);
	$results2 = "SELECT * FROM sobatip";
	
	$new_edited = $conn->query($results2);
	
	while ($red = $new_edited->fetch_assoc()) {
?>

	<tr class='table-bordered'>		
		
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
}

?>



	