<?php 
    require_once('dbconnect.php');
    require_once('functions.php');

    //editEmployee($conn);
    if (isset($_GET["edit"])) {
        //$script = "$('#editForm').show();";	// show edit form
        $id = $_GET["edit"];
        $sql = "SELECT * FROM supplier WHERE supplier_id = $id";
        $empArray = $conn->query($sql) or die($conn->error);	
        $row = $empArray->fetch_array();
        // get values form selected employee
        $id = $row['supplier_id'];
        $name = $row['name'];
        $industry = $row['industry'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];
        $website = $row['website'];
    }
        // update selected employee   
         
    if (isset($_POST['update'])){
        $website = "";
        $id = $_POST['id'];
        $name = $_POST['name'];
        $industry = $_POST['industry'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $website = $_POST['website'];
        // Update record
        $mySQL= "UPDATE supplier 
                 SET name='$name', industry='$industry', phone='$phone', email='$email', address='$address', website='$website' 
                 WHERE supplier_id = $id;";
        $retval = mysqli_query($conn, $mySQL);
        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error($conn));
        }

        header("location: suppliers.php?updateID:$id=success");
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
    <div>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <span class="navbar-brand">Edit Supplier: <?php echo $id, " - ", $name;?></span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse"></div>
            <?php include("navigationMenu.php");  ?><br><br>
    
    <body>
        <div class="container">
            <form action="editSupplier.php" method="POST" >
                <div class="form-group row">
                    <b class="col-sm-2">Supplier ID:</b><b><?php echo $id;?>
                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Supplier Name</label>
                    <input id="name" name="name" value="<?php echo $name; ?>" type='text' class="form-control col-sm-5" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Industry</label>
                    <input id="industry" name="industry" value="<?php echo $industry; ?>" type="text" class="form-control col-sm-5" placeholder="Industry">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Phone Number</label>
                    <input id="phone" name="phone" value="<?php echo $phone; ?>" type="text" class="form-control col-sm-5" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Email</label>
                    <input id="email" name="email" value="<?php echo $email; ?>" type="text" class="form-control col-sm-5" placeholder="example: aaa@gmail.com" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Address</label>
                    <input id="address" name="address" value="<?php echo $address; ?>" type="text" class="form-control col-sm-5"  required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Website</label>
                    <input id="website" name="website" value="<?php echo $website; ?>" type="text" class="form-control col-sm-5" placeholder="Example: www.google.com" >
                </div>
                <div  align="center">
                    <button name="update" type="submit" class="btn btn-success">Update</button>   
                    <a href="suppliers.php" class="btn btn-danger">Cancel</a>
                </div>
</b>
            </form>
        </div>
    </body>
    <?php include("scripts.php") ?>
</html>
