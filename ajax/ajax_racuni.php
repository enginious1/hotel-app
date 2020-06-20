<?php 
include 'dbconnect.php';


/* UNOS MAIN RAČUNA */

if ($_POST['akcija'] == 'racunMainUnos') {
	$brRacuna = $_POST['brRacuna'];
	$datum = $_POST['datumRacuna'];
	$datum = date("Y-m-d H:i:s", strtotime($datum));
	$brojgodine = date("Y", strtotime($datum));
	$sqlbr = "SELECT MAX(broj_racuna) AS broj FROM racunimain WHERE broj_godine = $brojgodine";
	
	$results = $conn->query($sqlbr);
	$row = $results->fetch_assoc();
	$br = $row['broj'] + 1;
	$gost = $_POST['gost'];
	
	$sql = "INSERT INTO `racunimain`(`racun_id`, `broj_racuna`, `broj_godine`, `gost_id`, `datum_izdavanja`) VALUES ('', '$br', '$brojgodine', '$gost', '$datum')";
	
	$conn->query($sql);	
	
	if ($conn->affected_rows) {
		$sql = "SELECT MAX(racun_id) AS id FROM racunimain";		
		$results = $conn->query($sql);
		$row = $results->fetch_assoc();
		echo $row['id'];
	}
}

/* EDIT MAIN RAČUNA */

if ($_POST['akcija'] == 'editRacunMain') {
	$brRacuna = $_POST['brRacuna'];
	$datum = $_POST['datumRacuna'];
	$datum = date("Y-m-d H:i:s", strtotime($datum));
	$brojgodine = date("Y", strtotime($datum));
	$idRM = $_POST['idRM'];
	$gost = $_POST['gost'];
	$sql = "UPDATE racunimain SET datum_izdavanja = '$datum', gost_id = '$gost' WHERE racun_id = '$idRM'";
	$conn->query($sql);
}

/* AJAX ZA BLUR DATUM */


if ($_POST['akcija'] == 'blurDatum') {
	$godina = $_POST['godina'];
	$godina = date("Y", strtotime($godina));
	$sqlbr = "SELECT MAX(broj_racuna) AS broj FROM racunimain WHERE broj_godine = '$godina'";
	$results = $conn->query($sqlbr);
	$row = $results->fetch_assoc();
	$br = $row['broj'] + 1;
	echo $br . "/" . $godina;
} 

if ($_POST['akcija'] == 'lista') {
	$vrsta = $_POST['vrsta'];
	$gost = $_POST['gost'];
	
	if ($vrsta == "1") {
		$sql = "SELECT * FROM rezervacije LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id WHERE rezervacije.gost_id = '$gost'";
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while($row=$results->fetch_assoc()) {
			$dani = strtotime($row['datum_do'])  - strtotime($row['datum_od']);
			
			$dani = date("d", $dani);					
			$dani = ltrim($dani, '0');			
			
			echo "<option value='" . $row['rezervacije_id'] . "' data-cena='" . $row['cena_sobe'] . "' data-dani='" . $dani . "'>" . $row['rezervacije_id'] . " : " . $row['naziv_sobe'] . " Broj sobe: " . $row['broj_sobe'] . "</option>";
		
		}
	}		
	if ($vrsta == "2") {
		$sql = "SELECT * FROM domacinstvo WHERE suvenir = 1";
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while ($row=$results->fetch_assoc()){
			echo "<option value='". $row['domacinstvo_id'] . "'data-cena='" . $row['suv_prodajna'] . "'>" . $row['ime'] . "</option>";
		}
	}
	if ($vrsta == "3") {
		$sql = "SELECT * FROM usluge WHERE cena_usluge > 0";
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while ($row = $results->fetch_assoc()) {
			echo "<option value='". $row['usluge_id'] . "'data-cena='" . $row['cena_usluge']. "'>" . $row['naziv_usluge'] . "</option>";
		}
	} 	
}

/* AJAX ZA UNOS KALKULACIJE DETAILED */

