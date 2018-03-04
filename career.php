<?php 
	include 'include/header.php';
	$page=1;
	$limit=10;
	$next=2;
	$prev=1; 
	if(isset($_GET['srch']) && $_GET['srch']!="")
		$sql = $conn->prepare("SELECT COUNT(*) FROM jobs WHERE title LIKE '%".$_GET['srch']."%'");
	else
		$sql = $conn->prepare("SELECT COUNT(*) FROM jobs");
	$sql->execute();
	$rows = $sql->fetchColumn();
	$last = ceil($rows/$limit);
	if(isset($_GET['page']) && $_GET['page']!='' && ($_GET['page']>=1 && $_GET['page']<=$last)) {
		$page=$_GET['page'];
		if($page>1)
			$prev=$page-1;
		else
			$prev=$page;
		if($page<$last)
			$next=$page+1;
		else
			$next=$page;
	}
?>

	</div>
</div>

<div class="page-heading"><?php echo $language['career']; ?></div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12">
			<button class="btn btn-danger btn-ds deleteSelected" id="deleteSelectedJobs" title="Delete"><?php echo $language['deleteSelected']; ?></button>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="pull-right">
				<div class="input-group">
					<input type="text" name="srch" class="form-control job-search-field" value="<?php echo $_GET['srch']; ?>" placeholder="<?php echo $language['findAJob']; ?>">
				<span class="input-group-btn">
				<button type="submit" class="btn btn-success btn-search-job"><i class="fa fa-search"></i></button>
				</span>
				</div>
			</div>
		</div>
	<?php if($rows>0) { ?>
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered">
					<thead><th><?php echo $language['jobTitle']; ?></th><th><?php echo $language['location']; ?></th><th><?php echo $language['salary']; ?></th><th class="text-center"><?php echo $language['action']; ?></th><thead>
					<tbody>
						<?php 
						$start = ($page-1)*$limit;
						echo $obj->jobs($conn, $_GET['srch'], $start, $limit, $language); 
						?>
					</tbody>
				</table>
			</div>
			<ul class="pagination">
			<?php if($prev==1) { ?>
				<li><span><i class="fa fa-chevron-left"></i></span></li>
				<?php } else { ?>
				<li><a href="<?php echo $obj->rootpath($conn); ?>/career/<?php echo $prev; ?>/<?php echo $_GET['srch']; ?>"><i class="fa fa-chevron-left"></i></a></li>
				<?php } if ($page>1 && $last>4) {
				$i=((int)$page/4)*4-1;
				if (!($i+4>$last)) {
				$temp_last = $i+4;
				} else {
				$i = $last - 4;
				$temp_last = $last;
				}
				} else {
				$i=1;
				if (!($i+4>$last)) {
				$temp_last = 4;
				} else {
				$temp_last = $last;
				}
				}
				for ($i; $i<=$temp_last; $i++) {
				if ($i==$page) {
				echo '<li class="active accent"><a href="'.$obj->rootpath($conn).'/career/'.$i.'/'.$_GET['srch'].'">'.$i.'</a></li>';
				} else {
				echo'<li><a href="'.$obj->rootpath($conn).'/career/'.$i.'/'.$_GET['srch'].'">'.$i.'</a></li>';
				}
				} 
				if($page==$last) { ?>
				<li><span><i class="fa fa-chevron-right"></i></span></li>
				<?php } else { ?>
				<li><a href="<?php echo $obj->rootpath($conn); ?>/career/<?php echo $next; ?>/<?php echo $_GET['srch']; ?>"><i class="fa fa-chevron-right"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	<?php } else { ?>
		<div class="col-xs-12">
			<div class="notFound">
			<i class="fa fa-folder-o"></i> <?php echo $language['nothingToShowHere']; ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>		

<?php 
	include 'include/footer.php';
?>