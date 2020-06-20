<?php 

include 'dbconnect.php';


if ($_POST['akcija'] == 'test') {
	$datum = $_POST['datum'];
	$datum = strtotime($datum);
	$datum = date("Y", $datum);

	$sql = "SELECT MAX(broj_fakture) AS broj FROM kalkulacijemain WHERE broj_godine = '$datum'";
	
	$res = $conn->query($sql);
	
	$red = $res->fetch_assoc();
	$br = $red['broj'] + 1;
	echo $br . "/" . $datum;	
}

if ($_POST['akcija'] == 'unosKalk') {
	$datum = $_POST['datum'];
	$dobavljac = $_POST['dobavljac'];
	$napomena = $_POST['napomena'];
	$brojgodine = strtotime($datum);
	$datumClean = strtotime($datum);
	$brojgodine = date("Y", $brojgodine);
	$datumClean = date('Y-m-d', $datumClean);

	$sqlbr = "SELECT MAX(broj_fakture) AS broj FROM kalkulacijemain WHERE broj_godine = '$brojgodine'";
	
	$res = $conn->query($sqlbr);
	$red = $res->fetch_assoc();
	$broj_fakture = $red['broj'] + 1;
	
	
	$sql = "INSERT INTO kalkulacijemain(`dobavljaci_id`, `datum_prijema`, `broj_fakture`, `broj_godine`, `napomena`) VALUES ('$dobavljac', '$datumClean', '$broj_fakture', '$brojgodine', '$napomena')";

	$res = $conn->query($sql);
	
	if ($conn->affected_rows) {
		$sql = "SELECT MAX(racun_id) as id FROM kalkulacijemain";
		$res = $conn->query($sql);
		$red = $res->fetch_assoc();
		echo $red['id'];		
	}
	
}		

if ($_POST['akcija'] == 'brisanje') {
	$kalkulacije_id = $_POST['kalkulacije_id'];	
	$sql = "SELECT kalkulacijedetailed.domacinstvo_id AS ddom, kalkulacijedetailed.kolicina FROM kalkulacijedetailed WHERE kalkulacijedetailed.racun_id = '$kalkulacije_id'";
	$results = $conn->query($sql);	
	foreach($results as $result) {
		$TRkolicina = $result['kolicina'];
		$domacinstvo_id = $result['ddom'];
		$sql = "SELECT domacinstvo.kolicina FROM domacinstvo WHERE domacinstvo.domacinstvo_id = '$domacinstvo_id'";		
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$stanje = $row['kolicina'];
		$ukupno = $stanje - $TRkolicina;
		$sql1 = "UPDATE domacinstvo SET domacinstvo.kolicina= '$ukupno' WHERE domacinstvo.domacinstvo_id = '$domacinstvo_id'";	
		$conn->query($sql1);		
	}	
	
	$deleteDET = "DELETE FROM kalkulacijedetailed WHERE kalkulacijedetailed.racun_id = '$kalkulacije_id'";
	$conn->query($deleteDET);
		
	$delete = "DELETE FROM kalkulacijemain WHERE racun_id = $kalkulacije_id";
	
	$conn->query($delete);
	echo "obrisana";
	 /*if ($conn->affected_rows) {
		
		$sql1 = "SELECT kolicina as kdKol, domacinstvo_id FROM kalkulacijedetailed WHERE racun_id = '$kalkulacije_id'";		
		
		$res1 = $conn->query($sql1);
		$row1 = $res1->fetch_assoc();
		$kol = $row1['kdKol'];
		$dom = $row1['domacinstvo_id'];
		
		
		$sql = "DELETE FROM kalkulacijedetailed WHERE racun_id = '$kalkulacije_id'";
		$conn->query($sql);
		if($conn->affected_rows) {
			$sql2 = "SELECT kolicina as dKol FROM domacinstvo WHERE domacinstvo_id = '$dom'";
			
			$res2 = $conn->query($sql2);
			$row2 = $res2->fetch_assoc();
			$stanje = $row2['dKol'];			
			$stanje = $stanje - $kol;		
			$sql = "UPDATE `domacinstvo` SET kolicina ='$stanje' WHERE domacinstvo.domacinstvo_id = '$dom'";
			$conn->query($sql);
		} 
	}	*/
	
}		
/*	if ($conn->affected_rows) {
	$sql1 = "SELECT kolicina, domacinstvo_id FROM kalkulacijedetailed WHERE racun_id = '$kalkulacije_id'";
	$res = $conn->query($sql1);
	$row1 = $res->fetch_assoc();
	$kol = $row1['kolicina'];
	$dom = $row1['domacinstvo_id'];
	$sql = "DELETE FROM kalkulacijedetailed WHERE racun_id = '$kalkulacije_id'";
	$conn->query($sql);
	if ($conn->affected_rows) {
		$sql1 = "SELECT kolicina FROM domacinstvo WHERE domacinstvo_id = '$dom'";
		$res1 = $conn->query($sql1);
		$row1 = $res1->fetch_assoc();
		$stanje = $row1['kolicina'];
		$stanje = $stanje - $kol;
		$sql = "UPDATE domacinstvo SET kolicina = '$stanje' WHERE domacinstvo_id = '$dom'";
		$conn->query($sql);
		
		}
	} */


