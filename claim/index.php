<!DOCTYPE html>
<?php 

include '../config.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Claim a Jelly</title>
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
			  <link rel="stylesheet" href="../style.css">
    </head>
<body>
<div class="demotext">
    <p>This is the "claim" page! You can claim a jelly by clicking on an unclaimed Jelly, or you can <a href="#submitJelly">skip to the form</a> and use your own image!</p>
    <p><em>Hint:</em> There's no navigation on this page because it's supposed to be ~public~</em></p>
</div>
<div class="flex">


<?php
$stmt = $con->prepare("SELECT id, jellyname, jelly_image, flavortext, claimed, owner_name, owner_link FROM jellytable WHERE approved = 1");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
 $jellyname = $row["jellyname"];
 $jellyimg = $row["jelly_image"];
 $flavortext = $row["flavortext"];
 $ownername = $row["owner_name"];
 $ownerlink = $row["owner_link"];
 $claimed = $row["claimed"];
 
if ($claimed == 1) {
 echo '<div class="box claimed"><div>' . $jellyname . '</div>' . '<div><img src="' . $jellyimg . '"></div><br><div><strong><em>bonded with <a href="' . $ownerlink . '" target="_blank">' . $ownername . '!</a></em></strong></div><div class="hidden flavortext">' . $flavortext . '</div></div>' ;
} else {
    echo '<a href="#" class="jelly" data-id="'. $id . '"><div class="box"><div class="' . $jellyname . '">' . $jellyname . '</div>' . '<div class="' . $jellyimg . '"><img src="' . $jellyimg . '"></div><br><div>Available now!</strong></div><div class="hidden flavortext">' . $flavortext . '</div></div></a>' ;
}
}

echo '</div>';
?>

<form id="submitJelly" action="" method="">
    <h1>Submit a Jelly</h1>
        <input type="text" id="id" class="hidden">
    <div>
    <label>What is the name of your custom jelly? <span class="req">*</span></label>
</div>
    <div>
    <input type="text" id="jellyName"/>
    </div>
    
    <div>
        <label>Your jelly needs Flavor Text! Like "mhmm, tofu jelly" <span class="req">*</span></label>
    </div>
    <div>
        <input type="text" name="jellyDesc" class="jellyDesc" /></textarea>
    </div>
    
        <div>
    <label>You need to have art for your jelly! link to your art here! Go Crazy! <span class="req">*</span></label>
</div>
    <div>
    <input type="text" id="jellyImage" />
    </div>
    <div>
            <label>What would you like it to say when people find your jelly? (Make this a short description of your site!) <span class="req">*</span></label>
    </div>
    <div>
    <input type="text" name="ownerDesc" class="ownerDesc"/>
    </div>
    <div>
        
    <label>What would you like your name to be? <span class="req">*</span></label>
    </div>
    <div>
            <input type="text" name="ownerName" class="ownerName"/>
            </div>
            <div>
    <label>What is the link to your personal site? <span class="req">*</span></label>
    </div>
    <div>
    <input type="text" name="ownerLink" class="ownerLink"/></div>
    </div>
    <div>
    <label>Do you have a site badge or logo you'd like to go with it?</label>
    </div>
    <div>
    <input type="text" name="ownerButton" class="ownerButton"/></div>
    </div>
    <div>
    <label>Anything else you'd like me to know?</label>
    </div>
    <div>
    <input type="text" name="comments" class="comments"/>
    </div>
        <input type="text" class="honeypot"/>
    </div>
    <input type="submit" id="submitJellyForm" value="Submit Jelly!">
    <div class="validate">Please fill out the fields with a <span class="req">*</span>.</div>
