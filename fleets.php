<?php 
	include 'include/header.php';  
?>	
	</div>
</div>

<div class="page-heading"><?php echo $language['fleets'];?></div>

<div class="container">
	<div class="row">
		<?php echo $obj->fleets($conn); ?>
<?php 
	include 'include/footer.php'; 
?>