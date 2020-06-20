<?php
include 'dbconnect.php';

/* AJAX ZA INSERT */


if ($_POST['akcija'] == 'insert') {
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$e_mail = $_POST['e-mail'];	
	$telefon = $_POST['broj_telefona'];
	$pozicija = $_POST['pozicija'];
	$slika = $_FILES['filetoupload']['name'];
	$filetmpname = $_FILES['filetoupload']['tmp_name'];
	$folder = 'uploads/cv_slike/';
	move_uploaded_file($filetmpname, $folder.$slika);
	
	$insert = "INSERT INTO `zaposleni`(`radnik_id`, `ime`, `prezime`, `e_mail`, `slika`, `broj_telefona`, `pozicija`) VALUES (null, '$ime', '$prezime', '$e_mail', '$slika', '$telefon', '$pozicija')";
	
	
	$results = $conn->query($insert);
	$i=1;
	
	$sql = "SELECT * FROM zaposleni";
	$results2 = $conn->query($sql);
	while ($red = $results2->fetch_assoc()) {

?>


<tr>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['ime'];?></td>
	<td style='vertical-align: middle;'><?=$red['prezime'];?></td>
	<td style='vertical-align: middle;'><?=$red['e_mail'];?></td>
	<td style='vertical-align: middle;'><img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='50' width='50' data-html="true" data-toggle='tooltip' title="<img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='150' width='150'>"></td>
	<td style='vertical-align: middle;'><?=$red['broj_telefona'];?></td>
	<td style='vertical-align: middle;'><?=$red['pozicija'];?></td>
	<td style='vertical-align: middle; min-width: 130px'>		
		<button class="btn btn-warning edit" type='button' name='edit' id='edit' style='margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['radnik_id']?>"		
		data-id="<?=$red['radnik_id'];?>"
		data-a="<?=$red['ime'];?>"
		data-b="<?=$red['prezime'];?>"
		data-c="<?=$red['e_mail'];?>"
		data-d="<?=$red['slika'];?>"
		data-e="<?=$red['broj_telefona'];?>"		
		data-f="<?=$red['pozicija'];?>">		
		<i class="fas fa-edit"></i>		
		</button>
		<button class="btn btn-danger delete" name='delete' data-id="<?=$red['radnik_id']?>" id='delete'><i class="fas fa-trash"></i></button>
	</td>	
</tr>

<?php		
	}

}	
/* AJAX ZA SEARCH */


if ($_POST['akcija'] == 'search') {
	
	
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	if ($search == '') {
		$sql_search = "SELECT * FROM zaposleni";
	}
	else {
		$sql_search = "SELECT * FROM zaposleni WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%' OR e_mail LIKE '%$search%' OR broj_telefona LIKE '%$search%' OR pozicija LIKE '%$search%'"; 
		
	}
	
	$results = $conn->query($sql_search);
	$i = 1;
	while ($red = $results->fetch_assoc()) {
	
?>	

<tr>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['ime'];?></td>
	<td style='vertical-align: middle;'><?=$red['prezime'];?></td>
	<td style='vertical-align: middle;'><?=$red['e_mail'];?></td>
	<td style='vertical-align: middle;'><img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='50' width='50' data-html="true" data-toggle='tooltip' title="<img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='150' width='150'>"></td>
	<td style='vertical-align: middle;'><?=$red['broj_telefona'];?></td>
	<td style='vertical-align: middle;'><?=$red['pozicija'];?></td>
	<td style='vertical-align: middle; min-width: 130px'>		
		<button class="btn btn-warning edit" type='button' name='edit' id='edit' style='max-width:100px; margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['radnik_id']?>"		
		data-id="<?=$red['radnik_id'];?>"
		data-a="<?=$red['ime'];?>"
		data-b="<?=$red['prezime'];?>"
		data-c="<?=$red['e_mail'];?>"
		data-d="<?=$red['slika'];?>"
		data-e="<?=$red['broj_telefona'];?>"		
		data-f="<?=$red['pozicija'];?>">		
		<i class="fas fa-edit"></i>		
		</button>
		<button class="btn btn-danger delete" name='delete' data-id="<?=$red['radnik_id']?>" id='delete'><i class="fas fa-trash"></i></button>
	</td>	
</tr>


<?php
	}
}
/* AJAX ZA DELETE */

	if ($_POST['akcija'] == 'brisanje') {
		
		$radnik_id = $_POST['radnik_id'];
		
		
		$delete = "DELETE FROM zaposleni where radnik_id = $radnik_id";
		
		$conn->query($delete); 
		
		$prikaz = "SELECT * FROM zaposleni";
		
		$results = $conn->query($prikaz);
		
		$i = 1;
		while ($red = $results->fetch_assoc()) {
			
?>			
	
<tr>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['ime'];?></td>
	<td style='vertical-align: middle;'><?=$red['prezime'];?></td>
	<td style='vertical-align: middle;'><?=$red['e_mail'];?></td>
	<td style='vertical-align: middle;'><img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='50' width='50' data-html="true" data-toggle='tooltip' title="<img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='150' width='150'>"></td>
	<td style='vertical-align: middle;'><?=$red['broj_telefona'];?></td>
	<td style='vertical-align: middle;'><?=$red['pozicija'];?></td>
	<td style='vertical-align: middle; min-width: 130px'>		
		<button class="btn btn-warning edit" type='button' name='edit' id='edit' style='max-width:100px; margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['radnik_id']?>"		
		data-id="<?=$red['radnik_id'];?>"
		data-a="<?=$red['ime'];?>"
		data-b="<?=$red['prezime'];?>"
		data-c="<?=$red['e_mail'];?>"
		data-d="<?=$red['slika'];?>"
		data-e="<?=$red['broj_telefona'];?>"		
		data-f="<?=$red['pozicija'];?>">		
		<i class="fas fa-edit"></i>		
		</button>
		<button class="btn btn-danger delete" name='delete' data-id="<?=$red['radnik_id']?>" id='delete'><i class="fas fa-trash"></i></button>
	</td>	
</tr>
			
			
<?php			
		}
	}

