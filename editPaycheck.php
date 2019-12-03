<?php
	require_once('dbconnect.php');
	require_once('functions.php');
	
	//editPaycheck($conn)
	if (isset($_GET["edit"])) {
		//$script = "$('#editForm').show();";	// show edit form
		$employee_id = $_GET["edit"];
		$pay_date = $_GET["pay_date"];
		$sql = "SELECT * FROM payroll WHERE employee_id = '$employee_id' AND pay_date = '$pay_date'";
        $empArray = $conn->query($sql) or die($conn->error);
        $row = $empArray->fetch_array();
        // get values form selected employee
        $paycheck_amount = $row['paycheck_amount'];
    }
	
	if (isset($_POST['update'])) {
		$employee_id = $_POST['employee_id'];
        $pay_date = $_POST['pay_date'];
        $paycheck_amount = $_POST['paycheck_amount'];

        // Query
        $mySQL= "UPDATE payroll
                SET paycheck_amount='$paycheck_amount'
                WHERE employee_id = '$employee_id' AND pay_date = '$pay_date'";
        $conn->query($mySQL);
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: payrolls.php?updateID:$employee_id, $pay_date=success");
        $_SESSION['message'] = "Edit Record Successlly ID:  $employee_id, $pay_date";
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
		<span class="navbar-brand">Editing paycheck <?php echo "for ", $employee_id, " on ", $pay_date;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
            </div>
            <?php include("navigationMenu.php");  ?><br>
        
		<br>

		<!-- Display Edit form-->
		<div class="container">
			<form action="editPaycheck.php" method="POST" >
				<div class="form-group row">
					<b class="col-sm-2">Employee ID:</b><b><?php echo $employee_id;?></b>
					<input type = "hidden" id="employee_id" name="employee_id" value="<?php echo $employee_id; ?>" class="form-control col-sm-5" required>
				</div>
				
				<div class="form-group row">
					<b class="col-sm-2">Pay Date:</b><b><?php echo $pay_date;?></b>
					<input type="hidden" id="pay_date" name="pay_date" value="<?php echo $pay_date; ?>" class="form-control col-sm-5" required>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2">Paycheck Amount</label>
					<input id="paycheck_amount" name="paycheck_amount" value="<?php echo $paycheck_amount; ?>" type="number" min="0" step="0.00001" class="form-control col-sm-5" required>
				</div>

				<div  align="center">
					<button name="update" type="submit" class="btn btn-success">Update</button>
					<a href="payrolls.php" class="btn btn-danger">Cancel</a>
				</div></b>
			</form>
		</div>
		</body>
	<?php include("scripts.php") ?>
</html>
