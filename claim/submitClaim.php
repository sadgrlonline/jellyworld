<? 
include '../config.php'; 

if (isset($_POST['jellyName'])) {
    $id = $_POST['id'];
 	$jelly_name = $_POST['jellyName'];
 	$jelly_img = $_POST['jellyImage'];
 	$jelly_desc =  $_POST['jellyDesc'];
 	$claimed = 1;
 	$owner_name = $_POST['ownerName'];
 	$owner_desc = $_POST['ownerDesc'];
 	$owner_link = $_POST['ownerLink'];
 	$owner_button = $_POST['ownerButton'];
 	$comments = $_POST['comments'];
 	$approved = 0;

// updates if existing, creates if not
if(empty($id)) {
    
$stmt = $con->prepare("INSERT INTO jellytable(jellyname, jelly_image, flavortext, claimed, owner_name, owner_desc, owner_link, owner_button, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $jelly_name, $jelly_img, $jelly_desc, $claimed, $owner_name, $owner_desc, $owner_link, $owner_button, $comments);
$stmt->execute();
$result = $stmt->get_result();
    
} else {

$stmt = $con->prepare("UPDATE jellytable SET jellyname=?, jelly_image=?, flavortext=?, claimed=?, owner_name=?, owner_desc=?, owner_link=?, owner_button=?, comments=?, approved=? WHERE id = ?");
$stmt->bind_param("sssssssssss", $jelly_name, $jelly_img, $jelly_desc, $claimed, $owner_name, $owner_desc, $owner_link, $owner_button, $comments, $approved, $id);
$stmt->execute();
$result = $stmt->get_result();
}
}
?>