/* AJAX ZA EDIT */

if ($_POST['akcija'] == 'edit') {
	
	$radnik_id = $_POST['radnik_id'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$e_mail = $_POST['e-mail'];	
	
	$telefon = $_POST['broj_telefona'];
	$pozicija = $_POST['pozicija'];	
	$slika = $_FILES['filetoupload']['name'];
	$filetmpname = $_FILES['filetoupload']['tmp_name'];
	$folder = 'uploads/cv_slike/';
	move_uploaded_file($filetmpname, $folder.$slika);
	
	$sql = "UPDATE `zaposleni` SET `ime`='$ime', `prezime`='$prezime', `e_mail`='$e_mail', `slika`='$slika', `pozicija`='$pozicija', `broj_telefona`='$telefon' where radnik_id = $radnik_id";
	
	$results = $conn->query($sql);
	
	$results2 = "SELECT * FROM zaposleni";	
	
	$edited = $conn->query($results2);

	$i = 1;
	
	while ($red = $edited->fetch_assoc()) {
		
?>	

<tr>	
	<td style='vertical-align: middle;'><?=$i++;?></td>
	<td style='vertical-align: middle;'><?=$red['ime'];?></td>
	<td style='vertical-align: middle;'><?=$red['prezime'];?></td>
	<td style='vertical-align: middle;'><?=$red['e_mail'];?></td>
	<td style='vertical-align: middle;'><img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='50' width='50' data-html="true" data-toggle='tooltip' title="<img src='ajax/uploads/cv_slike/<?=$red['slika'];?>' height='150' width='150'>"></td>
	<td style='vertical-align: middle;'><?=$red['broj_telefona'];?></td>
	<td style='vertical-align: middle;'><?=$red['pozicija'];?></td>
	<td style='vertical-align: middle; min-width: 130px'>		
		<button class="btn btn-warning edit" type='button' name='edit' id='edit' style='max-width:100px; margin-right: 10px; color: #fff;' data-toggle="modal" data-target="#insert_modal" value="<?=$red['radnik_id']?>"		
		data-id="<?=$red['radnik_id'];?>"
		data-a="<?=$red['ime'];?>"
		data-b="<?=$red['prezime'];?>"
		data-c="<?=$red['e_mail'];?>"
		data-d="<?=$red['slika'];?>"
		data-e="<?=$red['broj_telefona'];?>"		
		data-f="<?=$red['pozicija'];?>">		
		<i class="fas fa-edit"></i>		
		</button>
		<button class="btn btn-danger delete" name='delete' data-id="<?=$red['radnik_id']?>" id='delete'><i class="fas fa-trash"></i></button>
	</td>	
</tr>


<?php	
		
	}
	
}

?>

