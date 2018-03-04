<?php 
	include 'include/header.php';	
	$page=1;
	$limit=10;
	$next=2;
	$prev=1; 
	if(isset($_GET['srch']) && $_GET['srch']!="")
		$sql = $conn->prepare("SELECT COUNT(*) FROM fares WHERE pickfrom LIKE '%".$_GET['srch']."%' OR dropto LIKE '%".$_GET['srch']."%'");
	else
		$sql = $conn->prepare("SELECT COUNT(*) FROM fares");
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
	if(isset($_GET['deleteFares'])){
		$obj->deleteFares($conn, $_GET['deleteFares']);
		header("Location: manageFares.php");
	}
	if($_GET['values']){
		$values = explode(",",$_GET['values']);
		foreach($values as $value){
			$obj->deleteFares($conn, $value);
		}
		header("Location: manageFares.php");
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-money"></i> Manage Fares
	</div>
	<div class="panel-body">
		<div class="col-md-8 col-xs-12">
			<a href="addFare.php" class="btn btn-success btn-new" title="Add New"><i class="fa fa-plus"></i> Add New</a>
			<button class="btn btn-danger btn-ds deleteSelected" id="deleteSelectedFares" title="Delete"><i class="fa fa-trash"></i> Delete Selected</button>
		</div>
		<div class="col-md-4 col-xs-12">
			<form method="GET" class="pull-right">
				<div class="input-group">
					<input type="text" name="srch" class="form-control search-field" value="<?php echo $_GET['srch']; ?>" placeholder="Find a Fare">
				<span class="input-group-btn">
				<button type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i></button>
				</span>
				</div>
			</form>
		</div>
	<?php if($rows>0) { ?>
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered">
				<thead><th><input type="checkBox" id="checkAll" /> From</th><th>To</th><th>Fleet</th><th>Fare</th><th class="text-center">Action</th></thead>
					<?php 
					$start = ($page-1)*$limit;
					echo $obj->manageFares($conn, $_GET['srch'], $start, $limit); 
					?>
				</table>
			</div>	
			<ul class="pagination">
			<?php if($prev==1) { ?>
				<li><span><i class="fa fa-chevron-left"></i></span></li>
				<?php } else { ?>
				<li><a href="manageFares.php?srch=<?php echo $_GET['srch']; ?>&page=<?php echo $prev; ?>"><i class="fa fa-chevron-left"></i></a></li>
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
				echo '<li class="active accent"><a href="manageFares.php?srch='.$_GET['srch'].'&page='.$i.'">'.$i.'</a></li>';
				} else {
				echo'<li><a href="manageFares.php?srch='.$_GET['srch'].'&page='.$i.'">'.$i.'</a></li>';
				}
				} 
				if($page==$last) { ?>
				<li><span><i class="fa fa-chevron-right"></i></span></li>
				<?php } else { ?>
				<li><a href="manageFares.php?srch=<?php echo $_GET['srch']; ?>&page=<?php echo $next;?>"><i class="fa fa-chevron-right"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	<?php } else { ?>
		<div class="col-xs-12">
			<div class="notFound">
			<i class="fa fa-folder-o"></i> Nothing to show here
			</div>
		</div>
	<?php } ?>
	</div>
</div>		

<?php 
	include 'include/footer.php';
?>