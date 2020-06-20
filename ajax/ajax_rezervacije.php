<?php
include 'dbconnect.php';


/* AJAX ZA INSERT REZERVACIJE */

if ($_POST['akcija'] == 'insertRez') {
	$ime = $_POST['ime'];
	$status = $_POST['status'];
	$brojSobe = $_POST['brojSobe'];
	$datumOd = $_POST['datumOd'];
	$datumOdClean = strtotime($datumOd);
	$datumOdClean = date("Y-m-d H:i:s", $datumOdClean);
	$datumDo = $_POST['datumDo'];
	$datumDoClean = strtotime($datumDo);
	$datumDoClean = date("Y-m-d H:i:s", $datumDoClean);	
	$cena = $_POST['cena'];
	
	
	
	$sql = "INSERT INTO `rezervacije`(`rezervacije_id`, `gost_id`, `soba_id`, `datum_od`, `datum_do`, `rez_status_id`, `cena`) VALUES ('', '$ime', '$brojSobe', '$datumOdClean', '$datumDoClean', '$status', '$cena')";	
	
	$conn->query($sql);	
	
	$prikaz = "SELECT sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM `rezervacije` LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id;";
	
	$results = $conn->query($prikaz);
	while ($row = $results->fetch_assoc()) {
?>
		<tr class="table-success">
			<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime'];?></td>
			<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>
			<td style="vertical-align: middle;"><?=$row['status'];?></td>
			<td style="vertical-align: middle;"><?=$row['cena'] . "€";?></td>
			<td style="min-width: 100px"><?=$row['datum_od'];?></td>			
			<td style="vertical-align: middle;"><?=$row['datum_do'];?></td>		
			<td style='min-width: 130px;vertical-align: middle;'><button type="button" data-toggle="modal" data-target="#insert_modal" class="btn btn-warning edit" style="color: #fff; margin-right: 10px;"
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
	
}

/* AJAX ZA DELETE */

if ($_POST['akcija'] == 'brisanjeREZ') {
	$id = $_POST['id'];
	
	$sql = "DELETE FROM rezervacije WHERE rezervacije_id = '$id'";

	$conn->query($sql);
	
	$prikaz = "SELECT sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM `rezervacije` LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id;";
	
	
	$results = $conn->query($prikaz);
	while ($row = $results->fetch_assoc()) {
?> 
		<tr class="table-success">
			<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime'];?></td>
			<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>
			<td style="vertical-align: middle;"><?=$row['status'];?></td>
			<td style="vertical-align: middle;"><?=$row['cena'] . "€";?></td>
			<td style="min-width: 100px; vertical-align: middle;"><?=$row['datum_od'];?></td>			
			<td style="vertical-align: middle;"><?=$row['datum_do'];?></td>		
			<td style='min-width: 130px;vertical-align: middle;'> <button type="button" data-toggle="modal" data-target="#insert_modal" class="btn btn-warning edit" style="color: #fff; margin-right: 10px;"
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
}

/* AJAX ZA EDIT */

if ($_POST['akcija'] == 'editRez') {
	$rezId = $_POST['rezId'];
	$ime = $_POST['ime'];
	$status = $_POST['status'];
	$brojSobe = $_POST['brojSobe'];
	$datumOd = $_POST['datumOd'];
	$datumOdClean = strtotime($datumOd);
	$datumOdClean = date("Y-m-d H:i:s", $datumOdClean);
	$datumDo = $_POST['datumDo'];
	$datumDoClean = strtotime($datumDo);
	$datumDoClean = date("Y-m-d H:i:s", $datumDoClean);
	$cena = $_POST['cena'];
	
    $sql = "UPDATE `rezervacije` SET `gost_id`='$ime',`soba_id`='$brojSobe',`datum_od`='$datumOdClean',`datum_do`='$datumDoClean',`rez_status_id`='$status',`cena`='$cena' WHERE rezervacije_id = '$rezId'";
	
	$conn->query($sql);
	
	$prikaz = "SELECT sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM `rezervacije` LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id;";

	$results = $conn->query($prikaz);
	while ($row = $results->fetch_assoc()) {
?>
		<tr class="table-success">
			<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime'];?></td>
			<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>
			<td style="vertical-align: middle;"><?=$row['status'];?></td>
			<td style="vertical-align: middle;"><?=$row['cena'] . "€";?></td>
			<td style="min-width: 100px; vertical-align: middle;"><?=$row['datum_od'];?></td>			
			<td style="vertical-align: middle;"><?=$row['datum_do'];?></td>		
			<td style='min-width: 130px; vertical-align: middle;'> <button type="button" data-toggle="modal" data-target="#insert_modal" class="btn btn-warning edit" style="color: #fff; margin-right: 10px;"
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
}


/* AJAX ZA SEARCH */

if ($_POST['akcija'] == 'pretragaRez') {
	$imeGost = $_POST['imeGosta'];
	$brsobe = $_POST['brSobe'];
	
	$datumOd = date("Y-m-d H:i:s", strtotime($_POST['datumOd']));
	$datumDo = date("Y-m-d H:i:s", strtotime($_POST['datumDo']));
	$datumFake = date("Y-m-d H:i:s");
	
	if ($imeGost == '') {
		$gostSQL = "";
	} else {
		$gostSQL = "AND guests.guests_id = $imeGost";
	}
	
	if ($brsobe == '') {
		$brsobeSQL = "";
	} else {
		$brsobeSQL = "AND sobe.sobe_id = '$brsobe'";
	}	
	
	if ($datumOd=="1970-01-01 01:00:00" && $datumDo=="1970-01-01 01:00:00") {	
		$sqlx = "";	
	} else if ($datumOd != "1970-01-01 01:00:00" && $datumDo == "1970-01-01 01:00:00") {
		$sqlx = "AND datum_od BETWEEN '$datumOd' AND '$datumFake'";
	} else if ($datumOd == "1970-01-01 01:00:00" && $datumDo != "1970-01-01 01:00:00") {
		$sqlx = "AND datum_do BETWEEN '1970-01-01 01:00:00' AND '$datumDo'";
	} else {
		$sqlx = "AND datum_od > '$datumOd' AND datum_do < '$datumDo'";
	}	
	$prikaz = "SELECT sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM rezervacije LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id WHERE rezervacije_id > 0 $sqlx $gostSQL $brsobeSQL";	



	/* $prikaz = "SELECT guests.guests_id, sobe.sobe_id, sobe.broj_sobe, rezervacije.rezervacije_id, rezervacije.gost_id, rezervacije.soba_id, rezervacije.datum_od, rezervacije.datum_do, rezervacije.rez_status_id, rezervacije.cena, sobestatus.status, guests.ime, guests.prezime FROM `rezervacije` LEFT JOIN sobestatus ON rezervacije.rez_status_id = sobestatus.sst_status_id LEFT JOIN guests ON rezervacije.gost_id = guests.guests_id LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id WHERE datum_od BETWEEN '$datumOd' AND '$datumDo' $gostSQL $brsobeSQL ORDER BY rezervacije_id DESC"; */
	
	
	$results = $conn->query($prikaz);
	while ($row = $results->fetch_assoc()) {
?>
	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime'];?></td>
		<td style="vertical-align: middle;"><?=$row['broj_sobe']?></td>
		<td style="vertical-align: middle;"><?=$row['status'];?></td>
		<td style="vertical-align: middle;"><?=$row['cena'] . "€";?></td>
		<td style="min-width: 100px; vertical-align: middle;"><?=$row['datum_od'];?></td>			
		<td style="vertical-align: middle;"><?=$row['datum_do'];?></td>		
		<td style='min-width: 130px; vertical-align: middle;'><button type="button" data-toggle="modal" data-target="#insert_modal" class="btn btn-warning edit" style="color: #fff; margin-right: 10px;"
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
}