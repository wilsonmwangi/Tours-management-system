<?php 
	include 'include/header.php';
	if(isset($_POST['addLocation'])){
		 $name=$_POST['name'];
		 if($name=="")
			 $nameError="Please enter location name !";
		 if(!$nameError){
			$obj->addLocation($conn, $name);
			$successMsg="New location saved successfully.";
		 }
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageLocations.php"><i class="fa fa-map-marker"></i> Manage Locations</a> /</small> <i class="fa fa-plus"></i> Add New
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Enter location name" value="<?php echo $_POST['name']; ?>" />
				<?php if($nameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$nameError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="addLocation" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>