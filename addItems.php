
<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    
    insertItem($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Items</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <div>
            <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Items</span>
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
  
        <div a align="right"><a class="btn btn-danger" href="supplies.php">Back to View All Items</a></div>
        <div class="container">
            <b><h3 >Item Information</h3><br>
            <form action="addItems.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2">Product ID*</label>
                    <input id="product_id" name="product_id" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Product ID" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Category*</label>
                    <input id="category" name="category" type="text" class="form-control col-sm-5" placeholder="Supplier Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Unit Price</label>
                    <input id="unit_price" name="unit_price" type="number" min="0" step="0.000001" class="form-control col-sm-5" placeholder="Supplier Industry">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Quantity*</label>
                    <input id="quantity" name="quantity" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Quantity">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Description</label>
                    <input id="description" name="description" type="text" class="form-control col-sm-5" placeholder="Item description">
                </div>

                <h3> Supplier Information</h3><br>

                <div class="form-group row">
                    <label class="col-sm-2">Supplier ID*</label>
                    <input id="supplier_id" name="supplier_id" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Supplier ID" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Supplier Name*</label>
                    <input id="name" name="name" type="text" class="form-control col-sm-5" placeholder="Supplier Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Industry</label>
                    <input id="industry" name="industry" type="text" class="form-control col-sm-5" placeholder="Supplier Industry">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Phone Number*</label>
                    <input id="phone" name="phone" type="number" min="1000000000" step="1" class="form-control col-sm-5" placeholder="Phone Number">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Email*</label>
                    <input id="email" name="email" type="email" class="form-control col-sm-5" placeholder="example: aaa@gmail.com" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Address*</label>
                    <input id="address" name="address" type="text" class="form-control col-sm-5" placeholder="Full address" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Website</label>
                    <input id="website" name="website" type="text" class="form-control col-sm-5" placeholder="Example: www.google.com">
                </div></b>
                    <button name="insert" type="submit" class="btn btn-success">Insert Record</button>  
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
