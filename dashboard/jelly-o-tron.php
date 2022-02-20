<?php 
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login/");
    exit();
} else {
include '../config.php';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jelly-o-Tron</title>
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
			  <link rel="stylesheet" href="../style.css">
    </head>
<body>
        <div class="nav"><em><a href="index.php">[Approve Jellies]</a> <a href="jelly-management.php">[Jelly Management]</a> 
    <a href="/jellyworld/claim/">[Claim & Submit Jellies]</a>
<a href="/jellyworld/logout.php">[Logout]</a></em></div>
        <h1>Jelly-o-tron</h1>
    <p>This is an admin-only way to quickly add 'stock jellies' that other people can adopt. They do not need to be approved, and they are listed as 'claimable'.</p>
<form id="submitJelly" action="" method="">

    <div>
    <label>Jelly Name<span class="req">*</span></label>
</div>
    <div>
    <input type="text" id="jellyName"/>
    </div>
            <div>
    <label>Jelly Image Link: <span class="req">*</span></label>
</div>
    <div>
    <input type="text" id="jellyImage" />
    </div>
    
    <div>
        <label>Jelly Flavortext <span class="req">*</span></label>
    </div>
    <div>
        <input type="text" name="jellyDesc" class="jellyDesc" /></textarea>
    </div>
    

   
    <input type="submit" id="submitJellyForm" value="Submit Jelly!">
    </div>
    <h2>Live Preview</h2>
    <div class="box preview">
        <div class="name"></div>
        <div class="image"></div>
        <div class="flavortext"></div>
    </div>
</form>
<style>
    .preview {
        border:1px solid black;
        width:150px;
        height:150px;
    }
</style>
<script>
    // this runs every second to render a live preview

    function renderPreview() {
        $('.name').text($('#jellyName').val());
        $('.image').html('<img src="' + $('#jellyImage').val() + '">');
        $('.flavortext').text($('.jellyDesc').val());
    }
        setInterval(renderPreview, 500);
        
         $('#submitJellyForm').on("click", function(e) {
        // prevents default form logic
        e.preventDefault();
        
        // this grabs the input values as variables to pass to PHP
        var jellyName = $('#jellyName').val();
        var jellyImage = $('#jellyImage').val();
        var jellyDesc = $('.jellyDesc').val();
        
    $.ajax({
			type: 'post',
			data: {'jellyName':jellyName, 'jellyImage':jellyImage, 'jellyDesc':jellyDesc},
			url: 'submit-jtron.php',
			success: function(response) {
			    // redirects to new page
	            window.location.href = "jelly-management.php"
	            
			}
		});
        });
</script>