<?php 
	include 'include/header.php';  
?>	
	</div>
</div>

<div class="main">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1><?php echo $language['needARide']; ?></h1>
			<h4><?php echo $language['youAreAtTheRightPlace']; ?></h4>
			<a href="<?php echo $obj->rootpath($conn); ?>/fleets" class="btn btn-lg btn-default"><?php echo $language['fleets']; ?></a>
			<a href="<?php echo $obj->rootpath($conn); ?>/makeABooking" class="btn btn-lg btn-success"><?php echo $language['makeABooking']; ?></a>
		</div>
	</div>
</div>

<!-- <div class="page-heading"><?php echo $language['bookings']; ?></div>

<div class="container">
	<div class="row">
		<form class="col-md-5 col-xs-12">
			<div class="form-group">
				<label><?php echo $language['pickupDate']; ?></label>
				<div class="input-append date" id="pickupDate">
					<input data-format="dd/MM/yyyy" id="pickdate" type="text" class="form-control" placeholder="<?php echo $language['pickupDatePlaceholder']; ?>" />
					<span class="add-on">
						<i class="fa fa-calendar"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label><?php echo $language['pickupTime']; ?></label>
				<div class="input-append" id="pickupTime">
					<input data-format="hh:mm:ss PP" id="picktime" type="text" class="form-control" placeholder="<?php echo $language['pickupTimePlaceholder']; ?>" />
					<span class="add-on">
						<i class="fa fa-clock-o"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label><?php echo $language['pickupFrom']; ?></label>
				<input type="text" class="form-control pickDrop" id="start" placeholder="<?php echo $language['pickupFromPlaceholder']; ?>" onkeypress="calcRoute();" onkeyup="calcRoute();" onblur="calcRoute();" />
				<span class="add-on">
					<i class="fa fa-map-marker"></i>
				</span>
			</div>
			<div class="form-group">
				<label><?php echo $language['dropTo']; ?></label>
				<input type="text" class="form-control pickDrop" id="end" placeholder="<?php echo $language['dropToPlaceholder']; ?>" onkeypress="calcRoute();" onkeyup="calcRoute();" onblur="calcRoute();" />
				<span class="add-on">
					<i class="fa fa-map-marker"></i>
				</span>
			</div>
			<div class="form-group btn-group fleetsList">
				<label><?php echo $language['fleet']; ?></label>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="fleetText"><?php echo $language['selectAFleet']; ?></span> 
				<span class="add-on">
					<i class="fa fa-car"></i>
				</span>
				</button>
				<ul class="dropdown-menu">
					<?php echo $obj->fleetsList($conn); ?>
				</ul>
				<input type="hidden" id="fleet" />
			</div>
			<div class="form-group">
				<label><?php echo $language['fare']; ?></label>
				<input type="text" class="form-control" id="fare" placeholder="<?php echo $language['selectcardinalsabove']; ?>" />
				<span class="add-on">
					<i class="fa fa-money"></i>
				</span>
			</div>
			<div class="form-group">
				<a class="btn btn-info checkFare"><?php echo $language['checkFare']; ?></a>
				<a class="btn btn-success bookNow"><?php echo $language['bookNow']; ?></a>
			</div>
		</form>
		<div class="col-md-7 col-xs-12">
			<div class="form-group">
				<div id="map-canvas"></div>
			</div>
		</div>
	</div>
</div>

<div class="page-heading"><?php echo $language['ourTeam'];?></div>

<div class="ourTeam">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-xs-12 text-center">
				<h2><?php echo $language['meetOurAmazingTeam']; ?></h2>
				<p><i class="fa fa-quote-left"></i> <?php echo $language['aboutTeam']; ?> <i class="fa fa-quote-right"></i></p>
			</div>
		</div>
	</div>
</div>

<div class="page-heading"><?php echo $language['fleets'];?></div>

<div class="container">
	<div class="row">
		<?php echo $obj->fleets($conn); ?>
		 -->
<?php 
	include 'include/footer.php'; 
?>