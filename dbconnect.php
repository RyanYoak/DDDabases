<?php
//Step1
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "dddatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
         
 if(! $conn ){
    die('Could not connect: ' . mysqli_error($conn));
  }
  //echo "Connected successfully";
  //header("location: employee.php?insert=success");
?>
