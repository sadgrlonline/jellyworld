<?php 
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login/");
    exit();
} else {
include '../config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
			  <link rel="stylesheet" href="../style.css">
    </head>
<body>
    <em><a href="jelly-management.php">[Manage Jellies]</a> <a href="jelly-o-tron.php">[Jelly-o-Tron]</a> <a href="../claim/">[Claim & Submit Jellies]</a> <a href="/jellyworld/logout.php">[Logout]</a></em> 
    <h2>Awaiting Approval</h2>
    <p><em>The Jellies below are eager for you to approve them!</em></p>
    

<?php 

$stmt = $con->prepare("SELECT id, jellyname, jelly_image, flavortext, owner_name, owner_link, owner_button, comments FROM jellytable WHERE approved = 0");
$stmt->execute();
$result = $stmt->get_result();
$stmt->store_result();
echo $match;
if(mysqli_num_rows($result) < 1) {
    echo 'There are no lonely jellies waiting in your queue!<br><br>';
} else if(mysqli_num_rows($result) == 1) {
    echo 'There is one lonely jelly waiting in your queue!<br><br>';
    echo '<div class="flex">';
    while ($row = $result->fetch_assoc()) {
 $id = $row["id"];
 $jellyname = $row["jellyname"];
 $jellyimg = $row["jelly_image"];
 $jellydesc = $row["flavortext"];
 $ownername = $row["owner_name"];
 $ownerlink = $row["owner_link"];
 $ownerbutton = $row["owner_button"];
 $comments = $row["comments"];
    echo '<div class="flex">';
    echo '<a href="#" class="approve"><div class="box"><div class="' . $id . '"></div><div>' . $jellyname . '</div>' . '<div><img src="' . $jellyimg . '"></div><div><strong>Description: </strong>' . $jellydesc . '</div><div><strong>Owner: </strong>' . $ownerlink . '</div><div><strong>Button: </strong>' . $ownerbutton . '</div><div><strong>Comments: </strong>' . $comments . '</div></div></a>' ;
    }
    }
    else {
    echo 'There are ' . mysqli_num_rows($result) . ' jellies, waiting in your queue!<br><br>';
    echo '<div class="flex">';
while ($row = $result->fetch_assoc()) {
 $id = $row["id"];
 $jellyname = $row["jellyname"];
 $jellyimg = $row["jelly_image"];
 $jellydesc = $row["flavortext"];
 $ownername = $row["owner_name"];
 $ownerlink = $row["owner_link"];
 $ownerbutton = $row["owner_button"];
 $comments = $row["comments"];
 
    echo '<a href="#" class="approve"><div class="box"><div class="' . $id . '"></div><div>' . $jellyname . '</div>' . '<div><img src="' . $jellyimg . '"></div><div><strong>Description: </strong>' . $jellydesc . '</div><div><strong>Owner: </strong>' . $ownerlink . '</div><div><strong>Button: </strong>' . $ownerbutton . '</div><div><strong>Comments: </strong>' . $comments . '</div></div></a>' ;
    }
 
}

$stmt->close();
}
?>
<style>
    .approve {
        display:block;
        text-decoration:none;
        color:black;
    }
</style>
<script>
    $('.approve').on("click", function(e) {
        // this makes the item disappear after clicking
        $(this).css("display", "none");
        // this prevents the link from scrolling to the top
        e.preventDefault();
        // grabbing the id which I used as the first div in .box
        var id = $(this).children('.box').children(":first").attr('class');
        // approval status
        var approved = 1;
            $.ajax({
			type: 'post',
			data: {'approved':approved, 'id':id},
			url: 'submit.php',
			success: function(response) {
            
	            
			}
		});
    });
</script>