<?php
	/* ============================= Employees ===============================	*/
	session_start();
	// Insert new employee to employee table
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

	// Show important information of employees
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

			$conn->query("DELETE FROM payroll WHERE employee_id = $id") or die($conn->error);
			$conn->query("DELETE FROM logs WHERE employee_id = $id") or die($conn->error);
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
	
	function showEmployeeID($conn) {
		$sql = "SELECT employee_id FROM employee";
		$result = mysqli_query($conn, $sql) or die($conn->error);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["employee_id"];
				echo "<option value=" . $row["employee_id"] . ">" . $row["employee_id"] . "</option>";
			}
		}
	}
	

	/* ============================= Suppliers ===============================	*/
	/* Show employee's information
		- Offer edit and delete options
		- delete function
	*/
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

	// Show supplier ID
	function showSupplierID($conn) {
		$sql = "SELECT supplier_id FROM supplier";
		$result = mysqli_query($conn, $sql) or die($conn->error);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["supplier_id"];
				echo "<option value=" . $row["supplier_id"] . ">" . $row["supplier_id"] . "</option>";
			}
		}
	}

/* ============================= Items & Supplies ===============================	*/
	// Insert new item to items table
	function insertItem($conn){
		if (isset($_POST['insert'])){
			// 1. Get supplier information
			$supplier_id = $_POST['supplier_id'];
			$name = $_POST['name'];
			$industry = $_POST['industry'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$website = $_POST['website'];
			// 2. Get item inforation
			$product_id = $_POST['product_id'];
			$category = $_POST['category'];
			$unit_price = $_POST['unit_price'];
			$quantity = $_POST['quantity'];
			$description = $_POST['description'];

			// 3. Prepare query for inserting supplier
			$suppSQL = "INSERT INTO supplier "."(supplier_id, name, industry, phone, email, address, website) "."VALUES".
			"('$supplier_id', '$name', '$industry', '$phone', '$email', '$address', '$website')";
			// 4. Prepare query for inserting product
			$itemSQL = "INSERT INTO items "."(product_id, category, unit_price, quantity, description) "."VALUES".
			"('$product_id', '$category', '$unit_price', '$quantity', '$description')";
			// 5. Prepare query for inserting product
			$sql = "INSERT INTO supplies "."(product_id, supplier_id) "."VALUES"."('$product_id', '$supplier_id')";

			// 6. insert supplier, product, supplies
			$addSupplier = mysqli_query($conn, $suppSQL);
			$addItem = mysqli_query($conn, $itemSQL);
			$addSupplies = mysqli_query($conn, $sql);
			/*	if not exist supplier or not exist item then (add supllier & item , execute b4) ---> add supplies
					if exist supplies -> die("ERRRO: Existing Record, Cannot Insert, ")
			 */
			if (! $addSupplier && $addSupplies){
				$_SESSION['message'] = "Insert supplies Sucessfully; \n Warning: supplier ID has been taken / the supplier exists";
				$_SESSION['msg_type'] = "warning";
			}
			elseif (! $addItems && $addSupplies){
				$_SESSION['message'] = "Insert supplies Sucessfully; \n Warning: item ID has been taken / the item exists";
				$_SESSION['msg_type'] = "warning";
			}
			elseif(! $addSupplies ) {
				$_SESSION['message'] = "ERROR: Existing Record, Please enter new information";
				$_SESSION['msg_type'] = "danger";
			}
			else{
				$_SESSION['message'] = "Insert Record Successfully";
				$_SESSION['msg_type'] = "success";
			}

			echo "<script> setTimeout(\"location.href = 'addItems.php';\", 4500);</script>";
		}

	}
	/* Show supplies information: product_id, supplier_id, supplier.name, description,  */
	function showSupplies($conn){
		$sql = "SELECT supplies.product_id, supplies.supplier_id, supplier.name, items.description FROM supplies NATURAL JOIN  items NATURAL JOIN supplier";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["product_id"]. "</td>";
					echo "<td>" . $row["supplier_id"]. "</td>";
					echo "<td>" . $row["name"]. "</td>";
					echo "<td>" . $row["description"]. "</td>";
					echo "<td>";
						echo "<a href='supplies.php?edit=". $row["product_id"]. "' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='supplies.php?delete=" . $row["product_id"] . "&supplier=" . $row["supplier_id"] . "'class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		}
		else{
			echo "There is no supplies";
		}

		// delete supplies
		if (isset($_GET["delete"])){
			$product_id = $_GET["delete"];
			$supplier_id = $_GET['supplier'];
			$conn->query("DELETE FROM supplies WHERE supplier_id=$supplier_id AND product_id=$product_id") or die($conn->error);
			// Display message
			$_SESSION['message'] = "Successlly Delete Supplies, Product ID: $product_id, Supplier ID: $supplier_id";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'supplies.php';\", 3000);</script>";
			// delete any supplies and item that's not in supplies list
			$conn->query("DELETE FROM supplier WHERE supplier_id NOT IN (SELECT supplier_id FROM supplies);");
			$conn->query("DELETE FROM items WHERE product_id NOT IN (SELECT product_id FROM supplies);");
		}
		$conn->close();
	}

	function insertSupplies($conn){
		if (isset($_POST["insert"])){
			$product_id = $_POST["product_id"];
			$supplier_id = $_POST["supplier_id"];
			//insert rescord
			$sql = "INSERT INTO supplies "."(product_id, supplier_id) "."VALUES"."('$product_id', '$supplier_id')";
			$conn->query("INSERT INTO supplies (product_id, supplier_id) VALUES ('$product_id', '$supplier_id')") or die($conn->error);
			//$result = mysqli_query($conn, $sql);
			$_SESSION['message'] = "Insert Record Successlly";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'supplies.php';\", 0);</script>";
		}
	}

	// show product ID
	function showProductID($conn) {
		$sql = "SELECT product_id FROM items";
		$result = mysqli_query($conn, $sql) or die($conn->error);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["product_id"];
				echo "<option value=" . $row["product_id"] . ">" . $row["product_id"] . "</option>";
			}
		}
	}

	function showAllItems($conn){ //show item (not include supplier's information)
		# code...
	}



	/* ============================= Customers ===============================	*/
	function showCustomers($conn){
		$sql = "SELECT * FROM customer";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// view all customers
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["customer_id"]. "</td>";
					echo "<td>" . $row["first_name"]. "</td>";
					echo "<td>" . $row["last_name"]. "</td>";
					echo "<td>" . $row["email"]. "</td>";
					echo "<td>" . $row["phone"]. "</td>";
					echo "<td>" . $row["address"]. "</td>";
					echo "<td>" . $row["pays"]. "</td>";
					echo "<td>";
						echo "<a href='editCustomer.php?edit=". $row["customer_id"]. "' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='customers.php?delete=". $row["customer_id"]. "' class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		}
		else {
					echo "0 results";
		}
		// Delete customer by customer_ID
		if (isset($_GET["delete"])){
			$id = $_GET["delete"];
			//Delete orders that have the customer_ID

			$conn->query("DELETE FROM orders WHERE customer_id = $id") or die($conn->error);
			$conn->query("DELETE FROM customer WHERE customer_id = $id") or die($conn->error);
			$conn->close();

			// display message
			$_SESSION['message'] = "Successlly Delete Customer and orders that have ID: $id";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'customers.php';\", 2);</script>";
		}

}

