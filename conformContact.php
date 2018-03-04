<?php 
	include 'include/header.php'; 
	if(isset($_POST['contactDetails'])){
		$name=$_POST['name'];
		if($name=="")
			$nameError=$language['nameError'];
		$email=$_POST['email'];
		if($email=="")
			$emailError=$language['emailError'];
		$mobile=$_POST['mobile'];
		if($mobile=="")
			$mobileError=$language['mobileError'];
		$address=$_POST['address'];
		if($address=="")
			$addressError=$language['addressError'];
		if(!$nameError && !$emailError && !$mobileError && !$addressError){
			$obj->updateBookingContact($conn, $name, $email, $mobile, $address, $_GET['bid']);
			header("Location: ".$obj->rootpath($conn)."/conformBooking/".$_GET['bid']."/");
		}
	}
	if($_GET['status']=="delete"){
		$obj->deleteBooking($conn, $_GET['bid']);
		header("Location: ".$obj->rootpath($conn)."/");
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['contactDetails']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<form method="POST">
				<div class="form-group">
					<label><?php echo $language['name']; ?></label>
					<input type="text" class="form-control" name="name" value="<?php echo $logedInUser['name']; ?>"  placeholder="<?php echo $language['namePlaceholder']; ?>" />
					<?php if($nameError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $nameError; ?></p><?php } ?>
				</div>
				<div class="form-group">
					<label><?php echo $language['email']; ?></label>
					<input type="email" class="form-control" name="email" value="<?php echo $logedInUser['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
					<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
				</div>	
				<div class="form-group">
					<label><?php echo $language['mobile']; ?></label>
					<input type="text" class="form-control" name="mobile" value="<?php echo $logedInUser['mobile']; ?>"  placeholder="<?php echo $language['mobilePlaceholder']; ?>" />
					<?php if($mobileError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $mobileError; ?></p><?php } ?>
				</div>
				<div class="form-group">
					<label><?php echo $language['address']; ?></label>
					<input type="text" class="form-control" name="address" value="<?php echo $logedInUser['address']; ?>"  placeholder="<?php echo $language['addressPlaceholder']; ?>" />
					<?php if($addressError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $addressError; ?></p><?php } ?>
				</div>
				<div><hr></div>
				<div class="form-group">
					<button type="submit" name="contactDetails" class="btn btn-success"><?php echo $language['next']; ?></button>
					<a href="<?php echo $obj->rootpath($conn); ?>/conformContact/<?php echo $_GET['bid']?>/delete" class="btn btn-default"><?php echo $language['cancel']; ?></a>
				</div>
			</form>
		</div>

<?php 
	include 'include/footer.php'; 
?>