/* AJAX ZA EDIT */	

if ($_POST['akcija'] == 'edit') {
	$racun_id = $_POST['racun_id'];
	$dobavljaci_id = $_POST['dobavljac'];
	$datum = $_POST['datum'];
	$datumClean = strtotime($datum);
	$datumClean = date('Y-m-d', $datumClean);
	$napomena = $_POST['napomena'];	
	$godina = date("Y", strtotime($datum));
	
	
	$sql_select = "SELECT broj_godine FROM kalkulacijemain WHERE racun_id = '$racun_id'";
	
	$results1 = $conn->query($sql_select);
	
	$red1 = $results1->fetch_assoc();
	if ($godina == $red1['broj_godine']) {
		$sqlgod = "";
	} else {
		$sql2 = "SELECT MAX(broj_fakture) AS broj FROM kalkulacijemain WHERE broj_godine = '$godina'";
		$results2 = $conn->query($sql2);
		$red2 = $results2->fetch_array();
		$br = $red2['broj'] + 1;
		$sqlgod = "broj_godine = '$godina', broj_fakture = '$br', "; 
				
	}
	
	$sql = "UPDATE `kalkulacijemain` SET `dobavljaci_id`='$dobavljaci_id', `datum_prijema`='$datumClean', `napomena`='$napomena' WHERE racun_id = '$racun_id'";
   
	$conn->query($sql);
	if ($conn->affected_rows) {
		$sql = "SELECT * FROM kalkulacijemain WHERE racun_id = '$racun_id'";
		$results = $conn->query($sql);
		$red = $results->fetch_assoc();
		$faktura = $red['broj_fakture'] . "/" . $red['broj_godine'];
		echo $faktura; 
	} else {
		echo "Failed";
	}	
	$sql_1 = "SELECT kalkulacijemain.dobavljaci_id, kalkulacijemain.racun_id, kalkulacijemain.datum_prijema, kalkulacijemain.broj_fakture, kalkulacijemain.broj_godine, kalkulacijemain.napomena, dobavljaci.dobavljaci_id, dobavljaci.ime FROM kalkulacijemain LEFT JOIN dobavljaci ON kalkulacijemain.dobavljaci_id = dobavljaci.dobavljaci_id";
	$edited = $conn->query($sql_1);
}

?>


<?php		
	 

/* AJAX ZA UNOS NOVOG DOBAVLJACA (SELECT) */ 

if($_POST['akcija'] == 'insert_dob') {
	
	$ime = $_POST['ime'];
	
	$sql = "INSERT INTO `dobavljaci`(`ime`) VALUES ('$ime')";
	$conn->query($sql);
	

		$sql1 = "SELECT * FROM dobavljaci";
		
?>

		<option>Izaberi...</option>
		<option class="dobShow" type="button" value='novi_dob'>Novi dobavljač: </option>	
		

<?php
		$results = $conn->query($sql1);
		while ($red = $results->fetch_assoc()) {
		
?>
		<option value="<?=$red['dobavljaci_id'];?>"><?=$red['ime'];?>			
		</option>

<?php
		}
				
	}	
/* AJAX ZA UNOS KALKULACIJE DETAILED */

