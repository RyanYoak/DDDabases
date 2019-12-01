<?php
	require_once('dbconnect.php');
	require_once('functions.php');

	insertPaycheck($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Paycheck</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
	</head>

	<div>
		<nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
			<span class="navbar-brand">Add New Paycheck</span>
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

	<div a align="right"><a class="btn btn-danger" href="payrolls.php">Back to View All Payrolls</a></div>
	<div class="container">
		<b><h3 >Paycheck Information</h3><br>
		<form action="addPaycheck.php" method="POST">
			<div class="form-group row">
				<label style="width: 120px">Employee ID*: </label>
                    <select id="fade" name="employee_id" style="background-color: white;" required>
                        <?php showEmployeeID($conn); ?>
                    </select>
                </div>

			<div class="form-group row">
				<label class="col-sm-2">Date*</label>
				<input id="pay_date" name="pay_date" type="date" min="0" class="form-control col-sm-5" placeholder="Date" required>
			</div>

			<div class="form-group row">
				<label class="col-sm-2">Amount*</label>
				<input id="paycheck_amount" name="paycheck_amount" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="Amount" required>
			</div>

			<button name="insert" type="submit" class="btn btn-success">Insert Record</button>  
		</form>
	</div>
	</body>
	<?php include("scripts.php") ?>
</html>
