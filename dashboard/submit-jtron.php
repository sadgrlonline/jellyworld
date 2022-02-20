<?php 

include '../config.php';

if (isset($_POST['jellyName'])) {
    $jelly_name = $_POST['jellyName'];
 	$jelly_img = $_POST['jellyImage'];
 	$jelly_desc =  $_POST['jellyDesc'];
 	$claimed = 0;
 	$approved = 1;
 	
 	$stmt = $con->prepare("INSERT INTO jellytable(jellyname, jelly_image, flavortext, claimed, approved) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $jelly_name, $jelly_img, $jelly_desc, $claimed, $approved);
$stmt->execute();
$result = $stmt->get_result();
}
?>