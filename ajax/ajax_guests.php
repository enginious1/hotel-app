<?php

include 'dbconnect.php';

/* AJAX ZA INSERT */ 

if ($_POST['akcija'] == 'insert') {
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$e_mail = $_POST['e_mail'];
	$lk_broj = $_POST['lk_broj'];
	
	$insert = "INSERT INTO `guests`(`guests_id`, `ime`, `prezime`, `e_mail`, `lk_broj`) VALUES ('' , '$ime', '$prezime', '$e_mail', '$lk_broj')";
	
	$conn->query($insert);
	
	$sql = "SELECT * FROM guests";
	
	$results = $conn->query($sql);
	$i = 1;
	while ($red = $results->fetch_assoc()) {

?>

		<tr>			
			<td style="vertical-align: middle;"><?=$i++?></td>			
			<td style="vertical-align: middle;"><?=$red['ime']?></td>			
			<td style="vertical-align: middle;"><?=$red['prezime']?></td>
			<td style="vertical-align: middle;"><?=$red['e_mail']?></td>
			<td style="vertical-align: middle;"><?=$red['lk_broj']?></td>		
			<td style='min-width: 180px; vertical-align: middle;'>			
				<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width: 45px; color: #fff;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['guests_id']?>"
				data-a="<?=$red['ime']?>"
				data-b="<?=$red['prezime']?>"
				data-c="<?=$red['e_mail']?>"
				data-d="<?=$red['lk_broj']?>"><i class="fas fa-edit"></i>			
				</button>
				<button class="btn btn-danger delete" name='delete' id='delete' style="margin-right: 5px; width: 45px;" data-id="<?=$red['guests_id']?>"><i class="fas fa-trash"></i></button>
				<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['guests_id']?>"><i class="fas fa-id-card"></i></button>
			</td>	
		</tr>

<?php	
	}
}


/* AJAX ZA DELETE */

if ($_POST['akcija'] == 'brisanje') {
	$guests_id = $_POST['guests_id'];
	
	$delete = "DELETE FROM guests WHERE guests_id = '$guests_id'";
	
	$conn->query($delete);
	
	$prikaz = "SELECT * FROM guests";
	
	/* if ($conn->affected_rows) {
		$sql = "SELECT * FROM rezervacije WHERE gost_id = $guests_id";
		$results = $conn->query($sql);
		$row = $results->fetch_assoc();
		$gost = $row['gost_id'];
	
		$sql2 = "DELETE FROM rezervacije WHERE gost_id = '$gost'";
		$conn->query($sql2);
	} */
	
	$results = $conn->query($prikaz);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
		
?>		
		
		<tr>			
			<td style="vertical-align: middle;"><?=$i++?></td>			
			<td style="vertical-align: middle;"><?=$red['ime']?></td>			
			<td style="vertical-align: middle;"><?=$red['prezime']?></td>
			<td style="vertical-align: middle;"><?=$red['e_mail']?></td>
			<td style="vertical-align: middle;"><?=$red['lk_broj']?></td>			
			<td style='min-width: 180px; vertical-align: middle;'>			
				<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width: 45px; color: #fff;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['guests_id']?>"
				data-a="<?=$red['ime']?>"
				data-b="<?=$red['prezime']?>"
				data-c="<?=$red['e_mail']?>"
				data-d="<?=$red['lk_broj']?>"><i class="fas fa-edit"></i>			
				</button>
				<button class="btn btn-danger delete" name='delete' id='delete' style="margin-right: 5px; width: 45px;" data-id="<?=$red['guests_id']?>"><i class="fas fa-trash"></i></button>
				<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['guests_id']?>"><i class="fas fa-id-card"></i></button>
			</td>	
		</tr>

		
<?php		
	
	}
}

/* AJAX ZA EDIT */

