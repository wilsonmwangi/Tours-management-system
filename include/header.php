<?php 
	include 'functions.php'; 
	include 'include/language/English.php';
	$shareUser=$obj->getPublicPortfolio($conn, $_GET['eid']);
	$page=$obj->getPageDetails($conn,$_GET['pid']);
	$logedInUser=$obj->getLogedInuserDetails($conn, $_SESSION['sessionEmail']);
	$uid=$logedInUser['id'];
	if(!isset($_SESSION['uniqueHits'])) {
		$_SESSION['uniqueHits']='1';
		$obj->hits($conn);
	}
	$obj->views($conn);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="<?php echo $obj->description($conn); ?>">
		<meta name="keywords" content="<?php echo $obj->keywords($conn); ?>">
		<meta property="og:title" content="<?php echo $shareUser['name']; ?>"/>
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo $obj->rootpath($conn); ?>/externalPortfolio/<?php echo $shareUser['id']; ?>" />
		<meta property="og:image" content="<?php echo $obj->rootpath($conn); ?>/images/dps/<?php echo $shareUser['dp']; ?>">
		<meta property="og:description" content="<?php echo $shareUser['about']; ?>" /> 
		<?php if(basename($_SERVER['PHP_SELF'])=="index.php"){ ?>
		<title><?php echo $obj->title($conn); ?></title>
		<?php } else if(basename($_SERVER['PHP_SELF'])=="page.php"){ ?>
		<title><?php echo $obj->title($conn)." - ".$page['title']; ?></title>
		<?php } else { ?>
		<title><?php echo $obj->title($conn)." - ".substr(basename($_SERVER['PHP_SELF']),0,-4); ?></title>
		<?php } ?>
		<link rel="icon" href="<?php echo $obj->rootpath($conn); ?>/uploads/images/<?php echo $obj->favicon($conn); ?>" sizes="32x32">
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/action.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/style.css" />
		<link rel="stylesheet" href="<?php echo $obj->rootpath($conn); ?>/css/theme.php" />
	</head>
	<body>
		<div class="loaderBG">
			<div class="loader"></div>
		</div>
		<nav class="navbar navbar-default">
		<a href="<?php echo $obj->rootpath($conn); ?>/" class="navbar-brand">
		<img class="img-responsive" src="<?php echo $obj->rootpath($conn); ?>/uploads/images/<?php echo $obj->logo($conn); ?>" /></a>
		<div class="menu">
			<?php if($logedInUser['email']==""){ ?>
				<a href="<?php echo $obj->rootpath($conn);?>/login"><i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $language['account']; ?></span></a>
			<?php } else { ?>
				<a href="<?php echo $obj->rootpath($conn);?>/profile/myBookings/1/"><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/dps/<?php echo $logedInUser['dp']; ?>" /> <span class="hidden-xs"><?php $Fname= explode(' ',$logedInUser['name']); echo $Fname[0]; ?></span></a>	
			<?php } ?>
			<a href="<?php echo $obj->rootpath($conn); ?>/makeABooking"><i class="fa fa-calendar-check-o"></i> <span class="hidden-xs"><?php echo $language['bookings']; ?></span></a>
			<a href="<?php echo $obj->rootpath($conn); ?>/fleets"><i class="fa fa-car"></i> <span class="hidden-xs"><?php echo $language['fleets']; ?></span></a>
			<!-- <a href="<?php echo $obj->rootpath($conn); ?>/career/1/"><i class="fa fa-search"></i> <span class="hidden-xs"><?php echo $language['career']; ?></span></a> -->
			<a href="<?php echo $obj->rootpath($conn); ?>/contact"><i class="fa fa-envelope"></i> <span class="hidden-xs"><?php echo $language['contact']; ?></span></a>
		</div>
	</nav>
	<div class="site">
		<div class="container">
			<div class="row">