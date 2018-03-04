<?php 
	include 'include/header.php';
	if(isset($_POST['sendReply'])){
		$mailDetails=$obj->getSubMailDetails($conn,$_GET['id']); 
		$themeColors=$obj->getThemeColors($conn);
		$msg=$_POST['msg'];
		if($msg=="")
			$msgError="Please enter message !";
		if(!$msgError){
			$obj->contact($conn, $mailDetails['email'], $mailDetails['subject'], $mail, $msg, $obj->title($conn), $themeColors);
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
		<small><a href="manageInbox.php"><i class="fa fa-inbox"></i> Manage Inbox</a> /</small> <i class="fa fa-file"></i> View
	</div>
	<div class="panel-body">
		<div class="col-md-8 col-xs-12">
			<h4><b>Subject </b><?php echo $mailDetails['subject']; ?><span class="pull-right"><small><em><?php echo date("d, M Y", strtotime($mailDetails['enterDate'])); ?></em></small></span></h4>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="emailMsg">
				<?php echo $mailDetails['message']; ?>
			</div>
		</div>
		
		<div class="col-md-8 col-xs-12"><hr></div>
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Reply</label>
				<textarea id="editor" class="form-control" name="msg"><?php echo $_POST['msg']; ?></textarea>
				<?php if($msgError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$msgError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="sendReply" class="btn btn-success">Send</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>