function insertCustomer($conn){
	if (isset($_POST['insert'])){
		$customer_id = $_POST['customer_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$middle_name = $_POST['middle_name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$pays = $_POST['pays'];

		// get query for insert
		$sql = "INSERT INTO customer "."(customer_id, first_name, last_name, middle_name, email, phone, address, pays) "."VALUES".
		"('$customer_id','$first_name','$last_name', '$middle_name', '$email', '$phone', '$address', '$pays')";
		// insert to database
		$retval = mysqli_query($conn, $sql);

		if(! $retval ) {
							die('Could not enter data: ' . mysqli_error($conn));
		}
		$conn->close();

		// display message after submit
		$_SESSION['message'] = "Insert Record Successlly Customer ID:  $customer_id Name:  $first_name $last_name";
		$_SESSION['msg_type'] = "success";
		echo "<script> setTimeout(\"location.href = 'addCustomer.php';\", 3000);</script>";
	}
}


	/* ============================= Orders ===============================	*/
	function showAllOrders($conn){
		$sql = "SELECT * FROM orders";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// view all orders
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["customer_id"]. "</td>";
					echo "<td>" . $row["product_id"]. "</td>";
					echo "<td>" . $row["timestamp"]. "</td>";
					echo "<td>" . $row["quantity"]. "</td>";
					echo "<td>";
						echo "<a href='editOrders.php?edit=". $row["customer_id"] . "&product_id=" . $row["product_id"] . "&timestamp=" . $row["timestamp"] ."' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='orders.php?delete=". $row["customer_id"] . "&product_id=" . $row["product_id"] . "&timestamp=" . $row["timestamp"] ."' class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		}
		else {
				echo "0 results";
		}

		// Delete selected order
		if (isset($_GET["delete"])){
			$customer_id = $_GET["delete"];
			$product_id = $_GET["product_id"];
			$timestamp = $_GET["timestamp"];

			//Delete orders that have the customer_ID

			$conn->query("DELETE FROM orders WHERE customer_id = '$customer_id' AND product_id = '$product_id' AND timestamp='$timestamp'") or die($conn->error);
			$conn->close();

			// display message
			$_SESSION['message'] = "Successlly Delete orders";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'orders.php';\", 2);</script>";
		}
	}

	function insertOrder($conn){
		if (isset($_POST['insert'])){
			// 1. Get oder information
			$customer_id = $_POST['customer_id'];
			$product_id = $_POST['product_id'];
			$timestamp = $_date['"Y-m-d H:i:s"'];
			$quantity = $_POST['quantity'];

			// get query for insert
			$sql = "INSERT INTO orders "."(customer_id, product_id, timestamp, quantity) "."VALUES". "('$customer_id', '$product_id', '$timestamp', '$quantity')";
			// insert to database
			$retval = mysqli_query($conn, $sql);

			if(! $retval ) {
                die('Could not insert order, data: ' . mysqli_error($conn));
			}
			// display message after submit
			$_SESSION['message'] = "Insert Record Successlly. Customer ID:  $customer_id Product ID:  $product_id Quantity: $quantity";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'addOrders.php';\", 3000);</script>";
		}
	}


	/* ============================= Payrolls ===============================	*/
	function showPayrolls($conn) {
		$sql = "SELECT * from payroll";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// view all payrolls
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
					echo "<td>" . $row["employee_id"]. "</td>";
					echo "<td>" . $row["pay_date"]. "</td>";
					echo "<td>" . $row["paycheck_amount"]. "</td>";
					echo "<td>";
						echo " <a href='editPaycheck.php?edit=". $row["employee_id"] . "&pay_date=" . $row["pay_date"] . "&paycheck_amount=" . $row["paycheck_amount"] ."' class='btn btn-info btn-sm'>Edit</a>";
						echo " <a href='paycheck.php?delete=". $row["employee_id"] . "&pay_date=" . $row["pay_date"] . "&paycheck_amount=" . $row["paycheck_amount"] ."' class='btn btn-danger btn-sm'>Delete</a>";
					echo "</td>";
				echo '</tr>';
			}
		}
		
		else {
			echo "0 results";
		}
		
		// Delete paycheck by employee_ID, date
		if (isset($_GET["delete"])){
			$employee_id = $_GET["delete"];
			$pay_date = $_GET["pay_date"];
			//Delete paycheck that has the employee id, date

			$conn->query("DELETE FROM payroll WHERE employee_id = $employee_id AND pay_date = $pay_date") or die($conn->error);
			$conn->close();

			// display message
			$_SESSION['message'] = "Successlly deleted paycheck that has ID: $employee_id, Date: $pay_date";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'payrolls.php';\", 2);</script>";
		}
	}

	function insertPaycheck($conn) {
		if (isset($_POST['insert'])){
			$employee_id = $_POST['employee_id'];
			$pay_date = $_POST['pay_date'];
			$paycheck_amount = $_POST['paycheck_amount'];

			// get query for insert
			$sql = "INSERT INTO payroll "."(employee_id, pay_date, paycheck_amount) "."VALUES".
			"('$employee_id', '$pay_date', '$paycheck_amount')";
			
			// insert to database
			$retval = mysqli_query($conn, $sql);

			if(! $retval ) {
                		die('Could not insert paycheck, data: ' . mysqli_error($conn));
			}

			// display message after submit
			$_SESSION['message'] = "Insert Record Successlly. Employee ID:  $employee_id Date:  $pay_date Amount: $paycheck_amount";
			$_SESSION['msg_type'] = "success";
			echo "<script> setTimeout(\"location.href = 'addPaycheck.php';\", 3000);</script>";
		}

	}	
?>