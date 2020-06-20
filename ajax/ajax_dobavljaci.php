<?php

include 'dbconnect.php';


if ($_POST['akcija'] == 'insert') {
	
	$ime = $_POST['ime'];
	
	$insert = "INSERT INTO `dobavljaci`(`dobavljaci_id`, `ime`) VALUES ('' , '$ime')";
	
	$conn->query($insert);
	
	$sql = "SELECT * FROM dobavljaci";
	
	$results = $conn->query($sql);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
?>

	<tr>	
		<td><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td style='min-width: 130px; vertical-align: middle;'>			
			<button class="btn btn-warning edit"  name='edit' id='edit'  style='margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['dobavljaci_id']?>"
			data-a="<?=$red['ime']?>"><i class="fas fa-edit"></i>			
			</button>
			<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['dobavljaci_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>

<?php
	}	
}

/* AJAX ZA DELETE */

if ($_POST['akcija'] == 'brisanje') {
	$dobavljaci_id = $_POST['dobavljaci_id'];
	
	$delete = "DELETE FROM dobavljaci WHERE dobavljaci_id = $dobavljaci_id";
	
	$conn->query($delete);
	
	$prikaz = "SELECT * FROM dobavljaci";
	$i = 1;
	$results = $conn->query($prikaz);
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
}
if ($_POST['akcija'] == 'edit') {
	$dobavljaci_id = $_POST['dobavljaci_id'];
	$ime = $_POST['ime'];
	
	$sql = "UPDATE `dobavljaci` SET `ime`='$ime' WHERE dobavljaci_id = $dobavljaci_id";
	$results = $conn->query($sql);
	$prikaz = "SELECT * FROM dobavljaci"; 
	$edited = $conn->query($prikaz);
	$i = 1;
	
	while ($red = $edited->fetch_assoc()) {
?>

	<tr>		
		<td><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td style='min-width: 130px; vertical-align: middle;'>			
			<button class="btn btn-warning edit"  name='edit' id='edit'  style='margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['dobavljaci_id']?>"
			data-a="<?=$red['ime']?>"><i class="fas fa-edit"></i>			
			</button>
			<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['dobavljaci_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>

<?php	
	}
	
}

if ($_POST['akcija'] == 'search') {
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	if ($search == '') {
		$sql_search = "SELECT * FROM dobavljaci";
	} else {
		$sql_search = "SELECT * FROM dobavljaci WHERE ime LIKE '%$search%'";
	}	
	
	$results = $conn->query($sql_search);
	$i = 1;
	while($red = $results->fetch_assoc()) {
?>

	<tr>		
		<td><?=$i++?></td>			
		<td><?=$red['ime']?></td>			
		<td style='min-width: 130px; vertical-align: middle;'>			
			<button class="btn btn-warning edit"  name='edit' id='edit'  style='margin-right: 10px;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=	$red['dobavljaci_id']?>"
			data-a="<?=$red['ime']?>"><i class="fas fa-edit"></i>			
			</button>
			<button class="btn btn-danger delete" name='delete' id='delete' data-id="<?=$red['dobavljaci_id']?>"><i class="fas fa-trash"></i></button>
		</td>			
	</tr>

<?php
	} 
}

?>