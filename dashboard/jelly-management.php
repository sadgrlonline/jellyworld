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
    <div class="nav"><em><a href="index.php">[Approve Jellies]</a> <a href="jelly-o-tron.php">[Jelly-o-Tron]</a> 
    <a href="/jellyworld/claim/">[Claim & Submit Jellies]</a>
<a href="/jellyworld/logout.php">[Logout]</a></em></div>
    <div class="flex">
    <?php
    
    $stmt = $con->prepare("SELECT id, jellyname, jelly_image, flavortext, claimed, owner_name, owner_desc, owner_link, owner_button, comments FROM jellytable ORDER BY id DESC");

$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
 $id = $row["id"];
 $jellyname = $row["jellyname"];
 $jellyimg = $row["jelly_image"];
 $jellydesc = $row["flavortext"];
 $ownername = $row["owner_name"];
 $ownerdesc = $row["owner_desc"];
 $ownerlink = $row["owner_link"];
 $ownerbutton = $row["owner_button"];
 $comments = $row["comments"];
 $claimed = $row["claimed"];
     if ($claimed == 1) {
  echo '<div class="box ' . $id . '"><div class="name">' . $jellyname . '</div>' . '<div class="image"><img src="' . $jellyimg . '"></div><div class="description">' . $jellydesc . '</div><div class="bond"><strong><em>bonded with: <a href="' . $ownerlink . '" target="_blank">' . $ownername . '</a></em></strong><div class="view bondOwnerButton">' . $ownerbutton . '</div><div class="view bondOwnerDesc">' . $ownerdesc . '</div><div class="comments">' . $comments . '</div></div><div class="view claimBox">' . $claimed . '</div><a href="#" class="delete" data-id="' . $id . '">delete</a><a href="#" class="edit" data-id="' . $id . '">edit</a></div>' ;
     } else {
          echo '<div class="box ' . $id . '"><div class="name">' . $jellyname . '</div>' . '<div class="image"><img src="' . $jellyimg . '"></div><div class="description">' . $jellydesc . '</div><div class="bond available"><strong><em>bonded with: <a href="' . $ownerlink . '" target="_blank">' . $ownername . '</a></em></strong><div class="bondOwnerDesc">' . $ownerdesc . '</div><div class="bondOwnerButton">' . $ownerbutton . '</div><div class="comments">' . $comments . '</div></div><div class="view claimBox">' . $claimed . '</div><div class="available">Available Now!</div><a href="#" class="delete" data-id="' . $id . '">delete</a><a href="#" class="edit" data-id="' . $id . '">edit</a></div>' ;
     }
 
}
}
?>
</div>
<style>
    .flex-long {
        display:flex;
        flex-wrap:wrap;
    }
    .flex-long .box {
        width:250px;
        height:250px;
        position:relative;
    }
    .edit, .save {
        position:absolute;
        bottom:20px;
        right:5px;
        font-style:italic;
        font-size:smaller;
    }
    .delete {
        position:absolute;
        bottom:0px;
        right:5px;
        font-style:italic;
        font-size:smaller;
    }
    input[type="text"] {
        padding:0;
    }
    label {
       display:block;
       margin-top:10px;
    }
    .bond {
        margin-top:10px;
    }
    label[for="claimed"], label[for="unclaimed"] {
        display:inline-block;
    }
    .small {
        font-size:smaller;
    }
    .available {
        display:none;
    }
    .view {
        display:none;
    }


