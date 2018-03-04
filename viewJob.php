<?php 
	include 'include/header.php';
	$job=$obj->getJobDetails($conn, $_GET['jid']);
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['career']; ?> / <small><?php echo $language['view']; ?></small></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<h3><?php echo $job['title']; ?> <small>(<?php echo $job['status']; ?>)</small></h3>
			<p><?php echo $job['details']; ?></p>
			<p><b><?php echo $language['location']; ?></b> : <?php echo $job['location']; ?></p>
			<p><b><?php echo $language['salary']; ?></b> : <?php echo $job['salary']; ?></p>
			<hr>
			<a href="<?php echo $obj->rootpath($conn); ?>/apply/<?php echo $_GET['jid']; ?>/" class="btn btn-success"><?php echo $language['apply']; ?></a>
			<a href="<?php echo $obj->rootpath($conn); ?>/career/1/" class="btn btn-default"><?php echo $language['back']; ?></a>
		</div>
	</div>
</div>
			

<?php 
	include 'include/footer.php';
?>