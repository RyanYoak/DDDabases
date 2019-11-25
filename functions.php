<?php
	/* ============================= Employees ===============================	*/
		//$script = "$('#editForm').hide();";
		session_start();
	function insertEmployee($conn){
		if (isset($_POST['insert'])){			
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

			// get query for insert
			$sql = "INSERT INTO employee "."(employee_id, first_name, last_name, middle_name, ssn, gender, birthday, email, phone, address, position, wage, hiring_date) "."VALUES".
			"('$id','$first_name','$last_name', '$middle_name', '$ssn', '$gender', '$birthday', '$email', '$phone', '$address', '$position', '$wage', '$hiring_date')";
			// insert to database
			$retval = mysqli_query($conn, $sql);

			if(! $retval ) {
                die('Could not enter data: ' . mysqli_error($conn));
			}
			$conn->close();
			
			// display message after submit
			$_SESSION['message'] = "Insert Record Successlly Employee ID:  $id Name:  $first_name $last_name";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'addEmployee.php';\", 3000);</script>";
		}	
	}

	function showEmployee($conn) {	
		$sql = "SELECT * FROM employee";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// view all employees
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["employee_id"]. "</td>";
					echo "<td>" . $row["first_name"]. "</td>";
					echo "<td>" . $row["last_name"]. "</td>";
					echo "<td>" . $row["email"]. "</td>";
					echo "<td>" . $row["phone"]. "</td>";
					echo "<td>" . $row["address"]. "</td>";					
					echo "<td>" . $row["wage"]. "</td>";
					echo "<td>";
						echo "<a href='editEmployee.php?edit=". $row["employee_id"]. "' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='employees.php?delete=". $row["employee_id"]. "' class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		} 
		else {
				echo "0 results";
		}
		// Delete employee by employee_ID
		if (isset($_GET["delete"])){
			$id = $_GET["delete"];
			$conn->query("DELETE FROM employee WHERE employee_id = $id") or die($conn->error);
			$conn->close();

			// display message
			$_SESSION['message'] = "Successlly Delete Employee has ID: $id";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'employees.php';\", 2);</script>";
			//header("location: employees.php?delete:$id=success");
		}
		
		//$conn->close();
	}

	function getEmployeeByID($conn, $id) {
		$sql = "SELECT * FROM employee WHERE employee_id = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param("i", $id);
		$statement->execute();

		$result = $statement->get_result();

		$employee = $result->fetch_assoc();
		return $employee;
	}

	/* ============================= Suppliers ===============================	*/
	function insertSupplier($conn){
		if (isset($_POST['insert'])){			
			$id = $_POST['id'];
			$name = $_POST['name'];
			$industry = $_POST['industry'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$website = $_POST['website'];

			// get query for insert
			$sql = "INSERT INTO supplier "."(supplier_id, name, industry, phone, email, address, website) "."VALUES".
			"('$id', '$name', '$industry', '$phone', '$email', '$address', '$website')";
			// insert to database
			$retval = mysqli_query($conn, $sql);

			if(! $retval ) {
                die('Could not enter data: ' . mysqli_error($conn));
			}
			$conn->close();
			
			// display message after submit
			$_SESSION['message'] = "Insert Record Successlly, Supplier ID:  $id Name:  $name";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'suppliers.php';\", 20);</script>";
		}	
	}

	function showSuppliers($conn){
		$sql = "SELECT * FROM supplier";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// view all employees
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["supplier_id"]. "</td>";
					echo "<td>" . $row["name"]. "</td>";
					echo "<td>" . $row["industry"]. "</td>";
					echo "<td>" . $row["phone"]. "</td>";
					echo "<td>" . $row["email"]. "</td>";
					echo "<td>" . $row["address"]. "</td>";					
					echo "<td>" . $row['website']. "</td>";
					echo "<td>";
						echo "<a href='editSupplier.php?edit=". $row["supplier_id"]. "' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='suppliers.php?delete=". $row["supplier_id"]. "' class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		} 
		else {
				echo "0 results";
		}
		// Delete employee by employee_ID
		if (isset($_GET["delete"])){
			$id = $_GET["delete"];
			$conn->query("DELETE FROM supplier WHERE supplier_id = $id") or die($conn->error);
			$conn->close();

			// display message
			$_SESSION['message'] = "Successlly Delete Supplier, ID: $id";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'suppliers.php';\", 0);</script>";
			//header("location: suppliers.php?delete:$id=success");
		}		
		
	}

	function getSupplierByID($conn, $id){

	}


	/* ============================= Customers ===============================	*/
	function showCustomers(){

	}

	/* ============================= Items ===============================	*/
	function showAllItems($conn){
		# code...
	}

	function deleteItembyID($conn, $id){
		# code...
	}

	function getItemByID($conn, $id){
		# code...
	}

	/* ============================= Orders ===============================	*/
	function showAllOrders(){

	}

	function getOrderByID($conn, $id){

	}

	function deleteOrders(){

	}

	
?>