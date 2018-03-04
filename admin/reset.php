<?php 
	include 'include/header.php';
	if(isset($_POST['resetPass'])){
		$id=$_POST['id'];
		if($id=="" || !$obj->subAdminResetIdExist($conn, $id))
			$idError="Invalid email or empty field !";
		if(!$idError) {
			$obj->resetPasswordAdmin($conn, $mail, $obj->subAdminResetIdExist($conn, $id), $obj->rootpath($conn), $themeColors);
			$successMsg="A new password sent to your email.";
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
					<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
					<div class="form-group">
						<input type="text" name="id" class="form-control" placeholder="Enter username or email" />
						<?php if($idError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$idError.'</p>'; ?>
					</div>
					<hr>
					<div class="form-group">
						<button type="submit" name="resetPass" class="btn btn-info">Reset Password </button>
						<a href="login.php" class="pull-right">Login</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'include/footer.php';
?>