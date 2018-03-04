<?php 
	include 'include/header.php';
	if(isset($_POST['addFare'])){
		 $pickfrom=$_POST['pickfrom'];
		 if($pickfrom=="")
			 $pickfromError="Please select pick up from location !";
		 $dropto=$_POST['dropto'];
		 if($dropto=="")
			 $droptoError="Please select drop to location !";
		 $fleet=$_POST['fleet'];
		 if($fleet=="")
			 $fleetError="Please select a fleet !";
		 $fare=$_POST['fare'];
		 if($fare=="")
			 $fareError="Please enter fare !";
		 if(!$pickfromError && !$droptoError && !$fleetError && !$fareError){
			$obj->addFare($conn, $pickfrom, $dropto, $fleet, $fare);
			$successMsg="New fare saved successfully.";
		 }
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageFleets.php"><i class="fa fa-money"></i> Manage Fares</a> /</small> <i class="fa fa-plus"></i> Add New
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Pickup From</label>
				<input type="text" class="form-control pickDrop" name="pickfrom" placeholder="Enter a pickup location" value="<?php echo $_POST['pickfrom']; ?>" />
				<?php if($pickfromError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$pickfromError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Drop To</label>
				<input type="text" class="form-control pickDrop" name="dropto" placeholder="Enter a drop to location" value="<?php echo $_POST['dropto']; ?>" />
				<?php if($droptoError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$droptoError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Fleets</label>
				<div class="btn-group fleetsList">
					<input type="hidden" name="fleet" id="fleet" value="<?php echo $_POST['fleet']; ?>" />
					<?php if($_POST['fleet']){ ?>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_POST['fleet']; ?></button>
					<?php } else { ?>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select a Fleet</button>
					<?php } ?>
					<ul class="dropdown-menu">
						<?php echo $obj->fleetsList($conn); ?>
					</ul>
				</div>
				<?php if($fleetError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$fleetError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Fare Per Hour</label>
				<input type="text" class="form-control" name="fare" placeholder="Enter fare" value="<?php echo $_POST['fare']; ?>" />
				<?php if($fareError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$fareError.'</p>'; ?>
			</div>
			<hr>
			<div class="form-group">
				<button type="submit" name="addFare" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>