if ($_POST['akcija'] == 'edit') {
	$guests_id = $_POST['guests_id'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$e_mail = $_POST['e_mail'];
	$lk_broj = $_POST['lk_broj'];
	
	$sql = "UPDATE `guests` SET `ime`='$ime', `prezime`='$prezime', `e_mail`='$e_mail', `lk_broj`='$lk_broj' WHERE guests_id = '$guests_id'";
	
	$results = $conn->query($sql);
	
	$results2 = "SELECT * FROM guests";
	
	$edited = $conn->query($results2);
	$i = 1;
	while ($red = $edited->fetch_assoc()) {
		
?>

		<tr>			
			<td style="vertical-align: middle;"><?=$i++?></td>			
			<td style="vertical-align: middle;"><?=$red['ime']?></td>			
			<td style="vertical-align: middle;"><?=$red['prezime']?></td>
			<td style="vertical-align: middle;"><?=$red['e_mail']?></td>
			<td style="vertical-align: middle;"><?=$red['lk_broj']?></td>			
			<td style='min-width: 180px; vertical-align: middle;'>			
				<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width: 45px; color: #fff;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['guests_id']?>"
				data-a="<?=$red['ime']?>"
				data-b="<?=$red['prezime']?>"
				data-c="<?=$red['e_mail']?>"
				data-d="<?=$red['lk_broj']?>"><i class="fas fa-edit"></i>			
				</button>
				<button class="btn btn-danger delete" name='delete' id='delete' style="margin-right: 5px; width: 45px;" data-id="<?=$red['guests_id']?>"><i class="fas fa-trash"></i></button>
				<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['guests_id']?>"><i class="fas fa-id-card"></i></button>
			</td>	
		</tr>

		
<?php
	}
}
/* AJAX ZA SEARCH */


if ($_POST['akcija'] == 'search') {
	
	$search = mysqli_real_escape_string($conn, $_POST['search']);

	if ($search == '') {
		$sql = "SELECT * FROM guests";
	} else {
		$sql = "SELECT * FROM guests WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%' OR e_mail LIKE '%$search%' OR lk_broj LIKE '%$search%'";
	
	}

	
	$results = $conn->query($sql);
	
	$i = 1;
	
	while ($red = $results->fetch_assoc()) {
?>

		<tr>			
			<td style="vertical-align: middle;"><?=$i++?></td>			
			<td style="vertical-align: middle;"><?=$red['ime']?></td>			
			<td style="vertical-align: middle;"><?=$red['prezime']?></td>
			<td style="vertical-align: middle;"><?=$red['e_mail']?></td>
			<td style="vertical-align: middle;"><?=$red['lk_broj']?></td>	
			<td style='min-width: 180px; vertical-align: middle;'>			
				<button class="btn btn-warning edit"  name='edit' id='edit' style='margin-right: 5px; width: 45px; color: #fff;' data-toggle="modal" data-target="#exampleModalCenter" data-id="<?=$red['guests_id']?>"
				data-a="<?=$red['ime']?>"
				data-b="<?=$red['prezime']?>"
				data-c="<?=$red['e_mail']?>"
				data-d="<?=$red['lk_broj']?>"><i class="fas fa-edit"></i>			
				</button>
				<button class="btn btn-danger delete" name='delete' id='delete' style="margin-right: 5px; width: 45px;" data-id="<?=$red['guests_id']?>"><i class="fas fa-trash"></i></button>
				<button class="btn btn-primary proveraREZ" name="provera" style="width: 45px;" data-toggle="modal" data-target="#modalRez" data-id="<?=$red['guests_id']?>"><i class="fas fa-id-card"></i></button>
			</td>	
		</tr>

<?php		
	}	
}	
/* AJAX ZA PROVERU REZERVACIJA */

if ($_POST['akcija'] == 'proveraREZ') {
	$id = $_POST['id'];
	$sql = "SELECT * FROM rezervacije INNER JOIN guests ON rezervacije.gost_id = guests.guests_id INNER JOIN sobe ON rezervacije.soba_id = sobe.sobe_id WHERE rezervacije.gost_id = '$id'";	
	$rez = $conn->query($sql);
	while ($row = $rez->fetch_assoc()) {
?>
		<tr id="redI<?=$row['rezervacije_id']?>">
			<td style="vertical-align: middle;"><?=$row['rezervacije_id']?></td>
			<td style="vertical-align: middle;"><?=$row['datum_od']?></td>
			<td style="vertical-align: middle;"><?=$row['datum_do']?></td>
			<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>		
			<td style="vertical-align: middle;"><button type="button" name="deleteREZ" class="btn btn-danger btn-sm deleteREZ" data-id=<?=$row['rezervacije_id']?>><i class="fas fa-trash"></i></button></td>
		</tr>
		
<?php		
	}
}
/* AJAX ZA BRISANJE REZERVACIJE IZ TABELE */

if ($_POST['akcija'] == 'brisanjeREZ') {
	$id = $_POST['id'];
	$sql = "DELETE FROM rezervacije WHERE rezervacije_id = '$id'";
	$conn->query($sql);
	if ($conn->affected_rows) {
	echo "obrisana";
	}
}	
?>
