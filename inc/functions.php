<?php 

function hashing ($len = 20) {
	$chars = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOASDFGHJKLZXCVBNM";
	$charLen = strlen($chars);
	$hash = "";
	
	for ($i = 0; $i < $len; $i++) {
		$hash .= $chars[rand(0, $charLen - 1)];
	}
	return $hash;
}

?>