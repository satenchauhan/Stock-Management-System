<?php
session_start();

if(!isset($_SESSION['LOGGEDIN'])){
	header("location:login.php?unauth=unauthorized access?");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Stock Management System</title>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">		
		<script src="js/bootstrap.js"></script>
	</head>
<body>
<?php include('common/navbar.php'); ?>

	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total User</strong></div>
				<div class="panel-body total_user" align="center">
					<!-- <h1>2000</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Category</strong></div>
				<div class="panel-body total_category" align="center">
					<!-- <h1>50</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Brand</strong></div>
				<div class="panel-body total_brand" align="center">
					<!-- <h1>234</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Item in Stock</strong></div>
				<div class="panel-body total_item" align="center">
					<!-- <h1>345</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Order Value</strong></div>
				<div class="panel-body total_order_value" align="center">
					<!-- <h1>12334</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Cash Order Value</strong></div>
				<div class="panel-body cash_value" align="center">
					<!-- <h1>40000</h1> -->
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Credit Order Value</strong></div>
				<div class="panel-body credit_value" align="center">
					<!-- <h1>606000</h1> -->
				</div>
			</div>
		</div>
		<hr />
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>More Data can be display here</strong></div>
				<div class="panel-body" align="center">
					------------------------------------------
				</div>
			</div>
		</div>
<script src="js/dashboard.js"></script>
<?php include("common/footer.php"); ?>