<?php

	include '../dbconnect.php';
	include '../inc/functions.php';

	/* AJAX ZA PRETRAGU */

	if ($_POST['akcija'] == 'pretragaKorisnika') {
		$pretraga = filter_var($_POST['pretraga'], FILTER_SANITIZE_STRING);
		$filter = $_POST['filter'];
	
		if ($filter == 2) {
			$filter = "";
		} else {
			$filter = "AND admin = '$filter'";
		}
	
	
	if ($pretraga == "") {
		$pret = "";
	} else {
		$pret = "AND ime LIKE '%$pretraga%' OR prezime LIKE '%$pretraga%' OR radnik_id = " . (int)$pretraga;
	}
	
	$sql = "SELECT * FROM radnici WHERE radnik_id > 0 $filter $pret";
	$results = $conn->query($sql);
	
	while ($row = $results->fetch_assoc()){
?>
		<tr class="table-success">
			<td style="vertical-align: middle;"><?=$row['ime']?></td>
			<td style="vertical-align: middle;"><?=$row['prezime']?></td>
			<td style="vertical-align: middle;"><?=$row['username']?></td>
			<td style="vertical-align: middle;"><?=$row['e_mail']?></td>
			<td style="vertical-align: middle; min-width: 130px;">
			<button class="btn btn-warning edit" style="margin-right: 10px; color: #fff;" data-toggle="modal" data-target="#exampleModalCenter"
			data-id = <?=$row['radnik_id']?>
			data-ime = <?=$row['ime']?>
			data-prezime = <?=$row['prezime']?>
			data-kor = <?=$row['username']?>
			data-mail = <?=$row['e_mail']?>
			data-pass = <?=$row['password']?>
			data-status = <?=$row['admin']?>><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger delete" data-id = <?=$row['radnik_id']?>><i class="fas fa-trash" ></i></button>
			</td>
		</tr>
		
<?php
		}

	}

	/* PROMENA ŠIFRE */

	if ($_POST['akcija'] == 'menjanjeSifre') {
		$novaS = $_POST['novaSifra'];
		$novaSRpt = $_POST['novaSifraRpt'];
		$hash = $_SESSION['hash'];	
		
		if ($novaS != $novaSRpt) {
			echo "Greška!";
		} else {
			$sql = "UPDATE radnici SET password = '$novaSRpt' WHERE hash = '$hash'";	
			$conn->query($sql);
			if ($conn->affected_rows) {
				echo "promenauspesna";
			}
		}
	}

	/* UNOS NOVOG KORISNIKA */

	if ($_POST['akcija'] == 'unosKor') {
		
		$ime = filter_var($_POST['ime'], FILTER_SANITIZE_STRING);
		$prezime = filter_var($_POST['prezime'], FILTER_SANITIZE_STRING);
		$korIme = filter_var($_POST['korIme'], FILTER_SANITIZE_STRING);
		$sifra = filter_var($_POST['sifra'], FILTER_SANITIZE_STRING);
		$mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
		$status = $_POST['status'];
		$datum = date('Y-m-d');
		$hash = hashing();
		
		$sql = "INSERT INTO radnici(ime, prezime, username, password, e_mail, datum_registracije, admin, hash) VALUES('$ime', '$prezime', '$korIme', '$sifra', '$mail', '$datum', '$status', '$hash')";
		$conn->query($sql);
		print_r($sql);
		die();
		
		echo "uneseno";
	}

	
	/* IZMENA KORISNIKA */

	if ($_POST['akcija'] == 'edit') {
		$id = $_POST['radnik_id'];
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$kor = $_POST['korIme'];
		$sifra =  $_POST['sifra'];
		$mail = $_POST['mail'];
		$status = $_POST['status'];
		$sql = "UPDATE radnici SET ime = '$ime', prezime = '$prezime', username = '$kor', password = '$sifra', e_mail = '$mail', admin = '$status' WHERE radnik_id = '$id'";
		$conn->query($sql);		
	}
	/* BRISANJE KORISNIKA */
	
	if ($_POST['akcija'] == 'brisanje') {
		$id = $_POST['id'];
		$sql = "DELETE FROM radnici WHERE radnik_id = '$id'";
		$conn->query($sql);
		echo "obrisan";
	}
?>