if ($_POST['akcija'] == 'unosDetailed') {
	$vrsta = $_POST['vrsta'];
	$stavka = $_POST['stavkaID'];
	$cena = $_POST['cena'];
	$ukupno = $_POST['ukupno'];
	$datum = $_POST['datum'];
	$datum = date("Y-m-d H:i:s", strtotime($datum));
	$racunMainID = $_POST['racunMainID'];
	$kolicina = $_POST['kolicina'];	
	$racunDetId = $_POST['racunDetID'];
	$dkol = $_POST['dkol'];
	$staraKol = $_POST['staraKol'];
if ($_POST['racunDetID'] == '') {
	$sql = "INSERT INTO racunidetailed (d_racun_id, datum_racuna, cena, vrsta, ukupan_racun, kolicina, stavka) VALUES ('$racunMainID', '$datum', '$cena', '$vrsta', '$ukupno', '$kolicina', '$stavka')";
	$conn->query($sql);
		if ($_POST['vrsta'] == '2') {
			$sql1 = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$stavka'";
			$res1 = $conn->query($sql1);
			$row1 = $res1->fetch_assoc();			
			$stanje = $row1['kolicina'] - $kolicina;
			$sqlstanje = "UPDATE domacinstvo SET domacinstvo.kolicina = '$stanje' WHERE domacinstvo.domacinstvo_id = '$stavka'";			
			$conn->query($sqlstanje);			
		}
	} else {
		$sql = "UPDATE `racunidetailed` SET `datum_racuna` = '$datum', `cena` = '$cena', `vrsta` = '$vrsta', `stavka` = '$stavka', `kolicina` = '$kolicina', `ukupan_racun` = '$ukupno' WHERE rac_det_id = '$racunDetId'";
		$conn->query($sql);		
		if ($_POST['vrsta'] == '2') {
			$sql1 = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$stavka'";
			$res1 = $conn->query($sql1);
			$row1 = $res1->fetch_assoc();
			$stanje = $row1['kolicina'] - $kolicina + $staraKol;
			$sqlstanje = "UPDATE domacinstvo SET domacinstvo.kolicina = '$stanje' WHERE domacinstvo.domacinstvo_id = '$stavka'";			
			$conn->query($sqlstanje);			
		}
	}
	
		$sql = "SELECT domacinstvo.kolicina as dKol, domacinstvo.ime, usluge.naziv_usluge, racunidetailed.rac_det_id, racunidetailed.d_racun_id, racunidetailed.datum_racuna, racunidetailed.cena, racunidetailed.vrsta, racunidetailed.ukupan_racun, racunidetailed.kolicina, racunidetailed.stavka FROM `racunidetailed` LEFT JOIN usluge ON racunidetailed.stavka = usluge.usluge_id LEFT JOIN domacinstvo ON racunidetailed.stavka = domacinstvo.domacinstvo_id WHERE racunidetailed.d_racun_id = $racunMainID";
	
		
		$results = $conn->query($sql);
	
		while ($row = $results->fetch_assoc()) {		
		?>
	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['datum_racuna']?></td>
		<td style="vertical-align: middle;"><?=$row['kolicina']?></td>
		<td style="vertical-align: middle;"><?php if ($row['vrsta'] == 1) {
		echo $naziv = "Rezervacija";	
		} else if($row['vrsta'] == 2){
			echo "Suvenir";
			$naziv = $row['ime'];
		} else if ($row['vrsta'] == 3){
			echo "Usluga";
			$naziv = $row['naziv_usluge'];
		}?></td>
		<td style="vertical-align: middle;"><?=$naziv?></td>
		<td style="vertical-align: middle;"><?=$row['cena'] . "€"?></td>
		<td style="vertical-align: middle;"><?=$row['ukupan_racun'] . "€"?></td>
		<td style="width: 100px; vertical-align: middle;"><button class="btn btn-warning btn-sm EditDetPrikaz" style="margin-right: 10px; color: #fff;"
		data-id=<?=$row['rac_det_id']?>
		data-vrsta=<?=$row['vrsta']?>
		data-cena=<?=$row['cena']?>
		data-ukupno=<?=$row['ukupan_racun']?>
		data-kolicina="<?=$row['kolicina']?>"
		data-datum="<?=date("d.m.Y H:i:s", strtotime($row['datum_racuna']));?>"
		data-stavka=<?=$row['stavka']?> data-dkol=<?=$row['dKol']?>><i class="fas fa-edit"></i></button>
		<button class="btn btn-danger btn-sm rdDelete" data-id=<?=$row['rac_det_id']?> data-mid=<?=$row['d_racun_id']?> data-kol=<?=$row['kolicina']?>><i class="fas fa-trash"></i></td>
	</tr>
		
		<?php
		/*	if ($row['vrsta'] == '2') {
			$sql1 = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$stavka'";
			$res1 = $conn->query($sql1);
			$row1 = $res1->fetch_assoc();
			$stanje = $row1['kolicina'] - $kolicina;
			$sqlstanje = "UPDATE domacinstvo SET domacinstvo.kolicina = '$stanje' WHERE domacinstvo.domacinstvo_id = '$stavka'";			
			$conn->query($sqlstanje);			
			} */
		}	
	}

