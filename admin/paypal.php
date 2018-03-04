<?php 
	include 'include/header.php';
	if(isset($_POST['updatePaypal'])){
		$paypal=$obj->getPaypal($conn);
		$email=$_POST['email'];
		if($email=="")
			$emailError="Please enter a valid email !";
		if(!$emailError){
			$obj->upatePaypal($conn, $email);
			$successMsg="Paypal email updated successfully.";
		}
	}
	$paypal=$obj->getPaypal($conn);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-users"></i> Manage Paypal
	</div>
	<div class="panel-body">
	<form class="col-md-8 col-xs-12" method="POST">
		<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo $paypal['email']; ?>" placeholder="Enter email" />
			<?php if($emailError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$emailError.'</p>'; ?>
		</div>
		<hr>
		<div class="form-group">
			<button type="submit" name="updatePaypal" class="btn btn-success">Update</button>
		</div>
	</form>
		
<?php 
	include 'include/footer.php';
?>