<?php 
	include 'include/header.php'; 
	if(isset($_POST['resetPass'])){
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email) || !$obj->emailExist($conn, $email))
			$emailError=$language['emailError'];
		if(!$emailError) {
			$obj->resetPassword($conn, $mail, $email, $obj->rootpath($conn), $themeColors);
			$successMsg=$language['resetSuccess'];
		} 
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['reset']; ?></div>
	
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<form method="POST">
				<?php if($successMsg) { ?> <p class="text-success"><i class="fa fa-check"></i> <?php echo $successMsg; ?></p><?php } ?>
				<div class="form-group">
					<label><?php echo $language['email']; ?></label>
					<input class="form-control" name="email" value="<?php echo $_POST['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
					<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
				</div>
				<hr>
				<div class="form-group">
				<button type="submit" name="resetPass" class="btn btn-success"> <?php echo $language['reset']; ?></button>
				<a class="btn btn-info" href="<?php echo $obj->rootpath($conn); ?>/login"><?php echo $language['login']; ?></a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
	include 'include/footer.php';
?>