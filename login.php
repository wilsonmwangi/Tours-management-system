<?php 
	include 'include/header.php'; 
	if(isset($_POST['login'])){
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email))
			$emailError=$language['emailError'];
		$password=$_POST['password'];
		if($password=="" || strlen($password)<8)
			$passwordError=$language['passwordError'];
		if(!$emailError && !$passwordError){
			if($obj->loginUser($conn, $email, md5($password))){
			$_SESSION['sessionEmail']=$email;
			header("Location: ".$obj->rootpath($conn)."/profile/myBookings/1/");
			} else {
			$loginError=$language['loginError'];
			}
		}
	} 
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['login']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
			<form method="POST">
				<?php if($loginError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $loginError; ?></p><?php } ?>
				<div class="form-group">
					<label><?php echo $language['email']; ?></label>
					<input type="email" class="form-control" name="email" value="<?php echo $_POST['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
					<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
				</div>
				<div class="form-group">
					<label><?php echo $language['password']; ?></label>
					<input type="password" class="form-control" name="password" value="<?php echo $_POST['password']; ?>"  placeholder="<?php echo $language['passwordPlaceholder']; ?>" />
					<?php if($passwordError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $passwordError; ?></p><?php } ?>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-success"><?php echo $language['login']; ?></button>
					<a class="btn btn-info" href="<?php echo $obj->rootpath($conn); ?>/signup" ><?php echo $language['register']; ?></a>
					<small><a class="pull-right" href="<?php echo $obj->rootpath($conn); ?>/reset" ><?php echo $language['resetPass']; ?></a></small>
				</div>
			</form>
		</div>

<?php 
	include 'include/footer.php'; 
?>