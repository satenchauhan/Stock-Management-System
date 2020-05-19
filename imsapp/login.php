<!DOCTYPE html>
<html>
	<head>
		<title>Stock Management System</title>
		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>	
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
<body>
		<br>
		<div class="container"><br>
			<h2 align="center">Stock Management System</h2>
			<br>
			<div class="panel panel-default" style="width:500px; margin-left: 320px;">
			    <div class="panel-heading">Login</div>
				<div class="panel-body">
					<form method="POST" id="form" class="login-form" action="users/login.php">
						<div class="form-group">
							<label>User Email</label>
							<input type="text" name="email" class="form-control" >
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" >
						</div>
						<div class="form-group">
							<input type="submit"  value="Login" class="btn btn-info" >
						</div>
					</form>
					<div class="modal-footer">
          				
                    </div>
				</div>
			</div>
			<div class="msg text-center w-100"></div>
			<?php
			   // if(isset($_GET['unauth'])){ echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">You are not authorized to access without login
			   // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
			   // </button></div>'; }
			 ?>
		</div>	
<script src="js/user.js"></script>
</body>
</html>