
<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    insertOrder($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Orders</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <div>
            <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Orders</span>
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
    <div id="insertForm" class="container">
        <form action="addOrders.php" method="POST">
        <b>
          <div class="form-group row">
              <label class="col-sm-2">Customer ID*</label>
              <input id="customer_id" name="customer_id" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Customer ID" required>
          </div>
          <div class="form-group row">
              <label class="col-sm-2">Product ID*</label>
              <input id="product_id" name="product_id" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Product ID" required>
          </div>
          <div class="form-group row">
              <label class="col-sm-2">Quantity*</label>
              <input id="quantity" name="quantity" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Product ID" required>
          </div>
          <div  align="center">
              <button name="insert" type="submit" class="btn btn-success">Insert Order</button>
          </div>
        </b>
        </form>
    </div>

    </body>
    <?php include("scripts.php") ?>
</html>
