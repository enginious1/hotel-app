<?php

include 'dbconnect.php';


/* AJAX ZA SEARCH */

//$sql_search = "SELECT * FROM usluge";

if ($_POST['akcija'] == 'search') {
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	if ($search == '') {
		$sql_search = "SELECT * FROM usluge";
	} else {
		$sql_search = "SELECT * FROM usluge WHERE naziv_usluge LIKE '%$search%' OR cena_usluge LIKE '%$search%'";
	}
	
	
	$results = $conn->query($sql_search);
	$i= 1;
	while ($red = $results->fetch_assoc()) {

?>

<tr class='table-bordered'>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['naziv_usluge'];?></td>
	<td style='vertical-align: middle;'><?=$red['cena_usluge'] . "€"?></td>	
	<td style='vertical-align: middle; min-width: 130px;'>
		<button class="btn btn-warning edit" type='button' name='Edit' style="color: #fff; margin-right: 10px;" data-id="<?=$red['usluge_id'];?>" data-i="<?=$red['naziv_usluge']?>" data-c="<?=$red['cena_usluge']?>" value="<?=$usluge_id?>" style='max-width:100px; margin-right: 10px;' data-toggle="modal" data-target="#edit_modal"><i class="fas fa-edit"></i></button>					
		<button class="btn btn-danger Delete" name='Delete' data-id="<?=$red['usluge_id'];?>"value='Delete'><i class="fas fa-trash"></i></button>	
	</td>
</tr>				

<?php
	}
	
}

/* AJAX ZA INSERT */

if ($_POST['akcija'] == 'insert') {
	$ime_usluge = $_POST['ime_modal'];
	$cena_usluge= $_POST['cena_modal'];
	
	$sql_insert = "INSERT INTO usluge (`usluge_id`, `naziv_usluge`, `cena_usluge`) VALUES (null, '$ime_usluge', '$cena_usluge')";
	
	$conn->query($sql_insert);
	$sql_search = "SELECT * FROM usluge";
	$results = $conn->query($sql_search);
	
	$i = 1;
	while ($red = $results->fetch_assoc()) {
?>


<tr class='table-bordered'>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['naziv_usluge'];?></td>
	<td style='vertical-align: middle;'><?=$red['cena_usluge'] . "€"?></td>	
	<td style='vertical-align: middle; min-width: 130px;'>
		<button class="btn btn-warning edit" type='button' name='Edit' style="color: #fff; margin-right: 10px;" data-id="<?=$red['usluge_id'];?>" data-i="<?=$red['naziv_usluge']?>" data-c="<?=$red['cena_usluge']?>" value="<?=$usluge_id?>" style='max-width:100px; margin-right: 10px;' data-toggle="modal" data-target="#edit_modal"><i class="fas fa-edit"></i></button>					
		<button class="btn btn-danger Delete" name='Delete' data-id="<?=$red['usluge_id'];?>"value='Delete'><i class="fas fa-trash"></i></button>	
	</td>
</tr>		

<?php

	}
}


/* AJAX ZA DELETE */

if ($_POST['akcija'] == 'brisanje') {
	
	$usluge_id = $_POST['usluge_id'];
	$query = "DELETE FROM `usluge` where usluge_id = $usluge_id";
	$conn->query($query);
	$prikaz_new = "SELECT * FROM usluge";
	
	$results = $conn->query($prikaz_new);
	$i = 1;
	while($red = $results->fetch_array()) {	

?>	
	
<tr class='table-bordered'>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['naziv_usluge'];?></td>
	<td style='vertical-align: middle;'><?=$red['cena_usluge'] . "€"?></td>	
	<td style='vertical-align: middle; min-width: 130px;'>
		<button class="btn btn-warning edit" type='button' name='Edit' style="color: #fff; margin-right: 10px;" data-id="<?=$red['usluge_id'];?>" data-i="<?=$red['naziv_usluge']?>" data-c="<?=$red['cena_usluge']?>" value="<?=$usluge_id?>" style='max-width:100px; margin-right: 10px;' data-toggle="modal" data-target="#edit_modal"><i class="fas fa-edit"></i></button>					
		<button class="btn btn-danger Delete" name='Delete' data-id="<?=$red['usluge_id'];?>"value='Delete'><i class="fas fa-trash"></i></button>	
	</td>
</tr>		
	
<?php
	}
}

/* AJAX ZA EDIT */

 if ($_POST['akcija'] == 'edit') {
	
	$usluge_id = $_POST['usluge_id'];
	$ime_edit = $_POST['ime_edit'];
	$cena_edit = $_POST['cena_edit'];
	
	
	$sql = "UPDATE `usluge` SET `naziv_usluge`='$ime_edit', `cena_usluge`='$cena_edit' WHERE usluge_id = $usluge_id";
		
	$results = $conn->query($sql);
	
	$results2 = "SELECT * FROM usluge";
	$edited = $conn->query($results2);
	$i = 1;
	while ($red = $edited->fetch_assoc()) {
	
?>

<tr class='table-bordered'>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['naziv_usluge'];?></td>
	<td style='vertical-align: middle;'><?=$red['cena_usluge'] . "€"?></td>	
	<td style='vertical-align: middle; min-width: 130px;'>
		<button class="btn btn-warning edit" type='button' name='Edit' style="color: #fff; margin-right: 10px;" data-id="<?=$red['usluge_id'];?>" data-i="<?=$red['naziv_usluge']?>" data-c="<?=$red['cena_usluge']?>" value="<?=$usluge_id?>" style='max-width:100px; margin-right: 10px;' data-toggle="modal" data-target="#edit_modal"><i class="fas fa-edit"></i></button>					
		<button class="btn btn-danger Delete" name='Delete' data-id="<?=$red['usluge_id'];?>"value='Delete'><i class="fas fa-trash"></i></button>	
	</td>
</tr>		


<?php
	}
}


?>





