<?php 
	include 'include/header.php';
	if(isset($_POST['addFleet'])){
		$name=$_POST['name'];
		if($name=="" or $obj->fleetNameExist($conn, $name))
			 $nameError="Name already exist or empty field !";
		 $details=$_POST['details'];
		 if($details=="")
			 $detailsError="Please add some details about fleet !";
		 if(!$nameError && !$detailsError){
			if(trim($_FILES["img"]["name"])!=""){
				$base=explode(".", strtolower(basename($_FILES["img"]["name"])));
				$ext=end($base);
				if($ext=="png" or $ext=="jpg" or $ext=="jpeg"){
					$image = getimagesize($_FILES["img"]["tmp_name"]);
					$width = $image[0];
					$height = $image[1];
					if($width<600 || $height<600)
						$imgError = "Please select an image with minimum resolution of 600x600 !";
					if(!$imgError){
						$img=uniqid().".".$ext;
						move_uploaded_file($_FILES["img"]["tmp_name"], "../uploads/fleets/" . $img);
						$obj->resizeFleetImg($img);
					}
				} else {
				$imgError="Invalid images extension !";
				}
			} else {
				$imgError="Please select an image !";
			}
			if(!$imgError){
				$obj->addFleet($conn, $name, $details, $img);
				$successMsg="New fleet saved successfully.";
			}
		 }
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageFleets.php"><i class="fa fa-car"></i> Manage Fleets</a> /</small> <i class="fa fa-plus"></i> Add New
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST" enctype="multipart/form-data">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Enter fleet name" value="<?php echo $_POST['name']; ?>" />
				<?php if($nameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$nameError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Details</label>
				<textarea rows="8" class="form-control" name="details" placeholder="Enter details about fleet"><?php echo $_POST['details']; ?></textarea>
				<?php if($detailsError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$detailsError.'</p>'; ?>
			</div>
			<div class="form-group">
				<input type="file" name="img" id="img-fleet" style="display:none;" />
				<a class="btn btn-info btn-fleet">Upload Image</a>
				<?php if($imgError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$imgError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="addFleet" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>