<?php 
	include 'include/header.php'; 
	if($logedInUser['email']!=""){
		header("Location: profile/myPortfolio/");
	}
	if(isset($_POST['signUp'])){
		$name=$_POST['name'];
		if($name=="")
			$nameError=$language['nameError'];
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email) || $obj->emailExist($conn, $email))
			$emailError=$language['emailError'];
		$password=$_POST['password'];
		if($password=="" || strlen($password)<8)
			$passwordError=$language['passwordError'];
		$mobile=$_POST['mobile'];
		if($mobile=="")
			$mobileError=$language['mobileError'];
		$address=$_POST['address'];
		if($address=="")
			$addressError=$language['addressError'];
		if(!$nameError && !$emailError && !$passwordError && !$mobileError && !$addressError){
			$code=uniqid();
			$dp="userDp.jpg";	
			$obj->addUser($conn, $name, $email, md5($password), $mobile, $address, $dp, 1);
			$_SESSION['sessionEmail']=$email;
			header("Location: ".$obj->rootpath($conn)."/profile/myBookings/1/");
		}
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['register']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<form method="POST">
				<div class="form-group">
					<label><?php echo $language['name']; ?></label>
					<input type="text" class="form-control" name="name" value="<?php echo $_POST['name']; ?>"  placeholder="<?php echo $language['namePlaceholder']; ?>" />
					<?php if($nameError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $nameError; ?></p><?php } ?>
				</div>
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
				<div class="form-group">
					<label><?php echo $language['mobile']; ?></label>
					<input type="text" class="form-control" name="mobile" value="<?php echo $_POST['mobile']; ?>"  placeholder="<?php echo $language['mobilePlaceholder']; ?>" />
					<?php if($mobileError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $mobileError; ?></p><?php } ?>
				</div>
				<div class="form-group">
					<label><?php echo $language['address']; ?></label>
					<input type="text" class="form-control" name="address" value="<?php echo $_POST['address']; ?>"  placeholder="<?php echo $language['addressPlaceholder']; ?>" />
					<?php if($addressError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $addressError; ?></p><?php } ?>
				</div>
				<div><hr></div>
				<div class="form-group">
					<button type="submit" name="signUp" class="btn btn-success"><?php echo $language['register']; ?></button>
					<a href="<?php echo $obj->rootpath($conn); ?>/login" class="btn btn-info"><?php echo $language['login']; ?></a>
				</div>
			</form>
		</div>

<?php 
	include 'include/footer.php'; 
?>