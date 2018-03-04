<?php 
	include '../functions.php';
?> 

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $obj->title($conn); ?></title>
		<link rel="icon" href="<?php echo $obj->rootpath($conn); ?>/uploads/images/<?php echo $obj->favicon($conn); ?>" sizes="32x32">
		<link href="<?php echo $obj->rootpath($conn); ?>/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $obj->rootpath($conn); ?>/css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo $obj->rootpath($conn); ?>/css/jquery-ui.css" rel="stylesheet" />
		<link href="<?php echo $obj->rootpath($conn); ?>/css/action.css" rel="stylesheet">
		<link href="<?php echo $obj->rootpath($conn); ?>/css/adminStyle.css" rel="stylesheet">
	</head>
	<body>
	   <div id="wrapper">