<?php 

include 'dbconnect.php';

/* AJAX ZA INSERT */

if ($_POST['akcija'] == 'insert') {	

	$tip_sobe = $_POST['tip_sobe'];
	$broj_sobe = $_POST['broj_sobe'];
	$sprat_sobe = $_POST['sprat_sobe'];
	
	
	$sql_insert = "INSERT INTO `sobe`(`sobe_id`, `broj_sobe`, `sprat_sobe`, `tip_sobe`) VALUES (null, '$broj_sobe', '$sprat_sobe', '$tip_sobe')";
	
	$conn->query($sql_insert);
	
	$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id";


	$results = $conn->query($sobe_upit);
	
	while ($red = $results->fetch_assoc()) {

?>

	<tr>			
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
	
}
/* AJAX ZA DELETE */
if ($_POST['akcija'] == 'brisanje') {
	$soba_id = $_POST['sobe_id'];
	$sql = "DELETE FROM sobe WHERE sobe_id = $soba_id";
	
	$conn->query($sql);	
	
	$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id";
	
	$results = $conn->query($sobe_upit);
	while ($red = $results->fetch_assoc()) {
	
?>

	<tr>			
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
	}
	/* AJAX ZA EDIT */
if ($_POST['akcija'] == 'edit') {
	$sobe_id = $_POST['sobe_id'];
	$broj_sobe = $_POST['broj_sobe'];
	$sprat_sobe = $_POST['sprat_sobe'];
	$tip_sobe = $_POST['tip_sobe'];	
	$sql = "UPDATE `sobe` SET `broj_sobe`='$broj_sobe', `sprat_sobe`='$sprat_sobe', `tip_sobe`='$tip_sobe' WHERE sobe_id = '$sobe_id'";
	
	$conn->query($sql);
	
	$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id";
	
	$results = $conn->query($sobe_upit);
	while ($red = $results->fetch_assoc()) {
?>		

	<tr>		
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
}
	
/* AJAX ZA SEARCH */

if ($_POST['akcija'] == 'search') {
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	if ($search == '') {
		$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id";	
	} else {
		$sobe_upit = "SELECT sobatip.tipsobe_id, sobe.sobe_id, sobe.broj_sobe, sobe.sprat_sobe, sobatip.naziv_sobe, sobatip.broj_gostiju, sobatip.broj_slobodnih, sobatip.cena_sobe, sobatip.povrsina FROM sobe LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id WHERE sobe.sobe_id LIKE '%$search%' OR sobe.broj_sobe LIKE '%$search%' OR sobe.sprat_sobe LIKE '%$search%' OR sobatip.naziv_sobe LIKE '%$search%' OR sobatip.broj_gostiju LIKE '%$search%' OR sobatip.broj_slobodnih LIKE '%$search%' OR sobatip.cena_sobe LIKE '%$search%' OR sobatip.povrsina LIKE '%$search%'";	
	}
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
}

/* AJAX ZA PROVERU REZERVACIJA ZA ODREĐENU SOBU */

if ($_POST['akcija'] == 'proveraREZ') {
	$id = $_POST['soba_id'];
	$sql = "SELECT datum_od, datum_do, guests.ime, guests.prezime, sobestatus.status, rezervacije_id, sobe_id FROM rezervacije LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id WHERE sobe.sobe_id = '$id'";
	
	$res = $conn->query($sql);
	while ($row = $res->fetch_assoc()) {		
?>		

	<tr id="redI<?=$row['rezervacije_id']?>">
		<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime']?></td>
		<td style="vertical-align: middle;"><?=$row['datum_od']?></td>
		<td style="vertical-align: middle;"><?=$row['datum_do']?></td>
		<td style="vertical-align: middle;"><?=$row['status']?></td>
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