</style>
<script>

    
    $('.box').on("click", ".edit", function(e) {
        // this makes the boxes stretch when you click to edit
        $('.box').css("height", "auto");
        $(this).parent('.box').children('.view').css("display", "block");
        
        
        // get id (correlates to db id)
        var id = $(this).data('id');
        e.preventDefault();
        
        // these grab all the different 'pieces' you can edit
        var jellyName = $(this).parent('.box').children('.name').html();
        var jellyImg = $(this).parent('.box').children('.image').children('img').attr('src');
        var jellyDesc = $(this).parent('.box').children('.description').html();
        var jellyOwnerName = $(this).parent('.box').children('.bond').children().children().children('a').text();
        var jellyOwnerDesc = $(this).parent('.box').children('.bond').children('.bondOwnerDesc').text();
        var jellyOwnerLink = $(this).parent('.box').children('.bond').children().children().children('a').attr('href');
        var jellyOwnerButton = $(this).parent('.box').children('.bond').children('.bondOwnerButton').text();
        var jellyOwnerComments = $(this).parent('.box').children('.comments').text();
        var claimed = $(this).parent('.box').children('.claimBox').text();
        console.log(jellyOwnerButton);
        console.log('claimed is..' + claimed);
        
        // this makes the inputs for editing
        $(this).parent('.box').children('.name').html('<label>Jelly Name</label><input type="text" class="nameInput" value="' + jellyName + '">');
        $(this).parent('.box').children('.image').html('<label>Jelly Image</label><input type="text" class="imageInput" value="' + jellyImg + '">');
        $(this).parent('.box').children('.description').html('<label>Flavor Text</label><textarea class="descriptionInput">' + jellyDesc + '</textarea>');
        $(this).parent('.box').children('.bond').html('<label>Owner</label><input type="text" class="bondOwnerInput" value="' + jellyOwnerName + '"><br><label>Description:</label><input type="text" class="bondOwnerDesc" value="' + jellyOwnerDesc + '"><br><label>Link:</label><input type="text" class="bondOwnerLink" value="' + jellyOwnerLink + '"><br><label>Button</label><input type="text" class="bondOwnerButton" value="' + jellyOwnerButton + '">');
        $(this).parent('.box').children('.comments').html('<label>Comments</label><textarea class="bondOwnerComments">' + jellyOwnerComments + '</textarea>');
            $(this).parent('.box').children('.claimBox').html('<label>Claimed?</label><input type="text" class="claimBox" value="' + claimed + '"></div>');

        
        // adds the save button
        $(this).parent('.box').append('<a href="#" data-id="' + id + '"class="save">save</a>')
        
       // hides the edit button
        $(this).remove();
        
    });
    
        $('.box').on("click", ".save", function(e) {
        var id = $(this).data('id');
        $('.available').css("display", "none");
        $('.claimed').css("display", "none");
        $('.view').css("display", "none");
        e.preventDefault();
        var jellyName = $(this).parent('.box').children('.name').children('.nameInput').val();
        var jellyImg = $(this).parent('.box').children('.image').children('.imageInput').val();
        var jellyDesc = $(this).parent('.box').children('.description').children('.descriptionInput').val();
        var jellyOwnerName = $(this).parent('.box').children('.bond').children('.bondOwnerInput').val();
        var jellyOwnerDesc = $(this).parent('.box').children('.bond').children('.bondOwnerDesc').val();
        var jellyOwnerLink = $(this).parent('.box').children('.bond').children('.bondOwnerLink').val();
        var jellyOwnerButton = $(this).parent('.box').children('.bond').children('.bondOwnerButton').val();
        var jellyOwnerComments = $(this).parent('.box').children('.comments').children('.bondOwnerComments').val();
        var claimed = $(this).parent('.box').children('.claimed').children('.claimBox').val();
        //$(this).parent('.box').children('.claimed').text(claimed);
        console.log(claimed);
        
        
        // this stuff just basically transforms the textboxes back into text
        $(this).parent('.box').children('.name').html(jellyName);
        $(this).parent('.box').children('.image').html('<img src="' + jellyImg + '"></div>');
         $(this).parent('.box').children('.description').html(jellyDesc);
        $(this).parent('.box').children('.bond').html('<strong><em>bonded with: <a href="' + jellyOwnerLink + '">' + jellyOwnerName + '</a></strong>')
        $(this).parent('.box').children('.comments').html(jellyOwnerComments)
        
       $(this).parent('.box').children('.claimed').html(claimed);
        
        $(this).parent('.box').append('<a href="#" data-id="' + id + '"class="edit">edit</a>')
        
        
        // removes the save button
        $(this).remove();
        
       // this stuff handles how it connected to the PHP (it's AJAX)
    $.ajax({
			type: 'post',
			data: {'id':id,
			       'jellyName':jellyName, 
			       'jellyImg':jellyImg, 
			       'jellyDesc':jellyDesc, 
			       'jellyOwnerDesc':jellyOwnerDesc,
			       'jellyOwnerName':jellyOwnerName, 
			       'jellyOwnerLink':jellyOwnerLink, 
			       'jellyOwnerButton':jellyOwnerButton, 
			       'jellyOwnerComments':jellyOwnerComments,
			       'claimed':claimed,
			},
			url: 'submit.php',
			success: function(response) {
             location.reload();
			}
		});
    });
    
    $('.delete').on("click", function(e) {
        e.preventDefault();
        console.log('hi');
        var id = $(this).data('id');
        var del = "delete";
        if (confirm("Are you sure you want to delete this Jelly?") == true) {
            $(this).parent('.box').remove();
			$.ajax({
				type: 'post',
				data: {'id':id, 'del':del},
				url: 'submit.php',
				success: function(response) {
				$('#' + id).hide();
				console.log('success');
				}
			});
        }
 		});

</script>