<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page Title</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/header.html"); ?>
            

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/home.html"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/about.html"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/contact.html"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/signup.html"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/login.html"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/manageaccount.html"); ?>



    <?php include($_SERVER['DOCUMENT_ROOT'] . "/appshell/footer.html"); ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/appshell.js"></script>
    <script>
		$(document).ready(function() {
		    $('section').eq(0).show(); 
		    $('.navbar-nav').on('click', 'a', function() {
		        $($(this).attr('href')).show().siblings('section:visible').hide();
		    });
		});
    </script>

</body>
</html>
