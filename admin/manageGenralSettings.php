<?php 
	include 'include/header.php';
	if(isset($_POST['generalSettingSubmit'])){
		$row=$obj->manageGenralSettings($conn);
		$title=$_POST['title'];
		if($title=="")
			$titleError="Please enter website title !";
		$description=$_POST['description'];
		if($description=="")
			$descriptionError="Please enter website description !";
		$keyword=$_POST['keyword'];
		if($keyword=="")
			$keywordError="Please enter website keywords !";
		$rootpath=$_POST['rootpath'];
		if($rootpath=="")
			$rootpathError="Please enter website rootpath e.g (http://www.example.com)";
		if(!$titleError && !$descriptionError && !$keywordError && !$rootpathError){
			if (trim($_FILES["logo"]["name"])!=""){
				$base=explode(".", strtolower(basename($_FILES["logo"]["name"])));
				$ext=end($base);
				if($ext=="png" or $ext=="jpg" or $ext=="jpeg"){
					$logo="logo.".$ext;
					unlink("../uploads/images/".$row['logo']);
					move_uploaded_file($_FILES["logo"]["tmp_name"], "../uploads/images/" . $logo);
				} else {
					$logo=$row['logo'];
				}
			} else {
				$logo=$row['logo'];
			}
			if(trim($_FILES["favicon"]["name"])!=""){
				$base=explode(".", strtolower(basename($_FILES["favicon"]["name"])));
				$ext=end($base);
				if($ext=="ico" or $ext == "png" or $ext == "jpg"){
					$favicon="favicon.".$ext;
					unlink("../uploads/images/".$row['favicon']);
					move_uploaded_file($_FILES["favicon"]["tmp_name"], "../uploads/images/" . $favicon);
				} else {
					$favicon=$row['favicon'];
				}
			} else {
				$favicon=$row['favicon'];
			}
			$obj->updateGeneralSetting($conn,$title,$description,$keyword,$rootpath, $logo,$favicon);
			$successMsg="General settings updated successfully.";
		}
	}
	$row=$obj->manageGenralSettings($conn);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-cogs"></i> General Settings
	</div>
	<div class="panel-body">
		<form method="POST" action="manageGenralSettings.php" enctype="multipart/form-data">
			<div class="col-md-8 col-xs-12">
				<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			</div>
			<div class="form-group col-md-8 col-xs-12">
				<label>Title</label>
				<input name="title" class="form-control" type="text" value=<?php echo $row['title']; ?> placeholder="Enter website title" />
				<?php if($titleError) echo'<p class="text-danger"><i class="fa fa-times-circle"></i> '.$titleError.'</p>'; ?>
			</div>
			<div class="form-group col-md-10 col-xs-12">
				<label>Description</label>
				<textarea name="description" placeholder="Enter website description" class="form-control" rows="10"><?php echo $row['description']; ?></textarea>
				<?php if($descriptionError) echo'<p class="text-danger"><i class="fa fa-times-circle"></i> '.$descriptionError.'</p>'; ?>
			</div>
			<div class="form-group col-md-10 col-xs-12">
				<label>Keywords</label>
				<textarea name="keyword" placeholder="Enter website keywords" class="form-control" rows="6"><?php echo  $row['keyword']; ?></textarea>
				<?php if($keywordError) echo'<p class="text-danger"><i class="fa fa-times-circle"></i> '.$keywordError.'</p>'; ?>
			</div>
			<div class="form-group col-md-8 col-xs-12">
				<label>Website URL</label>
				<input name="rootpath" class="form-control" type="text" value=<?php echo $row['rootpath']; ?> placeholder="Enter website rootpath e.g (http://www.example.com)" />
				<?php if($rootpathError) echo'<p class="text-danger"><i class="fa fa-times-circle"></i> '.$rootpathError.'</p>'; ?>
			</div>
			<div class="form-group col-md-8 col-xs-12">
				<div class="thumbnail col-md-4 text-center">
					<img src="../uploads/images/<?php echo $row['logo']; ?>" width="198" id="logoImg" />
					<div class="caption">
						<hr>
						<a class="btn btn-info btn-sm btn-block" id="logoBtn"><i class="fa fa-upload"></i> Upload New Logo</a>
						<input type="file" name="logo" id="logo" style="display:none;" onchange="showLogo(this);" />
					</div>
				</div>
				<div class="thumbnail col-md-4 text-center">
					<img src="../uploads/images/<?php echo $row['favicon']; ?>" width="32" id="faviconImg" />
					<div class="caption">
						<hr>
						<a class="btn btn-info btn-sm btn-block" id="faviconBtn"><i class="fa fa-upload"></i> Upload New Favicon</a>
						<input type="file" name="favicon" id="favicon" style="display:none;" onchange="showFavicon(this);" />
					</div>
				</div>
			</div>
			<div class="col-md-10 col-xs-12"><hr></div>
			<div class="form-group col-md-8 col-xs-12">
			<button type="submit" class="btn btn-success" name="generalSettingSubmit">Update</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>	