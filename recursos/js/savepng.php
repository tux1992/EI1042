<?php
$aaa = explode(",", $_POST['pngData']);
file_put_contents("../../media/firmas/firma.png", base64_decode($aaa[1]));
?>
