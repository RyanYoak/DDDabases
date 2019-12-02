
<?php
    require_once('dbconnect.php');
    require_once('functions.php');
    insertEmployee($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Employee</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
                <span class="navbar-brand">Add New Employee</span>
                <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto"></ul>
    <?php include("navigationMenu.php");  ?><br>
            <!-- Display message after insert -->
            <br> 
        <?php if(isset($_SESSION['message'])):?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
	<body>        
        <!-- display insert form -->
        <div id="insertForm" class="container">
            <form action="addEmployee.php" method="POST">
                <b>
                <div class="form-group row">
                    <label class="col-sm-2">First Name*</label>
                    <input id="first_name" name="first_name" type="text" class="form-control col-sm-5" placeholder="First Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Last Name*</label>
                    <input id="last_name" name="last_name" type="text" class="form-control col-sm-5" placeholder="Last Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Middle Name</label>
                    <input id="middle_name" name="middle_name" type="text" class="form-control col-sm-5" placeholder="Middle Name">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">SSN*</label>
                    <input id="ssn" name="ssn" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Gender</label>
                    <select id="gender" name="gender">
                        <option class="disabled">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Date of Birth*</label>
                    <input id="birthday" name="birthday" type="date" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Email*</label>
                    <input id="email" name="email" type="email" class="form-control col-sm-5" placeholder="example: aaa@gmail.com" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Phone Number*</label>
                    <input id="phone" name="phone" type="number" min="0" step="1" class="form-control col-sm-5" placeholder="number only" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Address*</label>
                    <input id="address" name="address" type="text" class="form-control col-sm-5" placeholder="Address" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Position*</label>
                    <input id="position" name="position" type="text" class="form-control col-sm-5" placeholder="position" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Wage*</label>
                    <input id="wage" name="wage" type="number" min="0" step="0.0000001" max="1000"class="form-control col-sm-5" placeholder="Wage per hour" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Hiring Date*</label>
                    <input id="hiring_date" name="hiring_date" type="date" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div  align="center">
                    <button name="insert" type="submit" class="btn btn-success">Insert Employee</button>
                </div>
                </b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