/* AJAX ZA PRETRAGU */

if ($_POST['akcija'] == 'pretragaRacuna') {
	$datumOd = date("Y-m-d H:i:s", strtotime($_POST['datumOd']));
	$datumDo = date("Y-m-d H:i:s", strtotime($_POST['datumDo']))	;
	$datumFake = date("Y-m-d H:i:s");
	$gost = $_POST['gost'];
	
	if ($gost == "") {
		$sqlgost = "";
	} else {
		$sqlgost = "AND guests.guests_id = '$gost'";
	}
	if ($datumOd == "1970-01-01 01:00:00" && $datumDo == "1970-01-01 01:00:00") {
		$sqlx = "";
	} else if ($datumOd != "1970-01-01 01:00:00" && $datumDo == "1970-01-01 01:00:00") {
		$sqlx = "AND racunimain.datum_izdavanja BETWEEN '$datumOd' AND '$datumFake'";
	} else if ($datumOd == "1970-01-01 01:00:00" && $datumDo != "1970-01-01 01:00:00") {
		$sqlx = "";
	} else {
		$sqlx = "AND racunimain.datum_izdavanja BETWEEN '$datumOd' AND '$datumDo'";
	}

	$sql = "SELECT * FROM racunimain LEFT JOIN guests ON racunimain.gost_id = guests.guests_id WHERE racun_id > 0 $sqlgost $sqlx ORDER BY broj_racuna ASC, broj_godine ASC";

	$results = $conn->query($sql);
	while ($row = $results->fetch_assoc()) {
?>	

	<tr <?=$row['racun_id']?> class="table-success">						
		<td style="vertical-align: middle;"><?=$row['broj_racuna'] . "/" . $row['broj_godine']?></td>
		<td style="vertical-align: middle;"><?=$row['ime'] . " " . $row['prezime']?></td>
		<td style="vertical-align: middle;"><?=date("d.m.Y H:i:s", strtotime($row['datum_izdavanja']));?></td>
		<td style="min-width: 130px; vertical-align: middle;"><button class="btn btn-warning racunEdit" style="margin-right: 10px; color: #fff;" data-toggle="modal" data-target="#racunModal" data-idrm= <?=$row['racun_id']?>
		data-gost = <?=$row['gost_id']?>
		data-broj = <?=$row['broj_racuna'] . "/" . $row['broj_godine']?>
		data-datum = "<?=date('d.m.Y H:i:s', strtotime($row['datum_izdavanja']));?>"
		
		><i class="fas fa-edit"></i></button><button class="btn btn-danger deleteRM" data-rmain=<?=$row['racun_id']?>><i class="fas fa-trash"></i></td>	
	</tr>
<?php	
	}
	
}
	/* BRISANJE RAČUNA MAIN */
	
if ($_POST['akcija'] == 'deleteRM') {
	
	$racun_id = $_POST['racun_id'];	
	$sql = "SELECT racunidetailed.kolicina, racunidetailed.stavka FROM racunidetailed WHERE d_racun_id = '$racun_id'";
	$results = $conn->query($sql);
	foreach ($results as $result) {
		$TRkolicina = $result['kolicina'];
		$stavka = $result['stavka'];
		if ($stavka == 19 || $stavka == 21) {
		$sql = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$stavka'";
	
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$stanje = $row['kolicina'];
		$ukupno = $stanje + $TRkolicina;
		$sqlnew = "UPDATE domacinstvo SET kolicina = '$ukupno' WHERE domacinstvo.domacinstvo_id = '$stavka'";
		$conn->query($sqlnew);
		}
	}
	$deleteDET = "DELETE FROM racunidetailed WHERE racunidetailed.d_racun_id = '$racun_id'";
	$conn->query($deleteDET);
	$delete = "DELETE FROM racunimain WHERE racun_id = '$racun_id'";
	$conn->query($delete);
	if ($conn->affected_rows) {
		echo "obrisana";
	}	

}


	/* $sql = "DELETE racunimain, racunidetailed FROM racunimain LEFT JOIN racunidetailed ON racunimain.racun_id = racunidetailed.d_racun_id WHERE racun_id = $racun_id";
	$conn->query($sql);
	if ($conn->affected_rows) {
		echo "obrisana";
	}	
} */
	/* BRISANJE RAČUNA DETAILED */
	
