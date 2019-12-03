<?php>
    require_once("dbconnet.php");
    require_once("functions.php");

    //editlog($conn)
    if(isset($_GET["edit"])){
      $id = $_GET["edit"];
      $log_date = $GET["log_date"];
      $sql = "SELECT * FROM logs WHERE employee_id = '$id' AND log_date = '$log_date';
        $empArray = $conn->query($sql) or die($conn->error);
        $row = $empArray->fetch_array();
        $login_time = $row['login_time'];
        $logout_time = $row['logout_time'];
        $log_date = $row['log_date'];
    }

    if(isset($_POST["update"])){
      $login_time = $_POST['login_time'];
      $logout_tome = $_POST['logout_time'];
      $log_date - $_POST['log_date'];

      $mySQL= "UPDATE logs
               SET login_time='$login_time', logout_time='$logout_time', log_date='log_date',
               WHERE employee_id = $id;";

      $conn->query($mySQL);

      $retval = mysqli_query($conn, $mySQL);

      if(! $retval ) {
          die('Could not enter data: ' . mysqli_error($conn));
      }

      header("location: logs.php?updatelog:$login_time, $logout_time, $log_date=success");
      $_SESSION['message'] = "Edit Record Successlly Logins:  $login_time, $logout_time, $log_date";
      $_SESSION['msg_type'] = "success";
    }
?>
