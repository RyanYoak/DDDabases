<?php>
    require_once("dbconnet.php");
    require_once("functions.php");

    //editlog($conn)
    if(isset($_GET["edit"])){
      $id = $_GET["edit"];
      $log_date = $GET["log_date"];
      $sql = "SELECT * FROM logs WHERE employee_id = $id AND log_date = $log_date";
      $empArray = $conn->query($sql) or die($conn->error);
      $row = $empArray->fetch_array();
      $login_time = $row['login_time'];
      $logout_time = $row['logout_time'];
      $log_date = $row['log_date'];
    }

    if(isset($_POST["update"])){
      $login_time = $_POST['login_time'];
      $logout_tome = $_POST['logout_time'];
      $log_date - $_POST['log_date'];

      $mySQL= "UPDATE logs
               SET login_time='$login_time', logout_time='$logout_time', log_date='$log_date',
               WHERE employee_id = $id;";

      $conn->query($mySQL);

      $retval = mysqli_query($conn, $mySQL);

      if(! $retval ) {
          die('Could not enter data: ' . mysqli_error($conn));
      }

      header("location: logs.php?updatelog:$login_time, $logout_time, $log_date=success");
      $_SESSION['message'] = "Edit Record Successlly Logins:  $login_time, $logout_time, $log_date";
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
