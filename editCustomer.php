<?php
    require_once('dbconnect.php');
    require_once('functions.php');

    //editEmployee($conn);
    if (isset($_GET["edit"])) {
        //$script = "$('#editForm').show();";	// show edit form
        $id = $_GET["edit"];
        $sql = "SELECT * FROM customer WHERE customer_id = $id";
        $empArray = $conn->query($sql) or die($conn->error);
        $row = $empArray->fetch_array();
        // get values form selected employee
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $middle_name = $row['middle_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        //$pays = $row['pays'];
    }
        // update selected employee
    if (isset($_POST['update'])){
        $id = $_POST['customer_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        //$pays = $_POST['pays'];
        // Update record
        $mySQL= "UPDATE customer
                 SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name',
                        email='$email', phone='$phone', address='$address'
                 WHERE customer_id = $id;";
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: customers.php?updateID:$id=success");
        $_SESSION['message'] = "Edit Record Successlly ID:  $id";
        $_SESSION['msg_type'] = "success";
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Edit Customers</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
	<body>
        <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <!-- Display Select employee for editting -->
            <span class="navbar-brand">Edit Customer: <?php echo $id, " - ", $first_name, " ", $last_name;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
            </div>
            <?php include("navigationMenu.php");  ?><br>
        <br>

        <!-- Display Add new customer form -->
        <div class="container">
            <form action="editCustomer.php" method="POST" >
                <div class="form-group row">
                    <b class="col-sm-2">Customer ID:</b><b><?php echo $id;?>
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $id;?>" required>
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

                

                <div  align="center">
                    <button name="update" type="submit" class="btn btn-success">Update</button>
                    <a href="customers.php" class="btn btn-danger">Cancel</a>
                </div></b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
