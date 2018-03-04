<?php 
	include 'include/header.php';	
	$row=$obj->getThemeColors($conn);
	if(isset($_POST['updateTheme'])){
		$dark = $_POST['dark'];
		if($dark == "")
			$darkError = "Invalid length or empty field.";
		$defaultColor = $_POST['defaultColor'];
		if($defaultColor == "")
			$defaultColorError = "Invalid length or empty field.";
		$success = $_POST['success'];
		if($success == "")
			$successError = "Invalid length or empty field.";
		$danger = $_POST['danger'];
		if($danger == "")
			$dangerError = "Invalid length or empty field.";
		$warning = $_POST['warning'];
		if($warning == "")
			$warningError = "Invalid length or empty field.";
		$info = $_POST['info'];
		if($info == "")
			$infoError = "Invalid length or empty field.";
		$successText = $_POST['successText'];
		if($successText == "")
			$successTextError = "Invalid length or empty field.";
		$warningText = $_POST['warningText'];
		if($warningText == "")
			$warningTextError = "Invalid length or empty field.";
		$dangerText = $_POST['dangerText'];
		if($dangerText == "")
			$dangerTextError = "Invalid length or empty field.";
		$infoText = $_POST['infoText'];
		if($infoText == "")
			$infoTextError = "Invalid length or empty field.";
		if(!$darkError && !$defaultColorError && !$successError && !$dangerError && !$warningError && !$infoError && !$successTextError && !$dangerTextError && !$warningTextError && !$infoTextError){
			$obj->updateTheme($conn, $dark, $defaultColor, $success, $danger, $warning, $info, $successText, $dangerText, $warningText, $infoText);
			$successMsg = "Theme updated successfully.";
		}
	}
	$row=$obj->getThemeColors($conn);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-flask"></i> Manage Themes
	</div>
		<div class="panel-body">
			<form method="POST">
				<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Dark Color</label>
					<input type="text" class="form-control color animated flipInX" name="dark" value="<?php echo $row['dark']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Default Color</label>
					<input type="text" class="form-control color animated flipInX" name="defaultColor" value="<?php echo $row['defaultColor']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Success Button</label>
					<input type="text" class="form-control color animated flipInX" name="success" value="<?php echo $row['success']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Danger Button</label>
					<input type="text" class="form-control color animated flipInX" name="danger" value="<?php echo $row['danger']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Warning Button</label>
					<input type="text" class="form-control color animated flipInX" name="warning" value="<?php echo $row['warning']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Info Button</label>
					<input type="text" class="form-control color animated flipInX" name="info" value="<?php echo $row['info']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Success Text</label>
					<input type="text" class="form-control color animated flipInX" name="successText" value="<?php echo $row['successText']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Danger Text</label>
					<input type="text" class="form-control color animated flipInX" name="dangerText" value="<?php echo $row['dangerText']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Warning Text</label>
					<input type="text" class="form-control color animated flipInX" name="warningText" value="<?php echo $row['warningText']; ?>" />
				</div>
				<div class="form-group col-md-3 col-sm-4 col-xs-6">
					<label>Info Text</label>
					<input type="text" class="form-control color animated flipInX" name="infoText" value="<?php echo $row['infoText']; ?>" />
				</div>
				<div class="col-xs-12"><hr></div>
				<div class="form-group col-xs-12">
					<button name="updateTheme" class="btn btn-success" type="submit" >Update</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	include 'include/footer.php';
?>
			