if ($_POST['akcija'] == 'brisanjeRD') {
	$kolicina = $_POST['kolicina'];
	$mid = $_POST['mid'];
	$id = $_POST['id'];
	
	$sqlkol = "SELECT racunidetailed.vrsta, racunidetailed.stavka FROM racunidetailed WHERE rac_det_id = '$id'";	
	$results = $conn->query($sqlkol);
	$row = $results->fetch_assoc();
	$stavka = $row['stavka'];
	$vrsta = $row['vrsta'];
	if ($vrsta == 2) {
		$sqlT = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$stavka'";
		$resT = $conn->query($sqlT);
		$rowT = $resT->fetch_assoc();
		$stanjeT = $rowT['kolicina'];
		$stanjeNT = $stanjeT + $kolicina;
		$sqlR = "UPDATE domacinstvo SET domacinstvo.kolicina = '$stanjeNT' WHERE domacinstvo.domacinstvo_id = '$stavka'";
		
		$conn->query($sqlR);	
	}
	
	$sql = "DELETE FROM racunidetailed WHERE rac_det_id = $id";
	$conn->query($sql);
	
	$prikaz = "SELECT domacinstvo.kolicina AS dKol, domacinstvo.ime, usluge.naziv_usluge, racunidetailed.rac_det_id, racunidetailed.d_racun_id, racunidetailed.datum_racuna, racunidetailed.cena, racunidetailed.vrsta, racunidetailed.ukupan_racun, racunidetailed.kolicina, racunidetailed.stavka FROM `racunidetailed` LEFT JOIN usluge ON racunidetailed.stavka = usluge.usluge_id LEFT JOIN domacinstvo ON racunidetailed.stavka = domacinstvo.domacinstvo_id WHERE racunidetailed.d_racun_id = $mid";	
	
	$results = $conn->query($prikaz);
	while ($row = $results->fetch_assoc()) {	
?>
	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['datum_racuna']?></td>
		<td style="vertical-align: middle;"><?=$row['kolicina']?></td>
		<td style="vertical-align: middle;"><?php if ($row['vrsta'] == 1) {
		echo $naziv = "Rezervacija";	
		} else if($row['vrsta'] == 2){
			echo "Suvenir";
			$naziv = $row['ime'];
		} else if ($row['vrsta'] == 3){
			echo "Usluga";
			$naziv = $row['naziv_usluge'];
		}?></td>
		<td style="vertical-align: middle;"><?=$naziv?></td>
		<td style="vertical-align: middle;"><?=$row['cena'] . "€"?></td>
		<td style="vertical-align: middle;"><?=$row['ukupan_racun'] . "€"?></td>
		<td style="min-width: 100px; vertical-align: middle;"><button style="margin-right: 10px; color: #fff;" class="btn btn-warning btn-sm EditDetPrikaz" 
		data-id=<?=$row['rac_det_id']?>
		data-vrsta=<?=$row['vrsta']?>
		data-cena=<?=$row['cena']?>
		data-ukupno=<?=$row['ukupan_racun']?>
		data-kolicina="<?=$row['kolicina']?>"
		data-datum="<?=date("d.m.Y H:i:s", strtotime($row['datum_racuna']));?>"
		data-stavka=<?=$row['stavka']?> data-dkol=<?=$row['dKol']?>><i class="fas fa-edit"></i></button>
		<button class="btn btn-danger btn-sm rdDelete" data-id=<?=$row['rac_det_id']?> data-mid=<?=$row['d_racun_id']?> data-kol=<?=$row['kolicina']?>><i class="fas fa-trash"></i></td>
	</tr>
	
<?php

		}
	}
		
	/* POPUNJAVANJE DETAILED TABELE ZA EDIT */

