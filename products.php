<?php 
    require_once('functions.php');
    require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Manage Products</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
	<body>
        <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <span class="navbar-brand">Manage Products</span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"> 
            </div>
        <?php include("navigationMenu.php");  ?><br>
        <br> 
        <?php
            if(isset($_SESSION['message'])):
        ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
        <br>

        <div class="container"><a class="btn btn-info " href="addEmployee.php?add">Add New Items</a></div><br>
        <div class="container">
            <table id="empTable">
                <thead class="table table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Wage</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody class="table table-striped">
                    <?php  showEmployee($conn) ?>                        
                </tbody>
            </table>
        </div>

    </body>
    <?php include("scripts.php"); ?>
    <script>
    
        $(document).ready(function () {
            $('#empTable').DataTable({
                'retrieve': true,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });

        });
    </script>

    </html>
