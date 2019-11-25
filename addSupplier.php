
<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    insertSupplier($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Supplier</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
	<body>
        <div>
            <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Supplier</span>
                <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"> 
                </div>
            <?php include("employeeNaviBar.php");  ?><br>
                <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
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

        <div id="insertForm" class="container">
            <form action="addSupplier.php" method="POST">
                <b>
                <div class="form-group row">
                    <label class="col-sm-3">Supplier ID*</label>
                    <input id="id" name="id" type="number" class="form-control col-sm-5" placeholder="Supplier ID" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Supplier Name*</label>
                    <input id="name" name="name" type="text" class="form-control col-sm-5" placeholder="Supplier Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Industry</label>
                    <input id="industry" name="industry" type="text" class="form-control col-sm-5" placeholder="Supplier Industry">
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Phone Number*</label>
                    <input id="phone" name="phone" type="number" class="form-control col-sm-5" placeholder="Phone Number">
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Email*</label>
                    <input id="email" name="email" type="email" class="form-control col-sm-5" placeholder="example: aaa@gmail.com" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Address*</label>
                    <input id="address" name="address" type="text" class="form-control col-sm-5" placeholder="Full address" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Website</label>
                    <input id="website" name="website" type="text" class="form-control col-sm-5" placeholder="Example: www.google.com">
                </div>
                <div  >
                    <button name="insert" type="submit" class="btn btn-success">Insert Record</button>
                    <a class="btn btn-danger" href="suppliers.php">Back to Suppliers</a>
                </div>
                </b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
