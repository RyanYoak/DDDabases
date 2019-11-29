<?php
    require_once('dbconnect.php');
    require_once('functions.php');

    //editOrders($conn);
    if (isset($_GET["edit"])) {
        //$script = "$('#editForm').show();";	// show edit form
        $customer_id = $_GET["edit"];
        $product_id = $_GET["product_id"];
        $timestamp = $_GET["timestamp"];
        $sql = "SELECT * FROM orders WHERE customer_id = '$customer_id' AND product_id = '$product_id' AND timestamp = '$timestamp'";
        $empArray = $conn->query($sql) or die($conn->error);
        $row = $empArray->fetch_array();
        // get values form selected employee
        $customer_id = $row['customer_id'];
        $product_id = $row['product_id'];
        $timestamp = $row['timestamp'];
        $quantity = $row['quantity'];
    }
        // update selected employee
    if (isset($_POST['update'])){
        $ocustomer_id = $customer_id;
        $oproduct_id = $product_id;
        $otimestamp = $timestamp;
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];
        $timestamp = $_POST['timestamp'];
        $quantity = $_POST['quantity'];

        // Query
        $mySQL= "UPDATE orders
                 SET customer_id='$customer_id', product_id='$product_id', timestamp='$timestamp', quantity='$quantity'
                 WHERE customer_id = '$ocustomer_id' AND product_id = '$oproduct_id' AND timestamp = '$otimestamp';";
        $conn->query($mySQL);
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: orders.php?updateID:$customer_id, $product_id, $timestamp=success");
        $_SESSION['message'] = "Edit Record Successlly ID:  $customer_id, $product_id, $timestamp";
        $_SESSION['msg_type'] = "success";
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Edit Items</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
	<body>
        <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <!-- Display Select employee for editting -->
            <span class="navbar-brand">Edit Order: <?php echo $customer_id, $product_id, $timestamp;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
            </div>
            <?php include("navigationMenu.php");  ?><br>
        <br>

        <!-- Display Edit form-->
        <div class="container">
            <form action="editOrders.php" method="POST" >
              <div class="form-group row">
                  <label class="col-sm-2">Customer ID</label>
                  <input id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" type="number" class="form-control col-sm-5" placeholder="number only" required>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2">Product ID</label>
                  <input id="product_id" name="product_id" value="<?php echo $product_id; ?>" type="number" class="form-control col-sm-5" placeholder="number only" required>
              </div>
                <div class="form-group row">
                    <label class="col-sm-2">timestamp</label>
                    <input id="timestamp" name="timestamp" value="<?php echo $timestamp; ?>" type="date" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Quantity</label>
                    <input id="quantity" name="quantity" value="<?php echo $quantity; ?>" type="number" class="form-control col-sm-5" placeholder="number only" required>
                </div>
                <div  align="center">
                    <button name="update" type="submit" class="btn btn-success">Update</button>
                    <a href="orders.php" class="btn btn-danger">Cancel</a>
                </div></b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
