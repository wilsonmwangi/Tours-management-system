<?php 
	header("Content-type: text/css");
	include '../functions.php';
	$theme=$obj->getThemeColors($conn);
?>

.loaderBG{
	background-color:<?php echo $theme['defaultColor']; ?>;
}

.navbar{
	background-color:<?php echo $theme['dark']; ?>;
}

.bootstrap-datetimepicker-widget td.active:active, .bootstrap-datetimepicker-widget td.active:hover:active, .bootstrap-datetimepicker-widget td.active.active, .bootstrap-datetimepicker-widget td.active:hover.active{
	background-color: <?php echo $theme['defaultColor']; ?>!important;
}

.bootstrap-datetimepicker-widget td.active, .bootstrap-datetimepicker-widget td.active:hover{
	background-image:none;
}

.btn-primary{
	background-color: <?php echo $theme['defaultColor']; ?>!important;
	border-color:<?php echo $theme['dark']; ?>!important;
}

.page-heading{
	background-color: <?php echo $theme['defaultColor']; ?>;
}

.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after{
	background-color: <?php echo $theme['dark']; ?>!important;
}

.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus{
	background-color:<?php echo $theme['dark']; ?>!important;
	border-color:<?php echo $theme['dark']; ?>!important;
}

.form-control:hover, .form-control:focus, .cke_chrome:hover,.cke_chrome:focus, .fleetsList .btn:hover, .fleetsList .btn:focus{
	border-color:<?php echo $theme['dark']; ?>!important;
}

em{
	color:<?php echo $theme['dark']; ?>!important;
}

hr{
	border-top: 1px dotted <?php echo $theme['dark']; ?>!important;
}

.btn-success{
	background-color:<?php echo $theme['success']; ?>!important;
}

.btn-warning{
	background-color:<?php echo $theme['warning']; ?>!important;
}

.btn-info{
	background-color:<?php echo $theme['info']; ?>!important;
}

.btn-danger{
	background-color:<?php echo $theme['danger']; ?>!important;
}

.text-success{
	background-color:<?php echo $theme['successText']; ?>!important;
}

.text-danger{
	background-color:<?php echo $theme['dangerText']; ?>!important;
}

.text-warning{
	background-color:<?php echo $theme['warningText']; ?>!important;
}

.text-info{
	background-color:<?php echo $theme['infoText']; ?>!important;
}

.navbar-default .navbar-toggle{
	background-color:<?php echo $theme['dark']; ?>!important;
	color:#fff;
}

.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
	background-color:#fff!important;
	color:<?php echo $theme['dark']; ?>!important;
	border-bottom:1px solid;
}

.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus{
	background-color:<?php echo $theme['dark']; ?>!important;
	border-color:<?php echo $theme['dark']; ?>!important;
}