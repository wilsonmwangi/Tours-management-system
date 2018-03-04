<?php 
include 'functions.php';
include 'include/language/English.php';
$logedInUser=$obj->getLogedInuserDetails($conn, $_SESSION['sessionEmail']);
$uid=$logedInUser['id'];
if(isset($_POST['getFare'])){
	$pickfrom=$_POST['pickfrom'];
	$dropto=$_POST['dropto'];
	$fleet=$_POST['fleet'];
	echo $fare=$obj->getFare($conn, $pickfrom, $dropto, $fleet);
} else if(isset($_POST['saveBooking'])){
	$pickdate=$_POST['pickdate'];
	$picktime=$_POST['picktime'];
	$pickfrom=$_POST['pickfrom'];
	$dropto=$_POST['dropto'];
	$fleet=$_POST['fleet'];
	$fare=$obj->getFare($conn, $pickfrom, $dropto, $fleet);
	if($uid=="")$uid=0;
	echo $bid=$obj->addBooking($conn, $uid, $pickdate, $picktime, $pickfrom, $dropto, $fleet, $fare, "0", "0", "0", "0", "0");
} else if(isset($_POST['notiCountReload'])){
	echo $obj->notificationCount($conn);
} else if(isset($_POST['notiReload'])){
	echo $obj->bookingsNotification($conn);
} else if(isset($_POST['notiChecked'])){
	echo $obj->notiChecked($conn, $_POST['id']);
}
?>