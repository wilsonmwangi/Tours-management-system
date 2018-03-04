<?php 
	include 'include/header.php'; 
	$booking=$obj->getBookingDetails($conn, $_GET['bid']);
	$fleet=$obj->getFleetDetailsByName($conn, $booking['fleet']);
	$paypal=$obj->getPaypal($conn);
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['myBookings']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<?php if($_GET['status']=="done") { ?> <p class="text-success"><i class="fa fa-check"></i> <?php echo $language['bookingSuccess']; ?></p><?php } ?>
			<?php if($txError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $txError; ?></p><?php } ?>
			<?php if($amtError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $amtError; ?></p><?php } ?>
			<div class="media bookingDetails">
				<div class="media-left">
					<a href="<?php echo $obj->rootpath($conn); ?>/viewFleet/<?php echo $fleet['id']; ?>">
						<img class="media-object" src="<?php echo $obj->rootpath($conn); ?>/uploads/fleets/<?php echo $fleet['img']; ?>" />
					</a>
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="_xclick">
						<input type="hidden" name="amount" value="<?php echo $booking['fare']; ?>" />
						<input type="hidden" name="cmd" value="_xclick" /> 
						<input type="hidden" name="business" value="<?php echo $paypal['email']; ?>" /> 
						<input type="hidden" name="return" value="<?php echo $obj->rootpath($conn); ?>/conformBooking.php?bid=<?php echo $_GET['bid']; ?>" /> 
						<?php if($booking['payment']=="0"){ ?>
						<button type="submit" name="addBalance" class="btn btn-primary btn-block"><i class="fa fa-paypal"></i> <?php echo $language['payNow']; ?></button>
						<?php } else { ?>
						<button class="btn btn-primary btn-block disabled"><i class="fa fa-paypal"></i> <?php echo $language['payNow']; ?></button>
						<?php } ?>
						<a class="btn btn-default btn-block disabled"><?php echo $language['payCashToDriver']; ?></a>
					</form>
				</div>
				<div class="media-body">
					<h3 class="media-heading">
					<?php 
					if(strlen($fleet['name'])>30)
						echo substr($fleet['name'],0,30)."...";
					else 
						echo $fleet['name']; 
					?>
					</h3>
					<table class="table table-striped">
						<tr>
							<td><b><?php echo $language['name']; ?></b></td><td><?php echo $booking['name']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['email']; ?></b></td><td><?php echo $booking['email']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['pickupFrom']; ?></b></td><td><?php echo $booking['pickfrom']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['dropTo']; ?></b></td><td><?php echo $booking['dropto']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['pickupDate']; ?></b></td><td><?php echo $booking['pickdate']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['pickupTime']; ?></b></td><td><?php echo $booking['picktime']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['mobile']; ?></b></td><td><?php echo $booking['mobile']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['address']; ?></b></td><td><?php echo $booking['address']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $language['fare']; ?></b></td><td>$<?php echo $booking['fare']; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

<?php 
	include 'include/footer.php'; 
?>