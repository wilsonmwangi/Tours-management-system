<?php
	if($_SESSION['sessionID']==""){
		header("Location: login.php");	
	} else {
?>
<nav class="navbar navbar-default navbar-static-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-ellipsis-h"></i></button>
		<a class="navbar-brand" href="<?php echo $obj->rootpath($conn); ?>/admin/"><img src="../uploads/images/<?php echo $obj->logo($conn); ?>" /> <?php echo $obj->title($conn); ?></a>
	</div>
	<ul class="nav navbar-top-links navbar-right">
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<input type="hidden" id="oldNotiCount" value="<?php echo $obj->notificationCount($conn); ?>" />
		<i class="fa fa-bell fa-fw"></i>  <span class="notiCount">
		<?php 
		if($obj->notificationCount($conn)<99){
			echo $obj->notificationCount($conn);
		} else {
			echo "99+";
		}
			
		?>
		</span></a>
		<ul class="dropdown-menu dropdown-alerts notifications">
			<?php echo $obj->bookingsNotification($conn); ?>
		</ul>
		</li>
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="fa fa-plus fa-fw"></i>  <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-alerts">
			<li><a href="addSubAdmin.php"><div><i class="fa fa-plus fa-fw"></i> Add New Administrator</div></a></li>
			<li class="divider"></li>
			<li><a href="composeEmail.php"><div><i class="fa fa-plus fa-fw"></i> Compose an Email</div></a></li>
			<li class="divider"></li>
			<li><a href="addPage.php"><div><i class="fa fa-plus fa-fw"></i> Add  a Page</div></a></li>
			<li class="divider"></li>
			<li><a href="addLocation.php"><div><i class="fa fa-plus fa-fw"></i> Add  a Location</div></a></li>
			<li class="divider"></li>
			<li><a href="addFleet.php"><div><i class="fa fa-plus fa-fw"></i> Add  a Fleet</div></a></li>
			<li class="divider"></li>
			<li><a href="addFare.php"><div><i class="fa fa-plus fa-fw"></i> Add  a Fare</div></a></li>
			<li class="divider"></li>
			<li><a href="addJob.php"><div><i class="fa fa-plus fa-fw"></i> Add  a Job</div></a></li>
		</ul>
		</li>
		<li class="dropdown hidden-xs">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-messages">
		<?php echo $obj->emailNotifications($conn); ?>
		<li>
		<a class="text-center" href="manageInbox.php">
		<strong>Read All Messages</strong>
		<i class="fa fa-angle-right"></i>
		</a>
		</li>
		</ul>
		</li>
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
		<li><a href="loginSettings.php"><i class="fa fa-user fa-fw"></i> Login Settings</a>
		</li>
		<li><a href="manageGenralSettings.php"><i class="fa fa-cogs fa-fw"></i> General Settings</a>
		</li>
		<li class="divider"></li>
		<li><a href="index.php?logOut=yes"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		</li>
		</ul>
		</li>
		<li><a href="../" title="Visit Website"><i class="fa fa-external-link"></i></a></li>
	</ul>
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav collapse navbar-collapse">
			<ul class="nav" id="side-menu">
				<?php if(basename($_SERVER['PHP_SELF'])=="index.php"){
				echo '<li><a href="index.php" class="active">Dashboard <i class="fa fa-dashboard fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="index.php">Dashboard <i class="fa fa-dashboard fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageGenralSettings.php"){
				echo '<li><a href="manageGenralSettings.php" class="active">General Settings <i class="fa fa-cogs fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageGenralSettings.php">General Settings <i class="fa fa-cogs fa-fw pull-right"></i></a></li>';
				}
				if($obj->getAdminType($conn, $_SESSION['sessionID'])=="super-Admin"){
					if(basename($_SERVER['PHP_SELF'])=="manageSubAdmin.php" or basename($_SERVER['PHP_SELF'])=="addSubAdmin.php" or basename($_SERVER['PHP_SELF'])=="editSubAdmin.php"){
					echo '<li><a href="manageSubAdmin.php" class="active">Administrators <i class="fa fa-users fa-fw pull-right"></i></a></li>';
					} else {
					echo '<li><a href="manageSubAdmin.php">Administrators <i class="fa fa-users fa-fw pull-right"></i></a></li>';
					}
				}
				if(basename($_SERVER['PHP_SELF'])=="manageInbox.php" or basename($_SERVER['PHP_SELF'])=="viewMail.php" or basename($_SERVER['PHP_SELF'])=="composeEmail.php"){
				echo '<li><a href="manageInbox.php" class="active">Inbox <i class="fa fa-inbox fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageInbox.php">Inbox <i class="fa fa-inbox fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manegeTheme.php"){
				echo '<li><a href="manegeTheme.php" class="active">Theme Settings <i class="fa fa-flask fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manegeTheme.php">Theme Settings <i class="fa fa-flask fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageSocial.php"){
				echo '<li><a href="manageSocial.php" class="active">Social Profiles <i class="fa fa-globe fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageSocial.php">Social Profiles <i class="fa fa-globe fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="managePages.php" or basename($_SERVER['PHP_SELF'])=="addPage.php" or basename($_SERVER['PHP_SELF'])=="editPage.php"){
				echo '<li><a href="managePages.php" class="active">Pages <i class="fa fa-files-o fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="managePages.php">Pages <i class="fa fa-files-o fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageUsers.php" or basename($_SERVER['PHP_SELF'])=="editUser.php" or basename($_SERVER['PHP_SELF'])=="addBalanceAdmin.php"){
				echo '<li><a href="manageUsers.php" class="active">Users <i class="fa fa-users fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageUsers.php">Users <i class="fa fa-users fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageLocations.php" or basename($_SERVER['PHP_SELF'])=="addLocation.php" or basename($_SERVER['PHP_SELF'])=="editLocation.php"){
				echo '<li><a href="manageLocations.php" class="active">Locations <i class="fa fa-map-marker fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageLocations.php">Locations <i class="fa fa-map-marker fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageFleets.php" or basename($_SERVER['PHP_SELF'])=="addFleet.php" or basename($_SERVER['PHP_SELF'])=="editFleet.php"){
				echo '<li><a href="manageFleets.php" class="active">Fleets <i class="fa fa-car fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageFleets.php">Fleets <i class="fa fa-car fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageFares.php" or basename($_SERVER['PHP_SELF'])=="addFare.php" or basename($_SERVER['PHP_SELF'])=="editFare.php"){
				echo '<li><a href="manageFares.php" class="active">Fares <i class="fa fa-money fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageFares.php">Fares <i class="fa fa-money fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageBookings.php" or basename($_SERVER['PHP_SELF'])=="viewBooking.php"){
				echo '<li><a href="manageBookings.php" class="active">Bookings <i class="fa fa-check fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageBookings.php">Bookings <i class="fa fa-check fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="manageJobs.php" or basename($_SERVER['PHP_SELF'])=="editJob.php"){
				echo '<li><a href="manageJobs.php" class="active">Jobs <i class="fa fa-briefcase fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="manageJobs.php">Jobs <i class="fa fa-briefcase fa-fw pull-right"></i></a></li>';
				}
				if(basename($_SERVER['PHP_SELF'])=="paypal.php"){
				echo '<li><a href="paypal.php" class="active">Paypal <i class="fa fa-paypal fa-fw pull-right"></i></a></li>';
				} else {
				echo '<li><a href="paypal.php">Paypal <i class="fa fa-paypal fa-fw pull-right"></i></a></li>';
				} 
				echo '<li><a href="index.php?logOut=yes">Logout <i class="fa fa-sign-out fa-fw pull-right"></i></a></li>';
				?>
			</ul>
		</div>
	</div>
</nav>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
		<audio id="notiSound" controls>
		  <source src="<?php echo $obj->rootpath($conn); ?>/uploads/noti.mp3" type="audio/mp3">
		</audio>
<?php
	}
?>