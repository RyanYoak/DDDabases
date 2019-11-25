<?php 
    require_once('dbconnect.php');
    require_once('functions.php');

    //editEmployee($conn);
    if (isset($_GET["edit"])) {
        //$script = "$('#editForm').show();";	// show edit form
        $id = $_GET["edit"];
        $sql = "SELECT * FROM employee WHERE employee_id = $id";
        $empArray = $conn->query($sql) or die($conn->error);	
        $row = $empArray->fetch_array();
        // get values form selected employee
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $middle_name = $row['middle_name'];
        $ssn = $row['ssn'];
        $gender = $row['gender'];
        $birthday = $row['birthday'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $position = $row['position'];
        $wage = $row['wage'];
        $hiring_date = $row['hiring_date'];
    }
        // update selected employee    
    if (isset($_POST['update'])){
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $ssn = $_POST['ssn'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $position = $_POST['position'];
        $wage = $_POST['wage'];
        $hiring_date = $_POST['hiring_date'];
        // Update record
        $mySQL= "UPDATE employee 
                 SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', ssn='$ssn', gender='$gender',
                        birthday='$birthday', email='$email', phone='$phone', address='$address', position='$position', wage='$wage', hiring_date='$hiring_date' 
                 WHERE employee_id = $id;";
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: employees.php?updateID:$id=success");
        $_SESSION['message'] = "Edit Record Successlly ID:  $id";
        $_SESSION['msg_type'] = "success";
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Edit Employees</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
	<body>
        <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <span class="navbar-brand">Edit Employee: <?php echo $id, " - ", $first_name, " ", $last_name;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"> 
            </div>
        <?php include("employeeNaviBar.php");  ?><br>

        <br> 
        <div class="container">
            <form action="editEmployee.php" method="POST" >
                <div class="form-group row">
                    <b class="col-sm-2">Employee ID:</b><b><?php echo $id;?>
                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">First Name</label>
                    <input id="firstName" name="first_name" value="<?php echo $first_name; ?>" type='text' class="form-control col-sm-5" placeholder="First Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Last Name</label>
                    <input id="last_name" name="last_name" value="<?php echo $last_name; ?>" type="text" class="form-control col-sm-5" placeholder="Last Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Middle Name</label>
                    <input id="middle_name" name="middle_name" value="<?php echo $middle_name; ?>" type="text" class="form-control col-sm-5" placeholder="Middle Name">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">SSN</label>
                    <input id="ssn" name="ssn" type="number" value="<?php echo $ssn; ?>" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Gender</label>
                    <input id="gender" name="gender" value="<?php echo $gender; ?>" type="text" class="form-control col-sm-5" placeholder="">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Date of Birth</label>
                    <input id="birthday" name="birthday" value="<?php echo $birthday; ?>" type="date" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Email</label>
                    <input id="email" name="email" value="<?php echo $email; ?>" type="text" class="form-control col-sm-5" placeholder="example: aaa@gmail.com" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Phone Number</label>
                    <input id="phone" name="phone" value="<?php echo $phone; ?>" type="number" class="form-control col-sm-5" placeholder="number only" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Address</label>
                    <input id="address" name="address" value="<?php echo $address; ?>" type="text" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Position</label>
                    <input id="position" name="position" value="<?php echo $position; ?>" type="text" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Wage</label>
                    <input id="wage" name="wage" value="<?php echo $wage; ?>" type="text" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Hiring Date</label>
                    <input id="hiring_date" name="hiring_date" value="<?php echo $hiring_date; ?>" type="date" class="form-control col-sm-5" placeholder="" required>
                </div>
                <div  align="center">
                    <button name="update" type="submit" class="btn btn-success">Update</button>   
                    <a href="employees.php" class="btn btn-danger">Cancel</a>
                </div>
</b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
