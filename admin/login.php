<?php 
	include 'include/header.php';
	if($_SESSION['sessionID']!=""){
		header("Location: index.php");
	}
	if(isset($_POST['adminLoginForm'])){
		$id=$_POST['name'];
		if($id=="")
			$idError="Please enter your username or email !";
		$password=$_POST['password'];
		if($password=="")
			$passwordError="Please enter your password !";
		if(!$idError and !$passwordError){
			if($obj->AdminLoginCheck($conn, $id, md5($password))){
				$_SESSION['sessionID']=$id;
				header('Location: index.php');
			} else {
				$loginError="Invalid username or password";
			}
		}
	}
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-xs-12">
			<div class="loginBox">
				<div class="text-center logo">
					<img class="indexLogo" src="<?php echo '../uploads/images/' . $obj->logo($conn); ?>" /> <?php echo $obj->title($conn); ?>
				</div>
				<form method="POST">
					<?php if($loginError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$loginError.'</p>'; ?>
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Enter username or email" />
						<?php if($idError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$idError.'</p>'; ?>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Enter Password" />
						<?php if($passwordError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$passwordError.'</p>'; ?>
					</div>
					<hr>
					<div class="form-group">
						<button type="submit" name="adminLoginForm" class="btn btn-success">Login</button>
						<a href="reset.php" class="pull-right">Forget Password</a>
					</div>
				</form>
			</div>
		<div>
	</div>
</div>

<?php 
	include 'include/footer.php';
?>