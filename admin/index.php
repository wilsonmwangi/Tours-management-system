<?php 
	include 'include/header.php';
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-dashboard"></i> Dashboard
	</div>
	<div class="panel-body">
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInUp">
				<h2>TODAY <small class="pull-right"><em><i class="fa fa-mouse-pointer"></i> Hits</em></small></h2>
				<h3><?php echo number_format($obj->dailyHits($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInUp">
				<h2>TODAY <small class="pull-right"><em><i class="fa fa-eye"></i> Views</em></small></h2>
				<h3><?php echo number_format($obj->dailyViews($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInUp">
				<h2>TODAY <small class="pull-right"><em><i class="fa fa-users"></i> Users</em></small></h2>
				<h3><?php echo number_format($obj->dailyUser($conn)); ?></h3>
			</div>
		</div>
		
		<div class="col-md-4 col-xs-12">
			<div class="stats">
				<h2>WEEK <small class="pull-right"><em><i class="fa fa-mouse-pointer"></i> Hits</em></small></h2>
				<h3><?php echo number_format($obj->weeklyHits($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats">
				<h2>WEEK <small class="pull-right"><em> <i class="fa fa-eye"></i> Views</em></small></h2>
				<h3><?php echo number_format($obj->weeklyViews($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats">
				<h2>WEEK <small class="pull-right"><em><i class="fa fa-users"></i> Users</em></small></h2>
				<h3><?php echo number_format($obj->weeklyUsers($conn)); ?></h3>
			</div>
		</div>
		
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInDown">
				<h2>ALL TIME <small class="pull-right"><em><i class="fa fa-mouse-pointer"></i> Hits</em></small></h2>
				<h3><?php echo number_format($obj->allTimeHits($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInDown">
				<h2>ALL TIME <small class="pull-right"><em><i class="fa fa-eye"></i>  Views</em></small></h2>
				<h3><?php echo number_format($obj->allTimeViews($conn)); ?></h3>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="stats animated fadeInDown">
				<h2>TOTAL <small class="pull-right"><em><i class="fa fa-users"></i> Users</em></small></h2>
				<h3><?php echo number_format($obj->allTimeUsers($conn)); ?></h3>
			</div>
		</div>
	</div>
</div>

<?php
	include 'include/footer.php';
?>
			