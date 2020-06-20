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
		top: 50px;
		margin-left: auto;
		margin-right: auto;
		table-layout: fixed;
		width: 70%;	
		}
	h2 {
		margin-left: 44.4%;		
	}
</style>
</head>

<body>
<h2>Kalkulacije</h2>
<table border='2px' class='pdftable'>
	
	<thead>
		<tr>		
			<th>Kalkulacije</th>
			<th>Naziv dobavljaca</th>	
			<th>Datum prijema</th>	
			<th>Napomena</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
		$sql_1 = "SELECT kalkulacijemain.dobavljaci_id, kalkulacijemain.racun_id, kalkulacijemain.datum_prijema, kalkulacijemain.broj_fakture, kalkulacijemain.broj_godine, kalkulacijemain.napomena, dobavljaci.dobavljaci_id, dobavljaci.ime FROM kalkulacijemain LEFT JOIN dobavljaci ON kalkulacijemain.dobavljaci_id = dobavljaci.dobavljaci_id";
	
		$results1 = $conn->query($sql_1);
			while ($red = $results1->fetch_assoc()) {		
		?>		
	<tr class="table-success">
			<td><?=$red['broj_fakture'] . "/" . $red['broj_godine']?></td>
			<td><?=$red['ime']?></td>
			<td><?=$red['datum_prijema']?></td>	
			<td><?=$red['napomena']?></td>
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