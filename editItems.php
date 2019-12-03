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

    }
        // update selected employee    
    if (isset($_POST['update'])){
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];

        // Query
        $mySQL= "UPDATE employee 
                 SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', ssn='$ssn', gender='$gender',
                        birthday='$birthday', email='$email', phone='$phone', address='$address', position='$position', wage='$wage', hiring_date='$hiring_date' 
                 WHERE employee_id = $id;";
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: items.php?updateID:$id=success");
        $_SESSION['message'] = "Edit Record Successlly ID:  $id";
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
            <span class="navbar-brand">Edit Item: <?php echo $id;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"> 
            </div>
            <?php include("navigationMenu.php");  ?><br>
        <br> 

        <!-- Display Edit form-->
        <div class="container">
            <form action="editEmployee.php" method="POST" >
                <div class="form-group row">
                    <b class="col-sm-2">Product Id:</b><b><?php echo $id;?>
                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">        </label>
                    <input id="firstName" name="first_name" value="<?php echo $first_name; ?>" type='text' class="form-control col-sm-5" placeholder="First Name" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Last Name</label>
                    <input id="last_name" name="last_name" value="<?php echo $last_name; ?>" type="text" class="form-control col-sm-5" placeholder="Last Name" required>
                <div>
                <div  align="center">
                    <button name="update" type="submit" class="btn btn-success">Update</button>   
                    <a href="items.php" class="btn btn-danger">Cancel</a>
                </div></b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
