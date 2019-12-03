<?php 
    require_once('functions.php');
    require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dunkin Donuts</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
        <nav role="navigation" class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark" style="width=: 100%;">
            <span class="navbar-brand">Our Products</span>
            <div class="collapse navbar-collapse justify-content-stretch" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>                   
                </ul>
            </div>
        </div>
    </nav> <br>
	<body>
        <!-- List of offered Products -->

        <div class="container">
          <table id="viewTable">
              <thead class="table table-dark">
                  <th scope="col">Product ID</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Description</th>
              </thead>
              <tbody class="table table-striped">
                  <?php  showFinishedGoods($conn); ?>
              </tbody>
          </table>
      </div>

    </body>
    <?php include("scripts.php"); ?>
    </html>
