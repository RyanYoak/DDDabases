
<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    //insertSupplier($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Logs</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <div>
            <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Logs</span>
                <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto"></ul>
        <?php include("navigationMenu.php");  ?><br><br> 
        <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>    
	<body>

    
    </body>
    <?php include("scripts.php") ?>
</html>