if ($_POST['akcija'] == 'kdet_insert') {
	$domacinstvo = $_POST['domacinstvo'];
	$kolicina = $_POST['kolicina'];	
	$nabavna = $_POST['nabavna'];
	$rabat = $_POST['rabat'];
	$pdv = $_POST['pdv'];
	$marza = $_POST['marza'];
	$prodajna = $_POST['prodajna'];
	$racun_id = $_POST['racun_id'];
	$kalkDetId = $_POST['kalk_det_id'];
	$dKol = $_POST['dkol'];
	$staraKol = $_POST['staraKol'];
	
if ($_POST['kalk_det_id'] == '' && $domacinstvo != '') { 
	$sql = "INSERT INTO `kalkulacijedetailed`(`kalk_det_id`, `racun_id`, `kolicina`, `nabavnacena`, `prodajnacena`, `domacinstvo_id`, `marza`, `pdv`, `rabat`) VALUES ('', '$racun_id', '$kolicina', '$nabavna', '$prodajna', '$domacinstvo', '$marza', '$pdv', '$rabat')";
	
	$conn->query($sql);
	
	if ($conn->affected_rows) {
		$sql1 = "SELECT kolicina FROM domacinstvo WHERE domacinstvo_id = $domacinstvo";
		$results1 = $conn->query($sql1);
		$red = $results1->fetch_assoc();
		$stanje = $red['kolicina'];
		
		if ($kolicina != '') {
		$novo_stanje = $stanje + $kolicina;
		
		$sql2 = "UPDATE domacinstvo SET kolicina = '$novo_stanje' WHERE domacinstvo_id = $domacinstvo";
		$conn->query($sql2);
		}	
		/*$sql3 = "SELECT * FROM kalkulacijedetailed WHERE racun_id = $racun_id";*/
	}
} else {

		$sql = "UPDATE `kalkulacijedetailed` SET `kolicina`='$kolicina',`nabavnacena`='$nabavna',`prodajnacena`='$prodajna',`domacinstvo_id`='$domacinstvo',`marza`='$marza',`pdv`='$pdv',`rabat`='$rabat' WHERE kalk_det_id = '$kalkDetId'";
		
		$conn->query($sql);
		if ($conn->affected_rows) {
			$novoStanje = $dKol - $staraKol + $kolicina;
			$sql2 = "UPDATE domacinstvo SET domacinstvo.kolicina = '$novoStanje' WHERE domacinstvo.domacinstvo_id = '$domacinstvo'";
			$conn->query($sql2);
		}
}
		
		$prikaz = "SELECT domacinstvo.kolicina as dKol, kalkulacijedetailed.kalk_det_id, kalkulacijedetailed.racun_id, kalkulacijedetailed.kolicina, kalkulacijedetailed.nabavnacena, kalkulacijedetailed.prodajnacena, kalkulacijedetailed.domacinstvo_id, kalkulacijedetailed.marza, kalkulacijedetailed.pdv, kalkulacijedetailed.rabat, domacinstvo.domacinstvo_id, domacinstvo.ime FROM kalkulacijedetailed LEFT JOIN domacinstvo ON kalkulacijedetailed.domacinstvo_id = domacinstvo.domacinstvo_id WHERE racun_id = $racun_id";
	
		
		$results = $conn->query($prikaz);
		
		while($row = $results->fetch_assoc()) {	
				
?>

	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['kolicina'];?></td>
		<td style="vertical-align: middle;"><?=$row['nabavnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['prodajnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['ime'];?></td>
		<td style="vertical-align: middle;"><?=$row['marza'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['pdv'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['rabat'] . "%";?></td>
		<td style="min-width: 100px; vertical-align: middle;">
			<button class="btn btn-warning btn-sm editDet" style="color: #fff;" data-id="<?=$row['kalk_det_id']?>" 
			data-kolicina="<?=$row['kolicina'];?>"				
			data-nabavna="<?=$row['nabavnacena'];?>" 
			data-prodajna=<?=$row['prodajnacena'];?> 
			data-domacinstvo_id=<?=$row['domacinstvo_id'];?> 
			data-marza=<?=$row['marza'];?> 
			data-pdv=<?=$row['pdv'];?> 
			data-rabat=<?=$row['rabat'];?>
			data-dkol=<?=$row['dKol']?>><i class="fas fa-edit"></i></button>
			<button style='margin-left: 10px'class="btn btn-danger btn-sm kalkDetDel" id='kalkDetDel' data-id=<?=$row['kalk_det_id']?> data-main=<?=$row['racun_id']?> data-kol=<?=$row['kolicina']?> data-dom=<?=$row['domacinstvo_id']?>><i class="fas fa-trash"></i></button>
		</td>
	</tr>	

				
<?php	
		}
}		
/* AJAX ZA DELETE KALK DETAILED IZ INSERTA */







/*AJAX ZA POPUNJAVANJE TABELE INICIJALNO */

if ($_POST['akcija'] == 'popTab') {
	$racun_id = $_POST['racun_id'];
	
	$sql = "SELECT domacinstvo.kolicina as dKol, kalkulacijedetailed.kalk_det_id, kalkulacijedetailed.racun_id, kalkulacijedetailed.kolicina, kalkulacijedetailed.nabavnacena, kalkulacijedetailed.prodajnacena, kalkulacijedetailed.domacinstvo_id, kalkulacijedetailed.marza, kalkulacijedetailed.pdv, kalkulacijedetailed.rabat, domacinstvo.domacinstvo_id, domacinstvo.ime FROM kalkulacijedetailed LEFT JOIN domacinstvo ON kalkulacijedetailed.domacinstvo_id = domacinstvo.domacinstvo_id WHERE racun_id = $racun_id";
		
	$prikaz = $conn->query($sql);
	while ($row = $prikaz->fetch_assoc()) {
		
?>
	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['kolicina'];?></td>
		<td style="vertical-align: middle;"><?=$row['nabavnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['prodajnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['ime'];?></td>
		<td style="vertical-align: middle;"><?=$row['marza'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['pdv'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['rabat'] . "%";?></td>
		<td style="min-width: 100px; vertical-align: middle;">
			<button class="btn btn-warning btn-sm editDet" style="color: #fff" data-id="<?=$row['kalk_det_id']?>" 
			data-kolicina="<?=$row['kolicina'];?>"				
			data-racunId="<?=$row['racun_id'];?>"				
			data-nabavna="<?=$row['nabavnacena'];?>" 
			data-prodajna=<?=$row['prodajnacena'];?> 
			data-domacinstvo_id=<?=$row['domacinstvo_id'];?> 
			data-marza=<?=$row['marza'];?> 
			data-pdv=<?=$row['pdv'];?> 
			data-rabat=<?=$row['rabat'];?>
			data-stanje=<?=$row['dKol']?>><i class="fas fa-edit"></i></button>
			<button style='margin-left: 10px' class="btn btn-danger btn-sm kalkDetDel" id='kalkDetDel' data-id=<?=$row['kalk_det_id']?> data-kol=<?=$row['kolicina']?> data-dom=<?=$row['domacinstvo_id']?>><i class="fas fa-trash"></i></button>
		</td>
	</tr>	


<?php		
	}
	
}


/* AJAX ZA BRISANJE KALKULACIJE DETAILED */


if ($_POST['akcija'] == 'brisanjeKDET') {
	$kalk_id = $_POST['kalkId'];
	$kalkMainId = $_POST['kalkMain'];
	$kolicina = $_POST['kolicina'];
	$dom = $_POST['dom'];
	$sql = "DELETE FROM kalkulacijedetailed WHERE kalk_det_id = '$kalk_id'";
	$conn->query($sql);
	
	if ($conn->affected_rows) {
		
		$sql3 = "SELECT kolicina, domacinstvo_id FROM domacinstvo WHERE domacinstvo_id = '$dom'";
		$results1 = $conn->query($sql3);
		$row1 = $results1->fetch_assoc();
		$stanje = $row1['kolicina'];
		$dom_id = $row1['domacinstvo_id'];
		$stanje = $stanje - $kolicina;
		$sqlBase = "UPDATE domacinstvo SET kolicina = '$stanje' WHERE domacinstvo_id = $dom";
	
		
		$conn->query($sqlBase);
	}
	$sql2 = "SELECT kalkulacijedetailed.kalk_det_id, kalkulacijedetailed.racun_id, kalkulacijedetailed.kolicina, kalkulacijedetailed.nabavnacena, kalkulacijedetailed.prodajnacena, kalkulacijedetailed.domacinstvo_id, kalkulacijedetailed.marza, kalkulacijedetailed.pdv, kalkulacijedetailed.rabat, domacinstvo.domacinstvo_id, domacinstvo.ime FROM kalkulacijedetailed LEFT JOIN domacinstvo ON kalkulacijedetailed.domacinstvo_id = domacinstvo.domacinstvo_id WHERE racun_id = $kalkMainId";
		
	$prikaz = $conn->query($sql2);
	while ($row = $prikaz->fetch_assoc()) {
?>


	<tr class="table-success">
		<td style="vertical-align: middle;"><?=$row['kolicina'];?></td>
		<td style="vertical-align: middle;"><?=$row['nabavnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['prodajnacena'] . "€";?></td>
		<td style="vertical-align: middle;"><?=$row['ime'];?></td>
		<td style="vertical-align: middle;"><?=$row['marza'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['pdv'] . "%";?></td>
		<td style="vertical-align: middle;"><?=$row['rabat'] . "%";?></td>
		<td style="min-width: 100px; vertical-align: middle;">
			<button class="btn btn-warning btn-sm editDet" style="color: #fff;" data-id="<?=$row['kalk_det_id']?>" 
			data-kolicina="<?=$row['kolicina'];?>"				
			data-nabavna="<?=$row['nabavnacena'];?>" 
			data-prodajna=<?=$row['prodajnacena'];?> 
			data-domacinstvo_id=<?=$row['domacinstvo_id'];?> 
			data-marza=<?=$row['marza'];?> 
			data-pdv=<?=$row['pdv'];?> 
			data-rabat=<?=$row['rabat'];?>><i class="fas fa-edit"></i></button>
			<button style='margin-left: 10px' class="btn btn-danger btn-sm kalkDetDel" id='kalkDetDel' data-id=<?=$row['kalk_det_id']?> data-kol=<?=$row['kolicina']?> data-dom=<?=$row['domacinstvo_id']?>><i class="fas fa-trash"></i></button>
		</td>
	</tr>	
	
<?php		
	}	
	
}

/*AJAX ZA SEARCH */

if ($_POST['akcija'] == 'pretragaK') {
	
	$datumOd = date("Y-m-d", strtotime($_POST['datumOd']));
	$datumDo = date("Y-m-d", strtotime($_POST['datumDo']));
	$dobavljac = $_POST['dobavljac'];
	$datumFake = date("Y-m-d");		
	if ($dobavljac == '') {
		$dobavljacsql = "";
	} else {
		$dobavljacsql = "AND dobavljaci.dobavljaci_id = '$dobavljac'";		
	}
	
	if ($datumOd=="1970-01-01" && $datumDo=="1970-01-01") {
		$sqlx = "";
	} else if ($datumOd!="1970-01-01" && $datumDo=="1970-01-01") {
		$sqlx = "AND datum_prijema BETWEEN '$datumOd' AND '$datumFake'";
	} else if ($datumOd == "1970-01-01" && $datumDo!="1970-01-01") {
		$sqlx = "AND datum_prijema BETWEEN '1970-01-01' AND '$datumDo'";
	} else {
		$sqlx = "AND datum_prijema BETWEEN '$datumOd' AND '$datumDo'";
	}
	
	$sql = "SELECT kalkulacijemain.racun_id, kalkulacijemain.dobavljaci_id, dobavljaci.ime, dobavljaci.dobavljaci_id, kalkulacijemain.datum_prijema, kalkulacijemain.broj_fakture, kalkulacijemain.broj_godine, kalkulacijemain.napomena, SUM(kalkulacijedetailed.prodajnacena) as pdc FROM kalkulacijemain LEFT JOIN dobavljaci ON kalkulacijemain.dobavljaci_id = dobavljaci.dobavljaci_id LEFT JOIN kalkulacijedetailed ON kalkulacijemain.racun_id = kalkulacijedetailed.racun_id WHERE kalkulacijemain.racun_id > 0 $dobavljacsql $sqlx GROUP BY kalkulacijemain.racun_id ORDER BY kalkulacijemain.broj_fakture ASC";
	$res = $conn->query($sql);
	while ($red = $res->fetch_assoc()) {
		?>
		<tr class="table-success">
			<td style="vertical-align: middle;"><?=$red['broj_fakture'] . "/" . $red['broj_godine']?></td>
			<td style="vertical-align: middle;"><?=$red['ime']?></td>			
			<td style="vertical-align: middle;"><?=$red['datum_prijema']?></td>
			<td style="vertical-align: middle;"><?php if (!$red['pdc']) { 
			echo "0€"; } else {	echo number_format($red['pdc'], 2) . "€";} ?></td>
			<td style="vertical-align: middle;"><?=$red['napomena']?></td>
			<td style="min-width: 220px; vertical-align: middle;">
			<button class="btn btn-warning edit" type='button' name='edit' value='edit' id='edit' style='margin-right: 10px; color: #fff;' data-toggle="modal" data-target=".bd-example-modal-lg"
			data-id="<?=$red['racun_id']?>"
			data-a="<?=$red['dobavljaci_id']?>"
			data-b="<?=date('d.m.Y', strtotime($red['datum_prijema']))?>"
			data-c="<?=$red['napomena']?>"
			data-d="<?=$red['broj_fakture'] . "/" . $red['broj_godine']?>">	
			<i class="fas fa-edit"></i> Prikaz</button>		
			<button class="btn btn-danger delete" type='button' name='delete' value='delete' id='delete' data-id="<?=$red['racun_id']?>"><i class="fas fa-trash"></i>  Obriši</button>		
			</td>
		</tr>	
<?php 	
	}	
	
}

?>
