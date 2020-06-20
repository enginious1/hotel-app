<?php

include 'dbconnect.php';
require_once 'dompdf/autoload.inc.php';


use Dompdf\Dompdf;
use Dompdf\Options;


$dompdf = new Dompdf();

ob_start();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
	.pdftable {
		color: black;
		text-align: center;
		border-collapse: collapse;
		padding: 1px;
		position: relative;
		margin-left: auto;
		margin-right: auto;
		table-layout: fixed;
		width: 70%;			
		top: 50px;
		}
			h2 {
		margin-left: 46.5%;		
	}
</style>
</head>

<body>
<h2>Racuni</h2>
	<table border='2px' class='pdftable'>
		<thead>
			<tr>		
				<th>Broj racuna</th>
				<th>Ukupan racun</th>
				<th>Gost</th>	
				<th>Datum izdavanja</th>				
			</tr>
		</thead>
		<tbody>
			<?php
			
			$sql = "SELECT guests.guests_id, guests.ime, guests.prezime, racunimain.racun_id, racunimain.broj_racuna, racunimain.broj_godine, racunimain.gost_id, racunimain.datum_izdavanja, SUM(racunidetailed.ukupan_racun) AS ukupanRacun FROM racunimain LEFT JOIN guests ON racunimain.gost_id = guests.guests_id LEFT JOIN racunidetailed ON racunimain.racun_id = racunidetailed.d_racun_id WHERE racun_id > 0 GROUP BY racunimain.racun_id ORDER BY broj_racuna ASC, broj_godine ASC";
		
			$results1 = $conn->query($sql);
				while ($row = $results1->fetch_assoc()) {		
			?>		
		<tr class="table-success">
			<td><?=$row['broj_racuna'] . "/" . $row['broj_godine']?></td>
			<td style="vertical-align: middle;"><?php if (!$row['ukupanRacun']) { echo "0€";} else {echo number_format ($row['ukupanRacun'], 2) . "€";}?></td>
			<td><?=$row['ime'] . " " . $row['prezime']?></td>
			<td><?=date("d.m.Y H:i:s", strtotime($row['datum_izdavanja']));?></td>
		</tr>
				<?php } ?>	
		</tbody>
	</table>
	

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="js/script.js"></script>



<?php 
$html = ob_get_clean();


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('easy.pdf',array('Attachment'=>0));


?>

</body>

</html>