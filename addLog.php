<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    insertLogs($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Logs</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <div>
            <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Logs</span>
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
    <div class="container">
            <form action="addLog.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2">Employee ID: </label>
                    <select id="viewId" name="employee_id" style="background-color: white;">
                        <?php showEmployeeID($conn); ?>
                    </select>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Date*</label>
                    <input id="log_date" name="log_date" type="Date" class="form-control col-sm-5"  required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Login Time*</label>
                    <input id="login_time" name="login_time" type="Time" class="form-control col-sm-5"  required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Logout Time*</label>
                    <input id="logout_time" name="logout_time" type="Time" class="form-control col-sm-5" required>
                </div>
                <button id="insert" name="insert" class="btn btn-secondary" type="submit">Save</button>

            </form>

    </body>
    <?php include("scripts.php") ?>
</html>
