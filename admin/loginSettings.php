<?php 
	include 'include/header.php';
	if(isset($_POST['updateSubAdmin'])){
		$row=$obj->manageAdminLoginSettings($conn, $_SESSION['sessionID']);
		$userName=$_POST['userName'];
		if($userName=="" or strlen($userName)<8 or $obj->thisSubAdminUsernameExist($conn, $userName, $row['userName']))
			$userNameError="Please check username length it must be grater then 8 or username already exist !";
		$email=$_POST['email'];
		if($email=="" or $obj->thisSubAdminEmailExist($conn, $email, $row['email']))
			$emailError="Invalid email or already exist !";
		$password=$_POST['password'];
		if($password=="" or strlen($password)<8)
			$passwordError="Password length must be grater than 8 !";
		if($password!=$row['password'])
			$password=md5($password);
		$status=$_POST['status'];
		if(!$userNameError && !$emailError && !$passwordError){
			$obj->updateSubAdmin($conn, $row['id'], $userName, $email, $password, 1);
			$_SESSION['sessionID']=$userName;
			$successMsg="Login settings updated successfully.";
		}
	}
	$row=$obj->manageAdminLoginSettings($conn, $_SESSION['sessionID']);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-user"></i> Login Settings
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="userName" placeholder="Enter username" value="<?php echo $row['userName']; ?>" />
				<?php if($userNameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$userNameError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" placeholder="Enter email address" value="<?php echo $row['email']; ?>" />
				<?php if($emailError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$emailError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Password</label>
	            <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $row['password']; ?>" />
				<?php if($passwordError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$passwordError.'</p>'; ?>
			</div>	
			<hr>
			<div class="form-group">
				<button type="submit" name="updateSubAdmin" class="btn btn-success">Update</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>