<?php 
	include 'include/header.php';
	$page=$obj->getPageDetails($conn,$_GET['pid']);
?>

	</div>
</div>

<div class="page-heading"><?php echo $page['title']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-xs-12">
			<p>
				<?php echo $page['contents']; ?> 
			</p>
		</div>
	</div>
</div>

<?php 
	include 'include/footer.php'; 
?>