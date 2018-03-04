<?php 
	include 'include/header.php';
	if(isset($_POST['addSubAdmin'])){
		 $userName=$_POST['userName'];
		 if($userName=="" or strlen($userName)<8 or $obj->subAdminUsernameExist($conn, $userName))
			 $userNameError="Please check username length it must be grater then 8 or username already exist !";
		 $email=$_POST['email'];
		 if($email=="" or $obj->thisSubAdminEmailExist($conn, $email))
			 $emailError="Invalid email or already exist !";
		 $password=$_POST['password'];
		 if($password=="" or strlen($password)<8)
			 $passwordError="Password length must be grater than 8 !";
		 if(!$userNameError && !$emailError && !$passwordError){
			$obj->addSubAdmin($conn, $userName, $email, md5($password), 1, "sub-Admin");
			$successMsg="New Administrators details saved successfully.";
		 }
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageSubAdmin.php"><i class="fa fa-users"></i> Manage Administrators</a> /</small> <i class="fa fa-plus"></i> Add New
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="userName" placeholder="Enter username" value="<?php echo $_POST['userName']; ?>" />
				<?php if($userNameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$userNameError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" placeholder="Enter email address" value="<?php echo $_POST['email']; ?>" />
				<?php if($emailError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$emailError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Password</label>
	            <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $_POST['password']; ?>" />
				<?php if($passwordError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$passwordError.'</p>'; ?>
			</div>	
			<hr>
			<div class="form-group">
				<button type="submit" name="addSubAdmin" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>