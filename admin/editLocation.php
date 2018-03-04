<?php 
	include 'include/header.php';
	if(isset($_POST['editLocation'])){
		$location=$obj->getLocationDetails($conn,$_GET['lid']); 
		 $name=$_POST['name'];
		 if($name=="")
			 $nameError="Please enter location name !";
		 if(!$nameError){
			$obj->updateLocation($conn, $name, $_GET['lid']);
			$successMsg="Location updated successfully.";
		 }
	}
	$location=$obj->getLocationDetails($conn,$_GET['lid']); 
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageLocations.php"><i class="fa fa-map-marker"></i> Manage Location</a> /</small> <i class="fa fa-edit"></i> Edit
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Enter location name" value="<?php echo $location['name']; ?>" />
				<?php if($nameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$nameError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="editLocation" class="btn btn-success">Update</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>