if ($_POST['akcija'] == 'tabelaPop') {
	$id = $_POST['idRM'];
	
	$sql = "SELECT domacinstvo.kolicina AS dKol, domacinstvo.ime, usluge.naziv_usluge, racunidetailed.rac_det_id, racunidetailed.d_racun_id, racunidetailed.datum_racuna, racunidetailed.cena, racunidetailed.vrsta, racunidetailed.ukupan_racun, racunidetailed.kolicina, racunidetailed.stavka FROM `racunidetailed` LEFT JOIN usluge ON racunidetailed.stavka = usluge.usluge_id LEFT JOIN domacinstvo ON racunidetailed.stavka = domacinstvo.domacinstvo_id WHERE racunidetailed.d_racun_id = $id";	
	
	$results = $conn->query($sql);
	while ($row = $results->fetch_assoc()){
?>
	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['datum_racuna']?></td>
		<td style="vertical-align: middle;"><?=$row['kolicina']?></td>
		<td style="vertical-align: middle;"><?php if ($row['vrsta'] == 1) {
		echo $naziv = "Rezervacija";	
		} else if($row['vrsta'] == 2){
			echo "Suvenir";
			$naziv = $row['ime'];
		} else if ($row['vrsta'] == 3){
			echo "Usluga";
			$naziv = $row['naziv_usluge'];
		}?></td>
		<td style="vertical-align: middle;"><?=$naziv?></td>
		<td style="vertical-align: middle;"><?=$row['cena'] . "€"?></td>
		<td style="vertical-align: middle;"><?=$row['ukupan_racun'] . "€"?></td>
		<td style="min-width: 100px; vertical-align: middle;"><button style="margin-right: 10px; color: #fff;" class="btn btn-warning btn-sm EditDetPrikaz" 
		data-id=<?=$row['rac_det_id']?>
		data-vrsta=<?=$row['vrsta']?>
		data-cena=<?=$row['cena']?>
		data-ukupno=<?=$row['ukupan_racun']?>
		data-kolicina="<?=$row['kolicina']?>"
		data-datum="<?=date("d.m.Y H:i:s", strtotime($row['datum_racuna']));?>"
		data-stavka=<?=$row['stavka']?> data-dkol=<?=$row['dKol']?>><i class="fas fa-edit"></i></button><button class="btn btn-danger btn-sm rdDelete" data-id=<?=$row['rac_det_id']?>  data-mid=<?=$row['d_racun_id']?> data-kol=<?=$row['kolicina']?>><i class="fas fa-trash"></i></td>
	</tr>

<?php		
	}
	
}
/* PRIKAZ SELECTA */

if ($_POST['akcija'] == 'popunjavanjeSelecta') {
	$vrsta = $_POST['vrsta'];
	$gost = $_POST['gostID'];
	if ($vrsta == "1") {
		$sql = "SELECT * FROM rezervacije LEFT JOIN sobe ON rezervacije.soba_id = sobe.sobe_id LEFT JOIN sobatip ON sobe.tip_sobe = sobatip.tipsobe_id WHERE rezervacije.gost_id = '$gost'";		
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while($row=$results->fetch_assoc()) {
			$dani = strtotime($row['datum_do'])  - strtotime($row['datum_od']);
			
			$dani = date("d", $dani);					
			$dani = ltrim($dani, '0');			
			
			echo "<option value='" . $row['rezervacije_id'] . "' data-cena='" . $row['cena_sobe'] . "' data-dani='" . $dani . "'>" . $row['rezervacije_id'] . " : " . $row['naziv_sobe'] . " Broj sobe: " . $row['broj_sobe'] . "</option>";		
		}
	}		
	if ($vrsta == "2") {
		$sql = "SELECT * FROM domacinstvo WHERE suvenir = 1";
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while ($row=$results->fetch_assoc()){
			echo "<option value='". $row['domacinstvo_id'] . "'data-cena='" . $row['suv_prodajna'] . "'>" . $row['ime'] . "</option>";
		}
	}
	if ($vrsta == "3") {
		$sql = "SELECT * FROM usluge WHERE cena_usluge > 0";
		$results = $conn->query($sql);
		echo "<option>Izaberi...</option>";
		while ($row = $results->fetch_assoc()) {
			 echo "<option value='". $row['usluge_id'] . "' data-cena='" . $row['cena_usluge']. "'>" . $row['naziv_usluge'] . "</option>";
		}
	} 	
}

?>
