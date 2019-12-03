<?php
    require_once("dbconnect.php");
    require_once("functions.php");

    //editlog($conn)
    if(isset($_GET["edit"])){
      $employee_id = $_GET["edit"];
      $log_date = $_GET["log_date"];
      $login_time = $_GET["login_time"];
      $logout_time = $_GET["logout_time"];

}

    if(isset($_POST["update"])){
      $employee_id = $_POST['employee_id'];
      $log_date = $_POST['log_date'];
      $login_time = $_POST['login_time'];
      $logout_time = $_POST['logout_time'];


      $mySQL= "UPDATE logs
        SET login_time='$login_time', logout_time='$logout_time'
        WHERE employee_id= '$employee_id' AND log_date='$log_date' AND login_time='$login_time' AND logout_time='$logout_time'";

      $conn->query($mySQL);
      $retval = mysqli_query($conn, $mySQL);

      if(! $retval ) {
          die('Could not enter data: ' . mysqli_error($conn));
      }

      header("location: logs.php?updatelog:$login_time, $logout_time, $log_date=success");
      $_SESSION['message'] = "Edit Record Successfully Login:  $log_date, $login_time, $logout_time";
      $_SESSION['msg_type'] = "success";
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Edit Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
	<div>
		<nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
		<!-- Display Select employee for editting -->
		<span class="navbar-brand">Editing Login <?php echo "for ", $employee_id, " on ", $log_date;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
            </div>
            <?php include("navigationMenu.php");  ?><br><br>

		<!-- Display Edit form-->
		<div class="container">
			<form action="editLog.php" method="POST" >
				<div class="form-group row">
					<b class="col-sm-2">Employee ID:</b><b><?php echo $employee_id;?></b>
					<input type = "hidden" id="employee_id" name="employee_id" value="<?php echo $employee_id; ?>" class="form-control col-sm-5" required>
				</div>

				<div class="form-group row">
					<b class="col-sm-2">Login Date:</b><b><?php echo $log_date;?></b>
					<input type="hidden" id="log_date" name="log_date" value="<?php echo $log_date; ?>" class="form-control col-sm-5" required>
				</div>

        <div class="form-group row">
            <label class="col-sm-2">Login Time</label>
            <input id="login_time" name="login_time" value="<?php echo $login_time; ?>" type="datetime" class="form-control col-sm-5" placeholder="" required>
        </div>

        <div class="form-group row">
            <label class="col-sm-2">Logout Time</label>
            <input id="logout_time" name="logout_time" value="<?php echo $logout_time; ?>" type="datetime" class="form-control col-sm-5" placeholder="" required>
        </div>

				<div  align="center">
					<button name="update" type="submit" class="btn btn-success">Update</button>
					<a href="logs.php" class="btn btn-danger">Cancel</a>
				</div></b>
			</form>
		</div>
		</body>
	<?php include("scripts.php") ?>
</html>
