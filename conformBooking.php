<?php 
	include 'include/header.php'; 
	$booking=$obj->getBookingDetails($conn, $_GET['bid']);
	$fleet=$obj->getFleetDetailsByName($conn, $booking['fleet']);
	$paypal=$obj->getPaypal($conn);
	if($_GET['tx']!="" && $_GET['amt']!=""){
		$tx=$_GET['tx'];
		if($tx=="")
			$txError=$language['txError'];
		$amt=$_GET['amt'];
		if($amt=="")
			$amtError=$language['amtError'];
		if(!$txError && !$amtError){
			$obj->updatePaymentStatus($conn, $_GET['bid']);
			if($uid!=""){
				header("Location: ".$obj->rootpath($conn)."/profile/myBookings/1/");
			} else {
				header("Location: ".$obj->rootpath($conn)."/conformBooking/".$_GET['bid']."/done");
			}
		}
	} 
	if($_GET['status']=="done"){
		$message='
			<table style="width:100%; border-spacing:0;">
			<tr style="background: #fafafa;"><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Name</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['name'].'</td></tr>
			<tr><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Email</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['email'].'</td></tr>
			<tr style="background: #fafafa;"><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Pickup From</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['pickfrom'].'</td></tr>
			<tr><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Drop To</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['dropto'].'</td></tr>
			<tr style="background: #fafafa;"><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Pickup Date</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['pickdate'].'</td></tr>
			<tr><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Pickup Time</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['picktime'].'</td></tr>
			<tr style="background: #fafafa;"><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Mobile</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['mobile'].'</td></tr>
			<tr><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Address</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">'.$booking['address'].'</td></tr>
			<tr style="background: #fafafa;"><td style="padding: 10px; border-top: 1px solid #ccc;"><b>Fare</b></td><td style="padding: 10px; border-top: 1px solid #ccc;">$'.$booking['fare'].'</td></tr>
			</table>
		';
		$obj->sendBookingDetails($conn, $booking['email'], $mail, $message, $themeColors);
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['conformYourBooking']; ?></div>

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
						<button type="submit" name="addBalance" class="btn btn-primary btn-block"><i class="fa fa-paypal"></i> <?php echo $language['payNow']; ?></button>
						<a href="<?php echo $obj->rootpath($conn); ?>/conformBooking/<?php echo $_GET['bid']; ?>/done" class="btn btn-default btn-block"><?php echo $language['payCashToDriver']; ?></a>
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