</form>
<div class="success hidden">Thank you for your submission!</div>
<style>
    .flex {
        display:flex;
        flex-wrap:wrap;
        max-width:100%;
        
    }
    .hidden {
        display:none;
    }
    body {
        font-family:sans-serif;
    }
    .box {
        border:1px solid black;
        width:150px;
        padding:20px;
        word-break:break-word;
    }
    .req {
        color:red;
        font-weight:strong;
    }
    .success {
        display:none;
    }
    .honeypot {
        display:none;
    }
    .validate {
        display:none;
        color:red;
        font-weight:bold;
        padding-top:20px;
        
    }
</style>
<script>
   $(function() {
       // this clears the values of the form when the page is refreshed
        clearForm();
   });
   
   function clearForm() {
       $('#id').val('');
        $('#jellyName').val('');
       $('#jellyImage').val('');
       $('.jellyDesc').val('');
       $('.ownerName').val('');
       $('.ownerDesc').val('');
       $('.ownerLink').val('');
       $('.ownerButton').val('');
       $('.comments').val('');
   }
   
    // when an available jelly is clicked...
    $('.jelly').on("click", function(e) {
        
        // prevent page from auto-scrolling to top
        e.preventDefault();
          var id = $(this).data('id');
        // this grabs the first div in the .box div's children, which is our jelly name
        var jellyName = $(this).children(".box").children(":first").attr('class');
        
        // this grabs the second div in the .box which is our jelly image link
        var jellyImg =  $(this).children(".box").children().eq(1).attr('class');
        
        var jellyDesc = $(this).children(".box").children('.flavortext').text();
        console.log(jellyDesc);
        // this autofills the form at the bottom with the clicked jelly info
        $('#id').val(id);
        $('#jellyName').val(jellyName);
        $('#jellyImage').val(jellyImg);
        $('.jellyDesc').val(jellyDesc);
        // this auto-scrolls down to the form at the bottom
        $('html, body').animate({
        scrollTop: $("#submitJelly").offset().top
    }, 2000);
    });
    
    $('#submitJellyForm').on("click", function(e) {
        $('.validate').css("display", "none");
        // prevents default form logic
        e.preventDefault();
        
        // this grabs the input values as variables to pass to PHP
        var jellyName = $('#jellyName').val();
        var jellyImage = $('#jellyImage').val();
        var jellyDesc = $('.jellyDesc').val();
        var ownerName = $('.ownerName').val();
        var ownerDesc = $('.ownerDesc').val();
        var ownerLink = $('.ownerLink').val();
        var ownerButton = $('.ownerButton').val();
        var comments = $('.comments').val();
        var id = $('#id').val();
        var honeypot = $('.honeypot').val();

            if ($('.honeypot').val().length > 0) {
                console.log('do nothing');
            } else {
                
        // this makes those form fields required because html5 is being a bitch
        if (jellyName !== '' && jellyImage !== '' && jellyDesc !== '' && ownerName !== '' && ownerDesc !== '' && ownerLink !== '') {
    
            
            // this stuff handles how it connected to the PHP (it's AJAX)
    $.ajax({
			type: 'post',
			data: {'id':id, 'jellyName':jellyName, 'jellyImage':jellyImage, 'jellyDesc':jellyDesc, 'ownerName':ownerName, 'ownerDesc':ownerDesc, 'ownerLink':ownerLink, 'ownerButton':ownerButton, 'comments':comments},
		    url: 'submitClaim.php',
			success: function(response) {
			    console.log(honeypot);
			    console.log('success');
	            $('.success').css("display", "block");
	     // clears all form fields
        var jellyName = $('#jellyName').val('');
        var jellyImage = $('#jellyImage').val('');
        var jellyDesc = $('.jellyDesc').val('');
        var ownerName = $('.ownerName').val('');
        var ownerDesc = $('.ownerDesc').val('');
        var ownerLink = $('.ownerLink').val('');
        var ownerButton = $('.ownerButton').val('');
        var comments = $('.comments').val('');
        var id = $('#id').val('');
			}
		});
        }
        else {
            $('.validate').css("display", "block");
        }
        }
    })
</script>
</body>
</html>