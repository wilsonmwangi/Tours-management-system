<?php 
	include 'include/header.php';
	if(isset($_POST['sendMsg'])){
		$mailDetails=$obj->getSubMailDetails($conn,$_GET['id']); 
		$themeColors=$obj->getThemeColors($conn);
		$emails=$_POST['email'];
		if($emails=="")
			$emailError="Please enter email !";
		$subject=$_POST['subject'];
		if($subject=="")
			$subjectError="Please enter subject !";
		$msg=$_POST['msg'];
		if($msg=="")
			$msgError="Please enter message !";
		if(!$subjectError && !$msgError){
			$email=explode(',',$emails);
			foreach($email as $e){
				$obj->contact($conn, $e, $subject, $mail, $msg, $obj->title($conn), $themeColors);
			}
			$successMsg="Message sent successfully.";
		}
	}
	$mailDetails=$obj->getSubMailDetails($conn,$_GET['id']); 
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageInbox.php"><i class="fa fa-inbox"></i> Manage Inbox</a> /</small> <i class="fa fa-plus"></i> Compose
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Subject</label>
				<input type="text" class="form-control" name="subject" placeholder="Enter subject" value="<?php echo $_POST['subject']; ?>" />
				<?php if($subjectError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$subjectError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" placeholder="Enter email (s) comma separated if multiple" value="<?php echo $_POST['email']; ?>" />
				<?php if($emailError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$emailError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Message</label>
				<textarea id="editor" class="form-control" name="msg"><?php echo $_POST['msg']; ?></textarea>
				<?php if($msgError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$msgError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="sendMsg" class="btn btn-success">Send</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>