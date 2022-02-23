<?php 

include '../config.php';

// this block handles saved changes/updates
if (isset($_POST['jellyName'])) {
    $id = $_POST['id'];
    $jelly_name = $_POST['jellyName'];
 	$jelly_img = $_POST['jellyImg'];
 	$jelly_desc =  $_POST['jellyDesc'];
 	$claimed =  $_POST['claimed'];
 	$owner_name = $_POST['jellyOwnerName'];
 	$owner_desc = $_POST['jellyOwnerDesc'];
 	$owner_link = $_POST['jellyOwnerLink'];
 	$owner_button = $_POST['jellyOwnerButton'];
 	$comments = $_POST['jellyOwnerComments'];
 	
 	
 	$stmt = $con->prepare("UPDATE jellytable SET jellyname = ?, jelly_image = ?, flavortext = ?, claimed = ?, owner_name = ?, owner_desc = ?, owner_link = ?, owner_button = ?, comments = ? WHERE id = ?");
$stmt->bind_param("ssssssssss", $jelly_name, $jelly_img, $jelly_desc, $claimed,  $owner_name, $owner_desc, $owner_link, $owner_button, $comments, $id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
    // this generates the JSON file
    $rows = array();
    $sql = ("SELECT id, jellyname, jelly_image, flavortext, claimed, owner_name, owner_desc, owner_link, owner_button, comments FROM jellytable WHERE approved = 1;");
mysqli_set_charset($con, 'utf8');
if ($result = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        // moving html
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    $f = fopen('../jellyworld.json', 'w');
    // REMEMBER TO UNCOMMENT THIS LATER
    fwrite($f, json_encode($rows));
    }
}
}

// this block handles deletion logic
if (isset($_POST['del'])) {
    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM jellytable WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    
    // this generates the JSON file
    $rows = array();
    $sql = ("SELECT id, jellyname, jelly_image, flavortext, claimed, owner_name, owner_desc, owner_link, owner_button, comments FROM jellytable WHERE approved = 1;");
mysqli_set_charset($con, 'utf8');
if ($result = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    $f = fopen('../jellyworld.json', 'w');
    fwrite($f, json_encode($rows));
    }
}
}

// this block handles approval logic
if (isset($_POST['approved'])) {
    $id = $_POST['id'];
$stmt = $con->prepare("UPDATE jellytable SET approved = 1, claimed = 1 WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->close();

$rows = array();

// this generates the JSON file
$sql = ("SELECT id, jellyname, jelly_image, flavortext, claimed, owner_name, owner_desc, owner_link, owner_button, comments FROM jellytable WHERE approved = 1;");
mysqli_set_charset($con, 'utf8');
if ($result = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        // moving html
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    $f = fopen('../jellyworld.json', 'w');
    fwrite($f, json_encode($rows));
    }
}
}


?>