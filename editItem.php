<?php
	require_once('dbconnect.php');
	require_once('functions.php');
	
	//editItem($conn)
	if (isset($_GET["edit"])) {
		//$script = "$('#editForm').show();";	// show edit form
		$product_id = $_GET["edit"];        
        $sql = "SELECT * FROM items WHERE product_id = '$product_id'";
        $empArray = $conn->query($sql) or die($conn->error);
        $row = $empArray->fetch_array();

        $category = $row["category"];
        $unit_price = $row["unit_price"];
        $description = $row['description'];

    }
	
	if (isset($_POST['update'])) {
		$product_id = $_POST['product_id'];
        $category = $_POST['category'];
        $unit_price = $_POST['unit_price'];
        $description = $_POST['description'];
        // Query
        $mySQL= "UPDATE items
                SET category='$category', unit_price='$unit_price', description='$description' 
                WHERE product_id = '$product_id' ";
        $conn->query($mySQL);
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: items.php?updateID:$product_id=success");
        $_SESSION['message'] = "Edit Record Successlly ID: $product_id";
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
		<span class="navbar-brand">Editing Item <?php echo $product_id;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"> </div>
            <?php include("navigationMenu.php");  ?><br>
        
		<br>

		<!-- Display Edit form-->
		<div class="container">
			<form action="editItem.php" method="POST" >
				<div class="form-group row">
					<b class="col-sm-2">Product ID:</b><b><?php echo $product_id;?></b>
					<input type = "hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>" class="form-control col-sm-5" required>
				</div>				
				<div class="form-group row">
					<label class="col-sm-2">Category*</label>
                    <select id="category" name="category" class="form-control col-sm-5" required>
                        <option class="disabled">Select</option>
                        <option value="finished">Finished Goods</option>
                        <option value="sub-product">Sub-Product</option>
                        <option value="Others">Others</option>
                    </select>
				</div>			
				<div class="form-group row">
					<label class="col-sm-2">Unit Price</label>
					<input id="unit_price" name="unit_price" value="<?php echo $unit_price; ?>" type="number" min="0" step="0.00001" class="form-control col-sm-5" required>
				</div>
				<div class="form-group row">
					<label class="col-sm-2">Description</label>
					<input id="description" name="description" value="<?php echo $description; ?>" class="form-control col-sm-5">
				</div>
				<div  align="center">
					<button name="update" type="submit" class="btn btn-success">Update</button>
					<a href="items.php" class="btn btn-danger">Cancel</a>
				</div></b>
			</form>
		</div>
		</body>
	<?php include("scripts.php") ?>
</html>
