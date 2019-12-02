<?php 
    require_once('functions.php');
    require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Logs</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <span class="navbar-brand">Manage Logs</span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"></div>
            <?php include("navigationMenu.php");  ?><br><br>
            <!-- Display Message after edit, add and delete -->
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
        <?php endif ?><br>
        
    <body>
        <div class="container"><a class="btn btn-info " href="addLog.php?insert">New Log</a></div><br> <br>
        
        <!-- Please Modified below  -->
        <div class="container">
            <table id="viewTable">
                <thead class="table table-dark">
                    <th scope="col">Product ID</th>
                    <th scope="col">Supplier ID</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody class="table table-striped">
                    <?php showSupplies($conn); ?>                        
                </tbody>
            </table>
        </div>


    </body>
    <?php include("scripts.php"); ?>
    </html>
