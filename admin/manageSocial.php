<?php 
	include 'include/header.php';	
	$row=$obj->manegeSocial($conn);
	if(isset($_POST['socialProfileSubmit'])){
		$facebook=$_POST['facebook'];
		if($facebook=="")
			$facebookError="Please enter your facebook ID !";
		$twitter=$_POST['twitter'];
		if($twitter=="")
			$twitterError="Please enter your twitter ID !";
		$googlePlus=$_POST['googlePlus'];
		if($googlePlus=="")
			$googlePlusError="Please enter your google-plus ID !";
		$linkedIn=$_POST['linkedIn'];
		if($linkedIn=="")
			$linkedInError="Please enter your linkedIn ID !";
		if(!$facebookError and !$twitterError and !$googlePlusError and !$linkedInError){
			$obj->updateSocial($conn, $facebook, $twitter, $googlePlus, $linkedIn);
			$successMsg="Social media profiles updated successfully.";
		}
	}
	$row=$obj->manegeSocial($conn);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-globe"></i> Social Profiles
	</div>
	<div class="panel-body">
		<form method="post" class="col-md-8 col-xs-12">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
				<input name="facebook" class="form-control" type="text" value=<?php echo  $row['facebook']; ?> />
			</div>
			<?php if($facebookError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$facebookError.'</p>'; ?>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-twitter"></i></span>
				<input name="twitter" type="text" class="form-control" value=<?php echo $row['twitter']; ?> />
			</div>
			<?php if($twitterError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$twitterError.'</p>'; ?>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
				<input name="googlePlus" type="text" class="form-control" value=<?php echo $row['googlePlus']; ?> />
			</div>
			<?php if($googlePlusError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$googlePlusError.'</p>'; ?>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
				<input name="linkedIn" type="text" class="form-control" value=<?php echo $row['linkedIn']; ?> >
			</div>
			<?php if($linkedInError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$linkedInError.'</p>'; ?>
			<hr>
			<div class="form-group">
				<button class="btn btn-success" name="socialProfileSubmit" type="submit" >Update</button> 
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>