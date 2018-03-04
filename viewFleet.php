<?php 
	include 'include/header.php';
	$fleet=$obj->getFleetDetails($conn, $_GET['fid']);
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['fleets']; ?> / <small><?php echo $language['view']; ?></small></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="media bookingDetails">
				<div class="media-left">
					<a href="<?php echo $obj->rootpath($conn); ?>/viewFleet/<?php echo $fleet['id']; ?>">
						<img class="media-object" src="<?php echo $obj->rootpath($conn); ?>/uploads/fleets/<?php echo $fleet['img']; ?>" />
					</a>
				</div>
				<div class="media-body">
					<h3 class="media-heading"><?php echo $fleet['name']; ?></h3>
					<p><?php echo $fleet['details']; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
			

<?php 
	include 'include/footer.php';
?>