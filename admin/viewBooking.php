<?php 
	include 'include/header.php';
	$booking=$obj->getBookingDetails($conn, $_GET['bid']);
	$fleet=$obj->getFleetDetailsByName($conn, $booking['fleet']);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageBookings.php"><i class="fa fa-check"></i> Manage Bookings</a> /</small> <i class="fa fa-eye"></i> View
	</div>
	<div class="panel-body">
		<div class="col-md-8 col-xs-12">
			<div class="media bookingDetails">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="<?php echo $obj->rootpath($conn); ?>/uploads/fleets/<?php echo $fleet['img']; ?>" />
					</a>
				</div>
				<div class="media-body">
					<h2 class="media-heading"><?php echo $fleet['name']; ?></h2>
					<table class="table table-striped">
						<tr>
							<td><b>Name</b></td><td><?php echo $booking['name']; ?></td>
						</tr>
						<tr>
							<td><b>Email</b></td><td><?php echo $booking['email']; ?></td>
						</tr>
						<tr>
							<td><b>Pickup From</b></td><td><?php echo $booking['pickfrom']; ?></td>
						</tr>
						<tr>
							<td><b>Drop To</b></td><td><?php echo $booking['dropto']; ?></td>
						</tr>
						<tr>
							<td><b>Pickup Date</b></td><td><?php echo $booking['pickdate']; ?></td>
						</tr>
						<tr>
							<td><b>Pickup Time</b></td><td><?php echo $booking['picktime']; ?></td>
						</tr>
						<tr>
							<td><b>Mobile</b></td><td><?php echo $booking['mobile']; ?></td>
						</tr>
						<tr>
							<td><b>Address</b></td><td><?php echo $booking['address']; ?></td>
						</tr>
						<tr>
							<td><b>Fare</b></td><td>$<?php echo $booking['fare']; ?></td>
						</tr>
						<tr>
							<td><b>Payment Status</b></td>
							<td>
							<?php 
							if($booking['payment']!="0"){ 
								echo "OK";
							} else {
								echo "Pay Cash to Driver";
							}
							?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include 'include/footer.php';
?>