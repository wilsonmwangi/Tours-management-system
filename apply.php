<?php 
	include 'include/header.php';
	if($logedInUser['email']==""){
		header("Location: ".$obj->rootpath($conn)."/login");
	}
	$job=$obj->getJobDetails($conn, $_GET['jid']);
	if(isset($_POST['applyJob'])){
		$name=$_POST['name'];
		if($name=="")
			$nameError=$language['nameError'];
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email))
			$emailError=$language['emailError'];
		$mobile=$_POST['mobile'];
		if($mobile=="")
			$mobileError=$language['mobileError'];
		$coverLetter=$_POST['coverLetter'];
		if($coverLetter=="")
			$coverLetterError=$language['coverLetterError'];
		if(!$nameError && !$emailError && !$mobileError && !$coverLetterError){
			$msg="
			<p><b>Job Title: </b>".$job['title']."</p>
			<p><b>Name: </b> $name</p>
			<p><b>Email: </b> $email</p>
			<p><b>Mobile: </b> $mobile</p>
			<p><b>Cover Letter: </b> $coverLetter</p>
			";
			$obj->ApplyForJob($conn, $mail, $obj->adminEmail($conn), $email, $msg, $themeColors);
			$successMsg=$language['applyJobSuccess'];
		}
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['career']; ?> / <small><?php echo $language['apply']; ?></small></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<form method="POST">
				<?php if($warningMsg and !$successMsg) { ?> <p class="text-warning"><i class="fa fa-info"></i> <?php echo $warningMsg; ?></p><?php } ?>
			
				<?php if($successMsg) { ?> <p class="text-success"><i class="fa fa-check"></i> <?php echo $successMsg; ?></p><?php } ?>
				<div class="row">
				<div class="form-group col-lg-10">
					<label><?php echo $language['name']; ?></label>
					<input type="text" class="form-control" name="name" value="<?php echo $logedInUser['name']; ?>"  placeholder="<?php echo $language['namePlaceholder']; ?>" />
					<?php if($nameError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $nameError; ?></p><?php } ?>
				</div>
				<div class="form-group col-lg-10">
					<label><?php echo $language['email']; ?></label>
					<input type="email" class="form-control" name="email" value="<?php echo $logedInUser['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
					<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
				</div>
				<div class="form-group col-lg-10">
					<label><?php echo $language['mobile']; ?></label>
					<input type="text" class="form-control" name="mobile" value="<?php echo $logedInUser['mobile']; ?>"  placeholder="<?php echo $language['mobilePlaceholder']; ?>" />
					<?php if($mobileError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $mobileError; ?></p><?php } ?>
				</div>
				</div>
				<div class="form-group">
					<label><?php echo $language['coverLetter']; ?></label>
					<textarea id="editor" type="text" class="form-control" name="coverLetter"  placeholder="<?php echo $language['coverLetterPlaceholder']; ?>" rows="10"><?php echo $_POST['coverLetter']; ?></textarea>
					<?php if($coverLetterError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $coverLetterError; ?></p><?php } ?>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" name="applyJob" class="btn btn-success"><?php echo $language['apply']; ?></button>
					<a href="<?php echo $obj->rootpath($conn); ?>/career/1/" class="btn btn-default"><?php echo $language['back']; ?></a>
				</div>
			</form>
		</div>
	</div>
</div>
			

<?php 
	include 'include/footer.php';
?>