<?php 
	include 'include/header.php';
	if(isset($_POST['contactUs'])){
		$subject=$_POST['subject'];
		if($subject=="")
			$subjectError=$language['subjectError'];
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email))
			$emailError=$language['emailError'];
		$msg=$_POST['msg'];
		if($msg=="")
			$msgError=$language['msgError'];
		if(!$subjectError && !$emailError && !$msgError){
			$obj->contact($conn, $email, $subject, $mail, $msg, $obj->title($conn), $themeColors);
			$obj->saveMsg($conn, $subject, $email, $msg);
			$successMsg=$language['contactSuccess'];
		}
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['contactUsHead']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<form method="POST">
				<?php if($successMsg) { ?> <p class="text-success"><i class="fa fa-check"></i> <?php echo $successMsg; ?></p><?php } ?>
				<div class="row">
				<div class="form-group col-xs-12">
					<label><?php echo $language['subject']; ?></label>
					<input type="text" class="form-control" name="subject" value="<?php echo $_POST['subject']; ?>"  placeholder="<?php echo $language['subjectPlaceholder']; ?>" />
					<?php if($subjectError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $subjectError; ?></p><?php } ?>
				</div>
				<div class="form-group col-xs-12">
					<label><?php echo $language['email']; ?></label>
					<input type="email" class="form-control" name="email" value="<?php echo $_POST['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
					<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
				</div>
				</div>
				<div class="form-group">
					<label><?php echo $language['msg']; ?></label>
					<textarea id="editor" type="text" class="form-control" name="msg"  placeholder="<?php echo $language['msgPlaceholder']; ?>" rows="8"><?php echo $_POST['msg']; ?></textarea>
					<?php if($msgError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $msgError; ?></p><?php } ?>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" name="contactUs" class="btn btn-success"><?php echo $language['send']; ?></button>
				</div>
			</form>
		</div>

<?php 
	include 'include/footer.php'; 
?>