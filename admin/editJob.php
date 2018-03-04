<?php 
	include 'include/header.php';
	$job=$obj->getJobDetails($conn, $_GET['jid']);
	if(isset($_POST['updateJob'])){
		$title=$_POST['title'];
		if($title=="")
			$titleError="Please enter website title !";
		$status=$_POST['status'];
		$details=$_POST['details'];
		if($details=="" || strlen($details)<20)
			$detailsError="Please enter some details about job !";
		$location=$_POST['location'];
		if($location=="")
			$locationError="Please enter job location !";
		$salary=$_POST['salary'];
		if($salary=="")
			$salaryError="Please enter job salary !";
		if(!$titleError && !$detailsError && !$locationError && !$salaryError){
			$obj->updateJob($conn, $title, $status, $details, $location, $salary, $_GET['jid']);
			$successMsg="Job updated successfully.";
		}
	}
	$job=$obj->getJobDetails($conn, $_GET['jid']);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageJobs.php"><i class="fa fa-users"></i> Manage Jobs</a> /</small> <i class="fa fa-edit"></i> Edit
	</div>
	<div class="panel-body">
	<form class="col-md-8 col-xs-12" method="POST">
		<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
		<div class="form-group">
			<label>Job Title</label>
			<input type="text" class="form-control" name="title" value="<?php echo $job['title']; ?>" placeholder="Enter title" />
			<?php if($titleError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$titleError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Job Status</label>
			<select class="form-control" name="status">
				<?php if($job['status']=='Available'){ ?>
				<option value="Available">Available</option>
				<option value="Filled">Filled</option>
				<?php } else { ?>
				<option value="Filled">Filled</option>
				<option value="Available">Available</option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Job Details</label>
			<textarea id="edit" class="form-control" name="details" placeholder="Enter job details" rows="10"><?php echo $job['details']; ?></textarea>
			<?php if($detailsError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$detailsError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Location</label>
			<input type="text" class="form-control" name="location" value="<?php echo $job['location']; ?>" placeholder="Enter job location" />
			<?php if($locationError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$locationError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Salary</label>
			<input type="text" class="form-control" name="salary" value="<?php echo $job['salary']; ?>" placeholder="Enter job salary" />
			<?php if($salaryError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$salaryError.'</p>'; ?>
		</div>
		<hr>
		<div class="form-group">
			<button type="submit" name="updateJob" class="btn btn-success">Update</button>
		</div>
	</form>
	
<?php 
	include 'include/footer.php'; 
?>